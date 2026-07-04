# BizLife コーポレートサイト WordPress 設計書

> **本ドキュメントの位置づけ**  
> BizLife サイト制作における WordPress 化の基本方針書（案件固有）。  
> ページ構成・CPT 設計・共通化方針の判断は、本書を正とする。  
> 全案件共通の WP 設計テンプレート: [WORDPRESS_DESIGN_TEMPLATE.md](./WORDPRESS_DESIGN_TEMPLATE.md)

---

## 実装優先順位（重要）

本案件では、以下の順序で進める。**固定ページの ACF 化は最初からすべて行わない。**

| フェーズ | 内容 | 備考 |
|---------|------|------|
| **Phase 1** | 静的コーディング | 全ページを HTML / Sass / JS で実装。partials 共通化を優先 |
| **Phase 2** | WordPress テーマ化 | 静的 HTML を PHP テンプレートへ移植。ヘッダー・フッター・共通パーツの `get_template_part` 化 |
| **Phase 3** | CPT 実装 | `works` / `news` / `job` の登録とアーカイブ・シングルテンプレート |
| **Phase 4** | ACF 段階導入 | 動的更新が必要な箇所から順次フィールド化（後述） |

### ACF 導入の方針

- **最初から ACF 化しない固定ページ:** About / Service / Recruit / Company / Download など
- **Phase 1〜2 では HTML に直接記述**し、見た目・構造の完成を優先する
- **Phase 3 以降、更新頻度・運用ニーズに応じて段階的に ACF 化**する

#### ACF 導入の優先度

| 優先度 | 対象 | 理由 |
|--------|------|------|
| 高 | `works` / `news` / `job` CPT フィールド | CPT 実装と同時に必須 |
| 高 | Options Page（会社情報・SNS・外部 URL） | フッター・Company 共通 |
| 中 | トップページの表示件数・ヒーロー文言 | 運用で更新する可能性 |
| 低 | About / Service / Recruit のセクション内容 | 更新頻度が低い。初期は HTML 直書きで可 |
| 低 | Privacy / Terms | 固定ページ本文（エディタ）で十分 |

---

## 1. サイト概要

**サイト名:** 株式会社 BizLife（Biz Care Life）  
**事業:** 福利厚生・メンタルヘルス支援 SaaS  
**グローバルナビ:** About / Service / Works / Recruit / Blog / Contact

---

## 2. ページ一覧

| # | ページ名 | PDF | URL 案 | 種別 |
|---|---------|-----|--------|------|
| 1 | トップ | Body.pdf | `/` | 固定ページ（フロント） |
| 2 | 私たちについて | Body-1.pdf | `/about/` | 固定ページ |
| 3 | 事業内容（サービス） | Body-2.pdf | `/service/` | 固定ページ |
| 4 | 実績紹介（一覧） | Body-3.pdf | `/works/` | アーカイブ（CPT） |
| 5 | 実績紹介（詳細） | 内部崩壊…pdf | `/works/{slug}/` | シングル（CPT） |
| 6 | 採用情報 | Body-4.pdf | `/recruit/` | 固定ページ |
| 7 | 採用エントリー | Body-10.pdf | `/recruit/entry/` | 固定ページ（フォーム） |
| 8 | お問い合わせ | Body-5.pdf | `/contact/` | 固定ページ（フォーム） |
| 9 | 会社概要 | Body-6.pdf | `/company/` | 固定ページ |
| 10 | お知らせ（一覧） | Body-8.pdf | `/news/` | アーカイブ（CPT） |
| 11 | お知らせ（詳細） | Body-7.pdf | `/news/{slug}/` | シングル（CPT） |
| 12 | 資料ダウンロード | Body-9.pdf | `/download/` | 固定ページ（フォーム） |
| 13 | ブログ（一覧） | Body-11.pdf | `/blog/` | 投稿アーカイブ |
| 14 | ブログ（詳細） | Body-12.pdf | `/blog/{slug}/` | 投稿シングル |
| 15 | プライバシーポリシー | Body-13.pdf | `/privacy-policy/` | 固定ページ |
| 16 | 利用規約 | Body-14.pdf | `/terms/` | 固定ページ |

