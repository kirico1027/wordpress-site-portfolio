# コンポーネント一覧（トップページ — WordPress 化前提）

> WP テーマ構成: `WORDPRESS_DESIGN.md` §7–§8

## レイアウト partials（全ページ）

| ブロック名 | 静的 | WP template-parts |
|-----------|------|-------------------|
| head | `partials/head.html` | `header.php` 内 |
| top-header | `partials/header.html` | `header.php` |
| site-footer | `partials/footer.html` | `footer.php` |
| breadcrumb | `partials/breadcrumb.html` | `breadcrumb.php` |
| page-hero | `partials/page-hero.html` | `page-hero.php` |

## カード partials（CPT / ループ単位）

| ブロック名 | 静的 | WP | データソース |
|-----------|------|-----|-------------|
| service-card | `partials/cards/service-card.html` | `cards/service-card.php` | Phase 4 Repeater |
| works-card | `partials/cards/works-card.html` | `cards/works-card.php` | CPT `works` |
| news-item | `partials/cards/news-item.html` | `cards/news-item.php` | CPT `news` |

## セクション partials

| ブロック名 | 静的 | WP | 備考 |
|-----------|------|-----|------|
| section-heading | `partials/sections/section-heading.html` | 共通パーツ化可 | en + title |
| btn-more | `partials/sections/btn-more.html` | 共通パーツ化可 | ピル型リンク |
| cta-contact | `partials/sections/cta-contact.html` | `cta-contact.php` | 複数ページ include |
| top-hero | `partials/sections/top-hero.html` | `front-page.php` | トップのみ |
| top-about | `partials/sections/top-about.html` | `front-page.php` | 固定 HTML |
| top-services | `partials/sections/top-services.html` | `front-page.php` | card ループ |
| top-works | `partials/sections/top-works.html` | `front-page.php` | works ループ |
| top-company | `partials/sections/top-company.html` | `front-page.php` | 固定 HTML |
| top-news | `partials/sections/top-news.html` | `front-page.php` | news ループ |

## SCSS（BEM — 変更なし）

| コンポーネント | SCSS |
|---------------|------|
| section-heading | `components/section-heading/` |
| btn-more | `components/btn-more/` |
| service-card | `components/service-card/` |
| works-card | `components/works-card/` |
| news-item | `components/news-item/` |
| ヘッダー・フッター・トップ各セクション | `pages/top/_top.scss` |

## 未作成（下層ページ実装時）

- `partials/sections/cta-entry.html` — Recruit 用
- `partials/cards/blog-card.html`
- `partials/sections/filter-tabs.html`
- `partials/sections/accordion.html`
- `partials/sections/share-block.html`
