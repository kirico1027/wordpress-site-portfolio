# 共通化方針（BizLife — WordPress 化前提）

> 設計の正: `coding-md/07-wordpress-design/WORDPRESS_DESIGN.md`

## 実装フェーズ

| フェーズ | 内容 | 本プロジェクトでの状態 |
|---------|------|---------------------|
| Phase 1 | 静的コーディング（partials 共通化） | **進行中** — トップページ |
| Phase 2 | WP テーマ化（get_template_part） | 未着手 |
| Phase 3 | CPT（works / news / job） | 未着手 |
| Phase 4 | ACF 段階導入 | 未着手 |

## レイアウト基準

- コンテナ最大幅: 1184px（内側パディング 32px）
- 左右余白: `.l-inset-comp-1920` / `.container`
- セクション間余白: `padding-top` rem(120) 相当（fluid-spacing）

## 静的 → WordPress 移行マップ（partials）

| 静的（Phase 1） | WordPress（Phase 2+） | 動的データ（Phase 3+） |
|----------------|------------------------|----------------------|
| `partials/head.html` | `header.php` 内 wp_head 前 | — |
| `partials/header.html` | `template-parts/header.php` | wp_nav_menu |
| `partials/footer.html` | `template-parts/footer.php` | Options Page |
| `partials/breadcrumb.html` | `template-parts/breadcrumb.php` | — |
| `partials/page-hero.html` | `template-parts/page-hero.php` | 固定ページタイトル |
| `partials/sections/cta-contact.html` | `template-parts/cta-contact.php` | 固定リンク |
| `partials/cards/service-card.html` | `template-parts/cards/service-card.php` | Phase 4 Repeater |
| `partials/cards/works-card.html` | `template-parts/cards/works-card.php` | CPT works ループ |
| `partials/cards/news-item.html` | `template-parts/cards/news-item.php` | CPT news ループ |
| `partials/sections/top-*.html` | `front-page.php` 内 get_template_part | 下記参照 |

### front-page.php 各セクション

| セクション partial | 静的 | WP 化後 |
|-------------------|------|---------|
| `top-hero.html` | HTML 直書き | Phase 4 ACF（ヒーロー文言） |
| `hero-news`（top-hero 内） | 固定1件 | news CPT 最新1件（重要フラグ） |
| `top-about.html` | HTML 直書き | Phase 4 ACF |
| `top-services.html` | service-card ×3 | Phase 4 Repeater |
| `top-works.html` | works-card ×5 | WP_Query works |
| `top-company.html` | HTML 直書き | Options Page 連動可 |
| `top-news.html` | news-item ×5 | WP_Query news |
| `cta-contact.html` | include | get_template_part（全ページ共通） |

## URL 対応（静的 HTML 名 → WP パーマリンク）

| 静的テンプレート（予定） | URL 案 |
|------------------------|--------|
| `index.html` | `/` |
| `about.html` | `/about/` |
| `service.html` | `/service/` |
| `works-archive.html` | `/works/` |
| `works-single.html` | `/works/{slug}/` |
| `recruit.html` | `/recruit/` |
| `entry.html` | `/recruit/entry/` |
| `company.html` | `/company/` |
| `news-archive.html` | `/news/` |
| `news-single.html` | `/news/{slug}/` |
| `blog-archive.html` | `/blog/` |
| `blog-single.html` | `/blog/{slug}/` |
| `contact.html` | `/contact/` |
| `download.html` | `/download/` |
| `privacy-policy.html` | `/privacy-policy/` |
| `terms.html` | `/terms/` |

## 共通化しない（ページ固有）

- トップ Hero コラージュレイアウト
- About / Company 画像コラージュ（固定ページ本文として Phase 1 は直書き）

## ACF 化しない（Phase 1〜2）

- About / Service / Recruit / Company のセクション本文 → HTML 直書きで完成優先
- サービス個別 CPT は作らない（Service 1 ページ + 外部リンク）
