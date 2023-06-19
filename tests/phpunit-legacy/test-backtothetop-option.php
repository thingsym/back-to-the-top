<?php

class BackToTheTop_Option_Test extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->Back_To_The_Top = new Back_to_the_Top();
	}

	/**
	 * @test
	 * @group option
	 */
	function get_default_options() {
		$options = $this->Back_To_The_Top->get_default_options();

		$this->assertSame( $options['duration'], 400 );
		$this->assertSame( $options['easing'], 'swing' );
		$this->assertSame( $options['offset'], 0 );
		$this->assertSame( $options['fixed-scroll-offset'], 0 );
		$this->assertSame( $options['fixed-fadeIn'], 800 );
		$this->assertSame( $options['fixed-fadeOut'], 800 );
		$this->assertSame( $options['fixed-display'], 'bottom-right' );
		$this->assertSame( $options['fixed-top'], 0 );
		$this->assertSame( $options['fixed-bottom'], 0 );
		$this->assertSame( $options['fixed-left'], 0 );
		$this->assertSame( $options['fixed-right'], 0 );
		$this->assertSame( $options['label'], '<i class="dashicons dashicons-arrow-up-alt2"></i><br>Back to the Top' );
		$this->assertSame( $options['font-size'], 140 );
		$this->assertSame( $options['font-weight'], 400 );
		$this->assertSame( $options['font-color'], 'f00' );
		$this->assertSame( $options['font-hover-color'], 'f00' );
		$this->assertSame( $options['custom-css'], '' );
	}

	/**
	 * @test
	 * @group option
	 */
	function uninstall() {
		$this->Back_To_The_Top->uninstall();
		$this->assertFalse( get_option( 'back_to_the_top_options' ) );
	}

	/**
	 * @test
	 * @group option
	 */
	function options() {
		$options = $this->Back_To_The_Top->get_options();

		$this->assertSame( $options['duration'], 400 );
		$this->assertSame( $options['easing'], 'swing' );
		$this->assertSame( $options['offset'], 0 );
		$this->assertSame( $options['fixed-scroll-offset'], 0 );
		$this->assertSame( $options['fixed-fadeIn'], 800 );
		$this->assertSame( $options['fixed-fadeOut'], 800 );
		$this->assertSame( $options['fixed-display'], 'bottom-right' );
		$this->assertSame( $options['fixed-top'], 0 );
		$this->assertSame( $options['fixed-bottom'], 0 );
		$this->assertSame( $options['fixed-left'], 0 );
		$this->assertSame( $options['fixed-right'], 0 );
		$this->assertSame( $options['label'], '<i class="dashicons dashicons-arrow-up-alt2"></i><br>Back to the Top' );
		$this->assertSame( $options['font-size'], 140 );
		$this->assertSame( $options['font-weight'], 400 );
		$this->assertSame( $options['font-color'], 'f00' );
		$this->assertSame( $options['font-hover-color'], 'f00' );
		$this->assertSame( $options['custom-css'], '' );
	}

	/**
	 * @test
	 * @group option
	 */
	function options_case_none_option() {
		$options = array();
		update_option( 'back_to_the_top_options', $options );

		$options = $this->Back_To_The_Top->get_options();

		$this->assertSame( $options['duration'], 400 );
		$this->assertSame( $options['easing'], 'swing' );
		$this->assertSame( $options['offset'], 0 );
		$this->assertSame( $options['fixed-scroll-offset'], 0 );
		$this->assertSame( $options['fixed-fadeIn'], 800 );
		$this->assertSame( $options['fixed-fadeOut'], 800 );
		$this->assertSame( $options['fixed-display'], 'bottom-right' );
		$this->assertSame( $options['fixed-top'], 0 );
		$this->assertSame( $options['fixed-bottom'], 0 );
		$this->assertSame( $options['fixed-left'], 0 );
		$this->assertSame( $options['fixed-right'], 0 );
		$this->assertSame( $options['label'], '<i class="dashicons dashicons-arrow-up-alt2"></i><br>Back to the Top' );
		$this->assertSame( $options['font-size'], 140 );
		$this->assertSame( $options['font-weight'], 400 );
		$this->assertSame( $options['font-color'], 'f00' );
		$this->assertSame( $options['font-hover-color'], 'f00' );
		$this->assertSame( $options['custom-css'], '' );
	}

}
