
<?php
require_once "../../Classes/Products.php";

class Validator
{
    protected $instance;
    public function __construct()
    {
        $this->instance = new Products();
    }
    public function NewProduct($data)
    {
        if (empty($data['inptEan']) or empty($data['inptNmProduct']) or empty($data['inptApresentation']) or empty($data['slctLaboratory']) or empty($data['slctCategory']) or empty($data['inptPrice'])) {
            $response = [
                'success' => false,
                'message' => "Por favor preencha todos os campos corretamente!"
            ];
            return json_encode($response);
        } else {
            $this->instance->setEan($data['inptEan']);
            $response = $this->instance->findByEan();
            if ($response) {
                $response = [
                    'success' => false,
                    'message' => "Já existe um produto com esse EAN"
                ];
                return json_encode($response);
            } else {
                if ($data['inptPrice'] <= 0)
                {
                    $response = [
                        'success' => false,
                        'message' => "O preço tem que ser maior que zero!"
                    ];
                    return json_encode($response);
                } else {
                    $this->instance->setCategory($data['slctCategory']);
                    $response = $this->instance->findCategoryExists();
                    if ($response = 0) 
                    {
                        $response = [
                            'success' => false,
                            'message' => "A categoria não existe!"
                        ];
                        return json_encode($response);
                    } else {
                        $this->instance->setLaboratory($data['slctLaboratory']);
                        $response = $this->instance->findLaboratoryExists();
                        if ($response = 0) {
                            $response = [
                                'success' => false,
                                'message' => "O Laboratorio informado não existe!"
                            ];
                            return json_encode($response);
                        } else {
                            return false;
                        }
                    }
                }
            }
        }
    }
}