# Figma MCP ログ（Blog 詳細ページ）

取得日: 2026-07-17

## 対象

- Figma 選択ノード: `1:5444`（全てが揃うコーポレートサイト / Blog 詳細）
- ページ種別: Blog 詳細ページ（WP: `single.php` / 投稿シングル想定）
- 技術変換: Figma MCP の React + Tailwind 参照コードを、既存の静的 HTML + Sass + BEM 構成へ変換

## 全体構成

1. Header
2. Breadcrumb
3. Article
4. Share
5. Back button
6. Pick up
7. Footer

## Breadcrumb

- 外側幅: `1184px`
- 左右 padding: `32px`
- PC padding-top: `200px`
- パンくず下の罫線: margin-top `48px`, width `1120px`, color `#dfdfdf`
- 親リンク:
  - `Blog`: `18px`, weight `600`, line-height `25.2px`, letter-spacing `1.8px`, color `#0096df`
  - `ブログ`: `14px`, weight `700`, line-height `14px`, letter-spacing `1.4px`, color `#1e1e1e`
- 区切り: Material Icons `chevron_right`, `24px`
- 現在地: `福利厚生の進化：従業員の幸福を...`, `14px`, weight `700`, letter-spacing `1.4px`

## Article

- Article container:
  - max-width: `720px`
  - PC padding-top: `48px`
  - PC padding-bottom: `160px`
  - section gap to button: `80px`
- Meta row:
  - tag pill: white bg, radius `24px`, padding `8px 16px`
  - tag text: `15px`, weight `700`, line-height `22.5px`, letter-spacing `1.5px`, color `#0096df`
  - date: `2024/4/26 15:32`, `16px`, weight `600`, line-height `16px`, letter-spacing `0.8px`, color `#777`
- Title:
  - text: `福利厚生の進化：従業員の幸福を追求するビジネスの新たな道`
  - `32px`, weight `700`, line-height `48px`, letter-spacing `3.2px`
  - margin-top `24px`
- Hero image:
  - `720px x 432px`
  - margin-top `32px`
  - 画像取得指示なしのため、実装では既存アセットを仮置き

## Body

- 本文開始 margin-top: `56px` 相当（body `32px` + first h2 `24px`）
- h2:
  - margin-top `32px`（先頭のみ `24px`）
  - padding `12px 4px 13px`
  - border-bottom `1px solid #dfdfdf`
  - `24px`, weight `700`, line-height `36px`, letter-spacing `2.4px`
- h3:
  - margin-top `32px`
  - padding-left `26px`
  - border-left `2px solid #000`
  - `18px`, weight `700`, line-height `30.6px`, letter-spacing `1.8px`
- p:
  - margin-top `32px`
  - `15px`, weight `500`, line-height `25.5px`, letter-spacing `1.5px`
  - 連続段落は上余白なし
- figure:
  - margin-top `32px`
  - `720px x 481.188px` または `720px x 539.688px`
  - 画像取得指示なしのため、実装では既存アセットを仮置き

## Share

- margin-top: `40px`
- width: `720px`
- background: `#fff`
- radius: `8px`
- padding: `24px 0 16px`
- label: `\ Let's shere ! /`, `18px`, line-height `21.6px`, letter-spacing `1.8px`
- icon list:
  - margin-top `12px`
  - gap `24px`
  - icon button size `64px`

## Back Button

- margin-top: `80px`
- 既存 `btn-more` と同形
- label: `一覧ページに戻る`
- href: `./blog-archive.html`

## Pick up

- background: `#fff`
- container width: `1184px`, content width `1120px`
- padding-top: `64px`
- padding-bottom: `120px`
- heading:
  - `Pick up`: `18px`, color `#0096df`, dot `16px`
  - `今話題の記事`: `32px`, line-height `44.8px`, letter-spacing `4.8px`
- card grid:
  - margin-top `40px`
  - 3 columns, card width `352px`
  - row gap `48px`
  - card image `352px x 211.188px`

## 画像について

Figma MCP（node `1:5444`）から localhost 経由で取得し、`src/public/assets/img/blog/` にリネーム保存。

| 用途 | ファイル | Figma node |
|------|----------|------------|
| ヒーロー | `blog-single_hero.png` | `1:5534` |
| 本文画像 1 | `blog-single_body_01.png` | `1:5549` |
| 本文画像 2 | `blog-single_body_02.png` | `1:5587` |
| Pick up 1 | `blog-single_pickup_01.png` | `1:5682` |
| Pick up 2 | `blog-single_pickup_02.png` | `1:5699` |
| Pick up 3 | `blog-single_pickup_03.png` | `1:5716` |
