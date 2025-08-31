#!/bin/bash

# Pterodactyl-Panel-Traditional-Chinese Installation Script

# 顯示可用版本
echo "可用的面板翻譯版本："
echo "1) v1.11.10"
echo "2) v1.11.7"
read -p "請選擇要安裝的版本 (1-2): " version_choice

case $version_choice in
    1)
        VERSION="v1.11.10"
        ;;
    2)
        VERSION="v1.11.7"
        ;;
    *)
        echo "無效的選擇，腳本將終止。"
        exit 1
        ;;
esac

echo "您選擇了版本: $VERSION"

# 讓用戶輸入 Pterodactyl 路徑
read -p "請輸入您的 Pterodactyl 面板安裝路徑 (預設: /var/www/pterodactyl): " PTERODACTYL_PATH
PTERODACTYL_PATH=${PTERODACTYL_PATH:-/var/www/pterodactyl}

echo "面板路徑設定為: $PTERODACTYL_PATH"

# 檢查路徑是否存在
if [ ! -d "$PTERODACTYL_PATH" ]; then
    echo "錯誤: 路徑 $PTERODACTYL_PATH 不存在。"
    exit 1
fi

# 提醒使用者權限問題
echo "請確認您有權限修改 $PTERODACTYL_PATH"

# 建立一個安全的暫存目錄
TEMP_DIR=$(mktemp -d)
if [ ! -d "$TEMP_DIR" ]; then
    echo "無法建立暫存目錄。"
    exit 1
fi

# 下載主分支的壓縮檔
DOWNLOAD_URL="https://github.com/HimService/Pterodactyl-Panel-Traditional-Chinese/archive/refs/heads/main.zip"
echo "正在從 $DOWNLOAD_URL 下載最新的翻譯儲存庫..."
if ! curl -L -o "$TEMP_DIR/repo.zip" "$DOWNLOAD_URL"; then
    echo "下載失敗，請檢查您的網路連線或 URL 是否正確。"
    rm -rf "$TEMP_DIR"
    exit 1
fi

echo "下載完成。"

# 解壓縮儲存庫
echo "正在解壓縮儲存庫..."
if ! unzip -o "$TEMP_DIR/repo.zip" -d "$TEMP_DIR"; then
    echo "解壓縮失敗。"
    rm -rf "$TEMP_DIR"
    exit 1
fi

# 替換 resources 資料夾
cd "$PTERODACTYL_PATH" || exit
echo "正在備份並刪除舊的 resources 資料夾..."
BACKUP_NAME="resources_backup_$(date +%Y%m%d_%H%M%S)"
if [ -d "resources" ]; then
    mv resources "$BACKUP_NAME"
    echo "舊的 resources 資料夾已備份為 $BACKUP_NAME。"
fi

SOURCE_RESOURCES="$TEMP_DIR/Pterodactyl-Panel-Traditional-Chinese-main/$VERSION/resources"

if [ ! -d "$SOURCE_RESOURCES" ]; then
    echo "錯誤: 找不到來源資料夾 $SOURCE_RESOURCES。"
    echo "請確認您選擇的版本 $VERSION 是否存在於儲存庫中。"
    # 如果來源不存在，還原備份
    if [ -d "$BACKUP_NAME" ]; then
         mv "$BACKUP_NAME" resources
    fi
    rm -rf "$TEMP_DIR"
    exit 1
fi

echo "正在從解壓縮的資料夾中複製 $VERSION 的 resources 資料夾..."
if ! cp -r "$SOURCE_RESOURCES" "."; then
    echo "複製 resources 資料夾失敗。"
    # 如果複製失敗，還原備份
    if [ -d "$BACKUP_NAME" ]; then
         mv "$BACKUP_NAME" resources
    fi
    rm -rf "$TEMP_DIR"
    exit 1
fi

# 清理下載和解壓縮的檔案
echo "正在刪除下載的檔案與暫存資料夾..."
rm -rf "$TEMP_DIR"

echo "resources 資料夾替換成功。"

# 運行 yarn 指令
echo "正在運行 yarn install..."
yarn install --pure-lockfile || { echo "yarn install 指令失敗，腳本終止。"; exit 1; }

echo "正在設定 NodeJS v17+ 環境變數..."
export NODE_OPTIONS=--openssl-legacy-provider

echo "正在建置前端資源..."
yarn build:production || { echo "yarn build:production 指令失敗，腳本終止。"; exit 1; }

# 將 storage 與 bootstrap/cache 擁有者改為 www-data
echo "正在設定資料夾權限..."
sudo chown -R www-data:www-data storage bootstrap/cache

# 設定目錄權限為 775
sudo chmod -R 775 storage bootstrap/cache

# 清除 Laravel 快取
echo "正在清除快取..."
sudo -u www-data php artisan cache:clear
sudo -u www-data php artisan config:clear
sudo -u www-data php artisan view:clear
sudo -u www-data php artisan route:clear
echo "快取已清除。"

echo "Pterodactyl Panel 繁體中文翻譯版本 $VERSION 安裝成功！"
