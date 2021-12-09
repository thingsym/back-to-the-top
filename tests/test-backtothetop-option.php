<?php

class BackToTheTop_Option_Test extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->Back_to_the_Top = new Back_to_the_Top();
	}

	/**
	 * @test
	 * @group option
	 */
	function get_default_options() {
		$options = $this->Back_to_the_Top->get_default_options();

		$this->assertEquals( $options['duration'], 400 );
		$this->assertEquals( $options['easing'], 'swing' );
		$this->assertEquals( $options['offset'], 0 );
		$this->assertEquals( $options['fixed-scroll-offset'], 0 );
		$this->assertEquals( $options['fixed-fadeIn'], 800 );
		$this->assertEquals( $options['fixed-fadeOut'], 800 );
		$this->assertEquals( $options['fixed-display'], 'bottom-right' );
		$this->assertEquals( $options['fixed-top'], 0 );
		$this->assertEquals( $options['fixed-bottom'], 0 );
		$this->assertEquals( $options['fixed-left'], 0 );
		$this->assertEquals( $options['fixed-right'], 0 );
		$this->assertEquals( $options['label'], '<i class="dashicons dashicons-arrow-up-alt2"></i><br>Back to the Top' );
		$this->assertEquals( $options['font-size'], 140 );
		$this->assertEquals( $options['font-weight'], 400 );
		$this->assertEquals( $options['font-color'], 'f00' );
		$this->assertEquals( $options['font-hover-color'], 'f00' );
		$this->assertEquals( $options['custom-css'], '' );
	}

	/**
	 * @test
	 * @group option
	 */
	function uninstall() {
		$this->Back_to_the_Top->uninstall();
		$this->assertFalse( get_option( 'back_to_the_top_options' ) );
	}

	/**
	 * @test
	 * @group option
	 */
	function options() {
		$options = $this->Back_to_the_Top->get_options();

		$this->assertEquals( $options['duration'], 400 );
		$this->assertEquals( $options['easing'], 'swing' );
		$this->assertEquals( $options['offset'], 0 );
		$this->assertEquals( $options['fixed-scroll-offset'], 0 );
		$this->assertEquals( $options['fixed-fadeIn'], 800 );
		$this->assertEquals( $options['fixed-fadeOut'], 800 );
		$this->assertEquals( $options['fixed-display'], 'bottom-right' );
		$this->assertEquals( $options['fixed-top'], 0 );
		$this->assertEquals( $options['fixed-bottom'], 0 );
		$this->assertEquals( $options['fixed-left'], 0 );
		$this->assertEquals( $options['fixed-right'], 0 );
		$this->assertEquals( $options['label'], '<i class="dashicons dashicons-arrow-up-alt2"></i><br>Back to the Top' );
		$this->assertEquals( $options['font-size'], 140 );
		$this->assertEquals( $options['font-weight'], 400 );
		$this->assertEquals( $options['font-color'], 'f00' );
		$this->assertEquals( $options['font-hover-color'], 'f00' );
		$this->assertEquals( $options['custom-css'], '' );
	}

	/**
	 * @test
	 * @group option
	 */
	function options_case_none_option() {
		$options = array();
		update_option( 'back_to_the_top_options', $options );

		$options = $this->Back_to_the_Top->get_options();

		$this->assertEquals( $options['duration'], 400 );
		$this->assertEquals( $options['easing'], 'swing' );
		$this->assertEquals( $options['offset'], 0 );
		$this->assertEquals( $options['fixed-scroll-offset'], 0 );
		$this->assertEquals( $options['fixed-fadeIn'], 800 );
		$this->assertEquals( $options['fixed-fadeOut'], 800 );
		$this->assertEquals( $options['fixed-display'], 'bottom-right' );
		$this->assertEquals( $options['fixed-top'], 0 );
		$this->assertEquals( $options['fixed-bottom'], 0 );
		$this->assertEquals( $options['fixed-left'], 0 );
		$this->assertEquals( $options['fixed-right'], 0 );
		$this->assertEquals( $options['label'], '<i class="dashicons dashicons-arrow-up-alt2"></i><br>Back to the Top' );
		$this->assertEquals( $options['font-size'], 140 );
		$this->assertEquals( $options['font-weight'], 400 );
		$this->assertEquals( $options['font-color'], 'f00' );
		$this->assertEquals( $options['font-hover-color'], 'f00' );
		$this->assertEquals( $options['custom-css'], '' );
	}

}
