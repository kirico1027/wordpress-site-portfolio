# コンポーネント一覧（Download ページ — 下層）

> ベース: `coding-md/mcp-log/top/component-list.md` / `commonization-plan.md` / Contact ページ

## 既存コンポーネント（流用）

| コンポーネント名 | 使用箇所 | 備考 |
|------------------|----------|------|
| top-header | 全ページ | `partials/header.html` |
| site-footer | 全ページ | `partials/footer.html` |
| page-hero | ページヒーロー | `page-hero--light`（画像なし） |

## 新規共通コンポーネント

なし（フォーム見た目は Contact と同型だが項目が異なるためページ固有として実装。将来 CF7 化時に partial 化を検討）

## ページ固有（コンポーネント化しない）

| ブロック名 | 説明 |
|-----------|------|
| download-intro | 資料カバー画像＋「この資料でわかること」リスト |
| download-form | 資料請求フォーム一式（入力・同意・送信） |
| download-form__field | ラベル＋入力の行 |
| download-form__agree | プライバシー同意チェック |
| download-form__submit | 送信ボタン |

## 置かないもの

- `cta-contact` — Download ページ自身のためフッター直前に CTA は置かない（Figma 準拠）
