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
    function construct() {
        $this->assertEquals( 10, has_action( 'admin_init', array( $this->Back_to_the_Top, 'admin_init' ) ) );
        $this->assertEquals( 10, has_filter( 'option_page_capability_back_to_the_top', array( $this->Back_to_the_Top, 'option_page_capability' ) ) );
        $this->assertEquals( 10, has_action( 'admin_menu', array( $this->Back_to_the_Top, 'add_option_page' ) ) );
        $this->assertEquals( 10, has_action( 'wp_enqueue_scripts', array( $this->Back_to_the_Top, 'enqueue_scripts' ) ) );
        $this->assertEquals( 10, has_action( 'wp_enqueue_scripts', array( $this->Back_to_the_Top, 'enqueue_styles' ) ) );
        $this->assertEquals( 10, has_action( 'wp_footer', array( $this->Back_to_the_Top, 'add_backtothetop' ) ) );

        // $uninstall_plugins = get_option( 'uninstall_plugins' );
        // foreach( $uninstall_plugins as $path => $val ) {
        //    $this->assertContains( 'Back_to_the_Top', $uninstall_plugins[$path] );
        //    $this->assertContains( 'uninstall', $uninstall_plugins[$path] );
        // }

    }

    /**
     * @test
     * @group basic
     */
    function admin_init() {
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
    }

    /**
     * @test
     * @group basic
     */
    function page_hook_suffix() {
    }

    /**
     * @test
     * @group basic
     */
    function admin_enqueue_scripts() {
        $this->Back_to_the_Top->admin_enqueue_scripts();

        $this->assertTrue( wp_script_is( 'backtothetop-icon' ) );
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
