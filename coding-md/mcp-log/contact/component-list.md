# コンポーネント一覧（Contact ページ — 下層）

> ベース: `coding-md/mcp-log/top/component-list.md` / `commonization-plan.md`

## 既存コンポーネント（流用）

| コンポーネント名 | 使用箇所 | 備考 |
|------------------|----------|------|
| top-header | 全ページ | `partials/header.html` |
| site-footer | 全ページ | `partials/footer.html` |
| page-hero | ページヒーロー | `page-hero--light`（画像なし） |

## 新規共通コンポーネント

なし（フォームは Contact ページ固有。将来 CF7 化時に partial 化を検討）

## ページ固有（コンポーネント化しない）

| ブロック名 | 説明 |
|-----------|------|
| contact-form | お問い合わせフォーム一式（ラジオ・入力・同意・送信） |
| contact-form__field | ラベル＋入力の行 |
| contact-form__radios | お問い合わせ項目ラジオ群 |
| contact-form__agree | プライバシー同意チェック |
| contact-form__submit | 送信ボタン |

## 置かないもの

- `cta-contact` — Contact ページ自身のためフッター直前に CTA は置かない（Figma 準拠）
