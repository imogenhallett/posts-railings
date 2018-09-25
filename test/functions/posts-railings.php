<?php
require ('../../functions/posts-railings.php');

use PHPUnit\Framework\TestCase;

class PostsRailings extends TestCase {
    public $formData = [
        'posts' => 2,
        'rails' => 1
    ];

    //test validateArray()

    /** @test */
    public function validateArray_success() {
        $validateArray = validateArray($this->formData);
        $this->assertArrayHasKey('posts', $validateArray);
        $this->assertArrayHasKey('rails', $validateArray);
        $this->assertArrayHasKey('status', $validateArray);
        $this->assertTrue($validateArray['status']);
    }

    /** @test */
    public function validateArray_fail_with_blank_array() {
        $formData = [];
        $validateArray = validateArray($formData);
        $this->assertArrayHasKey('status', $validateArray);
        $this->assertArrayHasKey('message', $validateArray);
        $this->assertFalse($validateArray['status']);
        $this->assertContains('ERROR! You have entered an invalid selection. Programme requires valid data type to execute.', $validateArray['message']);
    }

    /** @test */
    public function validateArray_fail_with_wrong_array_keys() {
        $formData = [
            'foo' => 2,
            'bar' => 1
        ];
        $validateArray = validateArray($formData);
        $this->assertArrayHasKey('status', $validateArray);
        $this->assertArrayHasKey('message', $validateArray);
        $this->assertFalse($validateArray['status']);
        $this->assertContains('ERROR! You have entered an invalid selection. Programme requires valid data type to execute.', $validateArray['message']);
    }


//    /** @test */
//    public function validateArray_malformed_with_string() {
//        $formData = 'a string';
//        $validateArray = validateArray($formData);
//        $this->assertArrayHasKey('status', $validateArray);
//        $this->assertArrayHasKey('message', $validateArray);
//        $this->assertFalse($validateArray['status']);
//        $this->assertContains('ERROR! You have entered an invalid selection. Programme requires valid data type to execute.', $validateArray['message']);
//    }


    //TEST validateIntValues

    /** @test */
    public function validateIntValues_success() {
        $validateIntValues = validateIntValues($this->formData);
        $this->assertArrayHasKey('posts', $validateIntValues);
        $this->assertArrayHasKey('rails', $validateIntValues);
        $this->assertArrayHasKey('status', $validateIntValues);
        $this->assertTrue($validateIntValues['status']);
    }


    /** @test */
    public function validateIntValues_failure_with_strings() {
        $formData = [
            'posts' => 'a string',
            'rails' => 'a string'
        ];

        $validateIntValues = validateIntValues($formData);
        $this->assertArrayHasKey('status', $validateIntValues);
        $this->assertArrayHasKey('message', $validateIntValues);
        $this->assertFalse($validateIntValues['status']);
        $this->assertContains('ERROR! You have entered an invalid selection. Please enter an integer value, greater than 0, for the number of posts and the number of rails', $validateIntValues['message']);
    }

    /** @test */
    public function validateIntValues_failure_with_zero() {
        $formData = [
            'posts' => 0,
            'rails' => 0
        ];

        $validateIntValues = validateIntValues($formData);
        $this->assertArrayHasKey('status', $validateIntValues);
        $this->assertArrayHasKey('message', $validateIntValues);
        $this->assertFalse($validateIntValues['status']);
        $this->assertContains('ERROR! You have entered an invalid selection. Please enter an integer value, greater than 0, for the number of posts and the number of rails', $validateIntValues['message']);
    }

    /** @test */
    public function validateIntValues_failure_with_floats() {
        $formData = [
            'posts' => 2.5,
            'rails' => 1.5
        ];

        $validateIntValues = validateIntValues($formData);
        $this->assertArrayHasKey('status', $validateIntValues);
        $this->assertArrayHasKey('message', $validateIntValues);
        $this->assertFalse($validateIntValues['status']);
        $this->assertContains('ERROR! You have entered an invalid selection. Please enter an integer value, greater than 0, for the number of posts and the number of rails', $validateIntValues['message']);
    }



}//end class PostRailings