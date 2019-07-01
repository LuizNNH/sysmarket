<?php

require_once "../../Classes/Categories.php";

Class Validator{

    protected $instance;

    public function __construct()
    {   
        $this->instance = new Categories();
    }

    public function NewCategory($data)
    {   
        if (empty($data['inptCategoryNm']))
        {
            $response = [
                'success' => false,
                'message' => 'Preencha o campo com o nome da categoria!'
            ];
            return json_encode($response);
        } else {
            
            $this->instance->setCategory($data['inptCategoryNm']);
            $response = $this->instance->findByName();
            if (!empty($response))
            {
                $response = [
                    'success' => false,
                    'message' => 'Categoria já existe!'
                ];
                return json_encode($response);
            } else {
                return false;
            }
        }
    }
}