<?php

class BackToTheTop_CSS_Test extends WP_UnitTestCase {

    public function setUp() {
        parent::setUp();
        $this->Back_to_the_Top = new Back_to_the_Top();
    }

    /**
     * @test
     * @group css
     */
    function css() {
        $css = $this->Back_to_the_Top->add_css();

        $this->assertRegExp( '/^<style>.*<\/style>$/', $css );

    }

}