---

## 3. 共通パーツ

### 全ページ共通

| パーツ | 内容 |
|--------|------|
| **Header** | ロゴ + グローバルナビ（About / Service / Works / Recruit / Blog / Contact）+ モバイルドロワー |
| **Footer** | キャッチコピー + 会社情報 + SNS リンク + フッターナビ + コピーライト |

### 複数ページで繰り返し使用

| パーツ | 使用ページ |
|--------|-----------|
| **Contact CTA** | トップ / About / Service / Works 一覧 / Company / Blog 一覧 |
| **Recruit ENTRY CTA** | Recruit |
| **Breadcrumb** | News 詳細 / Blog 詳細 / Works 詳細 / Privacy / Terms |
| **Page Hero** | 下層ページ H1 エリア |
| **SNS Share Block** | Blog 詳細 / Works 詳細 |

### セクション単位

- **News Ticker / Hero News** — トップヒーロー内の最新ニュース 1 件
- **Service Card** — 01/02/03 番号付きサービスカード
- **Works Card** — サムネイル + サービスタグ + タイトル + 会社名
- **News Item** — 日付 + カテゴリ + タイトル
- **Blog Card** — カテゴリ + 日付 + タイトル + サムネイル
- **Filter Tabs** — タブ式カテゴリフィルター（Works / News）
- **Keyword Search** — ブログ検索フォーム
- **Accordion** — 募集職種・選考フロー（Recruit）
- **Value List** — 01〜05 番号付き価値観リスト（About）
- **Culture / Welfare Grid** — アイコン + 見出し + 説明（Recruit）
- **Member Card** — 役職 + 氏名（Recruit）
- **Effect List** — 導入の効果 01/02/03（Service）
- **Voice Card** — 導入の声（Service / Works 詳細）
- **Company Info Table** — 会社概要テーブル（Company）
- **Pick Up / Related Posts** — サイドバー・フッター付近の関連記事

---

## 4. コンテンツ種別の設計

### 4-1. 固定ページ（Page）

| スラッグ | ページ名 | 初期実装 | ACF 化 |
|---------|---------|---------|--------|
| `front-page` | トップ | HTML 直書き + WP_Query | 後期（表示件数・ヒーロー） |
| `about` | 私たちについて | HTML 直書き | 後期 |
| `service` | 事業内容 | HTML 直書き | 後期 |
| `recruit` | 採用情報 | HTML 直書き + job CPT 取得 | Member / Culture / Welfare は後期 |
| `recruit/entry` | 採用エントリー | フォーム | — |
| `company` | 会社概要 | HTML 直書き | 後期（Options Page と連動可） |
| `contact` | お問い合わせ | フォーム | — |
| `download` | 資料ダウンロード | フォーム | PDF ファイルのみ ACF |
| `privacy-policy` | プライバシーポリシー | エディタ本文 | 不要 |
| `terms` | 利用規約 | エディタ本文 | 不要 |

### 4-2. 通常投稿（Post）→ ブログ

| 項目 | 内容 |
|------|------|
| 用途 | Blog 一覧・詳細 |
| カテゴリ | お役立ち情報 / 導入事例 / 働き方 |
| 機能 | キーワード検索、PICK UP 表示、関連記事 |

### 4-3. カスタム投稿タイプ（CPT）

#### ① `works`（実績紹介）

| 項目 | 内容 |
|------|------|
| 用途 | 導入事例・インタビュー形式の実績記事 |
| 一覧 | サービス別フィルター、もっと見る |
| 詳細 | Q&A 形式インタビュー、関連実績表示 |
| 表示箇所 | Works アーカイブ、トップ、Service ページ内 |

#### ② `news`（お知らせ）

| 項目 | 内容 |
|------|------|
| 用途 | 会社からの公式告知 |
| 一覧 | カテゴリタブフィルター |
| 詳細 | 日付 + カテゴリ + 本文 |
| 表示箇所 | News アーカイブ、トップ、フッターナビ |

#### ③ `job`（募集職種）— **採用**

