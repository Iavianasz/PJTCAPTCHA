<?php

    if($_POST){

        //curl
        $curl = curl_init();
        
        //definiões da requisição com curl
        curl_setopt_array($curl, [
            CURLOPT_URL => ' https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'secret' => '6LdC_BApAAAAAMcjXaupF9TBl_49IH_TwQggWLgT',
                'response' => $_POST['g-recaptcha-response'] ?? ''
            ]
        ]);

        //Executa a requisição
        $response = curl_exec($curl);

        //Fecha a execução Curl
        curl_close($curl);

        //Response em array
        $responseArray = json_decode($response,true);

        //Sucesso do recaptcha
        $sucesso = $responseArray['succes'] ?? false;

        //retorno para usuário
        echo $sucesso ? "Usuário cadastrado com sucesso!" : "ReCaptcha inválido";
    }
?>