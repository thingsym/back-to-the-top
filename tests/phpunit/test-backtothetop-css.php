<?php

class BackToTheTop_CSS_Test extends WP_UnitTestCase {
	public $Back_To_The_Top;

	public function setUp(): void {
		parent::setUp();
		$this->Back_To_The_Top = new Back_to_the_Top();
	}

	/**
	 * @test
	 * @group css
	 */
	function css() {
		$css = $this->Back_To_The_Top->add_css();

		$this->assertRegExp( '/^<style>.*<\/style>$/', $css );
	}

}
