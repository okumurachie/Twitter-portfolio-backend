# Twitter風SNSアプリ - (Backend API)

## 概要

Twitter風の簡易SNSアプリのバックエンドAPIです。
フロントエンド（Nuxt 4）と連携し、LaravelでREST APIを構築しています。

## 作成した目的

- LaravelとNuxtのAPI連携によるモダンなWebアプリ構成の理解
- Firebase Authenticationを用いたトークン認証の実装経験
- フロントエンド／バックエンド分離構成での開発演習

## 関連リポジトリ

- Frontend: https://github.com/okumurachie/Twitter-frontend
- Backend: https://github.com/okumurachie/Twitter-backend

## アプリケーションURL

※ 本アプリはローカル環境での動作を前提としています。デプロイは行っていません。

# 環境構築手順（ローカル開発用）

## ■ 動作環境

- PHP 8.2 以上（Laravel 12 要件）
- Composer
- MySQL

---

## 1.リポジトリをクローン

```bash
git clone git@github.com:okumurachie/Twitter-backend.git
cd Twitter-backend
```

## 2. .envファイル作成

```bash
cp .env.example .env
```

## 3.データベース作成

MySQLにログインし、以下を実行してください。

```sql
CREATE DATABASE twitter_sns_db;
```

## 4..envのDB設定を編集

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=twitter_sns_db
DB_USERNAME=root
DB_PASSWORD=
```

## 5.依存パッケージインストール

```bash
composer install
```

```bash
php artisan key:generate
```

## 6.Firebase設定

本アプリでは Firebase Authentication を使用しています。

1. Firebaseプロジェクトを作成 <br>
   Firebaseコンソールでプロジェクトを作成してください。

2. サービスアカウントキー(JSON)を取得 <br>
   Firebaseコンソール → プロジェクト設定 → サービスアカウント <br>
   → 「新しい秘密鍵を生成」からJSONファイルをダウンロード

3. JSONファイルを配置

```bash
mkdir storage/firebase
```

    取得したJSONファイルを以下に配置してください。

```
storage/firebase/firebase.json
```

4. envに設定

```env
FIREBASE_CREDENTIALS=storage/firebase/firebase.json
FIREBASE_PROJECT_ID=your-project-id
```

※UID関連の設定は不要です。(Seederユーザーはダミーのため)

## 7.DB初期化とシーディング

```bash
php artisan migrate:fresh --seed
```

(初期表示用のダミーデータを作成)

## 8.サーバー起動

```bash
php artisan serve
```

バックエンドURL:

```
http://127.0.0.1:8000
```

#### 注意事項(ダミーユーザーについて)

- Seederで作成されるユーザー(Test User1 / Test User2)は初期画面の表示用ダミーデータです。
- UIDはダミーのため、Firebase上には存在しません。
- そのため、削除や投稿などログインユーザーに紐づく操作は行えません。
- 操作確認は「新規登録」からユーザーを作成し、そのユーザー（例：Test User3）でログインしてください。
- Seederユーザーは表示や投稿閲覧用として利用します。

## システム構成

Frontend（Nuxt 4）<br>
↓ REST API<br>
Backend（Laravel）<br>
↓<br>
MySQL

## 使用技術

- PHP 8.2以上
- Laravel 12
- MySQL
- Firebase Authentication（IDトークン認証）

## 主な機能

- ユーザー認証(Firebase Authentication)
- 投稿の一覧表示
- 投稿作成・削除(認証ユーザーのみ)
- いいね機能(重複防止)
- コメント機能
- 投稿追加・削除・コメント追加・いいね機能は認証ユーザーのみ操作可能
- 自身の投稿のみ削除可能
- Seederユーザーは表示用で操作不可

## 使い方（ローカル確認）

1. フロントエンドを起動
2. Firebaseでユーザー登録（例：Test User3）
3. 投稿作成・投稿削除・いいね・コメント作成を操作（
   ※Seederユーザーは表示用で操作不可

## テーブル設計

![テーブル設計](./docs/table-design.png)

## ER図

![ER図](./index.png)

## 開発環境

バックエンドURL：

```
http://127.0.0.1:8000
```

※ フロントエンドは http://localhost:3000 で起動してください。

# Twitter-backend
