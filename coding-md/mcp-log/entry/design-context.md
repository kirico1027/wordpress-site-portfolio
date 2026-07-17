# Entry ページ — デザインコンテキスト

> 取得: Figma MCP `get_design_context` / `get_screenshot` / `get_metadata`（node: `1:4670` 全てが揃うコーポレートサイト / Entry）
> 取得日: 2026-07-16

## ページ構成

1. Header（共通）
2. Page Hero（Entry / 採用エントリー）— `page-hero--light`
3. Entry Form（採用エントリーフォーム）
4. Footer（共通）

※ Entry ページ末尾に CTA（cta-contact / cta-entry）は置かない（Figma でもフォーム直下が Footer）
※ Recruit ページの ENTRY セクションのリンク先

## フォント

- **font-family**: Poppins（日本語はシステムゴシックへフォールバック）
- **weight**: 400 / 600 / 700（SemiBold は 600 に寄せる）

## カラー

| 用途 | 値 | CSS 変数 |
|------|-----|----------|
| テキスト | #1e1e1e | `--color-text` |
| プレースホルダー | #dfdfdf / #ccc | `--color-border` / 個別 |
| ファイル案内文字 | #777 | 個別 |
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
| フィールドラベル（テキスト系） | 14px | 700 | 1.4 | 0.1em |
| フィールドラベル（セレクト・ファイル・質問） | 15px | 700 | 1.4 | 0.1em |
| 必須 * | 15px | 700 | 1.4 | — |
| 入力プレースホルダー | 14〜15px | 600 | normal | 0.1em |
| ファイル案内 | 14px | 600 | 1 | 0.1em |
| 同意文 | 12px | 400 | 1.4 | 0.05em |
| 送信ボタン | 16px | 700 | 1 | 0.05em |

## レイアウト数値（PC カンプ 1905）

| 項目 | 値 |
|------|-----|
| ヒーロー bg | #f9f9f9 / 下角丸 64px |
| ヒーロー padding | top 140 / bottom 64 / inline 48 |
| フォーム外枠 | max 1184 / padding 32 / pt 80 / pb 120 |
| フォーム幅 | 560px |
| フィールド間 | gap 24px |
| ラベル→入力 | gap 12px（セレクト・ファイルは label pb 10px） |
| 入力高さ | min-height 50px / radius 2px |
| セレクト高さ | min-height 53px / radius 4px |
| テキストエリア高さ | min-height 160px / radius 2px |
| ファイル枠 | dashed border / radius 2px / padding 11px |
| 送信ボタン | 320×64 / radius 48px / bg #373737 |
| 送信ボタン上余白 | padding-top 24px（フィールド群との間隔） |

## フォーム項目

| 項目 | 種別 | 必須 |
|------|------|------|
| お名前 | text | ○ |
| フリガナ | text | ○ |
| メールアドレス | email | ○ |
| メールアドレス（確認用） | email | ○ |
| ご年齢 | text（placeholder: 25） | ○ |
| 現在のご職業 | select | ○ |
| 希望職種 | select（Recruit 募集職種と連動想定） | ○ |
| ファイル添付 | file | ○ |
| 質問や面談時に聞きたいこと | textarea | — |
| プライバシーポリシーに同意する | checkbox | ○ |

## 画像一覧

新規ページ専用画像なし（ヘッダー・フッターロゴは共通画像を流用）。
