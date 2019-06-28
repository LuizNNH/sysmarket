<?php
require_once "../../classes/Users.php";


class Validator {

    protected $instance; 
    public function __construct()
    {
        $this->instance = new Users();
    }
    public function NewUser($data)
    {

        if (empty($data['inptUsername']) or empty($data['inptPassword']) or empty($data['inptEmail']))
        {
            $response = [
                'success' => false,
                'message' => "Por favor preencha todos os campos corretamente!"
            ];
            return json_encode($response);
        } else {
            $this->instance->setUsername($data['inptUsername']);
            $response = $this->instance->findByUsername();
            if (!empty($response))
            {
                $response = [
                    'success' => false,
                    'message' => "Já existe um usuário cadastrado com esse nome"
                ];
                return json_encode($response);
            } 
            else 
            {
                $this->instance->setEmail($data['inptEmail']);
                $response = $this->instance->findByEmail();

                if (!empty($response))
                {
                    $response = [
                        'success' => false,
                        'message' => "Já existe uma usuário cadastrado com esse email"
                    ];
                    return json_encode($response);                    
                }
                else
                {
                    return false;
                }
            }
            
        }
    }
}