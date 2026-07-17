# Contact ページ — デザインコンテキスト

> 取得: Figma MCP `get_design_context` / `get_screenshot`（node: `1:2631` 全てが揃うコーポレートサイト / Contact）
> 取得日: 2026-07-15

## ページ構成

1. Header（共通）
2. Page Hero（Contact / お問い合わせ）— `page-hero--light`
3. Contact Form（お問い合わせフォーム）
4. Footer（共通）

※ Contact ページ末尾に CTA（cta-contact）は置かない（Figma でもフォーム直下が Footer）

## フォント

- **font-family**: Poppins（日本語はシステムゴシックへフォールバック）
- **weight**: 400 / 600 / 700（SemiBold は 600 に寄せる）

## カラー

| 用途 | 値 | CSS 変数 |
|------|-----|----------|
| テキスト | #1e1e1e | `--color-text` |
| ラジオ等ラベル | #333 | （テキスト近似） |
| プレースホルダー | #dfdfdf / #ccc | `--color-border` / 個別 |
| 必須マーク | #f23a3c | `--color-required` |
| ボーダー | #dfdfdf | `--color-border` |
| 背景ヒーロー | #f9f9f9 | `--color-bg-light` |
| 送信ボタン背景 | #373737 | `--color-dark` |
| ボタン文字 | #ffffff | `--color-white` |

## タイポグラフィ（主要）

| 要素 | size | weight | line-height | letter-spacing |
|------|------|--------|-------------|----------------|
| ページヒーロー EN | 56px | 600 | 1.4 | 0.05em |
| ページヒーロー JA | 18px | 700 | 1 | 0.1em |
| フィールドラベル | 14〜15px | 700 | 1.4 | 0.1em |
| 必須 * | 15px | 700 | 1.4 | — |
| ラジオ選択肢 | 14px | 600 | 1.4 | 0.1em |
| 入力プレースホルダー | 14〜15px | 600 | normal | 0.1em |
| 同意文 | 12px | 400 | 1.4 | 0.05em |
| 送信ボタン | 16px | 700 | 1 | 0.1em |

## レイアウト数値（PC カンプ 1905）

| 項目 | 値 |
|------|-----|
| ヒーロー bg | #f9f9f9 / 下角丸 64px |
| ヒーロー padding | top 140 / bottom 64 / inline 48 |
| フォーム外枠 | max 1184 / padding 32 / pt 80 / pb 120 |
| フォーム幅 | 560px |
| フィールド間 | gap 24px |
| ラベル→入力 | gap 12px |
| 入力高さ | min-height 50px / radius 8px |
| テキストエリア高さ | min-height 160px |
| 送信ボタン | 320×64 / radius 48px / bg #373737 |
| 送信ボタン上余白 | 24px（フィールド群との間隔は form gap に含む） |

## フォーム項目

| 項目 | 種別 | 必須 |
|------|------|------|
| お問い合わせ項目 | radio（導入相談/お見積もり・セミナー/イベント申し込み・メディア掲載/その他） | ○ |
| お名前 | text | ○ |
| フリガナ | text | ○ |
| メールアドレス | email | ○ |
| メールアドレス（確認用） | email | ○ |
| 会社名 | text | ○ |
| お問い合わせ内容 | textarea | ○ |
| プライバシーポリシーに同意する | checkbox | ○ |

## 画像一覧

新規ページ専用画像なし（ヘッダー・フッターロゴは共通画像を流用）。
