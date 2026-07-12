# コンポーネント一覧（Works アーカイブページ — 下層）

> ベース: `coding-md/mcp-log/top/component-list.md` / `commonization-plan.md`

## 既存コンポーネント（流用）

| コンポーネント名 | 使用箇所 | 備考 |
|------------------|----------|------|
| top-header | 全ページ | `partials/header.html` |
| site-footer | 全ページ | `partials/footer.html` |
| page-hero | ページヒーロー | `page-hero--light` |
| works-card | 実績カード一覧 | `partials/cards/works-card.html` |
| section-cta | ページ末尾 | `partials/sections/cta-contact.html` |

## ページ固有（コンポーネント化しない）

| ブロック名 | 説明 |
|-----------|------|
| works-archive | フィルタータグ + カードグリッド + もっと見る |
| works-archive__filter | カテゴリフィルターピル（すべて / 各サービス名） |
| works-archive__more | もっと見るリンク（ボーダーなし・テキスト + アイコン） |