| 項目 | 内容 |
|------|------|
| 用途 | Recruit ページ内のアコーディオン募集枠 |
| 表示 | Recruit 固定ページ内で `WP_Query` 取得 |
| 例 | プロダクトマネージャー / WEB マーケター / インサイドセールス / バックオフィス |
| 連動 | エントリーフォームの「希望職種」セレクト |

> Recruit ページの Member（メンバー紹介）は CPT 化せず、Recruit 固定ページの HTML 直書き（後期 ACF Repeater 化可）。

---

## 5. カスタムタクソノミー

| タクソノミー | 紐付け | 用途 | ターム例 |
|-------------|--------|------|---------|
| `works_service` | `works` | サービス別フィルター・タグ表示 | みんなの福利厚生クラウド / つながるワークフロー / あなたのメンタルコーチ |
| `news_category` | `news` | お知らせカテゴリフィルター | お知らせ / イベント / メディア掲載 / 採用 / サービス情報 / その他 |
| `category`（標準） | `post` | ブログカテゴリ | お役立ち情報 / 導入事例 / 働き方 |

**補足:**

- `works_service` は 1 実績に複数タグ付け可能（PDF 上、Rabbit 社は 2 サービス）
- ブログの `#` タグ表示は `post_tag` も併用可

---

## 6. カスタムフィールド（ACF）

> Phase 3 以降、段階的に導入。Phase 1〜2 では HTML 直書きで代替する。

### 6-1. サイト共通（Options Page）— Phase 3 後期

| フィールド | 用途 |
|-----------|------|
| 会社名 / 住所 / 電話 / 代表者 | フッター・Company 共通 |
| SNS URL（Instagram / X / Facebook） | フッター |
| 資料ダウンロード PDF | Download ページ送付ファイル |
| 外部サービスサイト URL ×3 | Service 各サービスの「サービスサイト」リンク |
| Google Map 埋め込み | Company アクセス |

### 6-2. Works（CPT）— Phase 3

| フィールド | 用途 |
|-----------|------|
| クライアント企業名 | 例: 株式会社 monkey |
| クライアント企業ロゴ | カード・詳細表示 |
| インタビュー形式（Repeater） | Q（質問）/ A（回答）の Q&A セット |
| 関連実績（Relationship） | Pick up / おすすめ記事 |
| PICK UP フラグ | 一覧・トップ優先表示 |

### 6-3. News（CPT）— Phase 3

| フィールド | 用途 |
|-----------|------|
| （タクソノミーで代替） | `news_category` |
| 重要お知らせフラグ | トップヒーローティッカー表示 |

### 6-4. Job（CPT）— Phase 3

| フィールド | 用途 |
|-----------|------|
| 雇用形態 | 正社員 / 中途採用 / インターン |
| 募集要項本文 | アコーディオン内コンテンツ |
| 表示順 | Recruit ページ内の並び順 |
| エントリーフォーム連動 | 希望職種セレクトの選択肢 |

### 6-5. Blog（Post）— Phase 3 後期

| フィールド | 用途 |
|-----------|------|
| PICK UP フラグ | サイドバー・一覧上部 |
| 表示優先度 | 今話題の記事 |

### 6-6. 固定ページ ACF — Phase 4（段階導入）

| ページ | フィールドグループ | 導入タイミング |
|--------|-------------------|---------------|
| About | Purpose / Vision / Mission / Value（Repeater ×5） | 運用開始後 |
| Service | Service Block（Repeater ×3）+ 導入の効果 + 導入の声 | 運用開始後 |
| Recruit | Culture / Welfare / Member / Flow | Member 以外は後期 |
| Company | 会社概要テーブル / 事業内容 / Map | Options Page と統合検討 |
| front-page | ヒーロー文言 / 表示件数 | 運用開始後 |

### 6-7. フォーム系 — Phase 2〜3

| ページ | プラグイン | 主な項目 |
|--------|-----------|---------|
| Contact | Contact Form 7 等 | お問い合わせ項目（select）、名前、フリガナ、メール、会社名、内容 |
| Download | 同上 | 名前、フリガナ、メール、電話、会社名、PDF 自動送付 |
| Entry | 同上 | 名前、フリガナ、メール、年齢、現職、希望職種（job CPT 連動）、ファイル添付、質問 |

---

## 7. 静的コーディング時に共通化すべきコンポーネント

