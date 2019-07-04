<?php
require_once "../../Classes/Users.php";


class Validator {

    protected $instance; 
    public function __construct()
    {
        $this->instance = new Users();
    }
    public function NewUser($data)
    {

        if (empty($data['inptName']) or empty($data['inptEmail']) or empty($data['inptCpf']) or empty($data['inptPassword']) or empty($data['slctType']))
        {
            $response = [
                'success' => false,
                'message' => "Por favor preencha todos os campos corretamente!"
            ];
            return json_encode($response);
        } else {
            $this->instance->setCpf($data['inptUsername']);
            $response = $this->instance->findByCpf();
            if ($response)
            {
                $response = [
                    'success' => false,
                    'message' => "Já existe um usuário cadastrado com esse Cpf!"
                ];
                return json_encode($response);
            } 
            else 
            {
                $this->instance->setEmail($data['inptEmail']);
                $response = $this->instance->findByEmail();

                if ($response)
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