<?php
    if($_POST){
        $curl = curl_init();

        curl_setopt_array($curl,[
            CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => [
                'secret' => '6LdC_BApAAAAAMcjXaupF9TBl_49IH_TwQggWLgT'
                'response' => $_POST['g-recaptcha-response'] ?? ''
            ]
        ]);


        $response = curl_exec($curl);

        curl_close($curl);

        $responseArray = json_decode($response,true);

        $sucesso = $responseArray['success'] ?? false;

        echo $sucesso ? "Usuário cadastrado com sucesso!" : "RECAPTCHA inválido";
        exit;







    }
?>