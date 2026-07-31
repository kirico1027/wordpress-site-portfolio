<?php
/**
 * Seed Works posts for local / staging verification.
 *
 * Idempotent: only posts with post meta `_bizlife_seed_works` = `1` are deleted
 * and recreated. Manually created Works posts (no seed meta) are never touched,
 * including posts whose slug happens to match a legacy name such as sample-work.
 *
 * Run (Local example):
 *
 *   php bin/seed-works.php
 *
 * Or with WP-CLI when DB is reachable:
 *
 *   wp eval-file wp-content/themes/bizlife/bin/seed-works.php
 *
 * @package BizLife
 */

if (!defined('ABSPATH')) {
  $public = getenv('BIZLIFE_WP_ROOT');
  if (!$public) {
    $public = '/Users/mizutanitakeshi/Local Sites/bizlife/app/public';
  }

  $socket = getenv('BIZLIFE_MYSQL_SOCKET');
  if ($socket) {
    define('DB_HOST', 'localhost:' . $socket);
  } elseif (is_dir('/Users/mizutanitakeshi/Library/Application Support/Local/run/2E4LtQcnj/mysql')) {
    define(
      'DB_HOST',
      'localhost:/Users/mizutanitakeshi/Library/Application Support/Local/run/2E4LtQcnj/mysql/mysqld.sock'
    );
  }

  require $public . '/wp-load.php';
}

if (!function_exists('wp_insert_post')) {
  fwrite(STDERR, "WordPress failed to load.\n");
  exit(1);
}

require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

/**
 * Seed definition (Git-managed source of truth).
 *
 * - categories: works_category slugs (filter + card tags). 2–3 each.
 * - Primary filter coverage is ensured across the three service categories.
 *
 * @return array<int, array<string, mixed>>
 */
