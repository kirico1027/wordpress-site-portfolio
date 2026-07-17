# コンポーネント一覧（News 一覧ページ — 下層）

> ベース: `coding-md/mcp-log/top/component-list.md` / `commonization-plan.md`  
> Figma: node `1:3386`（全てが揃うコーポレートサイト / News）

## 既存コンポーネント（流用）

| コンポーネント名 | 使用箇所 | 備考 |
|------------------|----------|------|
| top-header | 全ページ | `partials/header.html` |
| site-footer | 全ページ | `partials/footer.html` |
| page-hero | ページヒーロー | `page-hero--light`（画像なし）News / お知らせ |
| news-item | 記事一覧 | `partials/cards/news-item.html`（アーカイブはカード見た目をページ SCSS で上書き） |
| section-cta | ページ末尾 | `partials/sections/cta-contact.html` |

## 新規共通コンポーネント

なし（フィルター UI・一覧レイアウトは News アーカイブ固有。Works アーカイブのフィルターと同型だがカテゴリ・縦並びレイアウトが異なるため共通化は見送り）

## ページ固有（コンポーネント化しない）

| ブロック名 | 説明 |
|-----------|------|
| news-archive | メイン一覧セクション（フィルター + リスト） |
| news-archive__filters | 左サイドバー（PC）カテゴリフィルター |
| news-archive__filter / --active | ピル型フィルターリンク |
| news-archive__list | 記事リスト（右カラム） |
| news-archive 内 `.news-item` | カード型スタイル上書き（bg / radius / タグ色） |

## 置かないもの

- 新規ヒーロー / CTA（既存を流用）
- ページ専用画像（指示なし）
- 「もっと見る」ボタン（Figma カンプに無し）
