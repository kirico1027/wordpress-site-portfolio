# コンポーネント一覧（Blog 一覧ページ — 下層）

> ベース: `coding-md/mcp-log/top/component-list.md` / `commonization-plan.md` / `WORDPRESS_DESIGN.md`  
> Figma: node `1:2`（全てが揃うコーポレートサイト / Blog）

## 既存コンポーネント（流用）

| コンポーネント名 | 使用箇所 | 備考 |
|------------------|----------|------|
| top-header | 全ページ | `partials/header.html` |
| site-footer | 全ページ | `partials/footer.html` |
| section-cta | ページ末尾 | `partials/sections/cta-contact.html` |

## 新規作成するコンポーネント

| コンポーネント名（ブロック名） | 使用箇所 | 想定パラメータ・バリエーション | 備考 |
|-------------------------------|----------|--------------------------------|------|
| blog-card | Blog 一覧グリッド | href, thumbnail, tags[], title, datetime, date | `partials/cards/blog-card.html` + `sass/components/blog-card` |
| blog-pickup | Blog サイドバー Pick up | href, thumbnail, title, category | 一覧内 partial（サイドバー専用） |

## ページ固有（コンポーネント化しない）

| ブロック名 | 説明 |
|-----------|------|
| blog-featured | 特集カルーセル（スライド + Prev/Next） |
| blog-archive | メイン一覧（グリッド + サイドバー） |
| blog-archive__main / __sidebar | 2 カラムレイアウト |
| blog-archive__categories | CATEGORY ピル群 |
| blog-archive__search | KEYWORD 検索フォーム |
| blog-archive__pickup | PICK UP リスト |
| blog-archive__more | 「もっと見る」 |

## 置かないもの

- page-hero（カンプに無し。特集スライダーが先頭）
- ページ専用画像の本取得（工程 2 指示なし → works 画像を仮置き）
