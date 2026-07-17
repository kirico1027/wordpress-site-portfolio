# コンポーネント一覧（News 詳細ページ — 下層）

> ベース: `coding-md/mcp-log/top/component-list.md` / `commonization-plan.md`  
> Figma: node `1:3177`（全てが揃うコーポレートサイト / News 詳細）

## 既存コンポーネント（流用）

| コンポーネント名 | 使用箇所 | 備考 |
|------------------|----------|------|
| top-header | 全ページ | `partials/header.html` |
| site-footer | 全ページ | `partials/footer.html` |
| btn-more | 一覧へ戻る | `partials/sections/btn-more.html`（枠線ピル型。CTA Contact は本ページに無し） |

## 新規共通コンポーネント

なし（パンくずは News / Blog / Works 詳細で使い回す想定だが、本カンプは「News お知らせ > 記事タイトル」の固有構造のため、まずはページ固有で実装。共通化は Blog / Works 詳細実装時に検討）

## ページ固有（コンポーネント化しない）

| ブロック名 | 説明 |
|-----------|------|
| news-single | ページルート（bg `#f9f9f9`） |
| news-single__breadcrumb | パンくず（EN+JA 親リンク + chevron + 現在タイトル） |
| news-single__article | 白カード記事本体（日付 / タイトル / 本文） |
| news-single__back | 一覧へ戻るボタンの配置ラッパー |

## 置かないもの

- page-hero（本カンプに無し。パンくずのみ）
- section-cta / CTA Contact（本カンプに無し）
- ページ専用画像（指示なし）
- SNS シェア（本カンプに無し）
