<?php

class BackToTheTop_HTML_Test extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->Back_to_the_Top = new Back_to_the_Top();
	}

	/**
	 * @test
	 * @group html
	 */
	function html() {
		$html = $this->Back_to_the_Top->add_html();

		$this->assertRegExp( '/^<a href="#" id="backtothetop-fixed".*>.*<\/a>$/', $html );
	}

	/**
	 * @test
	 * @group html
	 */
	function html_case_1() {
		$options = array(
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

			'label' => 'test test',
			'font-size' => 140,
			'font-weight' => 400,
			'font-color' => '',
			'font-hover-color' => '',
			'custom-css' => '',
		);

		update_option( 'back_to_the_top_options', $options );
		$html = $this->Back_to_the_Top->add_html();

		$this->assertRegExp( '/^<a href="#" id="backtothetop-fixed".*>test test<\/a>$/', $html );
	}

}
