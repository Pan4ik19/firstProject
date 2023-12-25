<?php

namespace Controller;

use Model\User;

class Validate
{
    protected array $errors;

    protected array $rulesList=['isRequired','isMin','isPattern','isNotUsed'];

    protected array $messages =[
        'isRequired' => 'The :fieldName: field is required',
        'isMin'=>'The :fieldName: field must be a minimum :ruleValues: characters',
        'isPattern'=>'The :fieldName: field must not contain numbers',
        'isNotUsed'=>'The :fieldName: is used'
    ];


    private array $rules = [
        'name'=>[
            'isRequired' => true,
            'isMin'=> 2,
            'isPattern'=> "/^[A-z]*$/"
        ],
        'email'=>[
            'isRequired' => true,
            'isPattern' => "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",
            'isNotUsed' => true
        ],
        'password'=>[
            'isRequired' =>true,
            'isMin'=>4
        ]
    ];

    public function validate(array $data = [], array $rules = []):Validate
    {
        foreach ($data as $fieldName => $value){
            if(in_array($fieldName, array_keys($rules)))
            {
                $this->fieldName([
                    'fieldName'=>$fieldName,
                    'value'=>$value,
                    'rules'=>$this->rules[$fieldName]
                ]);
            }
        }
        return $this;
    }

    protected function fieldName(array $field)
    {
        foreach ($field['rules'] as $rule=>$ruleValue )
        {
            if(in_array($rule, $this->rulesList ))
            {
               if(!call_user_func_array([$this, $rule],[$field['value']],$ruleValue))
               {
                    $this->addError($field['fieldName'],
                        str_replace([':fieldName:',':ruleValues:'],
                                    [$field['fieldName'],$ruleValue],
                                    $this->messages[$rule]));
               }
            }
        }
    }

    protected function addError(string $fieldName, string $error)
    {
        $this->errors[$fieldName][] = $error;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors()
    {
        return empty($this->errors);
    }

    protected function isRequired( $value,$ruleValue):bool
    {
        return !empty(trim($value));
    }

    protected function isMin($value,$ruleValue):bool
    {
        return mb_strlen($value,'UTF-8') >= $ruleValue;
    }

    protected function isPattern($value,$ruleValue):bool
    {
        return preg_match($ruleValue, $value );
    }

    protected function isNotUsed($value,$ruleValue):bool
    {
        if($this->isPattern($value,$ruleValue))
        {
            $modelUser= new User();
            $data = $modelUser->getOneByEmail($value);
            return empty($data);
        }
        return false;
    }
}