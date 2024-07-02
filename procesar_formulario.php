<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $secretKey = '6Lfu1gYqAAAAABAkNUPEj_xFzFdTSx4tvlduQXu9'; 
    $captcha = $_POST['g-recaptcha-response'];
    
    if (!$captcha) {
        echo json_encode(['success' => false, 'message' => 'Por favor, completa el reCAPTCHA.']);
        exit;
    }
    
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $secretKey,
        'response' => $captcha
    ];
    
    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response);
    
    if ($result->success) {
        // Procesar el formulario
        $name = $_POST['your-name'];
        $email = $_POST['your-email'];
        $ticketType = $_POST['ticket-type'];
        
        
        
        echo json_encode(['success' => true, 'message' => 'Formulario enviado exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al validar el reCAPTCHA. Por favor, inténtalo de nuevo.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método HTTP no permitido.']);
}
?>