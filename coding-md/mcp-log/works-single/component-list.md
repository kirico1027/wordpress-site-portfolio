# コンポーネント一覧（Works 詳細ページ — 下層）

> ベース: `coding-md/mcp-log/top/component-list.md` / `commonization-plan.md`  
> Figma: node `1:3957`（全てが揃うコーポレートサイト / Works 詳細）

## 既存コンポーネント（流用）

| コンポーネント名 | 使用箇所 | 備考 |
|------------------|----------|------|
| top-header | 全ページ | `partials/header.html` |
| site-footer | 全ページ | `partials/footer.html` |
| btn-more | 一覧へ戻る | `partials/sections/btn-more.html` |
| works-card | おすすめ記事 | `partials/cards/works-card.html`（3カラム配置はページ側で上書き） |
| section-heading | Pick up / おすすめ記事 | `partials/sections/section-heading.html`（サイズはページ側で上書き） |

## 新規共通コンポーネント

なし（パンくずは News 詳細と同型だが、親ラベルが Works / 実績紹介のためページ固有で実装。Blog 詳細実装時に共通化を検討）

## ページ固有（コンポーネント化しない）

| ブロック名 | 説明 |
|-----------|------|
| works-single | ページルート（bg `#f9f9f9`） |
| works-single__breadcrumb | パンくず（EN+JA 親リンク + chevron + 現在タイトル） |
| works-single__article | 記事本体（日付 / タイトル / ヒーロー画像 / クライアントカード / 本文 / シェア） |
| works-single__client | クライアント情報カード（ロゴ + 社名 + 説明） |
| works-single__body | インタビュー本文（h2 / Q見出し / 段落 / 図版） |
| works-single__share | SNS シェア（Let's share + X / Facebook） |
| works-single__back | 一覧へ戻るボタンの配置ラッパー |
| works-single__pickup | おすすめ記事セクション（白背景） |

## 置かないもの

- page-hero（本カンプに無し。パンくずのみ）
- section-cta / CTA Contact（本カンプに無し）
