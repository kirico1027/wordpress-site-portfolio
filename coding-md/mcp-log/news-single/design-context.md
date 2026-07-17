# News 詳細ページ — デザインコンテキスト

> 取得: Figma MCP `get_design_context` / `get_screenshot` / `get_metadata`  
> ノード: `1:3177`（ページ全体）/ `1:3229`（メイン）/ `1:3250`（記事カード）  
> 取得日: 2026-07-16

## ページ構成

1. Header（共通・fixed）
2. Breadcrumb（News お知らせ > 記事タイトル）
3. Article（白カード: 日付 / タイトル / 本文）
4. Back button（一覧ページに戻る — `btn-more`）
5. Footer（共通）

- **page-hero / CTA Contact なし**
- 一覧の「夏季休業のお知らせ」→ `news-single.html`
- WP: `single-news.php` / CPT `news`

## フォント

- **font-family**: Poppins（日本語はシステムゴシックへフォールバック）
- **weight**: 500（Medium）/ 600（SemiBold→600）/ 700（Bold）

## カラー

| 用途 | 値 | CSS 変数 |
|------|-----|----------|
| ページ背景 | #f9f9f9 | `--color-bg-light` |
| テキスト | #1e1e1e | `--color-text` |
| パンくず JA / 現在 | #373737 | `--color-dark` |
| 日付 | #777 | `--color-text-muted` |
| パンくず EN / ボタン | #0096df | `--color-primary` |
| 記事カード背景 | #ffffff | `--color-white` |

## タイポグラフィ（主要）

| 要素 | size | weight | line-height | letter-spacing |
|------|------|--------|-------------|----------------|
| パンくず EN（News） | 18px | 600 | 1.4 | 1.8px |
| パンくず JA / 現在 | 14px | 700 | 1 | 1.4px |
| 日付 | 16px | 500 | 1 | 0.8px |
| 記事タイトル | 28px | 700 | 1.4 | 2.8px |
| 本文 | 15px | 500 | 1.7 | 0.75px |
| 戻るボタン | 16px | 700 | 1.6 | 1.6px |

## レイアウト数値（PC カンプ 1905）

| 項目 | 値 |
|------|-----|
| ページ bg | #f9f9f9 |
| パンくず帯 padding-top | 200px（fixed ヘッダー分含む） |
| コンテナ | max 1184 / padding-inline 32 |
| 記事セクション | pt 48 / pb 160 / カード↔ボタン gap 64 |
| 記事カード | max-width 800 / padding 48 / radius 16 |
| 日付→タイトル | margin-top 24 |
| タイトル→本文 | margin-top 32（本文先頭段落の内側余白含む視覚は約 48） |
| 段落間 | margin-top 16 |
| 戻るボタン | border 2 / radius 96 / icon 64 |

## 本文（カンプ掲載）

```
平素は格別のお引き立てをいただき厚くお礼申し上げます。
弊社では、誠に勝手ながら下記日程を夏季休業とさせていただきます。

■夏季休業期間
2024年08月13日(火) ～ 08月16日(金)

休業期間中にいただいたお問合せについては、営業開始日以降に順次回答させていただきます。
皆様には大変ご不便をおかけいたしますが、何卒ご理解の程お願い申し上げます。
```

## 画像一覧

新規ページ専用画像なし（ヘッダー・フッターロゴは共通画像を流用）。
