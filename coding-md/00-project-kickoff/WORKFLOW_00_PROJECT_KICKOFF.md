# 工程 0: プロジェクトキックオフ（コーディング前整理）

## 概要

新規サイト制作では、**いきなりコーディングを開始しない**。  
まずトップページ全体を確認し、レイアウト基準・共通パーツ・共通化方針を整理する。  
WordPress 化を予定している場合は、設計書もこの段階で作成する。

本工程の完了後、工程 1（フォント・カラー）以降に進む。

## 目的

- レイアウト基準と共通パーツの認識ズレを、コーディング開始前に解消する
- 工程 3（コンポーネント検出）の入力を明確にし、手戻りを減らす
- WordPress 化案件では、静的コーディングと WP テーマ化の境界を事前に決める

## 前提条件

- デザインデータ（Figma / PDF 等）が揃っていること
- 対象サイトのページ一覧が把握できていること（最低限トップページ）

## 手順

### 1. トップページ全体の確認

トップページを起点に、サイト全体の設計基準を読み取る。

#### 1-1. レイアウト基準（SCSS 変数化の前提）

| 確認項目 | 記録内容の例 |
|---------|-------------|
| 共通レイアウト幅 | `max-width: 1200px` 等 |
| 左右余白 | SP / TB / PC それぞれの `padding-inline` |
| セクション間余白 | セクション上下の `margin-top` 基準値 |

→ `_variables.scss` や `_container.scss` に落とし込む値として記録する。

#### 1-2. 共通 UI パーツの洗い出し

トップページ上で繰り返し登場する、または全ページで使われるパーツを確認する。

| カテゴリ | 確認するパーツ（例） |
|---------|-------------------|
| レイアウト | Header / Footer / Breadcrumb / Page Hero |
| 見出し・操作 | Section Heading / Button |
| 訴求 | CTA |
| カード系 | Card（汎用）/ Service Card / Works Card / News Item / Blog Card |

**注意:** 上記は代表例。サイトによって名称・構成は異なる。  
案件固有のパーツは「その他」として追記する。

#### 1-3. WordPress 化時の template-parts 候補

WordPress 化を予定する場合、静的コーディング段階から **partials 化の対象** を決めておく。

| 静的（本プロジェクト） | WordPress |
|----------------------|-----------|
| `src/partials/header.html` | `template-parts/header.php` |
| `src/partials/footer.html` | `template-parts/footer.php` |
| `src/partials/sections/*.html` | `template-parts/sections/*.php` または `template-parts/cards/*.php` |

**原則:** 2 回以上使うパーツは静的段階で `partials/` に切り出す。  
1 ページ限定のセクションは `templates/` に直接記述し、後から共通化を検討する。

### 2. 共通化方針の提案

工程 0 の成果物として、**共通化方針を提案してから**静的コーディングを開始する。

#### 出力物

`coding-md/mcp-log/{プロジェクト名}/commonization-plan.md`

```markdown
# 共通化方針

## レイアウト基準
- コンテナ最大幅: …
- 左右余白: SP … / PC …
- セクション間余白: …

## 共通パーツ一覧

| パーツ名 | 静的配置 | WP template-parts | 使用箇所 | 備考 |
|---------|---------|---------------------|---------|------|
| Header | partials/header.html | header.php | 全ページ | |
| … | | | | |

## ページ固有（共通化しない）
- トップ Hero 等、1 ページ限定のセクション

## partials 構成案
src/partials/
├── header.html
├── footer.html
└── sections/
    └── …
```

- 提案内容を確認・合意してから工程 1 以降に進む
- 工程 3 では本ファイルをベースに `component-list.md` を詳細化する

### 3. WordPress 設計書の作成（WP 化案件のみ）

WordPress 化を予定する場合、コーディング前に以下を整理し設計書を作成する。

| 確認項目 | 内容 |
|---------|------|
| 固定ページ | 会社概要・サービス紹介等、更新頻度が低いページ |
| 通常投稿 | ブログ・コラム等 |
| カスタム投稿（CPT） | 実績・お知らせ・募集職種等 |
| カスタムタクソノミー | CPT / 投稿の分類・フィルター |
| カスタムフィールド | ACF 等で管理する項目（段階導入可） |
| template-parts 化要素 | 共通化方針と整合する PHP パーツ |

#### 出力物

- テンプレート: [WORDPRESS_DESIGN_TEMPLATE.md](../07-wordpress-design/WORDPRESS_DESIGN_TEMPLATE.md)
- 案件別設計書: `coding-md/07-wordpress-design/WORDPRESS_DESIGN.md`（案件名で上書き or 別名保存）

#### 実装優先順位（全 WP 案件共通）

1. 静的コーディング（partials 共通化）
2. WordPress テーマ化
3. CPT 実装
4. ACF 段階導入（固定ページの一括 ACF 化は最初から行わない）

## 工程 0 完了チェックリスト

- [ ] トップページからレイアウト基準（幅・余白・セクション間隔）を記録した
- [ ] 共通 UI パーツを洗い出した
- [ ] `commonization-plan.md` を作成し、共通化方針を提案した
- [ ] WP 化案件の場合、`WORDPRESS_DESIGN.md` を作成した
- [ ] 上記の確認・合意後、工程 1 に進む

## 後続工程との関係

```
工程 0（本ドキュメント）— トップ確認・共通化方針・WP 設計
    ↓
工程 1 — フォント・カラー
    ↓
工程 2 — 画像エクスポート（必要時）
    ↓
工程 3 — コンポーネント検出（commonization-plan を詳細化 → component-list.md）
    ↓
工程 4 — コーディング
```

- **工程 3 との役割分担:** 工程 0 は「方針・基準の決定」、工程 3 は「実装単位への分解・パラメータ設計」
- 工程 3 の詳細手順は [WORKFLOW_03_COMPONENT_DETECTION.md](../03-component-detection/WORKFLOW_03_COMPONENT_DETECTION.md) を参照

## 注意事項

- 共通化方針は「完璧な設計」でなくてよい。コーディング中に判断が変わったら `commonization-plan.md` を更新する
- すべてのパーツを事前に列挙する必要はない。2 回目以降の出現で共通化を検討してもよい（工程 3・工程 4 でも可）
- BizLife 案件の設計書例: [WORDPRESS_DESIGN.md](../07-wordpress-design/WORDPRESS_DESIGN.md)
