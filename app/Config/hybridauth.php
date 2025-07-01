<?php
return [
    'callback' => 'http://localhost:8080/auth/loginGoogle',
    'providers' => [
        'Google' => [
            'enabled' => true,
            'keys'    => [
                'id'     => '29930009673-ek8dar6sdbjla3khcq57uf16dhvjttlt.apps.googleusercontent.com',
                'secret' => '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',
            ],
            'scope'   => 'email profile',
        ],
    ],
];
