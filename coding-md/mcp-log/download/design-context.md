# Download ページ — デザインコンテキスト

> 取得: Figma MCP `get_design_context` / `get_screenshot` / `get_metadata`（node: `1:3677` 全てが揃うコーポレートサイト / Download）
> 取得日: 2026-07-16

## ページ構成

1. Header（共通）
2. Page Hero（Download / 資料ダウンロード）— `page-hero--light`
3. Download Intro（資料プレビュー＋わかることリスト）
4. Download Form（資料請求フォーム）
5. Footer（共通）

※ Download ページ末尾に CTA（cta-contact）は置かない（Figma でもフォーム直下が Footer）
※ Contact / 各ページ CTA の「資料ダウンロード」リンク先（`download.html`）

## フォント

- **font-family**: Poppins（日本語はシステムゴシックへフォールバック）
- **weight**: 400 / 600 / 700（SemiBold は 600 に寄せる）
- **アイコン**: Material Icons（check）

## カラー

| 用途 | 値 | CSS 変数 |
|------|-----|----------|
| テキスト | #1e1e1e | `--color-text` |
| プレースホルダー | #dfdfdf | `--color-border` |
| 必須マーク | #f23a3c | `--color-required` |
| ボーダー | #dfdfdf | `--color-border` |
| 背景ヒーロー / イントロ | #f9f9f9 | `--color-bg-light` |
| 見出し（この資料で…） | #0096df | `--color-primary` |
| チェックアイコン | #ffa76c | `--color-accent-orange` |
| 送信ボタン背景 | #373737 | `--color-dark` |
| ボタン文字 | #ffffff | `--color-white` |

## タイポグラフィ（主要）

| 要素 | size | weight | line-height | letter-spacing |
|------|------|--------|-------------|----------------|
| ページヒーロー EN | 56px | 600 | 1.4 | 0.05em |
| ページヒーロー JA | 18px | 700 | 1 | 0.1em |
| イントロ見出し | 20px | 700 | 30/20 | 0.1em |
| リスト本文 | 16px | 600 | 24/16 | 0.1em |
| チェックアイコン | 20px | — | 1 | — |
| フィールドラベル | 14px | 700 | 1.4 | 0.1em |
| 必須 * | 15px | 700 | 1.4 | — |
| 入力プレースホルダー | 14px | 600 | normal | 0.1em |
| 同意文 | 14px | 400 | 1.4 | 0.05em |
| 送信ボタン | 16px | 700 | 1 | 0.1em |

## レイアウト数値（PC カンプ 1905）

| 項目 | 値 |
|------|-----|
| ヒーロー bg | #f9f9f9 / 下角丸 64px |
| ヒーロー padding | top 140 / bottom 64 |
| コンテンツ外枠 | max 1184 / padding 32 / pt 80 / pb 120 / gap 64 |
| イントロパネル | bg #f9f9f9 / radius 16 / py 40 / pl 40 / pr 64 / gap 64 |
| 資料画像 | 400×210 / radius 4 |
| フォーム幅 | 560px |
| フィールド間 | gap 24px |
| ラベル→入力 | gap 12px |
| 入力高さ | min-height 50px / radius 8px |
| 送信ボタン | 320×64 / radius 48px / bg #373737 |

## フォーム項目

| 項目 | 種別 | 必須 |
|------|------|------|
| お名前 | text | ○ |
| フリガナ | text | ○ |
| メールアドレス | email | ○ |
| メールアドレス（確認用） | email | ○ |
| 電話番号 | tel | — |
| 会社名 | text | ○ |
| プライバシーポリシーに同意する | checkbox | ○ |

## 画像一覧

| 用途 | ファイル名 | 保存先 |
|------|-----------|--------|
| 資料カバー | document-cover.png | `src/public/assets/img/download/document-cover.png` |
