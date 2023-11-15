<?php
$recaptcha_secret = '6Le-9BApAAAAAPQJUB-ey5_TVfEcTfjPdpjQC2AA';

$recaptcha_response = $_POST['g-recaptcha-response'];
$url = 'https://www.google.com/recaptcha/api/siteverify';

$data = array(
    'secret' => $recaptcha_secret,
    'response' => $recaptcha_response
);

$options = array(
    'http' => array (
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$response = json_decode($result, true);

if ($response['success'] == true) {
    // O reCAPTCHA foi verificado com sucesso
    // Prossiga com o processamento do formulário
} else {
    // O reCAPTCHA falhou
    // Exiba uma mensagem de erro ou tome outras medidas apropriadas
}
?>
