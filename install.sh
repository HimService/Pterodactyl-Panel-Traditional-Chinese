#!/bin/bash

# Jexactyl-Panel-Traditional-Chinese Installation Script

# --- Colors ---
CYAN='\033[0;36m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# --- 清理控制台 ---
printf "\033c"

# --- 歡迎訊息 ---
echo -e "${CYAN}########################################################################${NC}"
echo -e "${CYAN}                                                                      ${NC}"
echo -e "${CYAN}          Jexactyl Panel 繁體中文翻譯安裝腳本                         ${NC}"
echo -e "${CYAN}                                                                      ${NC}"
echo -e "${CYAN}               你正在使用HimService專案安裝腳本安裝                      ${NC}"
echo -e "${CYAN}                                                                      ${NC}"
echo -e "${CYAN}         HimService/Jexactyl-Panel-Traditional-Chinese              ${NC}"
echo -e "${CYAN}                                                                      ${NC}"
echo -e "${CYAN}########################################################################${NC}"
echo ""

# --- 版本選擇 ---
echo -e "${CYAN}-------------------------- [ 版本選擇 ] ---------------------------${NC}"
echo -e "${YELLOW}可用的面板翻譯版本：${NC}"
echo "1) v3.7.3-測試版"
read -p "$(echo -e "${YELLOW}請選擇要安裝的版本 (1-1): ${NC}")" version_choice

case $version_choice in
    1)
        VERSION="v3.7.3"
        ;;
            *)
        echo -e "${RED}無效的選擇，腳本將終止。${NC}"
        exit 1
        ;;
esac

echo -e "${GREEN}您選擇了版本: $VERSION${NC}"
echo ""

# --- 路徑設定 ---
echo -e "${CYAN}------------------------ [ 面板路徑設定 ] -------------------------${NC}"
read -p "$(echo -e "${YELLOW}請輸入您的 Jexactyl 面板安裝路徑 (預設: /var/www/jexactyl): ${NC}")" Jexactyl_PATH
Jexactyl_PATH=${Jexactyl_PATH:-/var/www/jexactyl}

echo -e "${GREEN}面板路徑設定為: $Jexactyl_PATH${NC}"
echo ""

# 檢查路徑是否存在
if [ ! -d "$Jexactyl_PATH" ]; then
    echo -e "${RED}錯誤: 路徑 $Jexactyl_PATH 不存在。${NC}"
    exit 1
fi

# 提醒使用者權限問題
echo -e "${YELLOW}請確認您有權限修改 $Jexactyl_PATH${NC}"

# 建立一個安全的暫存目錄
TEMP_DIR=$(mktemp -d)
if [ ! -d "$TEMP_DIR" ]; then
    echo -e "${RED}無法建立暫存目錄。${NC}"
    exit 1
fi

# --- 下載與解壓縮 ---
echo -e "${CYAN}------------------------ [ 下載翻譯檔案 ] -------------------------${NC}"
DOWNLOAD_URL="https://github.com/HimService/Pterodactyl-Panel-Traditional-Chinese/archive/refs/heads/Jexactyl.zip"
echo -e "${YELLOW}正在從 $DOWNLOAD_URL 下載最新的翻譯儲存庫...${NC}"
if ! curl -L -o "$TEMP_DIR/repo.zip" "$DOWNLOAD_URL"; then
    echo -e "${RED}下載失敗，請檢查您的網路連線或 URL 是否正確。${NC}"
    rm -rf "$TEMP_DIR"
    exit 1
fi

echo -e "${GREEN}下載完成。${NC}"
echo ""
echo -e "${YELLOW}正在解壓縮儲存庫...${NC}"
if ! unzip -o "$TEMP_DIR/repo.zip" -d "$TEMP_DIR"; then
    echo -e "${RED}解壓縮失敗。${NC}"
    rm -rf "$TEMP_DIR"
    exit 1
fi

