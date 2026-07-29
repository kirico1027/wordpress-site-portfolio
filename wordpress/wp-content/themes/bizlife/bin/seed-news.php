<?php
/**
 * Seed News posts (CPT: news) for local / staging verification.
 *
 * Idempotent: only posts with post meta `_bizlife_seed_news` = `1` are deleted
 * and recreated. Manually created News posts (no seed meta) are never touched,
 * including posts whose slug or title happens to match a seed definition.
 *
 * Run (Local example):
 *
 *   php bin/seed-news.php
 *
 * Or with WP-CLI when DB is reachable:
 *
 *   wp eval-file wp-content/themes/bizlife/bin/seed-news.php
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

/**
 * Official News categories (WORDPRESS_DESIGN.md / static archive filters).
 *
 * @return array<string, string> slug => name
 */
function bizlife_seed_news_category_map() {
  return array(
    'information' => 'お知らせ',
    'event'       => 'イベント',
    'media'       => 'メディア掲載',
    'recruit'     => '採用',
    'service'     => 'サービス情報',
    'other'       => 'その他',
  );
}

/**
 * Ensure News categories exist (create only when missing).
 *
 * Matches by name first so existing Japanese terms are reused.
 *
 * @return array<string, int> slug => term_id
 */
function bizlife_seed_news_ensure_categories() {
  $map = bizlife_seed_news_category_map();
  $ids = array();

  foreach ($map as $slug => $name) {
    $term = get_term_by('name', $name, 'news_category');
    if (!$term) {
      $term = get_term_by('slug', $slug, 'news_category');
    }

    if ($term && !is_wp_error($term)) {
      $ids[$slug] = (int) $term->term_id;
      continue;
    }

    $result = wp_insert_term(
      $name,
      'news_category',
      array(
        'slug' => $slug,
      )
    );

    if (is_wp_error($result)) {
      fwrite(STDERR, "Category {$name}: " . $result->get_error_message() . "\n");
      continue;
    }

    $ids[$slug] = (int) $result['term_id'];
    echo "Created category: {$name} ({$slug})\n";
  }

  return $ids;
}

/**
 * Seed definition (Git-managed source of truth).
 *
 * - category: news_category slug from bizlife_seed_news_category_map()
 *
 * @return array<int, array<string, mixed>>
 */
function bizlife_seed_news_definitions() {
  $body_summer = <<<'HTML'
<p>平素は格別のお引き立てをいただき厚くお礼申し上げます。<br />
弊社では、誠に勝手ながら下記日程を夏季休業とさせていただきます。</p>
<p>■夏季休業期間<br />
2026年08月13日(木) ～ 08月16日(日)</p>
<p>休業期間中にいただいたお問合せについては、営業開始日以降に順次回答させていただきます。<br />
皆様には大変ご不便をおかけいたしますが、何卒ご理解の程お願い申し上げます。</p>
HTML;

  $body_service = <<<'HTML'
<p>このたび BizLife では、従業員のウェルビーイングを支える新サービスを正式に提供開始いたしました。</p>
<p>現場の声をもとに、制度設計から日々の活用までをシームレスにつなぐことを目指しています。導入をご検討の企業様向けに、資料請求とオンライン相談も受付中です。</p>
<p>詳細はサービスサイトおよび資料ダウンロードページをご確認ください。今後とも、従業員ファーストのサービス改善を続けてまいります。</p>
HTML;

  $body_short = <<<'HTML'
<p>平素より BizLife をご利用いただき、誠にありがとうございます。下記のとおりお知らせいたします。</p>
<p>詳細やお申し込み方法については、本ページおよび関連フォームをご確認ください。ご不明点がございましたら、お問い合わせフォームよりご連絡ください。</p>
HTML;

  // Dates are on/before 2026-07-30 so posts stay published (not future).
  return array(
    array(
      'slug'     => 'seed-news-internship-2027',
      'title'    => '2027年卒 インターンシップ募集開始のお知らせ',
      'date'     => '2026-07-29 10:00:00',
      'category' => 'recruit',
      'content'  => $body_short . "\n<p>対象学年や開催日程、応募締切などの詳細は採用サイトにて随時更新いたします。皆様のご応募をお待ちしております。</p>",
    ),
    array(
      'slug'     => 'seed-news-summer-holiday-2026',
      'title'    => '夏季休業のお知らせ',
      'date'     => '2026-07-28 09:30:00',
      'category' => 'information',
      'content'  => $body_summer,
    ),
    array(
      'slug'     => 'seed-news-event-exhibit-2024-summer',
      'title'    => 'イベント出展のお知らせ【2024夏】',
      'date'     => '2026-07-25 15:00:00',
      'category' => 'media',
      'content'  => $body_short . "\n<p>展示ブースでは、福利厚生クラウドのデモンストレーションと導入事例の紹介を予定しています。来場を検討されている企業様は、事前予約フォームよりお申し込みください。</p>",
    ),
    array(
      'slug'     => 'seed-news-clients-1000',
      'title'    => '【ご報告】導入社数1000社を突破しました！',
      'date'     => '2026-07-22 11:00:00',
      'category' => 'information',
      'content'  => $body_short . "\n<p>これもひとえに、日頃よりご支援くださるお客様・パートナーの皆様のおかげです。引き続きサービス品質の向上に努めてまいります。</p>",
    ),
    array(
      'slug'     => 'seed-news-new-service-launch',
      'title'    => '革新的な福利厚生サービスが登場！次世代の完全従業員ファーストの新サービス',
      'date'     => '2026-07-20 09:00:00',
      'category' => 'service',
      'content'  => $body_service,
    ),
    array(
      'slug'     => 'seed-news-welfare-seminar',
      'title'    => '福利厚生セミナー「従業員エンゲージメントを高める制度設計」開催のお知らせ',
      'date'     => '2026-07-15 14:00:00',
      'category' => 'event',
      'content'  => $body_short . "\n<p>オンライン開催予定です。人事・労務ご担当者様を対象に、制度設計の事例と運用のポイントを解説します。</p>",
    ),
    array(
      'slug'     => 'seed-news-service-update-q3',
      'title'    => 'サービスアップデート：ダッシュボードと申請フローを改善しました',
      'date'     => '2026-07-10 10:30:00',
      'category' => 'service',
      'content'  => $body_short . "\n<p>管理画面の視認性向上と、申請・承認のステップ削減を中心とした改善です。リリースノートは管理画面内のお知らせからもご確認いただけます。</p>",
    ),
    array(
      'slug'     => 'seed-news-office-relocation',
      'title'    => '本社オフィス移転のお知らせ',
      'date'     => '2026-06-15 16:00:00',
      'category' => 'other',
      'content'  => $body_short . "\n<p>移転に伴う電話番号・郵送先の変更はございません。訪問をご予定のお客様は、新住所をご確認のうえお越しください。</p>",
    ),
  );
}

