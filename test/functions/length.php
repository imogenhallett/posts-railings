<?php
require ('../../functions/length.php');

use PHPUnit\Framework\TestCase;

class Length extends TestCase {

    public $length = [
        'length' => 8.1,
    ];

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

}//end class Length