<?php

class BackToTheTop_Basic_Test extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->Back_to_the_Top = new Back_to_the_Top();
	}

	/**
	 * @test
	 * @group basic
	 */
	function public_variable() {
		$this->assertEquals( 'back_to_the_top', $this->Back_to_the_Top->option_group );
		$this->assertEquals( 'back_to_the_top_options', $this->Back_to_the_Top->option_name );
		$this->assertEquals( 'manage_options', $this->Back_to_the_Top->capability );
	}

	/**
	 * @test
	 * @group basic
	 */
	function construct() {
		$this->assertEquals( 10, has_filter( 'init', array( $this->Back_to_the_Top, 'load_textdomain' ) ) );
		$this->assertEquals( 10, has_filter( 'init', array( $this->Back_to_the_Top, 'init' ) ) );

		$this->assertEquals( 10, has_action( 'admin_init', array( $this->Back_to_the_Top, 'register_settings' ) ) );
		$this->assertEquals( 10, has_action( 'admin_menu', array( $this->Back_to_the_Top, 'add_option_page' ) ) );

		$uninstallable_plugins = (array) get_option( 'uninstall_plugins' );
		$this->assertEquals( array( 'Back_to_the_Top', 'uninstall' ), $uninstallable_plugins[ plugin_basename( __Back_to_the_Top__ ) ] );
	}

	/**
	 * @test
	 * @group basic
	 */
	function init() {
		$this->Back_to_the_Top->init();

		$this->assertEquals( 10, has_action( 'wp_enqueue_scripts', array( $this->Back_to_the_Top, 'enqueue_scripts' ) ) );
		$this->assertEquals( 10, has_action( 'wp_enqueue_scripts', array( $this->Back_to_the_Top, 'enqueue_styles' ) ) );
		$this->assertEquals( 10, has_action( 'wp_footer', array( $this->Back_to_the_Top, 'add_backtothetop' ) ) );

		$this->assertEquals( 10, has_filter( 'option_page_capability_back_to_the_top', array( $this->Back_to_the_Top, 'option_page_capability' ) ) );

		$this->assertEquals( 10, has_filter( 'plugin_action_links_' . plugin_basename( __Back_to_the_Top__ ), array( $this->Back_to_the_Top, 'plugin_action_links' ) ) );
		$this->assertEquals( 10, has_action( 'plugin_row_meta', array( $this->Back_to_the_Top, 'plugin_metadata_links' ) ) );
	}

	/**
	 * @test
	 * @group basic
	 */
	function register_settings() {
		$this->Back_to_the_Top->register_settings();

		global $wp_registered_settings;

		$this->assertTrue( isset( $wp_registered_settings['back_to_the_top_options'] ) );
		$this->assertEquals( 'back_to_the_top', $wp_registered_settings['back_to_the_top_options']['group'] );
		$this->assertTrue( in_array( $this->Back_to_the_Top, $wp_registered_settings['back_to_the_top_options']['sanitize_callback'] ) );
		$this->assertTrue( in_array( 'validate_options', $wp_registered_settings['back_to_the_top_options']['sanitize_callback'] ) );
	}

	/**
	 * @test
	 * @group basic
	 */
	function option_page_capability() {
		$this->assertEquals( 'manage_options', $this->Back_to_the_Top->option_page_capability() );
	}

	/**
	 * @test
	 * @group basic
	 */
	function add_option_page() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group basic
	 */
	function page_hook_suffix() {
		$this->Back_to_the_Top->page_hook_suffix();

		$this->assertEquals( 10, has_action( 'admin_enqueue_scripts', array( $this->Back_to_the_Top, 'admin_enqueue_scripts' ) ) );
		$this->assertEquals( 10, has_action( 'admin_enqueue_scripts', array( $this->Back_to_the_Top, 'admin_enqueue_styles' ) ) );
	}

	/**
	 * @test
	 * @group basic
	 */
	function admin_enqueue_scripts() {
		$this->Back_to_the_Top->admin_enqueue_scripts();

		$this->assertTrue( wp_script_is( 'backtothetop-admin' ) );
	}

	/**
	 * @test
	 * @group basic
	 */
	function admin_enqueue_styles() {
		$this->Back_to_the_Top->admin_enqueue_styles();

		$this->assertTrue( wp_style_is( 'wp-color-picker' ) );
		$this->assertTrue( wp_style_is( 'dashicons' ) );
		$this->assertTrue( wp_style_is( 'font-awesome' ) );
	}

	/**
	 * @test
	 * @group basic
	 */
	function plugin_action_links() {
		$links = $this->Back_to_the_Top->plugin_action_links( array() );
		$this->assertContains( '<a href="themes.php?page=backtothetop">Settings</a>', $links );
	}

	/**
	 * @test
	 * @group basic
	 */
	function easings() {

		$easings = array(
			'linear', 'swing', 'jswing', 'easeInQuad', 'easeOutQuad', 'easeInOutQuad',
			'easeInCubic', 'easeOutCubic', 'easeInOutCubic', 'easeInQuart', 'easeOutQuart',
			'easeInOutQuart', 'easeInQuint', 'easeOutQuint', 'easeInOutQuint', 'easeInSine',
			'easeOutSine', 'easeInOutSine', 'easeInExpo', 'easeOutExpo', 'easeInOutExpo',
			'easeInCirc', 'easeOutCirc', 'easeInOutCirc', 'easeInElastic', 'easeOutElastic',
			'easeInOutElastic', 'easeInBack', 'easeOutBack', 'easeInOutBack', 'easeInBounce',
			'easeOutBounce', 'easeInOutBounce',
		);

		$this->assertInternalType( 'array', $this->Back_to_the_Top->get_easings() );
		$this->assertCount( count( $easings ), $this->Back_to_the_Top->get_easings() );

		foreach ( $easings as $easing ) {
			$this->assertContains( $easing, $this->Back_to_the_Top->get_easings() );
		}
	}

	/**
	 * @test
	 * @group basic
	 */
	function displays() {
		$displays = array(
			'bottom-right', 'bottom-left', 'top-right', 'top-left',
		);

		$this->assertInternalType( 'array', $this->Back_to_the_Top->get_displays() );
		$this->assertCount( count( $displays ), $this->Back_to_the_Top->get_displays() );

		foreach ( $displays as $display ) {
			$this->assertContains( $display, $this->Back_to_the_Top->get_displays() );
		}
	}

	/**
	 * @test
	 * @group basic
	 */
	function enqueue_scripts() {
		$this->Back_to_the_Top->enqueue_scripts();

		$this->assertTrue( wp_script_is( 'jquery' ) );
		$this->assertTrue( wp_script_is( 'jquery-easing' ) );
		$this->assertTrue( wp_script_is( 'jquery-backtothetop' ) );
	}

	/**
	 * @test
	 * @group basic
	 */
	function enqueue_styles() {
		$this->Back_to_the_Top->enqueue_styles();

		$this->assertTrue( wp_style_is( 'dashicons' ) );
		$this->assertTrue( wp_style_is( 'font-awesome' ) );
	}

}
