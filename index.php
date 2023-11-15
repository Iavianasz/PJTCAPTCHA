
<?php
    if($_POST){
        $curl = curl_init();

        curl_setopt_array($curl,[
            CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'secret' => '6LdC_BApAAAAAMcjXaupF9TBl_49IH_TwQggWLgT',
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

<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Formulário</title>

    <script>
         function ValidatePost(){
                if(grecaptcha.getResponse() != "") return true;
                alert('Selecione a caixa de "Não sou um robô"')
                return false;
         }
    </script>
</head>
<body>

    <form action="php.php" method="post" onsubmit=" return ValidatePost()">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email">

        <div class="g-recaptcha" data-sitekey="6LdC_BApAAAAANBFoaT6G8wRx843YPMZCEF2teqs" required></div>

        <button type="submit">Enviar</button>
    </form>

</body>
</html>
