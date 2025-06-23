# ペット（動物）の魅力等をつぶやく掲示板を作成

![Image](https://github.com/user-attachments/assets/6c49baf3-3bd1-4a68-a97d-f7304b76b749)

新規登録画面

![Image](https://github.com/user-attachments/assets/30775281-bc4d-4e1e-b4bf-ed79977fca1e)


ログイン画面

![Image](https://github.com/user-attachments/assets/0f1449b5-c922-45e6-858b-b391f1e38589)

一般ユーザー　 HOME 画面

![Image](https://github.com/user-attachments/assets/cf7e42ee-ddbb-4fdb-99b2-90a44ee4ed79)

問合せフォーム

![Image](https://github.com/user-attachments/assets/957fe498-6cf9-4bfd-8510-4d41a8075e1f)

新規投稿画面

![Image](https://github.com/user-attachments/assets/5eeb79c2-1fb6-449d-b760-f0f7c488127d)

自分の投稿

![Image](https://github.com/user-attachments/assets/0430e13c-74e2-4702-b673-f2b6febe87c5)

コメントした投稿

![Image](https://github.com/user-attachments/assets/71057d0d-1455-4813-b420-31afcbb8dcc8)

管理者　 HOME 画面

![Image](https://github.com/user-attachments/assets/1a40e8eb-3d3c-4ac5-8f6b-904ede7e1c4c)

ユーザー一覧　

![Image](https://github.com/user-attachments/assets/c763d6ef-95c2-4be2-87b9-b30cddb910fb)

役割付与

![Image](https://github.com/user-attachments/assets/afb274e0-378a-41d8-9a8b-874e665d6645)

## アプリケーション URL

開発環境：http://localhost/

phpMyAdmin:：http://localhost:8080/

## 機能一覧

会員登録、メール 📨 認証、ログイン、ログアウト、お問い合わせ機能、お問い合わせの自動送信機能、投稿機能、いいね機能、アバター画像の設置・修正、管理者機能(ユーザーアカウントの編集機能、)

## 使用技術（実行環境）

Laravel 11.x、PHP 8.2.10 、docker、Larave-Sail、laravel-Breeze、MySQL

## ER 図

![Image](https://github.com/user-attachments/assets/51fdf3a5-6f84-4ac6-8a0f-2d4b2782253b)

## テーブル設定

###　 users テーブル

| カラム名          | 型        | 属性                           |
| ----------------- | --------- | ------------------------------ |
| id                | BIGINT    | 主キー、自動増分               |
| name              | STRING    |                                |
| avatar            | STRING    | デフォルト: `user_default.jpg` |
| email             | STRING    | 一意制約                       |
| email_verified_at | TIMESTAMP | NULL 許可                      |
| password          | STRING    |                                |
| remember_token    | STRING    | NULL 許可                      |
| created_at        | TIMESTAMP | 自動生成                       |
| updated_at        | TIMESTAMP | 自動生成                       |

###　 posts テーブル
| カラム名 | 型 | 属性 |
| ----------- | --------- | ------ |
| id | BIGINT | 主キー |
| title | STRING | |
| body | TEXT | |
| image | TEXT | NULL 許可 |
| user_id | BIGINT | 外部キー |
| created_at | TIMESTAMP | 自動生成 |
| updated_at | TIMESTAMP | 自動生成 |

###　 comments テーブル
| カラム名 | 型 | 属性 |
| ----------- | --------- | ---- |
| id | BIGINT | 主キー |
| post_id | BIGINT | 外部キー |
| user_id | BIGINT | 外部キー |
| body | TEXT | |
| created_at | TIMESTAMP | 自動生成 |
| updated_at | TIMESTAMP | 自動生成 |

###　 post_user テーブル（投稿のお気に入り管理）
| カラム名 | 型 | 属性 |
| ----------- | --------- | ----------------------- |
| id | BIGINT | 主キー |
| post_id | BIGINT | 外部キー（onDelete: cascade） |
| user_id | BIGINT | 外部キー（onDelete: cascade） |
| created_at | TIMESTAMP | 自動生成 |
| updated_at | TIMESTAMP | 自動生成 |

###　 contacts テーブル（お問い合わせ）
| カラム名 | 型 | 属性 |
| ----------- | --------- | ---- |
| id | BIGINT | 主キー |
| title | STRING | |
| body | TEXT | |
| email | STRING | |
| created_at | TIMESTAMP | 自動生成 |
| updated_at | TIMESTAMP | 自動生成 |

###　 roles テーブル
| カラム名 | 型 | 属性 |
| ----------- | --------- | ---- |
| id | BIGINT | 主キー |
| name | STRING | |
| created_at | TIMESTAMP | 自動生成 |
| updated_at | TIMESTAMP | 自動生成 |

###　 role_user テーブル（ユーザーと役割の中間テーブル）
| カラム名 | 型 | 属性 |
| ----------- | --------- | ---- |
| id | BIGINT | 主キー |
| user_id | BIGINT | 外部キー |
| role_id | BIGINT | 外部キー |
| created_at | TIMESTAMP | 自動生成 |
| updated_at | TIMESTAMP | 自動生成 |

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
