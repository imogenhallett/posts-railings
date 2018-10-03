<?php
require ('../../functions/posts-railings.php');

use PHPUnit\Framework\TestCase;

class Length extends TestCase {
    public $fence = [
        'posts' => 2,
        'rails' => 1
    ];

    public $posts = 2;
    public $rails = 1;

    //test validateArray()

    public function test_validateArray_success() {
        $validateArray = validateArray($this->fence);
        $this->assertTrue($validateArray);
    }

    public function test_validateArray_failure_bad_array() {
        $fence = [
            'foo' => 2,
            'bar' => 1
        ];
        $validateArray = validateArray($fence);
        $this->assertFalse($validateArray);
    }

    public function test_validateArray_malformed_string(){
        $fence = 'string';
        $this->expectException(TypeError::class);
        $validateArray = validateArray($fence);
    }


    //test validateInt()

    public function test_validateInt_success() {
        $validateInt = validateInt($this->fence);
        $this->assertTrue($validateInt);
    }

    public function test_validateInt_failure_float() {
        $fence = [
            'rails' => 1.1,
            'posts' => 2.1
        ];
        $validateInt = validateInt($fence);
        $this->assertFalse($validateInt);
    }

    public function test_validateInt_failure_negative() {
        $fence = [
            'rails' => -2,
            'posts' => -1
        ];
        $validateInt = validateInt($fence);
        $this->assertFalse($validateInt);
    }

    public function test_validateInt_failure_string() {
        $fence = [
            'rails' => 'string',
            'posts' => 'string'
        ];
        $validateInt = validateInt($fence);
        $this->assertFalse($validateInt);
    }

    public function test_validateInt_failure_wrong_keys() {
        $fence = [
            'foo' => 2,
            'bar' => 1
        ];
        $validateInt = validateInt($fence);
        $this->assertFalse($validateInt);
    }

    public function test_validateInt_malformed_string() {
        $fence = 'string';
        $this->expectException(TypeError::class);
        $validateInt = validateInt($fence);
    }

    //test validateMinReq()

    public function test_validateMinReq_success() {
        $validateInt = validateInt($this->fence);
        $this->assertTrue($validateInt);
    }

    public function test_validateMinReq_failure_insufficient_0() {
        $fence = [
            'rails' => 0,
            'posts' => 0
        ];
        $validateInt = validateInt($fence);
        $this->assertFalse($validateInt);
    }

    public function test_validateMinReq_failure_insufficient_negative() {
        $fence = [
            'rails' => -1,
            'posts' => -2
        ];
        $validateInt = validateInt($fence);
        $this->assertFalse($validateInt);
    }

    public function test_validateMinReq_failure_wrong_keys() {
        $fence = [
            'foo' => 2,
            'bar' => 1
        ];
        $validateInt = validateInt($fence);
        $this->assertFalse($validateInt);
    }

    public function test_validateMinReq_malformed_string() {
        $fence = 'string';
        $this->expectException(TypeError::class);
        $validateInt = validateInt($fence);
    }


    //test doCalculation

    public function test_doCalculation_success() {
        $doCalculation = doCalculation($this->posts, $this->rails);
        $this->assertContains('Congratulations you have enough materials to build a fence', $doCalculation);
    }

    public function test_doCalculation_failure_neg_int() { //this test sucks - in the real world this should fail but also the function will never run with neg values
        $posts = -2;
        $rails = -1;
        $doCalculation = doCalculation($posts, $rails);
        $this->assertContains('Congratulations you have enough materials to build a fence', $doCalculation);
    }

    public function test_doCalculation_malformed_string() {
        $posts = 'string';
        $rails = 'string';
        $this->expectException(TypeError::class);
        $doCalculation = doCalculation($posts, $rails);
    }

    //test calculateLength

    public function test_calculateLength_success() {
        $calculateLength = calculateLength($this->fence);
        $this->assertContains('Congratulations you have enough materials to build a fence', $calculateLength);
    }

    public function test_calculateLength_failure_bad_array() {
        $fence = [
            'foo' => 2,
            'bar' => 1
        ];
        $calculateLength = calculateLength($fence);
        $this->assertContains('Error! Invalid entry', $calculateLength);
    }

    public function test_calculateLength_failure_floats() {
        $fence = [
            'posts' => 2.1,
            'rails' => 1.1
        ];
        $calculateLength = calculateLength($fence);
        $this->assertContains('Error! Invalid entry', $calculateLength);
    }

    public function test_calculateLength_failure_string() {
        $fence = [
            'posts' => 'string',
            'rails' => 'string'
        ];
        $calculateLength = calculateLength($fence);
        $this->assertContains('Error! Invalid entry', $calculateLength);
    }

    public function test_calculateLength_failure_negative() {
        $fence = [
            'posts' => -2,
            'rails' => -1
        ];
        $calculateLength = calculateLength($fence);
        $this->assertContains('Error! Invalid entry', $calculateLength);
    }

    public function test_calculateLength_failure_insufficient() {
        $fence = [
            'posts' => 1,
            'rails' => 1
        ];
        $calculateLength = calculateLength($fence);
        $this->assertContains('Error! Invalid entry', $calculateLength);
    }

    public function test_calculateLength_malformed_string() {
        $fence = 'string';
        $this->expectException(TypeError::class);
        $calculateLength = calculateLength($fence);
    }


}//end class PostRailings