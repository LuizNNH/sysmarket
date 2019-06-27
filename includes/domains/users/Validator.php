<?php

class Validator {


    public function NewUser($data)
    {
        if ($data['username'] or $data['email'] or $data['password'] == null)
        {
            $response = [
                'success' => false,
                'message' => "Por favor preencha todos os campos corretamente!"
            ];

            return json_encode($response);
        }
    }
}