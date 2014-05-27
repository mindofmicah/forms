<?php
namespace MindOfMicah\Forms;

use Illuminate\Validation\Factory as Validator;


abstract class Form
{
    protected $validator;
    
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function validate($form_data)
    {
        $this->validation = $this->validator->make($form_data, $this->getValidationRules());    
        if ($this->validation->fails()) {
            throw new FormValidationException('Validation Failed', $this->getValidationErrors());
        }
        return true;
    }

    protected function getValidationRules() 
    {
        return $this->rules;
    }

    protected function getValidationErrors()
    {
        return $this->validation->errors();
    }
}
