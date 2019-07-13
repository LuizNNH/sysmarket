<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../../Classes/Users.php";
require_once "../../Domains/Users/Utils.php";


class Validator{

    private $instance;

    public function __construct()
    {
        $this->instance = new Users();
    }

    public function checkForm($data)
    {
        if (empty($data['inptEmail']) or empty($data['inptPass']))
        {
            $response = [
                'success'  => false,
                'message'  => 'Verifique todos campos!'
            ];

            return json_encode($response);

        } else {
            return false;
        }
    }

    public function tryLogin($data)
    {
        $this->instance->setEmail($data['inptEmail']);
        $response = $this->instance->findByEmail();
        if ($response)
        {
            $hash = $this->instance->getPassHash();
            if (password_verify($data['inptPass'], $hash->password))
            {
                $response = [
                    'success' => true,
                    'message' => "Usuário Logado!"
                ];
                return json_encode($response);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Senha Errada!"
                ];
                return json_encode($response);
                
            }
        } else {
            $response = [
                'success' => false,
                'message' => "E-mail não encontrado!"
            ];
            return json_encode($response);
        }
    }

}