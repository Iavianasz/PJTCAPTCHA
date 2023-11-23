<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';

    // Verificar se a resposta do reCAPTCHA está presente
    if (!$recaptchaResponse) {
        echo "Por favor, complete o reCAPTCHA.";
        exit;
    }

    // Chave secreta do reCAPTCHA
    $secretKey = '6LdC_BApAAAAAMcjXaupF9TBl_49IH_TwQggWLgT';

    // Verificar o reCAPTCHA usando cURL
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => [
            'secret' => $secretKey,
            'response' => $recaptchaResponse,
        ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    // Decodificar a resposta JSON
    $responseData = json_decode($response, true);

    // Verificar se a validação foi bem-sucedida
    if ($responseData && $responseData['success'] == true) {
        // A validação do reCAPTCHA foi bem-sucedida
        echo "Usuário cadastrado com sucesso!";
    } else {
        // A validação do reCAPTCHA falhou
        echo "Falha na validação do reCAPTCHA.";
    }
} else {
    // Se a solicitação não for POST, redirecione ou lide de acordo com sua lógica
    echo "Método de requisição inválido.";
}
?>








