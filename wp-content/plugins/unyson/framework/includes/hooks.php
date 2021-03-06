<?php if (!defined('FW')) die('Forbidden');
/**
 * Filters and Actions
 */

/**
 * Option types
 */
{
	/**
	 * @internal
	 */
	function _action_fw_init_option_types() {
		require_once dirname(__FILE__) .'/option-types/init.php';
	}
	add_action('fw_option_types_init', '_action_fw_init_option_types');

	/**
	 * Some option-types have add_action('wp_ajax_...')
	 * so init all option-types if current request is ajax
	 * @since 2.6.1
	 */
	if (defined('DOING_AJAX') && DOING_AJAX) {
		function _action_fw_init_option_types_on_ajax() {
			fw()->backend->option_type('text');
		}
		add_action('fw_init', '_action_fw_init_option_types_on_ajax');
	}

	/**
	 * Prevent Fatal Error if someone is registering option-types in old way (right away)
	 * not in 'fw_option_types_init' action
	 * @param string $class
	 */
	function _fw_autoload_option_types($class) {
		if ('FW_Option_Type' === $class) {
			require_once dirname(__FILE__) .'/../core/extends/class-fw-option-type.php';

			if (is_admin() && defined('WP_DEBUG') && WP_DEBUG) {
				FW_Flash_Messages::add(
					'option-type-register-wrong',
					__("Please register option-types on 'fw_option_types_init' action", 'fw'),
					'warning'
				);
			}
		} elseif ('FW_Container_Type' === $class) {
			require_once dirname(__FILE__) .'/../core/extends/class-fw-container-type.php';

			if (is_admin() && defined('WP_DEBUG') && WP_DEBUG) {
				FW_Flash_Messages::add(
					'container-type-register-wrong',
					__("Please register container-types on 'fw_container_types_init' action", 'fw'),
					'warning'
				);
			}
		}
	}
	spl_autoload_register('_fw_autoload_option_types');
}

/**
 * Container types
 */
{
	/**
	 * @internal
	 */
	function _action_fw_init_container_types() {
		require_once dirname(__FILE__) .'/container-types/init.php';
	}
	add_action('fw_container_types_init', '_action_fw_init_container_types');
}

/**
 * Custom Github API service
 * Provides the same responses but is "unlimited"
 * To prevent error: Github API rate limit exceeded 60 requests per hour
 * https://github.com/ThemeFuse/Unyson/issues/138
 * @internal
 */
function _fw_filter_github_api_url($url) {
	return 'http://github-api-cache.unyson.io';
}
add_filter('fw_github_api_url', '_fw_filter_github_api_url');

/**
 * Javascript events related to tinymce init
 * @since 2.6.0
 */
{
	add_action('wp_tiny_mce_init', '_fw_action_tiny_mce_init');
	function _fw_action_tiny_mce_init($mce_settings) {
?>
<script type="text/javascript">
	if (typeof fwEvents != 'undefined') { fwEvents.trigger('fw:tinymce:init:before'); }
</script>
<?php
	}

	add_action('after_wp_tiny_mce', '_fw_action_after_wp_tiny_mce');
	function _fw_action_after_wp_tiny_mce($mce_settings) {
?>
<script type="text/javascript">
	if (typeof fwEvents != 'undefined') { fwEvents.trigger('fw:tinymce:init:after'); }
</script>
<?php
	}
}

// FW_Form hooks
{
	if ( is_admin() ) {
		/**
		 * Display form errors in admin side
		 * @internal
		 */
		function _action_fw_form_show_errors_in_admin() {
			$form = FW_Form::get_submitted();

			if ( ! $form || $form->is_valid() ) {
				return;
			}

			foreach ( $form->get_errors() as $input_name => $error_message ) {
				FW_Flash_Messages::add( 'fw-form-admin-' . $input_name, $error_message, 'error' );
			}
		}
		add_action( 'wp_loaded', '_action_fw_form_show_errors_in_admin', 111 );
	} else {
		/**
		 * to disable this use remove_action('wp_print_styles', '_action_fw_form_frontend_default_styles');
		 * @internal
		 */
		function _action_fw_form_frontend_default_styles() {
			$form = FW_Form::get_submitted();

			if ( ! $form || $form->is_valid() ) {
				return;
			}

			echo '<style type="text/css">.fw-form-errors { color: #bf0000; }</style>';
		}
		add_action( 'wp_print_styles', '_action_fw_form_frontend_default_styles' );
	}
}

