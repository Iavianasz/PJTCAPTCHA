<?php
    // Get your reCAPTCHA secret key from https://www.google.com/recaptcha
    $recaptchaSecretKey = '6LdC_BApAAAAAMcjXaupF9TBl_49IH_TwQggWLgT';

    // Get the client's response token from the POST request
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Check if the reCAPTCHA response is set
    if (empty($recaptchaResponse)) {
        echo json_encode(['success' => false, 'message' => 'reCAPTCHA response is empty']);
        exit;
    }

    // Verify reCAPTCHA response
    $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $verifyData = [
        'secret'   => $recaptchaSecretKey,
        'response' => $recaptchaResponse,
    ];

    $ch = curl_init($verifyUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($verifyData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode and check the response from Google
    $result = json_decode($response, true);

    if ($result['success']) {
    // The reCAPTCHA verification was successful
        echo json_encode(['success' => true, 'message' => 'reCAPTCHA verification successful']);
    } 
    else {
        // The reCAPTCHA verification failed
    echo json_encode(['success' => false, 'message' => 'reCAPTCHA verification failed']);
    }
?>
