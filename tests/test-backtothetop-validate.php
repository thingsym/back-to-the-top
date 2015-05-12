<?php

class BackToTheTop_Validate_Test extends WP_UnitTestCase {

    public function setUp() {
        parent::setUp();
        $this->Back_to_the_Top = new Back_to_the_Top();
    }

    /**
     * @test
     * @group validate
     */
    function validate_case_none_input() {
        $input = array();

        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( $validate['duration'], 400 );
        $this->assertEquals( $validate['easing'], 'swing' );
        $this->assertEquals( $validate['offset'], 0 );
        $this->assertEquals( $validate['fixed-scroll-offset'], 0 );
        $this->assertEquals( $validate['fixed-fadeIn'], 800 );
        $this->assertEquals( $validate['fixed-fadeOut'], 800 );
        $this->assertEquals( $validate['fixed-display'], 'bottom-right' );
        $this->assertEquals( $validate['fixed-top'], 0 );
        $this->assertEquals( $validate['fixed-bottom'], 0 );
        $this->assertEquals( $validate['fixed-left'], 0 );
        $this->assertEquals( $validate['fixed-right'], 0 );
        $this->assertEquals( $validate['label'], '' );
        $this->assertEquals( $validate['font-size'], 140 );
        $this->assertEquals( $validate['font-weight'], 400 );
        $this->assertEquals( $validate['font-color'], '' );
        $this->assertEquals( $validate['font-hover-color'], '' );
        $this->assertEquals( $validate['custom-css'], '' );
    }


    /**
     * @test
     * @group validate
     */
    function validate_case_duration() {
        $input = array(
            'duration' => 500,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 500, $validate['duration'] );

        $input = array(
            'duration' => -1,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 400, $validate['duration'] );

        $input = array(
            'duration' => 'asdf',
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 400, $validate['duration'] );

    }

    /**
     * @test
     * @group validate
     */
    function validate_case_easing() {
        $easings = $this->Back_to_the_Top->get_easings();

        foreach ( $easings as $easing ) {
            $input = array(
                'easing' => $easing,
            );
            $validate = $this->Back_to_the_Top->validate($input);

            $this->assertEquals( $easing, $validate['easing'] );
        }

        $input = array(
            'easing' => 'asdf',
        );
        $validate = $this->Back_to_the_Top->validate($input);
        $this->assertEquals( 'swing', $validate['easing'] );

    }

    /**
     * @test
     * @group validate
     */
    function validate_case_offset() {
        $input = array(
            'offset' => 500,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 500, $validate['offset'] );

        $input = array(
            'offset' => -1,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( -1, $validate['offset'] );

        $input = array(
            'offset' => 'asdf',
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 0, $validate['offset'] );

    }

    /**
     * @test
     * @group validate
     */
    function validate_case_fixed_scroll_offset() {
        $input = array(
            'fixed-scroll-offset' => 500,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 500, $validate['fixed-scroll-offset'] );

        $input = array(
            'fixed-scroll-offset' => -500,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 0, $validate['fixed-scroll-offset'] );

        $input = array(
            'fixed-scroll-offset' => 'asdf',
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 0, $validate['fixed-scroll-offset'] );

    }

    /**
     * @test
     * @group validate
     */
    function validate_case_fixed_fadeIn() {
        $input = array(
            'fixed-fadeIn' => 500,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 500, $validate['fixed-fadeIn'] );

        $input = array(
            'fixed-fadeIn' => -1,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 800, $validate['fixed-fadeIn'] );

        $input = array(
            'fixed-fadeIn' => 'asdf',
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 800, $validate['fixed-fadeIn'] );

    }

    /**
     * @test
     * @group validate
     */
    function validate_case_fixed_fadeOut() {
        $input = array(
            'fixed-fadeOut' => 500,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 500, $validate['fixed-fadeOut'] );

        $input = array(
            'fixed-fadeOut' => -1,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 800, $validate['fixed-fadeOut'] );

        $input = array(
            'fixed-fadeOut' => 'asdf',
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 800, $validate['fixed-fadeOut'] );

    }

    /**
     * @test
     * @group validate
     */
    function validate_case_display() {
        $displays = $this->Back_to_the_Top->get_displays();

        foreach ( $displays as $display ) {
            $input = array(
                'fixed-display' => $display,
            );
            $validate = $this->Back_to_the_Top->validate($input);

            $this->assertEquals( $display, $validate['fixed-display'] );
        }

        $input = array(
            'fixed-display' => 'asdf',
        );
        $validate = $this->Back_to_the_Top->validate($input);
        $this->assertEquals( 'bottom-right', $validate['fixed-display'] );

    }

    /**
     * @test
     * @group validate
     */
    function validate_case_fixed_top() {
        $input = array(
            'fixed-top' => 500,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 500, $validate['fixed-top'] );

        $input = array(
            'fixed-top' => -1,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 0, $validate['fixed-top'] );

        $input = array(
            'fixed-top' => 'asdf',
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 0, $validate['fixed-top'] );

    }

    /**
     * @test
     * @group validate
     */
    function validate_case_fixed_bottom() {
        $input = array(
            'fixed-bottom' => 500,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 500, $validate['fixed-bottom'] );

        $input = array(
            'fixed-bottom' => -1,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 0, $validate['fixed-bottom'] );

        $input = array(
            'fixed-bottom' => 'asdf',
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 0, $validate['fixed-bottom'] );

    }

    /**
     * @test
     * @group validate
     */
    function validate_case_fixed_left() {
        $input = array(
            'fixed-left' => 500,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 500, $validate['fixed-left'] );

        $input = array(
            'fixed-left' => -1,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 0, $validate['fixed-left'] );

        $input = array(
            'fixed-left' => 'asdf',
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 0, $validate['fixed-left'] );

    }

    /**
     * @test
     * @group validate
     */
    function validate_case_fixed_right() {
        $input = array(
            'fixed-right' => 500,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 500, $validate['fixed-right'] );

        $input = array(
            'fixed-right' => -1,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 0, $validate['fixed-right'] );

        $input = array(
            'fixed-right' => 'asdf',
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 0, $validate['fixed-right'] );

    }

    /**
     * @test
     * @group validate
     */
    function validate_case_font_size() {
        $input = array(
            'font-size' => 500,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 500, $validate['font-size'] );

        $input = array(
            'font-size' => -1,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 140, $validate['font-size'] );

        $input = array(
            'font-size' => 'asdf',
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 140, $validate['font-size'] );

    }

    /**
     * @test
     * @group validate
     */
    function validate_case_font_weight() {
        $input = array(
            'font-weight' => 900,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 900, $validate['font-weight'] );

        $input = array(
            'font-weight' => 140,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 140, $validate['font-weight'] );

        $input = array(
            'font-weight' => 901,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 400, $validate['font-weight'] );

        $input = array(
            'font-weight' => 99,
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 400, $validate['font-weight'] );

        $input = array(
            'font-weight' => 'asdf',
        );
        $validate = $this->Back_to_the_Top->validate($input);

        $this->assertEquals( 400, $validate['font-weight'] );

    }
}