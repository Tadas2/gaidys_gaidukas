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
                'validate_email',
                'validate_user_exists'
            ]
        ],
        'password' => [
            'label' => 'Password',
            'type' => 'password',
            'placeholder' => '********',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'password_again' => [
            'label' => 'Password again',
            'type' => 'password',
            'placeholder' => '********',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'full_name' => [
            'label' => 'Full Name',
            'type' => 'text',
            'placeholder' => 'Ernestas Zidokas',
            'validate' => [
                'validate_not_empty',
                'validate_contains_space',
                'validate_more_4_chars'
            ]
        ],
        'age' => [
            'label' => 'Age',
            'placeholder' => '26',
            'type' => 'number',
            'min' => 0,
            'max' => 999,
            'validate' => [
                'validate_not_empty',
                'validate_is_number',
                'validate_age'
            ]
        ],
        'gender' => [
            'label' => 'Gender',
            'type' => 'select',
            'placeholder' => '',
            'options' => \Core\User\User::getGenderOptions(),
            'validate' => [
                'validate_not_empty',
                'validate_field_select'
            ]
        ],
        'orientation' => [
            'label' => 'Orientation',
            'type' => 'select',
            'placeholder' => '',
            'options' => \Core\User\User::getOrientationOptions(),
            'validate' => [
                'validate_not_empty',
                'validate_field_select'
            ],
        ],
        'photo' => [
            'label' => 'Photo',
            'placeholder' => 'file',
            'type' => 'file',
            'validate' => [
                'validate_file'
            ]
        ],
    ],
    'validate' => [
        'validate_password',
        'validate_form_file'
    ],
    'buttons' => [
        'submit' => [
            'text' => 'Paduoti!'
        ]
    ],
    'callbacks' => [
        'success' => [
            'form_success'
        ],
        'fail' => []
    ]
];

function form_success($safe_input, $form) {
    $user = new Core\User\User([
        'email' => $safe_input['email'],
        'password' => $safe_input['password'],
        'full_name' => $safe_input['full_name'],
        'age' => $safe_input['age'],
        'gender' => $safe_input['gender'],
        'orientation' => $safe_input['orientation'],
        'account_type' => \Core\User\User::ACCOUNT_TYPE_USER,
        'photo' => $safe_input['photo'],
        'is_active' => true
    ]);

    \App\App::$user_repo->insert($user);
}

if (!empty($_POST)) {
    $safe_input = get_safe_input($form);
    $form_success = validate_form($safe_input, $form);
    if ($form_success) {
        $success_msg = strtr('User "@email" sėkmingai sukurtas!', [
            '@email' => $safe_input['email']
        ]);
    }
}

?>
<html>
    <head>
        <title>OOP</title>
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <h1>BECOME THE RAP GOD</h1>
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