/**
 * Remove previously seeded news posts only.
 *
 * Safety: deletion is gated solely by meta `_bizlife_seed_news` = `1`.
 * Title / slug matching must never be used here.
 *
 * @return int Deleted count.
 */
function bizlife_seed_purge_seed_news() {
  $ids = get_posts(
    array(
      'post_type'      => 'news',
      'post_status'    => 'any',
      'posts_per_page' => -1,
      'fields'         => 'ids',
      'meta_key'       => '_bizlife_seed_news',
      'meta_value'     => '1',
    )
  );

  foreach ($ids as $id) {
    wp_delete_post((int) $id, true);
  }

  return count($ids);
}

/**
 * Upsert one seeded news post.
 *
 * @param array<string, mixed> $item     Seed row.
 * @param array<string, int>   $term_ids Category slug => term_id.
 * @return int|WP_Error
 */
function bizlife_seed_upsert_news_post(array $item, array $term_ids) {
  $post_id = wp_insert_post(
    array(
      'post_type'     => 'news',
      'post_status'   => 'publish',
      'post_title'    => $item['title'],
      'post_name'     => $item['slug'],
      'post_content'  => $item['content'],
      'post_date'     => $item['date'],
      'post_date_gmt' => get_gmt_from_date($item['date']),
    ),
    true
  );

  if (is_wp_error($post_id)) {
    return $post_id;
  }

  update_post_meta($post_id, '_bizlife_seed_news', '1');

  $category_slug = $item['category'];
  if (!empty($term_ids[$category_slug])) {
    wp_set_object_terms($post_id, array((int) $term_ids[$category_slug]), 'news_category', false);
  }

  return $post_id;
}

if (!post_type_exists('news') || !taxonomy_exists('news_category')) {
  fwrite(STDERR, "News CPT or news_category taxonomy is not registered. Activate the BizLife theme first.\n");
  exit(1);
}

$term_ids = bizlife_seed_news_ensure_categories();
$deleted  = bizlife_seed_purge_seed_news();
$created  = array();

foreach (bizlife_seed_news_definitions() as $item) {
  $result = bizlife_seed_upsert_news_post($item, $term_ids);
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

// One-time rewrite flush for this CLI seed run only (not on front-end requests).
flush_rewrite_rules(false);

echo "\nPurged previous seed posts: {$deleted}\n";
echo 'Created seed posts: ' . count($created) . "\n";
echo 'Categories ready: ' . count($term_ids) . "\n";
echo "Rewrite rules flushed (CLI seed only).\n";
echo "Done.\n";
