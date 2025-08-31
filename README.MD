# Pterodactyl-Panel-繁體中文翻譯
這是一個適用於翼手龍面板的繁體中文翻譯檔案，可將您的翼手龍面板幾乎翻譯成繁體中文顯示。其他版本仍在翻譯中!

## 當前製作的版本
- 1.11.10 製作完畢，測試中
- 1.11.7 製作完畢，優化中

## 安裝注意事項
請確保版本正確，並已備份面板的resources資料夾

## 安裝步驟
將指定版本的翻譯檔案下載，下載完畢後將面板內的resources資料夾備份後移除並替換成翻譯檔案內的resources資料夾
隨後進行以下操作(使用1.11.7版本演示)
```bash

cd /var/www/pterodactyl
yarn install --pure-lockfile
export NODE_OPTIONS=--openssl-legacy-provider # for NodeJS v17+
yarn build:production

```

編譯完成後請輸入
```bash

php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

```
恭喜，您已完成面板翻譯替換作業

## 備註
除了翻譯，我們僅在管理後台的概覽介面添加專案按鈕與文字，其餘與原版相同不做更改，僅做翻譯。
