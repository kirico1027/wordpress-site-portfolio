# コンポーネント一覧（Blog 詳細ページ）

> ベース: `coding-md/mcp-log/blog/blog-single-design-context.md`  
> Figma: node `1:5444`（全てが揃うコーポレートサイト / Blog 詳細）

## 既存コンポーネント（流用）

| コンポーネント名 | 使用箇所 | 備考 |
|------------------|----------|------|
| top-header | 全ページ | `partials/header.html` |
| site-footer | 全ページ | `partials/footer.html` |
| btn-more | 一覧ページへ戻る | `partials/sections/btn-more.html` |
| section-heading | Pick up 見出し | `partials/sections/section-heading.html` |
| blog-card | Pick up カード | `partials/cards/blog-card.html` |

## ページ固有（コンポーネント化しない）

| ブロック名 | 説明 |
|-----------|------|
| blog-single | ブログ詳細ページ全体 |
| blog-single__breadcrumb | パンくず |
| blog-single__content | 記事本文 720px 幅 |
| blog-single__meta | カテゴリタグ + 投稿日 |
| blog-single__body | h2 / h3 / p / figure の本文領域 |
| blog-single__share | SNS シェア |
| blog-single__pickup | 関連記事エリア |

## 画像（取得済み）

| ファイル | 用途 |
|----------|------|
| `blog-single_hero.png` | 記事ヒーロー |
| `blog-single_body_01.png` | 本文インライン 1 |
| `blog-single_body_02.png` | 本文インライン 2 |
| `blog-single_pickup_01.png` | Pick up カード 1 |
| `blog-single_pickup_02.png` | Pick up カード 2 |
| `blog-single_pickup_03.png` | Pick up カード 3 |

## 置かないもの

- page-hero（カンプに無し。パンくずから記事へ入る構成）
- CTA（カンプに無し。Pick up から Footer へ続く）
