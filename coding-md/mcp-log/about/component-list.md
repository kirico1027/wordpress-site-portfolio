# コンポーネント一覧（About ページ — 下層）

> ベース: `coding-md/mcp-log/top/component-list.md` / `commonization-plan.md`

## 既存コンポーネント（流用）

| コンポーネント名 | 使用箇所 | 備考 |
|------------------|----------|------|
| top-header | 全ページ | `partials/header.html` |
| site-footer | 全ページ | `partials/footer.html` |
| page-hero | ページヒーロー | `page-hero--light` モディファイアでテキストのみ |
| section-label | Purpose / Vision / Mission / Value | 新規共通（dot + 英語ラベル） |
| section-cta | ページ末尾 | `partials/sections/cta-contact.html` |

## 新規作成するコンポーネント

| コンポーネント名（ブロック名） | 使用箇所 | 備考 |
|-------------------------------|----------|------|
| section-label | About 他下層でも流用可 | `--orange` で Mission ドット色 |

## ページ固有（コンポーネント化しない）

| ブロック名 | 説明 |
|-----------|------|
| about-purpose | Purpose 2カラム + コラージュ |
| about-statements | Vision / Mission パネル + ギャラリー帯 |
| about-value | 5つの価値観カード |
| value-card | about-value 内のカード（about ページのみ） |
