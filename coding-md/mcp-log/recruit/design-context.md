# Recruit ページ — デザインコンテキスト

> 取得: Figma MCP `get_design_context`（node: 1:2024 全てが揃うコーポレートサイト / Recruit）
> 取得日: 2026-07-12

## フォント

- **font-family**: Poppins（日本語はシステムゴシックへフォールバック）
- **weight**: 400 / 500 / 600 / 700

## カラー

| 用途 | 値 | CSS 変数 |
|------|-----|----------|
| テキスト | #1e1e1e | `--color-text` |
| テキスト（補助） | #373737 | `--color-dark` |
| ミュート | #777 | `--color-text-muted` |
| プライマリ | #0096df | `--color-primary` |
| アクセントオレンジ | #ffa76c | `--color-accent-orange` |
| 背景ライト | #f9f9f9 | `--color-bg-light` |
| ボーダー | #dfdfdf | `--color-border` |
| ENTRY 背景 | #ffa76c | `--color-accent-orange` |

## タイポグラフィ（主要）

| 要素 | size | weight | line-height | letter-spacing |
|------|------|--------|-------------|----------------|
| ページヒーロー EN | 56px | 600 | 1.4 | 0.05em |
| ページヒーロー JA | 18px | 700 | 1 | 0.1em |
| イントロ見出し | 40px | 700 | 1.5 | 0.1em |
| イントロ本文 | 16px | 600 | 2.4 | 0.1em |
| セクションラベル | 18px | 700 | 1.4 | — |
| セクション見出し | 32px | 700 | 1.4 | 0.15em |
| 文化カード番号 | 32px | 700 | 1.8 | 0.1em |
| 文化カードタイトル | 24px | 700 | 1.5 | 0.1em |
| 文化カード本文 | 14px | 500 | 1.8 | 0.1em |
| 福利厚生ラベル | 13px | 600 | 1.4 | 0.05em |
| 福利厚生タイトル | 16px | 700 | 1.2 | 0.1em |
| 福利厚生本文 | 14px | 600 | 1.6 | 0.1em |
| メンバー役職 | 14px | 600 | 1.4 | 0.1em |
| メンバー氏名 | 18px | 700 | 1.2 | 0.1em |
| 職種カテゴリ | 13px | 500 | 1.4 | 0.1em |
| 職種タイトル | 18px | 700 | 1.2 | 0.1em |
| フロー STEP | 20px | 600 | 1.2 | 0.05em |
| ENTRY 見出し | 48px | 600 | 1.1 | 0.1em |

## レイアウト

| 要素 | 値 |
|------|-----|
| ヒーロー padding-top | 140px |
| ヒーロー padding-bottom | 64px |
| ヒーロー border-radius | 0 0 64px 64px |
| イントロ padding-top | 80px |
| イントロ padding-bottom | 120px |
| 文化セクション padding | 80px 0 |
| 文化カード gap | 24px |
| 福利厚生 padding | 80px 0 |
| 福利厚生カード gap | 24px |
| メンバー padding | 80px 0 120px |
| メンバーグリッド gap | 48px 64px |
| 募集職種 padding | 120px 0（背景 #f9f9f9） |
| 職種カード gap | 24px |
| 選考フロー padding | 120px 0 |
| フローボックス padding | 24px 64px 80px |
| フローボックス border-radius | 16px |
| ENTRY padding | 80px 0 |
| ENTRY border-radius | 32px |
| ギャラリー画像 border-radius | 24px |
| ギャラリー画像 aspect-ratio | 738 / 443 |
| メンバー写真 | 200px 円形 |

## 企業文化カード（node 1:2130）

| 要素 | 値 |
|------|-----|
| リスト max-width | 1120px |
| リスト gap | 24px |
| リスト margin-top | 64px |
| カード幅 | 357.328px |
| カード padding | 0 32px 24px |
| カード gap（縦） | 16px |
| 番号ラッパー高さ | 26px |
| 番号 position | top -32px（中央） |
| 番号 | 32px / 700 / #ffa76c / ls 3.2px |
| タイトル | 24px / 700 / #0096df / ls 2.4px |
| 本文 max-width | 294px / 14px / 500 |


| ファイル | 用途 |
|----------|------|
| `img/about/gallery_01.png` | イントロギャラリー01 |
| `img/about/gallery_02.png` | イントロギャラリー02 |
| `img/about/gallery_03.png` | イントロギャラリー03 |
| `img/about/gallery_04.png` | イントロギャラリー04 |

メンバー写真は Figma 上プレースホルダー（円形グレー）のため、画像は使用しない。
