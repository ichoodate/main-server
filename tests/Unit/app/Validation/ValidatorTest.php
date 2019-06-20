<?php

namespace Tests\Unit\App\Validation;

use Tests\Unit\_TestCase;

class ValidatorTest extends _TestCase {

    public function validator($data, $rules, $msg = [], $names = [])
    {
        $factory = inst(\Illuminate\Validation\Factory::class);
        $factory->resolver(function (\Illuminate\Translation\Translator $translator, array $data, array $rules, array $messages, array $customDataKeyNames) {

            return new \App\Validation\Validator($translator, $data, $rules, $messages, $customDataKeyNames);
        });

        return $factory->make($data, $rules, $msg, $names);
    }

    public function testGeRules()
    {
        $rules = ['keywords.*' => ['required']];
        $data  = ['keywords' => [1234, 2345, 3456]];

        $this->assertEquals($this->validator($data, $rules)->getRules(), [
            'keywords.0' => ['required'],
            'keywords.1' => ['required'],
            'keywords.2' => ['required']
        ]);
    }

    public function testMessageAsteriskCase()
    {
        $rules = ['keywords.*' => ['required']];

        $data  = ['keywords'   => [1234, 2345, 3456]];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data      = ['keywords'   => [1234, 2345, null]];
        $validator = $this->validator($data, $rules);

        $this->assertFalse($validator->passes());
        $this->assertContains('keywords.2 is required.', $validator->errors()->all());

        $validator = $this->validator($data, $rules, [], ['keywords.*' => 'keyword of keyword_ids.*']);
        $this->assertFalse($validator->passes());
        $this->assertContains('keyword of keyword_ids.2 is required.', $validator->errors()->all());
    }

    public function testValidateInIf()
    {
        $rules = ['bcd' => ['in_if:abc, 1234, 2345, 3456']];

        $data  = ['abc' => '2345', 'bcd' => 'bcde'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => 'abcd', 'bcd' => 'bcde'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => '1234', 'bcd' => '1234'];

        $this->assertFalse($this->validator($data, $rules)->passes());

        $data  = ['abc' => '1234', 'bcd' => '2345'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => '1234', 'bcd' => '3456'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $rules = ['abc' => ['in_if:first']];

        $this->assertException(function () use ($data, $rules) {

            $this->validator($data, $rules)->passes();
        });
    }

    public function testValidateInUnless()
    {
        $rules = ['bcd' => ['in_unless:abc, 1234, 2345, 3456']];

        $data  = ['abc' => '1234', 'bcd' => 'bcde'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => 'abcd', 'bcd' => 'bcde'];

        $this->assertFalse($this->validator($data, $rules)->passes());

        $data  = ['abc' => 'abcd', 'bcd' => '1234'];

        $this->assertFalse($this->validator($data, $rules)->passes());

        $data  = ['abc' => 'abcd', 'bcd' => '2345'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => 'abcd', 'bcd' => '3456'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $rules = ['abc' => ['in_unless:first']];

        $this->assertException(function () use ($data, $rules) {

            $this->validator($data, $rules)->passes();
        });
    }

    public function testValidateNotNull()
    {
        $rules = ['abc' => ['not_null']];

        $data  = ['abc' => '1234'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => 'null'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => null];

        $this->assertFalse($this->validator($data, $rules)->passes());

        $rules = ['bcd.*' => ['not_null']];

        $data  = ['bcd' => [null, null]];

        $this->assertFalse($this->validator($data, $rules)->passes());

        $data  = ['bcd' => ['1234', null]];

        $this->assertFalse($this->validator($data, $rules)->passes());

        $data  = ['bcd' => ['1234', 'abcd']];

        $this->assertTrue($this->validator($data, $rules)->passes());
    }

    public function testValidateNull()
    {
        $rules = ['abc' => ['null']];

        $data  = ['abc' => '1234'];

        $this->assertFalse($this->validator($data, $rules)->passes());

        $data  = ['abc' => 'null'];

        $this->assertFalse($this->validator($data, $rules)->passes());

        $data  = ['abc' => null];

        $this->assertTrue($this->validator($data, $rules)->passes());
    }

    public function testValidateNullIf()
    {
        $rules = ['bcd' => ['null_if:abc, 2345']];

        $data  = ['abc' => '1234', 'bcd' => null];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => '1234', 'bcd' => 'bcde'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => '2345', 'bcd' => null];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => '2345', 'bcd' => 'bcde'];

        $this->assertFalse($this->validator($data, $rules)->passes());

        $rules = ['abc' => ['null_if:first']];

        $this->assertException(function () use ($data, $rules) {

            $this->validator($data, $rules)->passes();
        });
    }

    public function testValidateNullUnless()
    {
        $rules = ['bcd' => ['null_unless:abc, 2345']];

        $data  = ['abc' => '1234', 'bcd' => null];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => '1234', 'bcd' => 'bcde'];

        $this->assertFalse($this->validator($data, $rules)->passes());

        $data  = ['abc' => '2345', 'bcd' => null];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => '2345', 'bcd' => 'bcde'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $rules = ['abc' => ['null_unless:first']];

        $this->assertException(function () use ($data, $rules) {

            $this->validator($data, $rules)->passes();
        });
    }
}