### 7-1. レイアウト（partials）

```
src/partials/
├── head.html              # meta, CSS, fonts
├── header.html            # グローバルナビ + ドロワー
├── footer.html            # フッターナビ + SNS + コピーライト
├── breadcrumb.html        # パンくず（下層ページ共通）
└── page-hero.html         # 下層ページ H1 エリア
```

### 7-2. セクションコンポーネント

```
src/partials/sections/
├── cta-contact.html       # CONTACT 3カラム CTA（問合せ/資料DL）
├── cta-entry.html         # Recruit ENTRY CTA
├── section-heading.html   # 英字ラベル + 日本語見出し
├── service-card.html      # サービスカード（番号付き）
├── works-card.html        # 実績カード
├── news-item.html         # お知らせ1行 / リストアイテム
├── blog-card.html         # ブログカード
├── filter-tabs.html       # タブフィルター（Works / News 共用）
├── accordion.html         # アコーディオン（Recruit 職種・フロー）
├── share-block.html       # SNS シェア
├── pickup-sidebar.html    # Pick up / 関連記事サイドバー
└── effect-list.html       # 導入の効果 01/02/03
```

### 7-3. ページテンプレート（templates）

```
src/templates/
├── index.html             # トップ
├── about.html             # 私たちについて
├── service.html           # 事業内容
├── works-archive.html     # 実績一覧
├── works-single.html      # 実績詳細
├── recruit.html           # 採用情報
├── company.html           # 会社概要
├── news-archive.html      # お知らせ一覧
├── news-single.html       # お知らせ詳細
├── blog-archive.html      # ブログ一覧
├── blog-single.html       # ブログ詳細
├── contact.html           # お問い合わせ
├── download.html          # 資料ダウンロード
├── entry.html             # 採用エントリー
├── privacy-policy.html    # プライバシーポリシー
└── terms.html             # 利用規約
```

### 7-4. Sass コンポーネント設計（BEM）

```
src/sass/
├── layout/
│   ├── _header.scss
│   ├── _footer.scss
│   ├── _breadcrumb.scss
│   └── _container.scss
├── object/
│   ├── component/
│   │   ├── _btn.scss
│   │   ├── _section-heading.scss
│   │   ├── _card.scss          # service / works / blog 共通ベース
│   │   ├── _filter-tabs.scss
│   │   ├── _accordion.scss
│   │   ├── _form.scss
│   │   ├── _cta.scss
│   │   ├── _share.scss
│   │   └── _tag.scss
│   ├── project/
│   │   ├── _hero.scss
│   │   ├── _about-values.scss
│   │   ├── _service-block.scss
│   │   ├── _works-list.scss
│   │   ├── _news-list.scss
│   │   ├── _blog-list.scss
│   │   ├── _recruit-culture.scss
│   │   ├── _recruit-member.scss
│   │   ├── _company-table.scss
│   │   └── _interview.scss     # Works 詳細 Q&A
│   └── utility/
│       └── _scroll-reveal.scss
```

---

## 8. WordPress テーマ構成案

```
wp-content/themes/bizlife/
├── style.css
├── functions.php
├── inc/
│   ├── setup.php              # テーマサポート・メニュー
│   ├── cpt.php                # works / news / job 登録
│   ├── taxonomies.php         # works_service / news_category
│   ├── acf-fields.php         # ACF フィールド定義（JSON export 推奨）
│   └── enqueue.php
├── template-parts/
│   ├── header.php
│   ├── footer.php
│   ├── breadcrumb.php
│   ├── cta-contact.php
│   ├── cta-entry.php
│   ├── cards/
│   │   ├── service-card.php
│   │   ├── works-card.php
│   │   ├── news-item.php
│   │   └── blog-card.php
│   └── sections/
├── front-page.php
├── page-about.php
├── page-service.php
├── page-recruit.php
├── page-company.php
├── page-contact.php
├── page-download.php
├── page-entry.php
├── page-legal.php             # privacy / terms 共用
├── archive-works.php
├── single-works.php
├── archive-news.php
├── single-news.php
├── home.php                   # ブログ一覧
├── single.php                 # ブログ詳細
├── archive.php
├── 404.php
└── assets/                    # 静的コーディング成果物を移植
```