# --- 替換檔案 ---
echo -e "${CYAN}------------------------ [ 替換面板檔案 ] -------------------------${NC}"
cd "$Jexactyl_PATH" || exit
echo -e "${YELLOW}正在備份並刪除舊的 resources 資料夾...${NC}"
BACKUP_NAME="resources_backup_$(date +%Y%m%d_%H%M%S)"
if [ -d "resources" ]; then
    mv resources "$BACKUP_NAME"
    echo -e "${GREEN}舊的 resources 資料夾已備份為 $BACKUP_NAME。${NC}"
fi

SOURCE_RESOURCES="$TEMP_DIR/Pterodactyl-Panel-Traditional-Chinese-Jexactyl/$VERSION/resources"

if [ ! -d "$SOURCE_RESOURCES" ]; then
    echo -e "${RED}錯誤: 找不到來源資料夾 $SOURCE_RESOURCES。${NC}"
    echo -e "${RED}請確認您選擇的版本 $VERSION 是否存在於儲存庫中。${NC}"
    # 如果來源不存在，還原備份
    if [ -d "$BACKUP_NAME" ]; then
         mv "$BACKUP_NAME" resources
    fi
    rm -rf "$TEMP_DIR"
    exit 1
fi

echo -e "${YELLOW}正在從解壓縮的資料夾中複製 $VERSION 的 resources 資料夾...${NC}"
if ! cp -r "$SOURCE_RESOURCES" "."; then
    echo -e "${RED}複製 resources 資料夾失敗，是否有使用root權限?${NC}"
    # 如果複製失敗，還原備份
    if [ -d "$BACKUP_NAME" ]; then
         mv "$BACKUP_NAME" resources
    fi
    rm -rf "$TEMP_DIR"
    exit 1
fi

# 清理下載和解壓縮的檔案
echo -e "${YELLOW}正在刪除下載的檔案與暫存資料夾...${NC}"
rm -rf "$TEMP_DIR"

echo -e "${GREEN}resources 資料夾替換成功。${NC}"
echo ""

# --- 安裝與建置 ---
echo -e "${CYAN}---------------------- [ 安裝前端套件並建置 ] -----------------------${NC}"
echo -e "${YELLOW}正在運行 yarn install...${NC}"
yarn install --pure-lockfile || { echo -e "${RED}yarn install 指令失敗，腳本終止。${NC}"; exit 1; }

echo -e "${YELLOW}正在設定 NodeJS v17+ 環境變數...${NC}"
export NODE_OPTIONS=--openssl-legacy-provider

echo -e "${YELLOW}正在建置前端資源...${NC}"
yarn build:production || { echo -e "${RED}yarn build:production 指令失敗，腳本終止。${NC}"; exit 1; }

# --- 設定權限與快取 ---
echo -e "${CYAN}---------------------- [ 設定權限與清除快取 ] -----------------------${NC}"
echo -e "${YELLOW}正在設定資料夾權限...${NC}"
sudo chown -R www-data:www-data storage bootstrap/cache

# 設定目錄權限為 775
sudo chmod -R 775 storage bootstrap/cache

# 清除 Laravel 快取
echo -e "${YELLOW}正在清除快取...${NC}"
sudo -u www-data php artisan cache:clear
sudo -u www-data php artisan config:clear
sudo -u www-data php artisan view:clear
sudo -u www-data php artisan route:clear
echo -e "${GREEN}快取已清除。${NC}"

echo ""
echo -e "${GREEN}########################################################################${NC}"
echo -e "${GREEN}                                                                      ${NC}"
echo -e "${GREEN}      Jexactyl Panel 繁體中文翻譯版本 $VERSION 安裝成功！             ${NC}"
echo -e "${GREEN}                                                                      ${NC}"
echo -e "${GREEN}               感謝您使用HimService專案安裝腳本                        ${NC}"
echo -e "${GREEN}                                                                      ${NC}"
echo -e "${GREEN}########################################################################${NC}"
