
<?php
require_once "../../Classes/Taxes.php";

class Validator
{
    protected $instance;
    public function __construct()
    {
        $this->instance = new Taxes();
    }
    public function NewTax($data)
    {
        if (empty($data['inptPercent']) or empty($data['slctState']) or empty($data['slctCategory'])) {
            $response = [
                'success' => false,
                'message' => "Por favor preencha todos os campos corretamente!"
            ];
            return json_encode($response);
        } else {
            $this->instance->setState($data['slctState']);
            $this->instance->setCategory($data['slctCategory']);
            $response = $this->instance->findByStateAndCategory();
            if ($response) {
                $response = [
                    'success' => false,
                    'message' => "Já existe um imposto cadastrado para este Estado/Categoria"
                ];
                return json_encode($response);
            } else {
                return false;
            }
        }
    }
}
