# BizLife

日本企業向けコーポレートサイトを想定し、静的サイトから WordPress オリジナルテーマへ再構築したポートフォリオ作品です。

フロント表示に加え、Blog / News / Works の用途別分離、Ajax 追加読み込み、管理画面の運用性まで実装しています。  
福利厚生・メンタルヘルス支援サービスを提供する架空企業を想定した、ポートフォリオ用のサイトです。

---

## Demo

| 項目 | URL |
|------|-----|
| 公開サイト | 公開準備中 |
| GitHub Repository | https://github.com/kirico1027/wordpress-site-portfolio |

## Screenshot

公開後に追加予定

---

## Overview

静的 HTML / SCSS / JavaScript で制作したコーポレートサイトを WordPress 化し、固定ページ・通常投稿・カスタム投稿タイプを用途ごとに整理しています。

Blog（通常投稿）・News・Works を分け、検索・Ajax 追加読み込み・関連 Works 表示を実装しました。  
管理画面から投稿やカテゴリーを更新できる構成です。

## Tech Stack

### Frontend

- HTML / SCSS / JavaScript

### Backend

- PHP 8.0+

### CMS

- WordPress（Requires at least 6.0 / Tested up to 6.7）
- Advanced Custom Fields（ACF）
- WordPress Ajax（`admin-ajax.php`）

### Development

- Gulp / gulp-sass / gulp-file-include
- BrowserSync

### Tools

- Local（ローカル WordPress 環境）

### Version Control

- Git / GitHub

## Features

### WordPress

- オリジナルテーマ `BizLife`（`bizlife`）
- 固定ページ用テンプレート（About / Service / Recruit / Company / Contact / Download / Entry / Terms など）
- 通常投稿（Blog）の一覧・詳細・カテゴリー・キーワード検索
- テンプレート階層に沿ったフォールバック（`index.php`）

### Custom Post Types

- `works`（実績紹介）／`news`（お知らせ）
- カスタムタクソノミー `works_category`／`news_category`
- Works 詳細の関連実績表示

### Ajax

- Blog / Works の「もっと見る」追加読み込み
- 通常表示と追加表示で同一のカード用テンプレートパーツを再利用

### Admin UI

- 投稿一覧の列整理（識別に必要な情報を優先表示）
- 固定ページ名の日本語・英字表記の整理
- 管理画面ラベルの運用向け調整

### Frontend

- レスポンシブ対応
- ヘッダー・ドロワーメニュー
- スクロールアニメーション
- スライダー／マーキー表示
- アコーディオン（採用職種カードなど）

### Forms

Contact / Entry / Download はポートフォリオ用のサンプル動作です。

- ブラウザの必須チェック・形式チェック
- 確認用メールアドレスの一致確認
- 送信後もページリロードなし（画面上のステータス表示）
- 実際のメール送信なし
- 実ファイルの配布なし

## Implementation Highlights

- Blog・News・Works を目的別に分離し、一覧・詳細・フィルター・検索の導線を用途に合わせて整理した
- 通常表示と Ajax 追加表示で同じカード用テンプレートパーツを再利用し、見た目とリンク構造のずれを抑えた
- Blog / Works の Ajax ではページ番号で重複取得を防ぎ、最終件数でボタンを非表示にし、追加後も同じレイアウト・リンク・アニメーションを維持した
- Works の会社名・会社紹介は ACF を使い、`acf_add_local_field_group()` でテーマ側に定義して Git 管理した
- Seed 専用メタ情報で検証投稿だけを識別・再投入し、手動投稿を巻き込まない再実行可能な設計にした
- `index.php` を最終フォールバックとし、検索結果のあり・なしや専用テンプレートのない表示（404 含む）を確認した

## Admin UI Improvements

- Works 一覧ではアイキャッチ画像・会社名・カテゴリー・日付を表示し、投稿を識別しやすくした
- News 一覧ではタイトル・カテゴリー・日付を中心にし、使用しない投稿者列を非表示にした
- Blog 一覧ではアイキャッチ画像・カテゴリー・日付を表示し、使用しない投稿者・タグ・コメント列を整理した
- 固定ページ名を日本語とフロント側英字名が対応する表記へ整理し、スラッグとテンプレート適用を維持した
- Works カテゴリーなど、管理画面ラベルを運用者向けに整理した
- 投稿タイプごとに実際に必要な情報だけを表示し、形だけの統一は避けた
- スラッグは通常 WordPress の自動生成を基本とする運用とした

