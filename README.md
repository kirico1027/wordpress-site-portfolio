# Site Starter Base

新規サイト制作のためのベースフォルダです。  
`project3`（FRACTAL 採用サイト）で蓄積した制作ルール・ワークフロー・Sass 基盤を反映しています。

## 含まれているもの

| パス | 内容 |
|------|------|
| `.cursor/rules/` | Cursor 向け制作ルール |
| `coding-md/00-project-kickoff/` | 工程 0: コーディング前キックオフ |
| `coding-md/07-wordpress-design/` | WordPress 設計書テンプレート・案件別設計書 |
| `coding-md/` | Figma MCP コーディングワークフロー |
| `src/sass/` | Sass 設計基盤（reset / variables / mixins / container） |
| `src/templates/` | ページテンプレート（編集の正） |
| `src/partials/` | 共通パーツ（head など） |
| `gulpfile.js`, `package.json` | Gulp ビルド環境 |

## 新規案件の開始手順

### 1. ベースをコピー

```bash
cp -R site-starter-base my-new-project
cd my-new-project
```

### 2. 依存関係をインストール

```bash
npm install
```

### 3. 開発サーバーを起動

```bash
npm run serve
```

ブラウザで `http://localhost:8080/index.html` を開いて確認してください。

### 4. 制作開始

- **工程 0（キックオフ）** から開始: トップページ確認 → 共通化方針提案 →（WP 案件は設計書作成）→ コーディング
- HTML の編集は `src/templates/` と `src/partials/` を正とする
- `npm run build` で `src/*.html` を再生成する
- Figma MCP コーディングは `coding-md/WORKFLOW_MASTER.md` に従う
- MCP ログは `coding-md/mcp-log/{page}/` に保存する

## Cursor ルール一覧

| ルール | 用途 |
|--------|------|
| `markup-bem-css.mdc` | BEM / HTML・CSS 設計 |
| `typography-rem-clamp.mdc` | rem / clamp タイポグラフィ |
| `hero-viewport-height.mdc` | ヒーロー高さ |
| `header-drawer-menu.mdc` | ヘッダー・ドロワーメニュー |
| `js-structure.mdc` | JS 集約・読み込み |
| `safari-layout-inset.mdc` | Safari 横インセット・figma-media |
| `cta-scroll-reveal.mdc` | CTA スクロールアニメーション |
| `subpage-scroll-reveal.mdc` | 下層ページ scroll-reveal |
| `mobile-reload-flicker.mdc` | モバイルリロード時のちらつき |
| `site-reflect-on-request.mdc` | 「反映して」対応手順 |
| `project-kickoff.mdc` | 工程 0: コーディング前キックオフ |
| `wordpress-design.mdc` | BizLife 案件の WP 設計（案件固有） |

## 補足

- `node_modules/` は Git 管理しません
- 生成物のソースマップ（`src/public/assets/css/*.map`）は `.gitignore` で除外しています
- `src/ejs/` は廃止済みです。テンプレートは `gulp-file-include`（`@@include`）を使用します
