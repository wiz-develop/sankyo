# sankyo-steel.com

WordPress 環境の構成管理用リポジトリです。

- `main`: 本番環境
- `test`: テスト環境
- `site/`: Web 公開ディレクトリ（認証情報を含む `wp-config.php` は除外）
- `backup/databases/`: 暗号化済み DB バックアップ
- `backup/uploads/`: 本番切替前の uploads バックアップ（分割 tar.gz）

## 2026-09-07 本番切替前バックアップ

初回の `main` コミットは、切替直前の本番ファイルと DB を保存したものです。
本番にはルート WordPress と `/wordpress` の旧 WordPress が存在するため、DB は2系統を保存しています。

`production-current-20260907.sql.gz.enc` は切替完了後の本番DB（新旧テーブルを含む）です。

## 2026-09-07 本番公開後の調整

- 検索エンジン・ブラウザ向けにブランドfaviconを設定
- Contact Form 7 のreCAPTCHAを旧本番環境の本番ドメイン用設定へ移行
- reCAPTCHAの秘密鍵などの認証情報はGit管理対象外

DB バックアップは AES-256-CBC / PBKDF2（200,000 iterations）で暗号化しています。復号鍵はリポジトリ外で保管します。

```sh
openssl enc -d -aes-256-cbc -pbkdf2 -iter 200000 \
  -in backup/databases/production-root-20260907.sql.gz.enc \
  -out production-root-20260907.sql.gz \
  -pass file:/path/to/backup-key-20260907.txt
```

uploads の復元時は分割ファイルを結合してください。

通常運用では `wp-content/uploads/` はGit管理対象外です。切替前の本番 uploads は `backup/uploads/` に分割アーカイブとして保存しています。

```sh
cat backup/uploads/production-uploads-20260907.tar.gz.part-* > production-uploads-20260907.tar.gz
tar -xzf production-uploads-20260907.tar.gz
```
