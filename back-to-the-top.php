<?php
/*
Plugin Name: Back to the Top
Plugin URI: https://github.com/thingsym/back-to-the-top
Description: Back to the Top is a WordPress plugin to return to scroll smoothly to the top of the page. You can scroll to the smooth anchor link in the page.
Version: 1.0.0
Author: thingsym
Author URI: http://www.thingslabo.com/
License: GPL2
Text Domain: backtothetop
Domain Path: /languages/
*/

/*
    Copyright 2015 thingsym (http://www.thingslabo.com/)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110, USA
*/

class Back_to_the_Top {

	public function __construct() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_filter( 'option_page_capability_back_to_the_top', array( $this, 'option_page_capability' ) );
		add_action( 'admin_menu', array( $this, 'add_option_page' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_footer', array( $this, 'add_backtothetop' ) );

		register_uninstall_hook( __FILE__, array( __CLASS__, 'uninstall' ) );
	}

	public function admin_init() {
		if ( false === $this->get_options() ) {
			add_option( 'back_to_the_top_options' );
		}

		register_setting(
			'back_to_the_top',
			'back_to_the_top_options',
			array( $this, 'validate' )
		);
	}

	public function uninstall() {
		delete_option( 'back_to_the_top_options' );
	}

	public function option_page_capability( $capability ) {
		return 'edit_theme_options';
	}

	public function add_option_page() {
		load_plugin_textdomain( 'backtothetop', false, 'back-to-the-top/languages' );

		add_filter( 'plugin_action_links', array( $this, 'plugin_action_links' ), 10, 2 );

		$page_hook = add_theme_page(
			__( 'Back to the Top', 'backtothetop' ),
			__( 'Back to the Top', 'backtothetop' ),
			'manage_options',
			'backtothetop',
			array( $this, 'render_option_page' )
		);

		if ( empty( $page_hook ) ) {
			return;
		}

		add_action( 'load-' . $page_hook, array( $this, 'page_hook_suffix' ) );
	}

	public function page_hook_suffix() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_styles' ) );
	}

	public function admin_enqueue_scripts() {
		wp_enqueue_script( 'backtothetop-icon', plugins_url() . '/back-to-the-top/backtothetop.admin.js', array( 'jquery', 'wp-color-picker' ), '2015-02-25', true );
	}

