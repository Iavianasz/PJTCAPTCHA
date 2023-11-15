<?php
// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se o nome e o email foram preenchidos
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if (empty($nome) || empty($email)) {
        echo "Erro: Nome e email são campos obrigatórios.";
        exit;
    }

    // Verifique o reCAPTCHA
    $recaptcha_secret_key = "6LdC_BApAAAAAMcjXaupF9TBl_49IH_TwQggWLgT";
    $recaptcha_response = $_POST['g-recaptcha-response'];

    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $recaptcha_secret_key,
        'response' => $recaptcha_response
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);

    // Tente fazer a solicitação HTTP
    $result = @file_get_contents($url, false, $context);

    // Verifique se a solicitação foi bem-sucedida
    if ($result !== false) {
        $result_json = json_decode($result, true);

        // Verifique se o reCAPTCHA foi validado
        if ($result_json['success']) {
            // Processar o restante do formulário aqui
            echo "reCAPTCHA validado. Formulário processado com sucesso!";
        } else {
            echo "Falha na validação do reCAPTCHA.";
        }
    } else {
        echo "Erro na solicitação HTTP para o Google reCAPTCHA.";
    }
} else {
    echo "Erro: O formulário não foi submetido.";
}
?>