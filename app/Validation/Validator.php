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

    public function getDisplayableAttribute($attribute)
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
        if ( array_key_exists($key, $this->customAttributes) )
        {
            return $this->customAttributes[$key];
        }

        return $key;
    }

    protected function getSize($attribute, $value)
    {
        if (is_numeric($value) ) {
            return $value;
        } elseif (is_array($value)) {
            return count($value);
        } elseif ($value instanceof File) {
            return $value->getSize() / 1024;
        }

        return mb_strlen($value);
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

    public function validateBase64($attribute, $value, $parameters, $validator)
    {
        if ( base64_encode(base64_decode($value, true)) === $value )
        {
            return true;
        }
        else
        {
            return false;
        }
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

    public function validateFalse($attribute, $value, $parameters, $validator)
    {
        return $value === false || $value === 'false' || $value === 0 || $value === '0';
    }

    public function validateGdImage($attribute, $value, $parameters, $validator)
    {
        return $this->validateMimes($attribute, $value, ['jpeg', 'png', 'gif']);
    }

    public function validateInIf($attribute, $value, $parameters)
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

    public function validateIntegers($attribute, $value)
    {
        if ( ! $this->validateString($attribute, $value) && ! $this->validateInteger($attribute, $value) )
        {
            return false;
        }

        $integers = preg_split('/\s*,\s*/', $value);
        $result   = true;

        foreach ( $integers as $integer )
        {
            if ( ! $this->validateInteger($attribute, $integer) )
            {
                $result = false;
            }
        }

        return $result;
    }

    public function validateInUnless($attribute, $value, $parameters)
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

    public function validateLess($attribute, $value, $parameters)
    {
        $this->requireParameterCount(1, $parameters, 'less');

        if ($value instanceof UploadedFile && ! $value->isValid()) {
            return false;
        }

        return $this->getSize($attribute, $value) < $parameters[0];
    }

    public function validateMore($attribute, $value, $parameters)
    {
        $this->requireParameterCount(1, $parameters, 'more');

        return $this->getSize($attribute, $value) > $parameters[0];
    }

    public function validateNotNull($attribute, $value)
    {
        return ! $this->validateNull($attribute, $value);
    }

    public function validateNotNullIf($attribute, $value, $parameters)
    {
        $this->requireParameterCount(2, $parameters, 'not_null_if');

        $ifValue = $this->getValue($parameters[0]);

        if ( $ifValue != $parameters[1] )
        {
            return true;
        }

        return $this->validateNotNull($attribute, $value);
    }

    public function validateNotNullUnless($attribute, $value, $parameters)
    {
        $this->requireParameterCount(2, $parameters, 'not_null_unless');

        $ifValue = $this->getValue($parameters[0]);

        if ( $ifValue == $parameters[1] )
        {
            return true;
        }

        return $this->validateNotNull($attribute, $value);
    }

    public function validateNull($attribute, $value)
    {
        if ( is_null($value) )
        {
            return true;
        }

        return false;
    }

    public function validateNullIf($attribute, $value, $parameters)
    {
        $this->requireParameterCount(2, $parameters, 'null_if');

        $ifValue = $this->getValue($parameters[0]);

        if ( $ifValue != $parameters[1] )
        {
            return true;
        }

        return $this->validateNull($attribute, $value);
    }

    public function validateNullUnless($attribute, $value, $parameters)
    {
        $this->requireParameterCount(2, $parameters, 'null_unless');

        $ifValue = $this->getValue($parameters[0]);

        if ( $ifValue == $parameters[1] )
        {
            return true;
        }

        return $this->validateNull($attribute, $value);
    }

    public function validateMax($attribute, $value, $parameters)
    {
        $this->requireParameterCount(1, $parameters, 'max');

        $limit = $parameters[0];

        if ( array_key_exists($limit, $this->data) )
        {
            $limit = $this->getValue($limit);
        }

        return $this->getSize($attribute, $value) <= $limit;
    }

    public function validateMin($attribute, $value, $parameters)
    {
        $this->requireParameterCount(1, $parameters, 'min');

        $limit = $parameters[0];

        if ( array_key_exists($limit, $this->data) )
        {
            $limit = $this->getValue($limit);
        }

        return $this->getSize($attribute, $value) >= $limit;
    }

    public function validateSeveralInArray($attribute, $value, $parameters, $validator)
    {
        $this->requireParameterCount(1, $parameters, 'several_in_array');

        $options = $this->getValue($parameters[0]);
        $result  = true;
        $value   = preg_split('/\s*,\s*/', $value);

        foreach ( $value as $option )
        {
            if ( !in_array($option, $options) )
            {
                $result = false;
            }
        }

        return $result;
    }

    public function validateTrue($attribute, $value, $parameters, $validator)
    {
        return $value === true || $value === 'true' || $value === 1 || $value === '1';
    }

}
