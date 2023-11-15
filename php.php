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
    echo("O recapcha foi verficado com sucesso")
} 
else {
    // O reCAPTCHA falhou
    echo("A verificação do recapcha falhou")
}
?>