---

## 9. 設計上の判断メモ

### Post と News を分ける理由

- **Blog（Post）:** コラム・インタビュー・SEO コンテンツ。カテゴリは「お役立ち情報 / 導入事例 / 働き方」
- **News（CPT）:** 公式告知。カテゴリは「お知らせ / イベント / メディア掲載 / 採用 / サービス情報 / その他」
- 更新者・公開フロー・URL 体系が異なるため分離

### Works と Blog「導入事例」の関係

- Blog にも「導入事例」カテゴリがあるが、Works は **営業実績・クライアントインタビュー** として独立
- Blog の「導入事例」は一般向け記事、Works は **サービス導入の成功事例**
- Service ページの「導入の声」は Works CPT への Relationship で連動（Phase 4）

### サービス個別ページについて

- PDF では 3 サービスは **1 ページ（Service）内のセクション** として構成
- 各サービスは外部「サービスサイト」へリンク。個別 CPT / 固定ページは **現段階では不要**

### フォーム

- Contact Form 7 + Flamingo（送信データ保存）を推奨
- Download は送信後 PDF 自動返信 or サンクスページで DL リンク
- Entry はファイルアップロード対応必須。希望職種は `job` CPT から動的生成

### 推奨プラグイン

| プラグイン | 用途 | 導入フェーズ |
|-----------|------|-------------|
| Advanced Custom Fields (ACF) Pro | カスタムフィールド・Options Page | Phase 3〜4 |
| Contact Form 7 | 各種フォーム | Phase 2〜3 |
| Flamingo | フォーム送信データ保存 | Phase 2〜3 |
| Custom Post Type UI | CPT / タクソノミー登録（またはテーマ内 code） | Phase 3 |
| Yoast SEO / Rank Math | SEO | Phase 2 |
| WP Super Cache / LiteSpeed Cache | キャッシュ | Phase 2 |

---

## 10. 静的コーディング → WP 化の移行マップ

| 静的テンプレート | WP テンプレート | 動的データソース | フェーズ |
|----------------|----------------|----------------|---------|
| `index.html` | `front-page.php` | works ×4, news ×5（Phase 3） | 1 → 2 → 3 |
| `about.html` | `page-about.php` | HTML 直書き → 後期 ACF | 1 → 2 |
| `service.html` | `page-service.php` | HTML 直書き → 後期 ACF + works | 1 → 2 → 4 |
| `works-archive.html` | `archive-works.php` | WP_Query + works_service | 1 → 3 |
| `works-single.html` | `single-works.php` | ACF Q&A + 関連 works | 1 → 3 |
| `recruit.html` | `page-recruit.php` | HTML + job CPT | 1 → 2 → 3 |
| `news-archive.html` | `archive-news.php` | WP_Query + news_category | 1 → 3 |
| `news-single.html` | `single-news.php` | 本文 + タクソノミー | 1 → 3 |
| `blog-archive.html` | `home.php` | 標準 Post + category / tag | 1 → 2 |
| `blog-single.html` | `single.php` | 本文 + Pick up サイドバー | 1 → 2 |
| `contact.html` | `page-contact.php` | CF7 ショートコード | 1 → 2 |
| `download.html` | `page-download.php` | CF7 + ACF PDF | 1 → 2 |
| `entry.html` | `page-entry.php` | CF7 + job CPT 連動 | 1 → 2 → 3 |
| `company.html` | `page-company.php` | HTML 直書き → 後期 ACF | 1 → 2 |
| `privacy-policy.html` | `page-legal.php` | 固定ページ本文 | 1 → 2 |
| `terms.html` | `page-legal.php` | 固定ページ本文 | 1 → 2 |

---

## 11. 関連ドキュメント

| ドキュメント | 内容 |
|-------------|------|
| `coding-md/WORKFLOW_MASTER.md` | 静的コーディング全体ワークフロー |
| `coding-md/04-coding/` | HTML / CSS コーディング手順 |
| `.cursor/rules/` | BEM / タイポグラフィ / ヘッダー等の制作ルール |

---

*最終更新: 2026-07-04*
