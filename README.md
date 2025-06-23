![Image](https://github.com/user-attachments/assets/6c49baf3-3bd1-4a68-a97d-f7304b76b749)

# ペット（動物）の魅力等をつぶやく掲示板を作成

## アプリケーション URL

開発環境：http://localhost/

phpMyAdmin:：http://localhost:8080/

## 機能一覧

会員登録、メール 📨 認証、ログイン、ログアウト、お問い合わせ機能、お問い合わせの自動送信機能、投稿機能、いいね機能、アバター画像の設置・修正、管理者機能(ユーザーアカウントの編集機能、)

## 使用技術（実行環境）

Laravel 11.x、PHP 8.2.10 、docker、Larave-Sail、laravel-Breeze、MySQL

## テーブル設定

###　 users テーブル

| カラム名                | 型         | 属性                        |
| ------------------- | --------- | ------------------------- |
| id                  | BIGINT    | 主キー、自動増分                  |
| name                | STRING    |                           |
| avatar              | STRING    | デフォルト: `user_default.jpg` |
| email               | STRING    | 一意制約                      |
| email\_verified\_at | TIMESTAMP | NULL許可                    |
| password            | STRING    |                           |
| remember\_token     | STRING    | NULL許可                    |
| created\_at         | TIMESTAMP | 自動生成                      |
| updated\_at         | TIMESTAMP | 自動生成                      |

###　 posts テーブル
| カラム名        | 型         | 属性     |
| ----------- | --------- | ------ |
| id          | BIGINT    | 主キー    |
| title       | STRING    |        |
| body        | TEXT      |        |
| image       | TEXT      | NULL許可 |
| user\_id    | BIGINT    | 外部キー   |
| created\_at | TIMESTAMP | 自動生成   |
| updated\_at | TIMESTAMP | 自動生成   |


###　 comments テーブル
| カラム名        | 型         | 属性   |
| ----------- | --------- | ---- |
| id          | BIGINT    | 主キー  |
| post\_id    | BIGINT    | 外部キー |
| user\_id    | BIGINT    | 外部キー |
| body        | TEXT      |      |
| created\_at | TIMESTAMP | 自動生成 |
| updated\_at | TIMESTAMP | 自動生成 |


###　 post_user テーブル（投稿のお気に入り管理）
| カラム名        | 型         | 属性                      |
| ----------- | --------- | ----------------------- |
| id          | BIGINT    | 主キー                     |
| post\_id    | BIGINT    | 外部キー（onDelete: cascade） |
| user\_id    | BIGINT    | 外部キー（onDelete: cascade） |
| created\_at | TIMESTAMP | 自動生成                    |
| updated\_at | TIMESTAMP | 自動生成                    |


###　 contacts テーブル（お問い合わせ）
| カラム名        | 型         | 属性   |
| ----------- | --------- | ---- |
| id          | BIGINT    | 主キー  |
| title       | STRING    |      |
| body        | TEXT      |      |
| email       | STRING    |      |
| created\_at | TIMESTAMP | 自動生成 |
| updated\_at | TIMESTAMP | 自動生成 |


###　  roles テーブル
| カラム名        | 型         | 属性   |
| ----------- | --------- | ---- |
| id          | BIGINT    | 主キー  |
| name        | STRING    |      |
| created\_at | TIMESTAMP | 自動生成 |
| updated\_at | TIMESTAMP | 自動生成 |


###　 role_user テーブル（ユーザーと役割の中間テーブル）
| カラム名        | 型         | 属性   |
| ----------- | --------- | ---- |
| id          | BIGINT    | 主キー  |
| user\_id    | BIGINT    | 外部キー |
| role\_id    | BIGINT    | 外部キー |
| created\_at | TIMESTAMP | 自動生成 |
| updated\_at | TIMESTAMP | 自動生成 |



## その他

###　管理者
ユーザー id:2 　　名前：管理者　花子　 メール:
hanako@example.com

###　一般ユーザー
ユーザー id:1 名前：テスト　テスト　メール：test@example.com

ユーザー id:3 名前：test2 　メール：test2@example.com

ユーザー id:4 名前：test3 　メール：test3@example.com

ユーザー id:5 名前：test4 　メール：test4@example.com

ユーザー id:6 名前：test5 　メール：test5@example.com

ユーザー id:7 名前：test6 　メール：test6@example.com

ユーザー id:8 名前：test7 　メール：test7@example.com

ユーザー id:9 名前：test8 　メール：test8@example.com

ユーザー id:10 名前：test9 　メール：test9@example.com

ユーザー id:11 名前：usagi 　メール：usagi@example.com

ユーザー id:12 名前：test11 　メール：test11@example.com

ユーザー id:13 名前：test12 　メール：test12@example.com

ユーザー id:14 名前：test13 　メール：test13@example.com

削除済み　ユーザー id:15 名前：test14 　メール：test14@example.com

ユーザー id:16 名前：test15 　メール：test15@example.com

ユーザー id:17 名前：test16 　メール：test16@example.com

ユーザー id:18 名前：test17 　メール：test17@example.com

ユーザー id:19 名前：test18 　メール：test18@example.com

ユーザー id:20 名前：test19 　メール：test19@example.com

###　パスワード
管理者も一般ユーザーも「１」が８個
