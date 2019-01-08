<?php

namespace Tests\Unit\App\Validation;

use Tests\Unit\_TestCase;

class ValidatorTest extends _TestCase {

    public function validator($data, $rules, $msg = [], $names = [])
    {
        $factory = inst(\Illuminate\Validation\Factory::class);
        $factory->resolver(function (\Symfony\Component\Translation\TranslatorInterface $translator, array $data, array $rules, array $messages, array $customDataKeyNames) {

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

        $data  = ['keywords'   => [1234, 2345, null]];

        $this->assertFalse($this->validator($data, $rules)->passes());
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

        $this->assertException(function () {

            $this->assertValid($data, $rules);
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

        $this->assertException(function () {

            $this->assertValid($data, $rules);
        });
    }

    public function testValidateNullIf()
    {
        $rules = ['bcd' => ['null_if:abc, 2345']];

        $data  = ['abc' => '1234', 'bcd' => 'null'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => '1234', 'bcd' => 'bcde'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => '2345', 'bcd' => 'null'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => '2345', 'bcd' => 'bcde'];

        $this->assertFalse($this->validator($data, $rules)->passes());

        $rules = ['abc' => ['null_if:first']];

        $this->assertException(function () {

            $this->assertValid($data, $rules);
        });
    }

    public function testValidateNullUnless()
    {
        $rules = ['bcd' => ['null_unless:abc, 2345']];

        $data  = ['abc' => '1234', 'bcd' => 'null'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => '1234', 'bcd' => 'bcde'];

        $this->assertFalse($this->validator($data, $rules)->passes());

        $data  = ['abc' => '2345', 'bcd' => 'null'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $data  = ['abc' => '2345', 'bcd' => 'bcde'];

        $this->assertTrue($this->validator($data, $rules)->passes());

        $rules = ['abc' => ['null_unless:first']];

        $this->assertException(function () {

            $this->assertValid($data, $rules);
        });
    }
}