## Development Workflow

本作品では、ChatGPT・Cursor・制作者の役割を分けて制作を進めました。

- **ChatGPT** … 要件整理、工程設計、Cursor 向け指示作成、結果レビュー
- **Cursor** … リポジトリ調査、実装、動作確認、差分確認
- **制作者** … 仕様判断、実機確認、最終品質判断

制作の流れは次のとおりです。

1. 要件整理・工程設計
2. 機能単位で実装
3. 実装レビュー
4. サイト全体レビュー
5. 管理画面レビュー
6. 公開前レビュー

実装範囲を小さく分割し、結果を都度確認して問題箇所だけ修正しました。  
Git で工程を記録し、4 段階レビューで確認の重複を防いでいます。  
制作ルールは Cursor Project Rules で管理しています。

## Setup

### Static build

```bash
npm install
npm run build
npm run serve
```

- `npm run build` … HTML include 展開と SCSS コンパイル
- `npm run serve` … BrowserSync 付きの開発サーバー起動

### WordPress

1. WordPress 環境を用意する（Local など）
2. テーマディレクトリ `bizlife` を `wp-content/themes/` 配下へ配置する
3. 必須プラグイン Advanced Custom Fields（ACF）を有効化する
4. テーマ `BizLife` を有効化する
5. 表示設定でフロントページ・投稿ページを設定する
6. パーマリンク設定を保存する
7. 検証用データが必要な場合は、テーマ内 `bin/seed-works.php`／`bin/seed-news.php`／`bin/seed-blog.php` を実行する

Seed の実行方法は環境差があるため、各スクリプト先頭のコメントを参照してください。

## Directory Structure

主要ディレクトリのみ示します。

```text
.
├── src/                                  # 静的コーディング（templates / partials / sass / public）
├── wordpress/wp-content/themes/bizlife/  # WordPress テーマ本体
│   ├── assets/                           # テーマ用 css / js / img
│   ├── bin/                              # 検証用 Seed スクリプト
│   ├── inc/                              # CPT / ACF / Ajax / 管理画面ロジック
│   ├── template-parts/                   # 共通パーツ・投稿カード
│   ├── functions.php                     # テーマ入口
│   └── style.css                         # テーマ情報
├── coding-md/                            # 制作ワークフロー・設計メモ
└── .cursor/rules/                        # Cursor Project Rules
```

## Verification

### Browser

- Chrome での表示・操作確認
- Safari の目視確認

### Responsive

- 主要幅：1440 / 1200 / 1024 / 900 / 768 / 375px

### PHP

- PHP Fatal / Warning / Notice の有無

### JavaScript

- JavaScript console error の有無

### WordPress

- 画像・CSS・JavaScript の 404 の有無
- `body` の横 overflow
- 404 時のフォールバック表示

### Search / Ajax

- 検索結果あり・なし
- Blog / Works の Ajax 追加読み込み

### Forms

- Contact / Entry / Download のサンプル動作

### Management Screen

- 管理画面からの更新性

## Notes

- 本サイトはポートフォリオ用の架空サイトです
- Contact / Entry / Download はサンプル動作であり、実メール送信と実ファイル配布は行いません
- 検証用に Seed データを使用しています
- 専用 `404.php` はなく、現在はフォールバック表示です
- 汎用 `page.php` は未作成です
- author / date アーカイブは専用デザイン未対応です
- Service ページの外部リンク（サービスサイト）は未設定です（`#`）

## Future Improvements

今後も品質・保守性・運用性を継続的に改善していきます。  
テンプレート構成、管理画面の使いやすさ、検証しやすい開発環境など、制作と運用の両面から見直していきます。

## Author

- Name：水谷 武志
- Role：Web Coder

## License

本リポジトリはポートフォリオ閲覧を目的としています。  
使用している画像・デザイン・外部ライブラリ等の権利は、それぞれの権利者およびライセンスに従います。
