<?php

return [
    'exceptions' => [
        'no_new_default_allocation' => '您正嘗試刪除此伺服器的預設分配，但沒有可用的備用分配。',
        'marked_as_failed' => '此伺服器先前已標示為安裝失敗。在此狀態下無法切換目前狀態。',
        'bad_variable' => '變數 :name 發生驗證錯誤。',
        'daemon_exception' => '嘗試與 daemon 通訊時發生例外狀況，導致 HTTP/:code 回應碼。此例外狀況已被記錄。(請求 ID: :request_id)',
        'default_allocation_not_found' => '在此伺服器的分配中找不到請求的預設分配。',
    ],
    'alerts' => [
        'startup_changed' => '此伺服器的啟動配置已更新。如果此伺服器的 Nest 或 Egg 已變更，現在將會進行重新安裝。',
        'server_deleted' => '已成功從系統中刪除伺服器。',
        'server_created' => '已成功在面板上建立伺服器。請讓 daemon 花幾分鐘時間完全安裝此伺服器。',
        'build_updated' => '此伺服器的建置詳細資料已更新。某些變更可能需要重新啟動才能生效。',
        'suspension_toggled' => '伺服器停權狀態已變更為 :status。',
        'rebuild_on_boot' => '此伺服器已標示為需要重建 Docker 容器。這將在下次啟動伺服器時發生。',
        'install_toggled' => '此伺服器的安裝狀態已切換。',
        'server_reinstalled' => '此伺服器已排入佇列，將立即開始重新安裝。',
        'details_updated' => '伺服器詳細資料已成功更新。',
        'docker_image_updated' => '已成功變更此伺服器要使用的預設 Docker 映像檔。需要重新啟動才能套用此變更。',
        'node_required' => '您必須至少設定一個節點，才能將伺服器新增至此面板。',
        'transfer_nodes_required' => '您必須至少設定兩個節點，才能傳輸伺服器。',
        'transfer_started' => '伺服器傳輸已開始。',
        'transfer_not_viable' => '您選取的節點沒有足夠的磁碟空間或記憶體來容納此伺服器。',
    ],
];