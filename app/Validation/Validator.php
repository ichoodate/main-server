<?php

namespace App\Validation;

use Illuminate\Support\Collection;
use Illuminate\Validation\Validator as BaseValidator;
use Closure;

class Validator extends BaseValidator {

    public function __construct($translator, array $data, array $rules, array $messages = [], array $customAttributes = [])
    {
        parent::__construct(
            $translator,
            $data,
            $rules,
            $messages,
            $customAttributes
        );

        $this->sizeRules  = array_merge($this->sizeRules, [
            'Less', 'More'
        ]);
        $this->implicitRules  = array_merge($this->implicitRules, [
            // ... add some implicit custom rules
        ]);
        $this->dependentRules = array_merge($this->dependentRules, [
            // ... add some dependent custom rules
        ]);
    }

    protected function getAttribute($attribute)
    {
        $pAttr        = $this->getPrimaryAttribute($attribute);
        $asteriskKeys = $this->getExplicitKeys($attribute);
        $cAttr        = $this->getCustomAttribute($pAttr);
        $matches      = [];

        if ( $asteriskKeys != [] )
        {
            $cAttr = str_replace('*', $asteriskKeys[0], $cAttr);
        }

        return $cAttr;
    }

    protected function getCustomAttribute($key)
    {
        return $this->customAttributes[$key];
    }

    public function addError($attribute, $rule, $parameters)
    {
        return parent::addError($attribute, $rule, $parameters);
    }

    protected function replaceLess($message, $attribute, $rule, $parameters)
    {
        return str_replace(':less', $parameters[0], $message);
    }

    protected function replaceMore($message, $attribute, $rule, $parameters)
    {
        return str_replace(':more', $parameters[0], $message);
    }

    public function validateDate($attribute, $value)
    {
        return is_string($value) && preg_match('/^(19|20)(\\d{2})-(0[1-9]|1[0-2])-(0[1-9]|[1-2]\\d|3[0-1])$/', $value);
    }

    public function validateDatetime($attribute, $value, $parameters, $validator)
    {
        if ( empty($value) )
        {
            return true;
        }
        else if ( preg_match('/^(19|20)(\\d{2})-(0[1-9]|1[0-2])-(0[1-9]|[1-2]\\d|3[0-1])\\s([0-1]\\d|2[0-3]):([0-5]\\d):([0-5]\\d)$/', $value) )
        {
            $datetime = new \DateTime($value);

            return checkdate($datetime->format('m'), $datetime->format('d'), $datetime->format('Y'));
        }

        return false;
    }

    protected function validateGdImage($attribute, $value, $parameters, $validator)
    {
        return $this->validateMimes($attribute, $value, ['jpeg', 'png', 'gif']);
    }

    protected function validateInIf($attribute, $value, $parameters)
    {
        $this->requireParameterCount(2, $parameters, 'in_if');

        $parameters[0] = $this->getValue($parameters[0]);

        if ( $parameters[0] != $parameters[1] )
        {
            return true;
        }

        $parameters = array_slice($parameters, 2);

        return $this->validateIn($attribute, $value, $parameters);
    }

    protected function validateIntegers($attribute, $value)
    {
        if ( ! $this->validateString($attribute, $value) && ! $this->validateInteger($attribute, $value) )
        {
            return false;
        }

        $integers = preg_split('/\s*,\s*/', $value);
        $result = true;

        foreach ( $integers as $integer )
        {
            ! $this->validateInteger($attribute, $integer) ?
                $result = false : null;
        }

        return $result;
    }

    protected function validateInUnless($attribute, $value, $parameters)
    {
        $this->requireParameterCount(2, $parameters, 'in_less');

        $parameters[0] = $this->getValue($parameters[0]);

        if ( $parameters[0] == $parameters[1] )
        {
            return true;
        }

        $parameters = array_slice($parameters, 2);

        return $this->validateIn($attribute, $value, $parameters);
    }

    protected function validateLess($attribute, $value, $parameters)
    {
        $this->requireParameterCount(1, $parameters, 'less');

        if ($value instanceof UploadedFile && ! $value->isValid()) {
            return false;
        }

        return $this->getSize($attribute, $value) < $parameters[0];
    }

    protected function validateMore($attribute, $value, $parameters)
    {
        $this->requireParameterCount(1, $parameters, 'more');

        return $this->getSize($attribute, $value) > $parameters[0];
    }

    protected function validateNotNull($attribute, $value)
    {
        return ! $this->validateNull($attribute, $value);
    }

    protected function validateNotNullIf($attribute, $value, $parameters)
    {
        $this->requireParameterCount(2, $parameters, 'not_null_if');

        $ifValue = $this->getValue($parameters[0]);

        if ( $ifValue != $parameters[1] )
        {
            return true;
        }

        return $this->validateNotNull($attribute, $value);
    }

    protected function validateNotNullUnless($attribute, $value, $parameters)
    {
        $this->requireParameterCount(2, $parameters, 'not_null_unless');

        $ifValue = $this->getValue($parameters[0]);

        if ( $ifValue == $parameters[1] )
        {
            return true;
        }

        return $this->validateNotNull($attribute, $value);
    }

    protected function validateNull($attribute, $value)
    {
        if ( is_null($value) || $value === 'null' )
        {
            return true;
        }

        return false;
    }

    protected function validateNullIf($attribute, $value, $parameters)
    {
        $this->requireParameterCount(2, $parameters, 'null_if');

        $ifValue = $this->getValue($parameters[0]);

        if ( $ifValue != $parameters[1] )
        {
            return true;
        }

        return $this->validateNull($attribute, $value);
    }

    protected function validateNullUnless($attribute, $value, $parameters)
    {
        $this->requireParameterCount(2, $parameters, 'null_unless');

        $ifValue = $this->getValue($parameters[0]);

        if ( $ifValue == $parameters[1] )
        {
            return true;
        }

        return $this->validateNull($attribute, $value);
    }

    protected function validateSeveralIn($attribute, $value, $parameters, $validator)
    {
        $this->requireParameterCount(1, $parameters, 'several_in');

        $value   = preg_split('/\s*,\s*/', $value);
        $options = $this->getValue($parameters[0]);

        sort($value);
        sort($options);

        $options = implode(',', $options);
        $value = implode(',', $value);

        return empty($value) || starts_with($options, $value);
    }

}
