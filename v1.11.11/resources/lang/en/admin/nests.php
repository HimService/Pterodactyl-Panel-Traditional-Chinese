<?php

return [
    'notices' => [
        'created' => '已成功建立新的 Nest :name。',
        'deleted' => '已成功從面板中刪除請求的 Nest。',
        'updated' => '已成功更新 Nest 配置選項。',
    ],
    'eggs' => [
        'notices' => [
            'imported' => '已成功匯入此 Egg 及其相關變數。',
            'updated_via_import' => '此 Egg 已使用提供的檔案進行更新。',
            'deleted' => '已成功從面板中刪除請求的 Egg。',
            'updated' => 'Egg 配置已成功更新。',
            'script_updated' => 'Egg 安裝指令碼已更新，並將在安裝伺服器時執行。',
            'egg_created' => '已成功產下新的 Egg。您需要重新啟動任何正在執行的 daemon 以套用此新 Egg。',
        ],
    ],
    'variables' => [
        'notices' => [
            'variable_deleted' => '變數 ":variable" 已被刪除，重建後將不再適用於伺服器。',
            'variable_updated' => '變數 ":variable" 已更新。您需要重建任何使用此變數的伺服器以套用變更。',
            'variable_created' => '已成功建立新變數並指派給此 Egg。',
        ],
    ],
];
