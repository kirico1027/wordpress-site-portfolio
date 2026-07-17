# Works 詳細ページ — デザインコンテキスト

> 取得: Figma MCP `get_design_context` / `get_screenshot` / `get_metadata`  
> ノード: `1:3957`（ページ全体）/ `1:4320`（Main）/ `1:4341`（記事カラム 720）/ `1:4478`（Pick up）  
> 取得日: 2026-07-16

## ページ構成

1. Header（共通・fixed）
2. Breadcrumb（Works 実績紹介 > 記事タイトル）
3. Article（日付 / タイトル / ヒーロー画像 / クライアントカード / インタビュー本文 / シェア）
4. Back button（一覧ページに戻る — `btn-more`）
5. Pick up / おすすめ記事（`works-card` × 3）
6. Footer（共通）

- **page-hero / CTA Contact なし**
- 一覧のカード → `works-single.html`
- WP: `single-works.php` / CPT `works`

## フォント

- **font-family**: Poppins（日本語はシステムゴシックへフォールバック）
- **weight**: 500（Medium）/ 600（SemiBold→600）/ 700（Bold）

## カラー

| 用途 | 値 | CSS 変数 |
|------|-----|----------|
| ページ背景 | #f9f9f9 | `--color-bg-light` |
| Pick up 背景 | #ffffff | `--color-white` |
| テキスト | #1e1e1e | `--color-text` |
| パンくず JA / 現在 | #373737 | `--color-dark` |
| 日付 / 社名 | #777 | `--color-text-muted` |
| パンくず EN / タグ / ボタン | #0096df | `--color-primary` |
| クライアント・シェアカード背景 | #ffffff | `--color-white` |
| 区切り線 | #dfdfdf | `--color-border` |

## タイポグラフィ（主要・PC カンプ）

| 要素 | size | weight | line-height | letter-spacing |
|------|------|--------|-------------|----------------|
| パンくず EN（Works） | 18px | 600 | 1.4 | 1.8px |
| パンくず JA / 現在 | 14px | 700 | 1 | 1.4px |
| 日付 | 16px | 500 | 1 | 1.6px |
| 記事タイトル | 32px | 700 | 1.5 (48/32) | 3.2px |
| クライアント社名 | 16px | 500 | 1.5 | 1.6px |
| クライアント説明 | 14px | 500 | 1.6 | 1.4px |
| 本文 h2 | 24px | 700 | 1.5 | 2.4px |
| Q 見出し | 18px | 700 | 1.7 | 1.8px |
| 本文段落 | 15px | 500 | 1.7 | 1.5px |
| シェア見出し | 18px | 500 | 1.2 | 1.8px |
| Pick up EN | 18px | 700 | 1.4 | — |
| おすすめ記事 | 32px | 700 | 1.4 | 4.8px |
| カードタイトル | 16px | 700 | 1.7 | 1.6px |
| カード会社 | 12px | 700 | 1.7 | 1.2px |

## レイアウト数値（PC カンプ 1905）

| 項目 | 値 |
|------|-----|
| ページ bg | #f9f9f9 |
| パンくず帯 padding-top | 200px（fixed ヘッダー分含む） |
| コンテナ | max 1184 / padding-inline 32 |
| 記事カラム | max-width 720 |
| 記事セクション | pt 48 / pb 160 / 記事↔戻る gap 80 |
| タイトル→ヒーロー | margin-top 32 |
| ヒーロー→クライアント | margin-top 24 |
| クライアントカード | white / radius 8 / px 32 / pt 8 / pb 24 |
| クライアント→本文 | margin-top 32 |
| 本文ブロック内要素間 | margin-top 32（連続段落は 0） |
| Q 見出し | border-left 2px black / padding-left 26 |
| シェア | margin-top 40 / white / radius 8 |
| Pick up | bg white / pt 64 / pb 120 / 見出し→カード 40 |
| カードグリッド | 3列 × 352 / column-gap 32 / row-gap 48 |

## 本文（カンプ掲載・要約）

インタビュー形式。h2 でリード、左ボーダー付き Q 見出し、回答段落、図版を交互に配置。

## 画像一覧

| 役割 | 保存先 |
|------|--------|
| ヒーロー | `works-single/works-single_01.png` |
| クライアントロゴ | `works-single/works-single_02.png` |
| 本文図版1 | `works-single/works-single_03.png` |
| 本文図版2 | `works-single/works-single_04.png` |
| Pick up 1（giraffe） | `works-single/works-single_05.png` |
| Pick up 2（turtle） | `works-single/works-single_06.png` |
| Pick up 3（Rabbit） | `works-single/works-single_07.png` |