	public function admin_enqueue_styles() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style('dashicons');
		wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', false, '2015-05-12' );

	}

	function plugin_action_links( $links, $file ) {
		if ( $file != plugin_basename( __FILE__ ) ) {
			return $links;
		}

		$settings_link = '<a href="themes.php?page=backtothetop">' . __( 'Settings', 'backtothetop' ) . '</a>';

		array_unshift( $links, $settings_link );

		return $links;
	}

	public function get_default_options() {
		$default_options = array(
			'duration' => 400,
			'easing' => 'swing',
			'offset' => 0,
			'fixed-scroll-offset' => 0,
			'fixed-fadeIn' => 800,
			'fixed-fadeOut' => 800,
			'fixed-display' => 'bottom-right',
			'fixed-top' => 0,
			'fixed-bottom' => 0,
			'fixed-left' => 0,
			'fixed-right' => 0,

			'label' => '<i class="dashicons dashicons-arrow-up-alt2"></i><br>Back to the Top',
			'font-size' => 140,
			'font-weight' => 400,
			'font-color' => 'f00',
			'font-hover-color' => 'f00',
			'custom-css' => '',
		);

		return apply_filters( 'back_to_the_top_get_default_options', $default_options );
	}

	public function get_options() {
		$options = get_option( 'back_to_the_top_options', $this->get_default_options() );
		$default_options = $this->get_default_options();

		foreach ( $default_options as $key => $value ) {
			if ( ! isset( $options[ $key ] ) ) {
				$options[ $key ] = $value;
			}
		}

		return apply_filters( 'back_to_the_top_get_options', $options );
	}

	public function render_option_page() {
		?>
		<div class="wrap">
			<div id="icon-themes" class="icon32"><br></div>
			<h2><?php printf( __( 'Back to the Top', 'backtothetop' ), wp_get_theme()->get( 'Name' ) ); ?></h2>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'back_to_the_top' );
					$options = $this->get_options();
				?>
				<table class="form-table">
					<tr><th scope="row"><?php _e( 'Preview', 'backtothetop' ); ?></th>
						<td>
							<legend class="screen-reader-text"><span><?php _e( 'Preview', 'backtothetop' ); ?></span></legend>
							<a href="#" id="backtothetop-fixed" class="backtothetop-viewer"><?php echo esc_html( $options['label'] ); ?></a>
						</td>
					</tr>

					<tr><th scope="row"><?php _e( 'Label', 'backtothetop' ); ?></th>
						<td>
							<legend class="screen-reader-text"><span><?php _e( 'Label', 'backtothetop' ); ?></span></legend>
							<label><input type="text" name="back_to_the_top_options[label]" value="<?php echo esc_attr( $options['label'] ); ?>" size="32"></label>

							<p>
							<a class="icon-maker"><i class="dashicons dashicons-arrow-up-alt2"></i></a>
							<a class="icon-maker"><i class="dashicons dashicons-arrow-up"></i></a>
							<a class="icon-maker"><i class="dashicons dashicons-arrow-up-alt"></i></a>
							<a class="icon-maker"><i class="fa fa-arrow-up"></i></a>
							<a class="icon-maker"><i class="fa fa-chevron-up"></i></a>
							<a class="icon-maker"><i class="fa fa-angle-up"></i></a>
							<a class="icon-maker"><i class="fa fa-angle-double-up"></i></a>
							<a class="icon-maker"><i class="fa fa-arrow-circle-o-up"></i></a>
							<a class="icon-maker"><i class="fa fa-arrow-circle-up"></i></a>
							<a class="icon-maker"><i class="fa fa-chevron-circle-up"></i></a>
							<a class="icon-maker"><i class="fa fa-caret-square-o-up"></i></a>
							<a class="icon-maker"><i class="fa fa-caret-up"></i></a>
							<a class="icon-maker"><i class="fa fa-hand-o-up"></i></a>
							</p>
						</td>
					</tr>
					<tr><th scope="row"><?php _e( 'Font Size', 'backtothetop' ); ?></th>
						<td>
							<legend class="screen-reader-text"><span><?php _e( 'Font Size', 'backtothetop' ); ?></span></legend>
							<label><input type="number" step="10" min="0" name="back_to_the_top_options[font-size]" value="<?php echo esc_attr( $options['font-size'] ); ?>" class="small-text"> <?php _e( '%', 'backtothetop' ); ?></label>
						</td>
					</tr>
					<tr><th scope="row"><?php _e( 'Font Weight', 'backtothetop' ); ?></th>
						<td>
							<legend class="screen-reader-text"><span><?php _e( 'Font Weight', 'backtothetop' ); ?></span></legend>
							<label><input type="number" step="100" min="100" max="900" name="back_to_the_top_options[font-weight]" value="<?php echo esc_attr( $options['font-weight'] ); ?>" class="small-text"></label>
						</td>
					</tr>

					<tr><th scope="row"><?php _e( 'Font Color', 'backtothetop' ); ?></th>
						<td>
							<legend class="screen-reader-text"><span><?php _e( 'Font Color', 'backtothetop' ); ?></span></legend>
							<label><input type="text" name="back_to_the_top_options[font-color]" value="#<?php echo esc_attr( $options['font-color'] ); ?>"></label>
						</td>
					</tr>
					<tr><th scope="row"><?php _e( 'Font Hover Color', 'backtothetop' ); ?></th>
						<td>
							<legend class="screen-reader-text"><span><?php _e( 'Font Hover Color', 'backtothetop' ); ?></span></legend>
							<label><input type="text" name="back_to_the_top_options[font-hover-color]" value="#<?php echo esc_attr( $options['font-hover-color'] ); ?>"></label>
						</td>
					</tr>

					<tr><th scope="row"><?php _e( 'Custom CSS', 'backtothetop' ); ?></th>
						<td>
							<fieldset><legend class="screen-reader-text"><span><?php _e( 'Custom CSS', 'backtothetop' ); ?></span></legend>
								<textarea name="back_to_the_top_options[custom-css]" rows="8" cols="70"><?php echo esc_textarea( $options['custom-css'] ); ?></textarea>
							</fieldset>
						</td>
					</tr>

					<tr><th scope="row"><?php _e( 'Display of the link', 'backtothetop' ); ?></th>
						<td>
							<legend class="screen-reader-text"><span><?php _e( 'Display of the link', 'backtothetop' ); ?></span></legend>

							<div style="display: inline-block;margin-right: 1em;">
							<h4 style="text-align: center;"><?php _e( 'Position', 'backtothetop' ); ?></h4>
							<div style="display: inline-block;text-align: left;"><input type="radio" name="back_to_the_top_options[fixed-display]" value="top-left" <?php checked( 'top-left', $options['fixed-display'] ); ?>></div>
							<div style="display: inline-block;float: right;text-align: right;"><input type="radio" name="back_to_the_top_options[fixed-display]" value="top-right" <?php checked( 'top-right', $options['fixed-display'] ); ?> style="margin-right: 0;"></div>
							<div style="overflow: hidden;width: 110px;height:110px;"><i class="dashicons dashicons-id-alt" style="font-size: 800%;color: #999;line-height: 1;"></i></div>
							<div style="display: inline-block;text-align: left;"><input type="radio" name="back_to_the_top_options[fixed-display]" value="bottom-left" <?php checked( 'bottom-left', $options['fixed-display'] ); ?>></div>
							<div style="display: inline-block;float: right;text-align: right;"><input type="radio" name="back_to_the_top_options[fixed-display]" value="bottom-right"<?php checked( 'bottom-right', $options['fixed-display'] ); ?> style="margin-right: 0;"></div>
							</div>

							<div style="display: inline-block;">
							<h4 style="text-align: center;"><?php _e( 'Margin', 'backtothetop' ); ?></h4>
							<div style="display: block;text-align: center;"><input type="number" step="1" min="0" name="back_to_the_top_options[fixed-top]" value="<?php echo esc_attr( $options['fixed-top'] ); ?>" class="small-text"> px</div>
							<div style="display: inline-block;"><input type="number" step="1" min="0" name="back_to_the_top_options[fixed-left]" value="<?php echo esc_attr( $options['fixed-left'] ); ?>" class="small-text"> px</div>
							<div style="display: inline-block;overflow: hidden;width: 110px;height:110px;vertical-align: middle;"><i class="dashicons dashicons-id-alt" style="font-size: 800%;color: #999;line-height: 1;"></i></div>
							<div style="display: inline-block;text-align: left;"><input type="number" step="1" min="0" name="back_to_the_top_options[fixed-right]" value="<?php echo esc_attr( $options['fixed-right'] ); ?>" class="small-text"> px</div>
							<div style="display: block;text-align: center;"><input type="number" step="1" min="0" name="back_to_the_top_options[fixed-bottom]" value="<?php echo esc_attr( $options['fixed-bottom'] ); ?>" class="small-text"> px</div>
							</div>
						</td>
					</tr>

					<tr><th scope="row"><?php _e( 'Operation period of the animation', 'backtothetop' ); ?></th>
						<td>
							<legend class="screen-reader-text"><span><?php _e( 'Operation period of the animation', 'backtothetop' ); ?></span></legend>
							<label><input type="number" step="100" min="0" name="back_to_the_top_options[duration]" value="<?php echo esc_attr( $options['duration'] ); ?>" class="small-text"> <?php _e( 'ms', 'backtothetop' ); ?></label>
						</td>
					</tr>
					<tr><th scope="row"><?php _e( 'Effects easing', 'backtothetop' ); ?></th>
						<td>
							<legend class="screen-reader-text"><span><?php _e( 'Effects easing', 'backtothetop' ); ?></span></legend>
							<select name="back_to_the_top_options[easing]">
							<?php
								foreach ( $this->get_easings() as $easing ) {
									echo '<option value="' . esc_attr( $easing ) . '" ';
									echo selected( $easing, $options['easing'] );
									echo '>';
									_e( esc_attr( $easing ), 'backtothetop' );
									echo '</option>';
								}
							?>
							</select>
						</td>
					</tr>
					<tr><th scope="row"><?php _e( 'Offset from the reference point of the stop position', 'backtothetop' ); ?></th>
						<td>
							<legend class="screen-reader-text"><span><?php _e( 'Offset from the reference point of the stop position', 'backtothetop' ); ?></span></legend>
							<label><input type="number" step="1" name="back_to_the_top_options[offset]" value="<?php echo esc_attr( $options['offset'] ); ?>" class="small-text"> px</label>
						</td>
					</tr>
					<tr><th scope="row"><?php _e( 'Scroll position to display a link to the top of the page', 'backtothetop' ); ?></th>
						<td>
							<legend class="screen-reader-text"><span><?php _e( 'Scroll position to display a link to the top of the page', 'backtothetop' ); ?></span></legend>
								<label><input type="number" step="1" min="0" name="back_to_the_top_options[fixed-scroll-offset]" value="<?php echo esc_attr( $options['fixed-scroll-offset'] ); ?>" class="small-text"> px</label>
						</td>
					</tr>
					<tr><th scope="row"><?php _e( 'Speed ​​of the fade-in', 'backtothetop' ); ?></th>
						<td>
							<legend class="screen-reader-text"><span><?php _e( 'Speed ​​of the fade-in', 'backtothetop' ); ?></span></legend>
							<label><input type="number" step="100" min="0" name="back_to_the_top_options[fixed-fadeIn]" value="<?php echo esc_attr( $options['fixed-fadeIn'] ); ?>" class="small-text"> <?php _e( 'ms', 'backtothetop' ); ?></label>
						</td>
					</tr>
					<tr><th scope="row"><?php _e( 'Speed ​​of the fade-out', 'backtothetop' ); ?></th>
						<td>
							<legend class="screen-reader-text"><span><?php _e( 'Speed ​​of the fade-out', 'backtothetop' ); ?></span></legend>
							<label><input type="number" step="100" min="0" name="back_to_the_top_options[fixed-fadeOut]" value="<?php echo esc_attr( $options['fixed-fadeOut'] ); ?>" class="small-text"> <?php _e( 'ms', 'backtothetop' ); ?></label>
						</td>
					</tr>

				</table>

				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

	public function get_easings() {
		$easings = array(
			'linear', 'swing', 'jswing', 'easeInQuad', 'easeOutQuad', 'easeInOutQuad',
			'easeInCubic', 'easeOutCubic', 'easeInOutCubic', 'easeInQuart', 'easeOutQuart',
			'easeInOutQuart', 'easeInQuint', 'easeOutQuint', 'easeInOutQuint', 'easeInSine',
			'easeOutSine', 'easeInOutSine', 'easeInExpo', 'easeOutExpo', 'easeInOutExpo',
			'easeInCirc', 'easeOutCirc', 'easeInOutCirc', 'easeInElastic', 'easeOutElastic',
			'easeInOutElastic', 'easeInBack', 'easeOutBack', 'easeInOutBack', 'easeInBounce',
			'easeOutBounce', 'easeInOutBounce',
		);

		return apply_filters( 'back_to_the_top_get_easings', $easings );
	}

	public function get_displays() {
		$displays = array(
			'bottom-right', 'bottom-left', 'top-right', 'top-left',
		);

		return apply_filters( 'back_to_the_top_get_displays', $displays );
	}

	public function validate( $input ) {
		$output = $default_options = $this->get_default_options();

		$output['duration'] = isset( $input['duration'] ) && is_numeric( $input['duration'] ) && $input['duration'] >= 0 ? $input['duration'] : $default_options['duration'];
		$output['easing'] = isset( $input['easing'] ) && in_array( $input['easing'], $this->get_easings() ) ? $input['easing'] : $default_options['easing'];
		$output['offset'] = isset( $input['offset'] ) && is_numeric( $input['offset'] ) ? $input['offset'] : $default_options['offset'];
		$output['fixed-scroll-offset'] = isset( $input['fixed-scroll-offset'] ) && is_numeric( $input['fixed-scroll-offset'] ) && $input['fixed-scroll-offset'] >= 0 ? $input['fixed-scroll-offset'] : $default_options['fixed-scroll-offset'];
		$output['fixed-fadeIn'] = isset( $input['fixed-fadeIn'] ) && is_numeric( $input['fixed-fadeIn'] ) && $input['fixed-fadeIn'] >= 0 ? $input['fixed-fadeIn'] : $default_options['fixed-fadeIn'];
		$output['fixed-fadeOut'] = isset( $input['fixed-fadeOut'] ) && is_numeric( $input['fixed-fadeOut'] ) && $input['fixed-fadeOut'] >= 0 ? $input['fixed-fadeOut'] : $default_options['fixed-fadeOut'];
		$output['fixed-display'] = isset( $input['fixed-display'] ) && in_array( $input['fixed-display'], $this->get_displays() ) ? $input['fixed-display'] : $default_options['fixed-display'];
		$output['fixed-top'] = isset( $input['fixed-top'] ) && is_numeric( $input['fixed-top'] ) && $input['fixed-top'] >= 0 ? $input['fixed-top'] : $default_options['fixed-top'];
		$output['fixed-bottom'] = isset( $input['fixed-bottom'] ) && is_numeric( $input['fixed-bottom'] ) && $input['fixed-bottom'] >= 0 ? $input['fixed-bottom'] : $default_options['fixed-bottom'];
		$output['fixed-left'] = isset( $input['fixed-left'] ) && is_numeric( $input['fixed-left'] ) && $input['fixed-left'] >= 0 ? $input['fixed-left'] : $default_options['fixed-left'];
		$output['fixed-right'] = isset( $input['fixed-right'] ) && is_numeric( $input['fixed-right'] ) && $input['fixed-right'] >= 0 ? $input['fixed-right'] : $default_options['fixed-right'];

		$output['label'] = isset( $input['label'] ) ? $input['label'] : '';
		$output['font-size'] = isset( $input['font-size'] ) && is_numeric( $input['font-size'] ) && $input['font-size'] >= 0 ? $input['font-size'] : $default_options['font-size'];
		$output['font-weight'] = isset( $input['font-weight'] ) && is_numeric( $input['font-weight'] ) && $input['font-weight'] >= 100 && $input['font-weight'] <= 900 ? $input['font-weight'] : $default_options['font-weight'];
		$output['font-color'] = isset( $input['font-color'] ) ? str_replace( '#', '', $input['font-color'] ) : '';
		$output['font-hover-color'] = isset( $input['font-hover-color'] ) ? str_replace( '#', '', $input['font-hover-color'] ) : '';

		$output['custom-css'] = isset( $input['custom-css'] ) ? $input['custom-css'] : '';

		return apply_filters( 'back_to_the_top_validate', $output, $input, $default_options );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( 'jquery-easing', '//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', array( 'jquery' ), '2015-02-25', true );
		wp_enqueue_script( 'jquery-backtothetop', plugins_url() . '/back-to-the-top/jquery.backtothetop.js', array( 'jquery' ), '2015-02-25', true );
	}
	public function enqueue_styles() {
		wp_enqueue_style('dashicons');
		wp_enqueue_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css', false, '2015-05-12' );
	}

	public function add_backtothetop() {
		echo $this->add_html();
		echo $this->add_css();
	}

	public function add_html() {
		$options = $this->get_options();

		$html = '<a href="#" id="backtothetop-fixed"';
		$html .= isset( $options['duration'] ) ? ' data-backtothetop-duration="' . esc_attr( $options['duration'] ) . '"' : '';
		$html .= isset( $options['easing'] ) ? ' data-backtothetop-easing="' . esc_attr( $options['easing'] ) . '"' : '';
		$html .= isset( $options['offset'] ) ? ' data-backtothetop-offset="' . esc_attr( $options['offset'] ) . '"' : '';
		$html .= isset( $options['fixed-scroll-offset'] ) ? ' data-backtothetop-fixed-scroll-offset="' . esc_attr( $options['fixed-scroll-offset'] ) . '"' : '';
		$html .= isset( $options['fixed-fadeIn'] ) ? ' data-backtothetop-fixed-fadeIn="' . esc_attr( $options['fixed-fadeIn'] ) . '"' : '';
		$html .= isset( $options['fixed-fadeOut'] ) ? ' data-backtothetop-fixed-fadeOut="' . esc_attr( $options['fixed-fadeOut'] ) . '"' : '';
		$html .= isset( $options['fixed-display'] ) ? ' data-backtothetop-fixed-display="' . esc_attr( $options['fixed-display'] ) . '"' : '';
		$html .= isset( $options['fixed-bottom'] ) ? ' data-backtothetop-fixed-bottom="' . esc_attr( $options['fixed-bottom'] ) . '"' : '';
		$html .= isset( $options['fixed-top'] ) ? ' data-backtothetop-fixed-top="' . esc_attr( $options['fixed-top'] ) . '"' : '';
		$html .= isset( $options['fixed-right'] ) ? ' data-backtothetop-fixed-right="' . esc_attr( $options['fixed-right'] ) . '"' : '';
		$html .= isset( $options['fixed-left'] ) ? ' data-backtothetop-fixed-left="' . esc_attr( $options['fixed-left'] ) . '"' : '';
		$html .= ' >' . $options['label'] . '</a>';

		return $html;
	}

	public function add_css() {
		$options = $this->get_options();

		$css = '<style>';
		$css .= 'a#backtothetop-fixed {';
		$css .= 'display: block;';
		$css .= isset( $options['font-size'] ) ? 'font-size: ' . esc_html( $options['font-size'] ) . '%;' : '';
		$css .= isset( $options['font-color'] ) ? 'color: #' . esc_html( $options['font-color'] ) . ';' : '';
		$css .= isset( $options['font-weight'] ) ? 'font-weight: ' . esc_html( $options['font-weight'] ) . ';' : '';
		$css .= isset( $options['background-color'] ) ? 'background: #' . esc_html( $options['background-color'] ) . ';' : '';
		$css .= 'text-decoration: none;';
		$css .= 'text-align: center;';
		$css .= 'line-height: 1.2;';
		$css .= '}';
		$css .= 'a#backtothetop-fixed:hover {';
		$css .= isset( $options['font-hover-color'] ) ? 'color: #' . esc_html( $options['font-hover-color'] ) . ';' : '';
		$css .= '}';
		$css .= 'a#backtothetop-fixed .dashicons {';
		$css .= 'font-size: 100%;';
		$css .= isset( $options['font-weight'] ) ? 'font-weight: ' . esc_html( $options['font-weight'] ) . ';' : '';
		$css .= 'text-decoration: none;';
		$css .= 'font-weight: none;';
		$css .= 'line-height: 1.2;';
		$css .= 'vertical-align: text-bottom;';
		$css .= 'padding: 0;';
		$css .= 'margin: 0;';
		$css .= 'display: inline;';
		$css .= 'width: auto;';
		$css .= 'height: auto;';
		$css .= '-webkit-transition: 0;';
		$css .= 'transition: 0;';
		$css .= '}';
		$css .= 'a#backtothetop-fixed .fa {';
		$css .= 'font-size: 100%;';
		$css .= '}';
		$css .= isset( $options['custom-css'] ) ? esc_html( $options['custom-css'] ) : '';
		$css .= '</style>';

		return $css;
	}

}

$backtothetop = new Back_to_the_Top;
