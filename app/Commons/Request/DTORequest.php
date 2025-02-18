<?php


namespace App\Commons\Request;


use Illuminate\Support\Facades\Validator;

class DTORequest
{
    protected $dtoForm;
    protected $query;

    public function hydrateForm($formData)
    {
        $this->dtoForm = $formData;
    }

    public function hydrateQueryForm($query)
    {
        $this->query = $query;
        return $this;
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

    public function hydrate()
    {

    }

    public function dehydrate()
    {
        return [];
    }
}
