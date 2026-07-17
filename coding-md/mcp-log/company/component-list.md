# コンポーネント一覧（Company ページ — 下層）

> ベース: `coding-md/mcp-log/top/component-list.md` / `commonization-plan.md`

## 既存コンポーネント（流用）

| コンポーネント名 | 使用箇所 | 備考 |
|------------------|----------|------|
| top-header | 全ページ | `partials/header.html` |
| site-footer | 全ページ | `partials/footer.html` |
| page-hero | ページヒーロー | `page-hero--light`（画像なし） |
| section-label | 会社概要 / アクセス | アクセスは `section-label--orange` |
| section-cta | ページ末尾 | `partials/sections/cta-contact.html` |

## 新規共通コンポーネント

なし（会社情報テーブル・アクセスは Company ページ固有）

## ページ固有（コンポーネント化しない）

| ブロック名 | 説明 |
|-----------|------|
| company-profile | 会社概要セクション（section-label + 定義リスト） |
| company-profile__list / __row / __term / __desc | 会社情報テーブル行 |
| company-access | アクセスセクション（住所 + マッププレースホルダ） |
| company-access__map | Google Maps 等を差し込む予定の枠 |

## 置かないもの

- 新規のヒーロー / CTA（既存を流用）
- マップ実画像の取得（指示がないためプレースホルダのみ）
