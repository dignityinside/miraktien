<?php

return [
    [
        'username' => 'test',
        'auth_key' => 'iwTNae9t34OmnK6l4vT4IeaTk-YWI2Rv',
        'password_hash' => '$2y$13$CXT0Rkle1EMJ/c1l5bylL.EylfmQ39O5JlHJVFpNn618OUS1HwaIi',
        'password_reset_token' => 't5GU9NwpuGYSfb7FEZMAxqtuz2PkEvv_' . time(),
        'created_at' => '1391885313',
        'updated_at' => '1391885313',
        'email' => 'test@example.com',
        'status' => \app\models\User::STATUS_WAIT,
        'premium' => '0'
    ],
    [
        'username' => 'test1',
        'auth_key' => 'EdKfXrx88weFMV0vIxuTMWKgfK2tS3Lp',
        'password_hash' => '$2y$13$g5nv41Px7VBqhS3hVsVN2.MKfgT3jFdkXEsMC4rQJLfaMa7VaJqL2',
        'password_reset_token' => '4BSNyiZNAuxjs5Mty990c47sVrgllIi_' . time(),
        'created_at' => '1391885313',
        'updated_at' => '1391885313',
        'email' => 'test1@example.com',
        'status' => \app\models\User::STATUS_WAIT,
        'premium' => '0'
    ],
    [
        'username' => 'test2',
        'auth_key' => 'O87GkY3_UfmMHYkyezZ7QLfmkKNsllzT',
        'password_hash' => '$2y$13$d17z0w/wKC4LFwtzBcmx6up4jErQuandJqhzKGKczfWuiEhLBtQBK', //Test1234
        'email' => 'test2@example.com',
        'status' => \app\models\User::STATUS_WAIT,
        'created_at' => '1548675330',
        'updated_at' => '1548675330',
        'premium' => '1'
    ],
    [
        'username' => 'test3',
        'auth_key' => '4XXdVqi3rDpa_a6JH6zqVreFxUPcUPvJ',
        'password_hash' => '$2y$13$d17z0w/wKC4LFwtzBcmx6up4jErQuandJqhzKGKczfWuiEhLBtQBK', //Test1234
        'email' => 'test3@example.com',
        'status' => \app\models\User::STATUS_DELETED,
        'created_at' => '1548675330',
        'updated_at' => '1548675330',
        'premium' => '0'
    ],
];
