<?php
require_once '../bootloader.php';

$form = [
    'pre_validate' => [],
    'fields' => [
        'email' => [
            'label' => 'Email',
            'type' => 'text',
            'placeholder' => 'email@gmail.com',
            'validate' => [
                'validate_not_empty',
                'validate_email'
            ]
        ],
        'password' => [
            'label' => 'Password',
            'type' => 'password',
            'placeholder' => '********',
            'validate' => [
                'validate_not_empty'
            ]
        ]
    ],
    'validate' => [
        'validate_login'
    ],
    'buttons' => [
        'submit' => [
            'text' => 'Login!'
        ]
    ],
    'callbacks' => [
        'success' => [],
        'fail' => []
    ]
];

function validate_login(&$safe_input, &$form) {
    $status = \App\App::$session->login($safe_input['email'], $safe_input['password']);
    switch ($status) {
        case Core\User\Session::LOGIN_SUCCESS:
            return true;
    }
    
    $form['error_msg'] = 'Blogas Email/Password!';
}

if (!empty($_POST)) {
    $safe_input = get_safe_input($form);
    $form_success = validate_form($safe_input, $form);
    if ($form_success) {
        $success_msg = strtr('User "@email" sėkmingai prisijungei!', [
            '@email' => $safe_input['email']
        ]);
        header('Location: index.php');
        exit();
    }
}
?>
<html>
    <head>
        <title>OOP</title>
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <h1>GET ON STAGE!</h1>
        <div class="container">
            <div class="forma">
                <?php require '../core/views/form.php'; ?>
            </div>
        </div>
        <?php if (isset($success_msg)): ?>
            <h3><?php print $success_msg; ?></h3>
        <?php endif; ?>
    </body>
</html>