// FW_Flash_Messages hooks
{
	if (is_admin()) {
		/**
		 * Start the session before the content is sent to prevent the "headers already sent" warning
		 * @internal
		 */
		function _action_fw_flash_message_backend_prepare() {
			if (!session_id()) {
				session_start();
			}
		}
		add_action('current_screen', '_action_fw_flash_message_backend_prepare', 9999);

		/**
		 * Display flash messages in backend as notices
		 */
		add_action( 'admin_notices', array( 'FW_Flash_Messages', '_print_backend' ) );
	} else {
		/**
		 * Start the session before the content is sent to prevent the "headers already sent" warning
		 * @internal
		 */
		function _action_fw_flash_message_frontend_prepare() {
			if (
				/**
				 * In ajax it's not possible to call flash message after headers were sent,
				 * so there will be no "headers already sent" warning.
				 * Also in the Backups extension, are made many internal ajax request,
				 * each creating a new independent request that don't remember/use session cookie from previous request,
				 * thus on server side are created many (not used) new sessions.
				 */
				!(defined('DOING_AJAX') && DOING_AJAX)
				&&
				!session_id()
			) {
				session_start();
			}
		}
		add_action('send_headers', '_action_fw_flash_message_frontend_prepare', 9999);

		/**
		 * Print flash messages in frontend if this has not been done from theme
		 */
		function _action_fw_flash_message_frontend_print() {
			if (FW_Flash_Messages::_frontend_printed()) {
				return;
			}

			if (!FW_Flash_Messages::_print_frontend()) {
				return;
			}

			?>
			<script type="text/javascript">
				(function(){
					if (typeof jQuery === "undefined") {
						return;
					}

					jQuery(function($){
						var $container;

						// Try to find the content element
						{
							var selector, selectors = [
								'#main #content',
								'#content #main',
								'#main',
								'#content',
								'#content-container',
								'#container',
								'.container:first'
							];

							while (selector = selectors.shift()) {
								$container = $(selector);

								if ($container.length) {
									break;
								}
							}
						}

						if (!$container.length) {
							// Try to find main page H1 container
							$container = $('h1:first').parent();
						}

						if (!$container.length) {
							// If nothing found, just add to body
							$container = $(document.body);
						}

						$(".fw-flash-messages").prependTo($container);
					});
				})();
			</script>
			<style type="text/css">
				.fw-flash-messages .fw-flash-type-error { color: #f00; }
				.fw-flash-messages .fw-flash-type-warning { color: #f70; }
				.fw-flash-messages .fw-flash-type-success { color: #070; }
				.fw-flash-messages .fw-flash-type-info { color: #07f; }
			</style>
			<?php
		}
		add_action('wp_footer', '_action_fw_flash_message_frontend_print', 9999);
	}
}

// FW_Resize hooks
{
	if ( ! function_exists( 'fw_delete_resized_thumbnails' ) ) {
		function fw_delete_resized_thumbnails( $id ) {
			$images = wp_get_attachment_metadata( $id );
			if ( ! empty( $images['resizes'] ) ) {
				$uploads_dir = wp_upload_dir();
				foreach ( $images['resizes'] as $image ) {
					$file = $uploads_dir['basedir'] . '/' . $image;
					@unlink( $file );
				}
			}
		}

		add_action( 'delete_attachment', 'fw_delete_resized_thumbnails' );
	}
}