function bizlife_seed_works_definitions() {
  return array(
    array(
      'slug'               => 'aurora-corp',
      'title'              => 'コーポレートサイトリニューアル',
      'date'               => '2025-01-15 10:00:00',
      'image'              => 'works_01.png',
      'categories'         => array('connected-workflow', 'mental-coach'),
      'company_name'       => 'Aurora',
      'company_description'=> "BtoB向けクラウド基盤を提供するスタートアップ。",
      'content'            => "<p>コーポレートサイトの情報設計からデザイン、実装までを一貫して担当。サービス価値が伝わるトップページ構成と、導入事例導線を整備しました。</p>\n<p>採用候補者向けの導線も整理し、問い合わせまでの離脱を抑える構成にしています。</p>",
    ),
    array(
      'slug'               => 'northwind-recruit',
      'title'              => 'エンジニア採用サイトの立ち上げ',
      'date'               => '2025-02-03 11:30:00',
      'image'              => 'works_02.png',
      'categories'         => array('mental-coach', 'welfare-cloud'),
      'company_name'       => '株式会社ノースウインドテクノロジーズ',
      'company_description'=> "地方拠点を持つ受託開発企業。リモート前提の組織づくりと、エンジニア向けカルチャー発信に注力しています。社員インタビューや働く環境の可視化を通じて、候補者とのミスマッチ低減を目指しています。",
      'content'            => "<p>採用ブランドのトーン設計、インタビュー記事テンプレート、応募フォームまでの導線を構築。求人票だけでなく「働き方」が一目で分かる構成にしました。</p>",
    ),
    array(
      'slug'               => 'petal-service',
      'title'              => 'SaaSサービスサイト制作',
      'date'               => '2025-02-20 09:15:00',
      'image'              => 'works_03.png',
      'categories'         => array('welfare-cloud', 'connected-workflow'),
      'company_name'       => 'Petal Soft',
      'company_description'=> "中小企業向けの勤怠・福利厚生を一体管理するSaaSを展開。導入企業の成長に合わせて機能を拡張できる柔軟なプロダクト設計が強みです。カスタマーサクセスとプロダクト開発が密に連携し、現場の声を短いサイクルで反映しています。また、オンボーディング教材やヘルプセンターの整備にも力を入れ、利用開始後の定着率向上を重視したサービス運営を行っています。",
      'content'            => "<p>料金表・機能比較・導入フローを再設計し、検討中ユーザーが自走で理解できるサービスサイトへ刷新しました。</p>",
    ),
    array(
      'slug'               => 'harbor-brand',
      'title'              => 'ブランドサイトと採用コンテンツの統合プロジェクト — 多拠点企業の情報設計見直し',
      'date'               => '2025-03-08 14:00:00',
      // Distinct from works_04 (same scene as works-single_01). Source: works-single_03 office photo.
      'image'              => 'works_05.png',
      'categories'         => array('mental-coach', 'connected-workflow', 'welfare-cloud'),
      'company_name'       => 'Harbor & Co. Holdings ホールディングス株式会社',
      'company_description'=> "国内外に拠点を持つホールディングス。グループ各社の採用とコーポレート発信を横断的に支援するプロジェクトを推進しています。",
      'content'            => "<p>グループ共通のデザインシステムを定義しつつ、各社ブランドの差分を許容するテンプレート設計を実施。長文の企業紹介にも耐えるタイポグラフィ設計を検証しています。</p>\n<p>採用・IR・サービス紹介の導線を整理し、回遊しやすい情報設計へ更新しました。</p>",
    ),
    array(
      'slug'               => 'lumen-lp',
      'title'              => 'キャンペーンLP',
      'date'               => '2025-03-22 16:45:00',
      'image'              => 'works_01.png',
      'categories'         => array('connected-workflow', 'welfare-cloud'),
      'company_name'       => 'ルーメン',
      'company_description'=> "店舗DXツールを提供。短期間のキャンペーン訴求に強いマーケティングチームを持つ。",
      'content'            => "<p>季節キャンペーン用の縦長LPを制作。CTAの配置とスマホでの読了導線を重点的に調整しました。</p>",
    ),
    array(
      'slug'               => 'orchid-wellness',
      'title'              => '福利厚生クラウドの導入事例サイト',
      'date'               => '2025-04-05 10:20:00',
      'image'              => 'works_02.png',
      'categories'         => array('welfare-cloud', 'mental-coach'),
      'company_name'       => '株式会社オーキッドウェルネスパートナーズ',
      'company_description'=> "従業員エンゲージメント支援を行うコンサルティング会社です。制度設計からコミュニケーション施策まで伴走します。",
      'content'            => "<p>導入企業インタビューを中心にした事例サイトを構築。カテゴリ横断のタグ表示と、読み物としての詳細ページレイアウトを確認できる構成にしています。</p>",
    ),
    array(
      'slug'               => 'kite-portal',
      'title'              => '社内ポータルUI改善',
      'date'               => '2025-04-18 13:10:00',
      'image'              => 'works_03.png',
      'categories'         => array('connected-workflow', 'welfare-cloud'),
      'company_name'       => 'Kite',
      'company_description'=> "リモートワーク支援ツールを自社開発するプロダクトカンパニー。プロダクトデザインとフロントエンド実装の内製比率が高く、社外パートナーとはデザインシステムの共通言語づくりを重視しています。今回の案件では既存ポータルの情報設計を見直し、よく使う導線の到達時間短縮を目標にしました。",
      'content'            => "<p>ダッシュボードの優先度整理と、モバイル閲覧時の操作性改善を実施。業務フローに沿ったナビ再編が主な成果です。</p>",
    ),
    array(
      'slug'               => 'summit-career',
      'title'              => '新卒向けキャリアサイト全面刷新とコンテンツ運用設計の伴走支援',
      'date'               => '2025-05-01 09:00:00',
      'image'              => 'works_04.png',
      'categories'         => array('mental-coach', 'connected-workflow'),
      'company_name'       => 'サミットキャリアデザイン合同会社（Summit Career Design LLC）',
      'company_description'=> "人材紹介とキャリア教育を組み合わせたサービスを展開。学生向けイベント運営のノウハウを活かし、企業の採用ブランディングを支援しています。長文の会社紹介がカード・詳細の両方で崩れていないかを確認するためのサンプル文として、複数段落相当のボリュームを持たせています。ミッションは「はたらく選択肢を増やすこと」。全国の大学との連携プログラムも拡大中です。",
      'content'            => "<p>新卒採用の世界観を再定義し、ストーリー型のトップと職種別の詳細テンプレートを用意。長いタイトル・会社名・紹介文によるレイアウト耐性の確認用データとしても機能します。</p>\n<p>コンテンツ運用ガイドラインを併せて整備し、更新しやすい見出し階層を設計しました。</p>",
    ),
  );
}

/**
 * Ensure media attachment exists for a theme image basename.
 *
 * @param string $filename Image file under assets/img/works/.
 * @return int Attachment ID or 0.
 */
