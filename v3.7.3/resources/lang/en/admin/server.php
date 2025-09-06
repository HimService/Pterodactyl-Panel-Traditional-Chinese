<?php

return [
    'exceptions' => [
        'no_new_default_allocation' => '您正在嘗試刪除此伺服器的預設分配，但沒有可用的備用分配。',
        'marked_as_failed' => '此伺服器先前被標記為安裝失敗。在此狀態下無法切換目前狀態。',
        'bad_variable' => ':name 變數驗證錯誤。',
        'daemon_exception' => '嘗試與 daemon 通訊時發生例外，導致 HTTP/:code 回應碼。此例外已被記錄。(請求 ID: :request_id)',
        'default_allocation_not_found' => '在此伺服器的分配中找不到請求的預設分配。',
    ],
    'alerts' => [
        'startup_changed' => '此伺服器的啟動設定已更新。如果此伺服器的巢或蛋已變更，現在將進行重新安裝。',
        'server_deleted' => '已成功從系統中刪除伺服器。',
        'server_created' => '已在面板上成功建立伺服器。請讓 daemon 幾分鐘時間完全安裝此伺服器。',
        'build_updated' => '此伺服器的建置詳細資料已更新。某些變更可能需要重新啟動才能生效。',
        'suspension_toggled' => '伺服器停權狀態已變更為 :status。',
        'rebuild_on_boot' => '此伺服器已被標記為需要重建 Docker 容器。這將在下次伺服器啟動時發生。',
        'install_toggled' => '此伺服器的安裝狀態已切換。',
        'server_reinstalled' => '此伺服器已排入佇列，將立即開始重新安裝。',
        'details_updated' => '伺服器詳細資料已成功更新。',
        'docker_image_updated' => '已成功變更此伺服器使用的預設 Docker 映像檔。需要重新啟動才能套用此變更。',
        'node_required' => '您必須至少設定一個節點才能將伺服器新增至此面板。',
        'transfer_nodes_required' => '您必須至少設定兩個節點才能轉移伺服器。',
        'transfer_started' => '伺服器轉移已開始。',
        'transfer_not_viable' => '您選取的節點沒有足夠的磁碟空間或記憶體來容納此伺服器。',
    ],
];
