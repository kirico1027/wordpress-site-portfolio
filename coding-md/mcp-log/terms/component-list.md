# コンポーネント一覧（Terms 利用規約ページ — 下層）

> ベース: `coding-md/mcp-log/top/component-list.md` / `commonization-plan.md`

## 既存コンポーネント（流用）

| コンポーネント名 | 使用箇所 | 備考 |
|------------------|----------|------|
| top-header | 全ページ | `partials/header.html` |
| site-footer | 全ページ | `partials/footer.html` |

## 新規共通コンポーネント

なし（パンくずは privacy-policy 等と同型だが Home 表記・色が異なるためページ固有で実装）

## ページ固有（コンポーネント化しない）

| ブロック名 | 説明 |
|-----------|------|
| terms-page | ページラッパー（白背景） |
| terms__breadcrumb-area | パンくず帯（fixed ヘッダー分の padding-top） |
| terms__breadcrumb | Home / ホーム > 利用規約 |
| terms__content | 本文セクション（max-width 720） |
| terms__title | H1 見出し |
| terms__body | 番号付きリスト + 締め段落 |
| terms__list | 番号付きリスト（ol） |
| terms__item | 各条項 |
| terms__item-title | 条項見出し（Black / 900） |
| terms__item-text | 条項本文（1.1, 1.2 等） |
| terms__item-list | 箇条書き（ul） |
| terms__closing | 締めの段落 |

## 置かないもの

- page-hero / CTA Contact（デザインにない）
- 戻るボタン（デザインにない）
- イントロ段落（デザインにない）
- 改定履歴（デザインにない）
- 新規画像（指示なし）

## WP 化メモ

- 静的: `terms.html`
- WP: `page-legal.php`（プライバシーポリシーと共用想定）