function bizlife_seed_ensure_attachment($filename) {
  static $cache = array();

  if (isset($cache[$filename])) {
    return $cache[$filename];
  }

  $existing = get_posts(
    array(
      'post_type'      => 'attachment',
      'post_status'    => 'inherit',
      'posts_per_page' => 1,
      'meta_key'       => '_bizlife_seed_image',
      'meta_value'     => $filename,
      'fields'         => 'ids',
    )
  );

  if ($existing) {
    $cache[$filename] = (int) $existing[0];
    return $cache[$filename];
  }

  $source = get_template_directory() . '/assets/img/works/' . $filename;
  if (!file_exists($source)) {
    fwrite(STDERR, "Missing image: {$source}\n");
    $cache[$filename] = 0;
    return 0;
  }

  $upload_dir = wp_upload_dir();
  if (!empty($upload_dir['error'])) {
    fwrite(STDERR, $upload_dir['error'] . "\n");
    $cache[$filename] = 0;
    return 0;
  }

  $dest = trailingslashit($upload_dir['path']) . 'bizlife-seed-' . $filename;
  if (!copy($source, $dest)) {
    fwrite(STDERR, "Failed to copy {$filename}\n");
    $cache[$filename] = 0;
    return 0;
  }

  $filetype = wp_check_filetype($filename, null);
  $attachment_id = wp_insert_attachment(
    array(
      'post_mime_type' => $filetype['type'],
      'post_title'     => 'BizLife Seed ' . pathinfo($filename, PATHINFO_FILENAME),
      'post_content'   => '',
      'post_status'    => 'inherit',
    ),
    $dest
  );

  if (is_wp_error($attachment_id) || !$attachment_id) {
    $cache[$filename] = 0;
    return 0;
  }

  $meta = wp_generate_attachment_metadata($attachment_id, $dest);
  wp_update_attachment_metadata($attachment_id, $meta);
  update_post_meta($attachment_id, '_bizlife_seed_image', $filename);

  $cache[$filename] = (int) $attachment_id;
  return $cache[$filename];
}

/**
 * Remove previously seeded works posts only.
 *
 * Safety: deletion is gated solely by meta `_bizlife_seed_works` = `1`.
 * Title / slug matching must never be used here.
 */
function bizlife_seed_purge_seed_works() {
  $ids = get_posts(
    array(
      'post_type'      => 'works',
      'post_status'    => 'any',
      'posts_per_page' => -1,
      'fields'         => 'ids',
      'meta_key'       => '_bizlife_seed_works',
      'meta_value'     => '1',
    )
  );

  foreach ($ids as $id) {
    wp_delete_post((int) $id, true);
  }

  return count($ids);
}

/**
 * Upsert one seeded works post.
 *
 * @param array<string, mixed> $item Seed row.
 * @return int|WP_Error
 */
function bizlife_seed_upsert_work(array $item) {
  $post_id = wp_insert_post(
    array(
      'post_type'    => 'works',
      'post_status'  => 'publish',
      'post_title'   => $item['title'],
      'post_name'    => $item['slug'],
      'post_content' => $item['content'],
      'post_date'    => $item['date'],
      'post_date_gmt'=> get_gmt_from_date($item['date']),
    ),
    true
  );

  if (is_wp_error($post_id)) {
    return $post_id;
  }

  update_post_meta($post_id, '_bizlife_seed_works', '1');

  if (function_exists('update_field')) {
    update_field('company_name', $item['company_name'], $post_id);
    update_field('company_description', $item['company_description'], $post_id);
  } else {
    update_post_meta($post_id, 'company_name', $item['company_name']);
    update_post_meta($post_id, 'company_description', $item['company_description']);
  }

  $term_ids = array();
  foreach ($item['categories'] as $slug) {
    $term = get_term_by('slug', $slug, 'works_category');
    if ($term && !is_wp_error($term)) {
      $term_ids[] = (int) $term->term_id;
    }
  }
  if ($term_ids) {
    wp_set_object_terms($post_id, $term_ids, 'works_category', false);
  }

  $attachment_id = bizlife_seed_ensure_attachment($item['image']);
  if ($attachment_id) {
    set_post_thumbnail($post_id, $attachment_id);
  }

  return $post_id;
}

$deleted = bizlife_seed_purge_seed_works();
$created = array();

foreach (bizlife_seed_works_definitions() as $item) {
  $result = bizlife_seed_upsert_work($item);
  if (is_wp_error($result)) {
    fwrite(STDERR, $item['slug'] . ': ' . $result->get_error_message() . "\n");
    continue;
  }
  $created[] = array(
    'id'    => $result,
    'slug'  => $item['slug'],
    'title' => $item['title'],
  );
  echo "Created #{$result} {$item['slug']} — {$item['title']}\n";
}

echo "\nPurged previous seed posts: {$deleted}\n";
echo 'Created seed posts: ' . count($created) . "\n";
echo "Done.\n";
