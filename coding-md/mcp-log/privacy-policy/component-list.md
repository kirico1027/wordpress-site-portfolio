# コンポーネント一覧（Privacy Policy ページ — 下層）

> ベース: `coding-md/mcp-log/top/component-list.md` / `commonization-plan.md`

## 既存コンポーネント（流用）

| コンポーネント名 | 使用箇所 | 備考 |
|------------------|----------|------|
| top-header | 全ページ | `partials/header.html` |
| site-footer | 全ページ | `partials/footer.html` |

## 新規共通コンポーネント

なし（パンくずは news-single 等と同型だが Home 表記・色が異なるためページ固有で実装）

## ページ固有（コンポーネント化しない）

| ブロック名 | 説明 |
|-----------|------|
| privacy-policy-page | ページラッパー（白背景） |
| privacy-policy__breadcrumb-area | パンくず帯（fixed ヘッダー分の padding-top） |
| privacy-policy__breadcrumb | Home / ホーム > プライバシーポリシー |
| privacy-policy__content | 本文セクション（max-width 720） |
| privacy-policy__title | H1 見出し |
| privacy-policy__body | イントロ + 番号付きリスト + 改定履歴 |
| privacy-policy__intro | 冒頭段落 |
| privacy-policy__list | 番号付きリスト（ol） |
| privacy-policy__item | 各条項 |
| privacy-policy__item-title | 条項見出し（Black / 900） |
| privacy-policy__item-text | 条項本文 |
| privacy-policy__item-list | 箇条書き（ul） |
| privacy-policy__link | メールリンク |
| privacy-policy__revision | 改定履歴 |

## 置かないもの

- page-hero / CTA Contact（デザインにない）
- 戻るボタン（デザインにない）
- 新規画像（指示なし）

## WP 化メモ

- 静的: `privacy-policy.html`
- WP: `page-legal.php`（利用規約と共用想定）
