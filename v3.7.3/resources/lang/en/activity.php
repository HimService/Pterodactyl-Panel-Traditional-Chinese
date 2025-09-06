<?php

/**
 * Contains all of the translation strings for different activity log
 * events. These should be keyed by the value in front of the colon (:)
 * in the event name. If there is no colon present, they should live at
 * the top level.
 */
return [
    'auth' => [
        'fail' => '登入失敗',
        'success' => '已登入',
        'password-reset' => '密碼已重設',
        'reset-password' => '請求重設密碼',
        'checkpoint' => '請求兩步驟驗證',
        'recovery-token' => '已使用兩步驟驗證備用碼',
        'token' => '已解決兩步驟驗證',
        'ip-blocked' => '已封鎖來自未列出 IP 位址的請求 :identifier',
        'sftp' => [
            'fail' => 'SFTP 登入失敗',
        ],
    ],
    'user' => [
        'account' => [
            'email-changed' => '電子郵件已從 :old 變更為 :new',
            'password-changed' => '密碼已變更',
            'username-changed' => '使用者名稱已從 :old 變更為 :new',
        ],
        'api-key' => [
            'create' => '已建立新的 API 金鑰 :identifier',
            'delete' => '已刪除 API 金鑰 :identifier',
        ],
        'ssh-key' => [
            'create' => '已將 SSH 金鑰 :fingerprint 新增至帳戶',
            'delete' => '已從帳戶移除 SSH 金鑰 :fingerprint',
        ],
        'two-factor' => [
            'create' => '已啟用兩步驟驗證',
            'delete' => '已停用兩步驟驗證',
        ],
        'store' => [
            'resource-purchase' => '已購買資源',
        ],
    ],

    'server' => [
        'reinstall' => '已重新安裝伺服器',
        'console' => [
            'command' => '已在伺服器上執行 ":command"',
        ],
        'power' => [
            'start' => '已啟動伺服器',
            'stop' => '已停止伺服器',
            'restart' => '已重新啟動伺服器',
            'kill' => '已終止伺服器處理程序',
        ],
        'backup' => [
            'download' => '已下載 :name 備份',
            'delete' => '已刪除 :name 備份',
            'restore' => '已還原 :name 備份 (刪除的檔案: :truncate)',
            'restore-complete' => '已完成 :name 備份的還原',
            'restore-failed' => '無法完成 :name 備份的還原',
            'start' => '已開始新的備份 :name',
            'complete' => '已將 :name 備份標記為完成',
            'fail' => '已將 :name 備份標記為失敗',
            'lock' => '已鎖定 :name 備份',
            'unlock' => '已解鎖 :name 備份',
        ],
        'database' => [
            'create' => '已建立新的資料庫 :name',
            'rotate-password' => '已輪替資料庫 :name 的密碼',
            'delete' => '已刪除資料庫 :name',
        ],
        'file' => [
            'compress_one' => '已壓縮 :directory:file',
            'compress_other' => '已壓縮 :directory 中的 :count 個檔案',
            'read' => '已檢視 :file 的內容',
            'copy' => '已建立 :file 的副本',
            'create-directory' => '已建立目錄 :directory:name',
            'decompress' => '已解壓縮 :directory 中的 :files',
            'delete_one' => '已刪除 :directory:files.0',
            'delete_other' => '已刪除 :directory 中的 :count 個檔案',
            'download' => '已下載 :file',
            'pull' => '已從 :url 下載遠端檔案至 :directory',
            'rename_one' => '已將 :directory:files.0.from 重新命名為 :directory:files.0.to',
            'rename_other' => '已重新命名 :directory 中的 :count 個檔案',
            'write' => '已將新內容寫入 :file',
            'upload' => '已開始檔案上傳',
            'uploaded' => '已上傳 :directory:file',
        ],
        'sftp' => [
            'denied' => '因權限問題已封鎖 SFTP 存取',
            'create_one' => '已建立 :files.0',
            'create_other' => '已建立 :count 個新檔案',
            'write_one' => '已修改 :files.0 的內容',
            'write_other' => '已修改 :count 個檔案的內容',
            'delete_one' => '已刪除 :files.0',
            'delete_other' => '已刪除 :count 個檔案',
            'create-directory_one' => '已建立 :files.0 目錄',
            'create-directory_other' => '已建立 :count 個目錄',
            'rename_one' => '已將 :files.0.from 重新命名為 :files.0.to',
            'rename_other' => '已重新命名或移動 :count 個檔案',
        ],
        'allocation' => [
            'create' => '已將 :allocation 新增至伺服器',
            'notes' => '已將 :allocation 的註解從 ":old" 更新為 ":new"',
            'primary' => '已將 :allocation 設定為主要伺服器分配',
            'delete' => '已刪除 :allocation 分配',
        ],
        'schedule' => [
            'create' => '已建立 :name 排程',
            'update' => '已更新 :name 排程',
            'execute' => '已手動執行 :name 排程',
            'delete' => '已刪除 :name 排程',
        ],
        'task' => [
            'create' => '已為 :name 排程建立新的 ":action" 任務',
            'update' => '已更新 :name 排程的 ":action" 任務',
            'delete' => '已刪除 :name 排程的任務',
        ],
        'settings' => [
            'rename' => '已將伺服器名稱從 :old 變更為 :new',
            'description' => '已將伺服器描述從 :old 變更為 :new',
        ],
        'startup' => [
            'edit' => '已將 :variable 變數從 ":old" 變更為 ":new"',
            'image' => '已將伺服器的 Docker 映像檔從 :old 更新為 :new',
        ],
        'subuser' => [
            'create' => '已將 :email 新增為子使用者',
            'update' => '已更新 :email 的子使用者權限',
            'delete' => '已移除 :email 子使用者',
        ],
    ],
];
