# コンポーネント一覧（Recruit ページ — 下層）

> ベース: `coding-md/mcp-log/top/component-list.md`

## 既存コンポーネント（流用）

| コンポーネント名 | 使用箇所 | 備考 |
|------------------|----------|------|
| top-header | 全ページ | `partials/header.html` |
| site-footer | 全ページ | `partials/footer.html` |
| page-hero | ページヒーロー | `page-hero--light` |
| section-label | 各セクション見出し | `partials/sections/section-label.html` |

## 新規共通コンポーネント

| コンポーネント名 | 静的 | 備考 |
|------------------|------|------|
| cta-entry | `partials/sections/cta-entry.html` | Recruit 専用 ENTRY CTA（オレンジ） |

## ページ固有（コンポーネント化しない）

| ブロック名 | 説明 |
|-----------|------|
| recruit-intro | イントロ見出し + 本文 + 横スクロールギャラリー |
| recruit-culture | 企業文化 3カード |
| culture-card | 文化カード（番号 + タイトル + 本文） |
| recruit-welfare | 福利厚生 4カード |
| welfare-card | 福利厚生カード |
| recruit-member | メンバー紹介 6名 |
| member-card | メンバーカード |
| recruit-jobs | 募集職種 4件（アコーディオン） |
| job-card | 職種カード |
| recruit-flow | 選考フロー 5ステップ |
| recruit-flow__step | フロー各ステップ |
