# Company ページ — デザインコンテキスト

> 取得: Figma MCP `get_design_context` / `get_screenshot` / `get_metadata`（node: `1:2907`）
> 取得日: 2026-07-15
> ページ役割: フッター「会社概要」リンク先の下層ページ（`company.html`）

## ページ構成

1. Header（共通）
2. Page Hero（Company / 会社について）— `page-hero--light`
3. 会社概要（定義リスト）
4. アクセス（住所 + マッププレースホルダ）
5. CTA CONTACT（共通 `cta-contact`）
6. Footer（共通）

## フォント

- **font-family**: Poppins（日本語はシステムゴシックへフォールバック）
- **weight**: 500 / 600 / 700（SemiBold は 600〜700 に寄せる）

## カラー

| 用途 | 値 | CSS 変数 |
|------|-----|----------|
| テキスト | #1e1e1e | `--color-text` |
| プライマリ（会社概要ドット / CTA） | #0096df | `--color-primary` |
| アクセント（アクセスドット） | #ffa76c | `--color-accent-orange` |
| ボーダー（リスト区切り） | #dfdfdf | `--color-border` |
| ヒーロー背景 | #f9f9f9 | `--color-bg-light` |
| マッププレースホルダ | #eeeeee | （ページ固有） |

## タイポグラフィ（主要）

| 要素 | size | weight | line-height | letter-spacing |
|------|------|--------|-------------|----------------|
| ページヒーロー EN | 56px | 600 | 1.4 | 0.05em |
| ページヒーロー JA | 18px | 700 | 1 | 0.1em |
| セクションラベル（会社概要 / アクセス） | 16px | 700 | 1.7 | 0.1em |
| 定義リスト term | 14px | 700 | 1.8 | 0.1em |
| 定義リスト desc | 14px | 500 | 1.8 | 0.1em |
| アクセス住所 | 14px | 500 | 1.8 | 0.1em |

## レイアウト数値（PC カンプ 1905）

| 項目 | 値 |
|------|-----|
| ヒーロー bg | #f9f9f9 / 下角丸 64px |
| ヒーロー padding | top 140 / bottom 64 |
| 会社概要外枠 | max 1184 / padding 32 / py 80 |
| 会社概要コンテンツ幅 | 960px |
| リスト上余白 | 40px（ラベルからの margin-top） |
| 行 padding | top 32 / bottom 33 / left 48 / right 24 |
| term 幅 | 222px |
| アクセス padding | top 80 / bottom 160 / inline 32 |
| 住所 margin-top | 48px |
| マップ margin-top | 24px / 960×400 / radius 4 / bg #eee |

## 会社概要データ

| 項目 | 内容 |
|------|------|
| 会社名 | 株式会社Biz Life |
| 設立 | 2029年3月15日 |
| 代表 | 一ノ瀬 一茶 |
| 資本金 | 2000万円 |
| 住所 | 〒361-9841 東京都中央区3-20-2シルバービルディング9F |
| 事業内容 | 福利厚生プログラム3本（Digital Wellbeing / Workflow Management / Mental Health Care） |

## 画像一覧

新規ページ専用画像なし（マップはプレースホルダ。ヘッダー・フッターロゴは共通）。
