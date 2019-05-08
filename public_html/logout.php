<?php
require_once '../bootloader.php';
redirect();

$form = [
    'pre_validate' => [],
    'fields' => [
    ],
    'buttons' => [
        'submit' => [
            'text' => 'Logout!'
        ]
    ],
    'validate' => [
        'validate_logout'
    ],
    'callbacks' => [
        'success' => [],
        'fail' => []
    ]
];

function redirect() {
    if (!\App\App::$session->isLoggedIn() === true) {
        header('Location: login.php');
        exit();
    }
}

if (!empty($_POST)) {
    $safe_input = get_safe_input($form);
    $form_success = validate_form($safe_input, $form);
    if ($form_success) {
        $success_msg = 'Sekmingai atsijungete';
        header('Location: login.php');
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