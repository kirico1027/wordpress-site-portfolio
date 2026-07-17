# コンポーネント一覧（Entry ページ — 下層）

> ベース: `coding-md/mcp-log/top/component-list.md` / `commonization-plan.md` / Contact・Download ページ

## 既存コンポーネント（流用）

| コンポーネント名 | 使用箇所 | 備考 |
|------------------|----------|------|
| top-header | 全ページ | `partials/header.html` |
| site-footer | 全ページ | `partials/footer.html` |
| page-hero | ページヒーロー | `page-hero--light`（画像なし） |

## 新規共通コンポーネント

なし（フォーム見た目は Contact / Download と同型だが項目が異なるためページ固有として実装。将来 CF7 化時に partial 化を検討）

## ページ固有（コンポーネント化しない）

| ブロック名 | 説明 |
|-----------|------|
| entry-form | 採用エントリーフォーム一式 |
| entry-form__field | ラベル＋入力の行 |
| entry-form__select-wrap | セレクト＋矢印アイコン |
| entry-form__file | ファイル添付（破線枠） |
| entry-form__agree | プライバシー同意チェック |
| entry-form__submit | エントリーボタン |

## 置かないもの

- `cta-contact` / `cta-entry` — Entry ページ自身のためフッター直前に CTA は置かない（Figma 準拠）
