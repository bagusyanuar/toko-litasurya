<?php


namespace App\Commons\Request;


use Illuminate\Support\Facades\Validator;

class DTORequest
{
    protected $dtoForm;

    public function hydrateForm($formData)
    {
        $this->dtoForm = $formData;
    }

    protected function rules()
    {
        return [];
    }

    protected function messages()
    {
        return [];
    }

    public function validate()
    {
        return Validator::make($this->dtoForm, $this->rules(), $this->messages());
    }
}
