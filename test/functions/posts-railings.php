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
            'bar' =>1
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


    //test validateIntValues

    

}//end class PostRailings