<?php

return [
    'sign_in' => '登入',
    'go_to_login' => '前往登入',
    'failed' => '找不到符合這些憑證的帳戶。',

    'forgot_password' => [
        'label' => '忘記密碼？',
        'label_help' => '輸入您的帳戶電子郵件地址以接收重設密碼的說明。',
        'button' => '復原帳戶',
    ],

    'reset_password' => [
        'button' => '重設並登入',
    ],

    'two_factor' => [
        'label' => '兩步驟驗證碼',
        'label_help' => '此帳戶需要第二層驗證才能繼續。請輸入您的裝置產生的代碼以完成此登入。',
        'checkpoint_failed' => '兩步驟驗證碼無效。',
    ],

    'throttle' => '登入嘗試次數過多。請在 :seconds 秒後再試。',
    'password_requirements' => '密碼長度至少需 8 個字元，且應為本站專用。',
    '2fa_must_be_enabled' => '管理員已要求您的帳戶必須啟用兩步驟驗證才能使用面板。',
];
