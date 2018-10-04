<?php
require ('../../functions/length.php');

use PHPUnit\Framework\TestCase;

class Length extends TestCase {

    public $length = [
        'length' => 8.1,
    ];

    public $lengthFloat = 8.1;

    //test validateFloat()

    public function test_validateFloat_success() {
        $validateFloat = validateFloat($this->length);
        $this->assertTrue($validateFloat);
    }

    public function test_validateFloat_success_with_string() {
        $length = [
            'length' => '8.1',
        ];
        $validateFloat = validateFloat($length);
        $this->assertTrue($validateFloat);
    }

    public function test_validateFloat_fail_zero() {
        $length = [
            'length' => 0,
        ];
        $validateFloat = validateFloat($length);
        $this->assertFalse($validateFloat);
    }

    public function test_validateFloat_fail_empty() {
        $length = [
            'length' => '',
        ];
        $validateFloat = validateFloat($length);
        $this->assertFalse($validateFloat);
    }

    public function test_validateFloat_malformed() {
        $length = 'string';
        $this->expectException(TypeError::class);
        $validateFloat = validateFloat($length);
    }

    //test doCalculation()

    public function test_doCalculation_success() {
        $doCalculation = doCalculation($this->lengthFloat);
        $this->assertContains('To make a fence 8.1 meters long you will require:', $doCalculation);
    }

    public function test_doCalculation_success_string() {
        $lengthFloat = '8.1';
        $doCalculation = doCalculation($lengthFloat);
        $this->assertContains('To make a fence 8.1 meters long you will require:', $doCalculation);
    }


    public function test_doCalculation_fail_zero() { //will never run with $lengthFloat = 0 due to proceeding if
        $lengthFloat = 0;
        $doCalculation = doCalculation($lengthFloat);
        $this->assertContains('To make a fence 0 meters long you will require:', $doCalculation);
    }

    public function test_doCalculation_malformed() {
        $lengthFloat = [];
        $this->expectException(TypeError::class);
        $validateFloat = doCalculation($lengthFloat);
    }


}//end class Length