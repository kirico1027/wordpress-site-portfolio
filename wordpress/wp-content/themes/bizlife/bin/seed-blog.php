<?php
/**
 * Seed Blog posts (post type: post) for local / staging verification.
 *
 * Idempotent: only posts with post meta `_bizlife_seed_blog` = `1` are deleted
 * and recreated. Manually created posts (no seed meta) are never touched,
 * including posts whose slug or title happens to match a seed definition.
 *
 * Run (Local example):
 *
 *   php bin/seed-blog.php
 *
 * Or with WP-CLI when DB is reachable:
 *
 *   wp eval-file wp-content/themes/bizlife/bin/seed-blog.php
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
 * Official Blog categories (WORDPRESS_DESIGN.md).
 *
 * @return array<string, string> slug => name
 */
function bizlife_seed_blog_category_map() {
  return array(
    'useful-info' => 'お役立ち情報',
    'case-study'  => '導入事例',
    'work-style'  => '働き方',
  );
}

/**
 * Ensure Blog categories exist (create only when missing).
 *
 * Matches by name first so existing Japanese terms are reused.
 *
 * @return array<string, int> slug => term_id
 */
function bizlife_seed_blog_ensure_categories() {
  $map = bizlife_seed_blog_category_map();
  $ids = array();

  foreach ($map as $slug => $name) {
    $term = get_term_by('name', $name, 'category');
    if (!$term) {
      $term = get_term_by('slug', $slug, 'category');
    }

    if ($term && !is_wp_error($term)) {
      $ids[$slug] = (int) $term->term_id;
      continue;
    }

    $result = wp_insert_term(
      $name,
      'category',
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
 * - category: category slug from bizlife_seed_blog_category_map()
 * - image: relative path under assets/img/ (e.g. blog/foo.png, works/works_01.png)
 *
 * @return array<int, array<string, mixed>>
 */
function bizlife_seed_blog_definitions() {
  $body_tips = <<<'HTML'
<p>福利厚生は、単なる手当の積み上げではなく、働き方そのものを支える仕組みです。制度を整えつつ、現場の声を短いサイクルで反映することが定着の鍵になります。</p>
<p>まずは従業員が「何に困っているか」を可視化し、優先度の高い課題から着手しましょう。メンタルヘルス、育児・介護、スキルアップなど、テーマは企業ごとに異なります。</p>
<p>制度公開後は、利用率と満足度を定期的に確認し、使われない施策を見直す運用が重要です。今回の記事では、導入初期に押さえたいポイントを整理します。</p>
HTML;

  $body_case = <<<'HTML'
<p>導入前は、情報共有の遅れと属人化した運用が課題でした。ツールを入れ替えただけでなく、業務フローとコミュニケーションの型を合わせて再設計しました。</p>
<p>キックオフでは現場リーダーを巻き込み、成功指標を「利用率」ではなく「業務時間の短縮」と「問い合わせ件数の減少」に設定。3か月後に数値で効果を確認できる状態を作りました。</p>
<p>本記事では、要件定義から定着支援までの流れと、つまずきやすいポイントを事例ベースで紹介します。</p>
HTML;

  $body_work = <<<'HTML'
<p>働き方の選択肢が増えるほど、評価・コミュニケーション・オンボーディングの設計が重要になります。制度だけが先行すると、現場とのギャップが生まれやすいためです。</p>
<p>リモートと出社のハイブリッド運用では、非同期での意思決定ルールと、チームの「つながる時間」の両立が求められます。小さく試して改善する文化が土台になります。</p>
<p>ここでは、制度設計と日常オペレーションの両面から、無理なく続けられる働き方づくりのヒントをまとめます。</p>
HTML;

  return array(
    // Newest → older within each batch; dates staggered for archive order checks.
    // Dates are on/before 2026-07-29 so posts stay published (not future).
    array(
      'slug'     => 'seed-blog-workstyle-hybrid-guide',
      'title'    => 'ハイブリッド勤務を続けるためのチーム設計ガイド',
      'date'     => '2026-07-29 10:00:00',
      'image'    => 'blog/blog-featured_01.png',
      'category' => 'work-style',
      'excerpt'  => '出社とリモートを両立するチームが、評価とコミュニケーションをどう設計しているかを整理します。',
      'content'  => $body_work,
    ),
    array(
      'slug'     => 'seed-blog-tips-welfare-balance',
      'title'    => 'ビジネスの成功と従業員の幸福を両立させる福利厚生の秘訣',
      'date'     => '2026-07-28 11:30:00',
      'image'    => 'blog/blog-featured_02.png',
      'category' => 'useful-info',
      'excerpt'  => '福利厚生を戦略として捉え直し、定着と利用率を高めるための実践ポイントを紹介します。',
      'content'  => $body_tips,
    ),
    array(
      'slug'     => 'seed-blog-case-onboarding',
      'title'    => '導入3か月で問い合わせが半減したオンボーディング改善事例',
      'date'     => '2026-07-27 09:15:00',
      'image'    => 'blog/blog-single_body_01.png',
      'category' => 'case-study',
      'excerpt'  => '現場リーダーを巻き込んだ導入設計で、定着率と業務効率を同時に改善した事例です。',
      'content'  => $body_case,
    ),
    array(
      'slug'     => 'seed-blog-workstyle-async',
      'title'    => '非同期コミュニケーションが機能する組織の共通点',
      'date'     => '2026-07-25 14:00:00',
      'image'    => 'blog/blog-single_body_02.png',
      'category' => 'work-style',
      'excerpt'  => 'チャットとドキュメントを使い分けるルールづくりと、意思決定の見える化について解説します。',
      'content'  => $body_work,
    ),
    array(
      'slug'     => 'seed-blog-tips-mental-health',
      'title'    => 'メンタルヘルス施策を形骸化させない運用チェックリスト',
      'date'     => '2026-07-23 16:45:00',
      'image'    => 'blog/blog-single_pickup_01.png',
      'category' => 'useful-info',
      'excerpt'  => '制度公開後に見直すべき指標と、現場への浸透を促すコミュニケーションのコツをまとめました。',
      'content'  => $body_tips,
    ),
    array(
      'slug'     => 'seed-blog-case-engagement',
      'title'    => '従業員エンゲージメント向上につながった福利厚生戦略',
      'date'     => '2026-07-21 10:20:00',
      'image'    => 'blog/blog-single_pickup_02.png',
      'category' => 'case-study',
      'excerpt'  => '利用率の低い施策を見直し、従業員の声を反映した再設計で成果が出た事例を紹介します。',
      'content'  => $body_case,
    ),
    array(
      'slug'     => 'seed-blog-tips-career-growth',
      'title'    => '学びを止めない職場をつくるスキルアップ支援の考え方',
      'date'     => '2026-07-18 13:10:00',
      'image'    => 'blog/blog-single_pickup_03.png',
      'category' => 'useful-info',
      'excerpt'  => '研修制度だけでなく、日常業務の中で成長機会を作るための設計ポイントを解説します。',
      'content'  => $body_tips,
    ),
    array(
      'slug'     => 'seed-blog-workstyle-onboarding-remote',
      'title'    => 'リモート前提のオンボーディングで最初の90日を整える',
      'date'     => '2026-07-15 09:00:00',
      'image'    => 'blog/blog-single_hero.png',
      'category' => 'work-style',
      'excerpt'  => '入社直後の孤立を防ぎ、早期戦力化につなげるリモートオンボーディングの型を紹介します。',
      'content'  => $body_work,
    ),
    array(
      'slug'     => 'seed-blog-case-workflow',
      'title'    => 'ワークフロー刷新で承認待ち時間を短縮した導入事例',
      'date'     => '2026-07-12 11:00:00',
      'image'    => 'works/works_01.png',
      'category' => 'case-study',
      'excerpt'  => '承認ルートの可視化と自動化により、部門横断のボトルネックを解消した事例です。',
      'content'  => $body_case,
    ),
    array(
      'slug'     => 'seed-blog-tips-family-care',
      'title'    => '育児・介護と仕事を両立するための制度設計の基本',
      'date'     => '2026-07-09 15:30:00',
      'image'    => 'works/works_02.png',
      'category' => 'useful-info',
      'excerpt'  => '法定対応にとどまらず、現場が使いやすい両立支援を設計するための観点を整理します。',
      'content'  => $body_tips,
    ),
    array(
      'slug'     => 'seed-blog-workstyle-meeting',
      'title'    => '会議を減らし、成果を増やすミーティング再設計',
      'date'     => '2026-07-06 10:45:00',
      'image'    => 'works/works_03.png',
      'category' => 'work-style',
      'excerpt'  => '目的別の会議ルールとアジェンダ設計で、チームの集中時間を取り戻す方法を紹介します。',
      'content'  => $body_work,
    ),
    array(
      'slug'     => 'seed-blog-case-retention',
      'title'    => '離職率改善につながった働き方改革の実践レポート',
      'date'     => '2026-07-02 09:30:00',
      'image'    => 'works/works_04.png',
      'category' => 'case-study',
      'excerpt'  => '制度変更と現場コミュニケーションを両輪で進めた結果、定着率が改善した事例です。',
      'content'  => $body_case,
    ),
  );
}

/**
 * Ensure media attachment exists for a theme image path under assets/img/.
 *
 * Meta `_bizlife_seed_image` stores the relative path (e.g. blog/foo.png)
 * so the same file is never re-uploaded on re-runs.
 *
 * @param string $relative_path Path relative to assets/img/.
 * @return int Attachment ID or 0.
 */
function bizlife_seed_blog_ensure_attachment($relative_path) {
  static $cache = array();

  $relative_path = ltrim(str_replace('\\', '/', $relative_path), '/');

  if (isset($cache[$relative_path])) {
    return $cache[$relative_path];
  }

  $existing = get_posts(
    array(
      'post_type'      => 'attachment',
      'post_status'    => 'inherit',
      'posts_per_page' => 1,
      'meta_key'       => '_bizlife_seed_image',
      'meta_value'     => $relative_path,
      'fields'         => 'ids',
    )
  );

  // Backward compatible with works seed that stored basename only.
  if (!$existing && false !== strpos($relative_path, '/')) {
    $basename = basename($relative_path);
    $existing = get_posts(
      array(
        'post_type'      => 'attachment',
        'post_status'    => 'inherit',
        'posts_per_page' => 1,
        'meta_key'       => '_bizlife_seed_image',
        'meta_value'     => $basename,
        'fields'         => 'ids',
      )
    );
  }

  if ($existing) {
    $cache[$relative_path] = (int) $existing[0];
    return $cache[$relative_path];
  }

  $source = get_template_directory() . '/assets/img/' . $relative_path;
  if (!file_exists($source)) {
    fwrite(STDERR, "Missing image: {$source}\n");
    $cache[$relative_path] = 0;
    return 0;
  }

  $upload_dir = wp_upload_dir();
  if (!empty($upload_dir['error'])) {
    fwrite(STDERR, $upload_dir['error'] . "\n");
    $cache[$relative_path] = 0;
    return 0;
  }

  $filename = basename($relative_path);
  $dest = trailingslashit($upload_dir['path']) . 'bizlife-seed-' . $filename;
  if (!copy($source, $dest)) {
    fwrite(STDERR, "Failed to copy {$relative_path}\n");
    $cache[$relative_path] = 0;
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
    $cache[$relative_path] = 0;
    return 0;
  }

  $meta = wp_generate_attachment_metadata($attachment_id, $dest);
  wp_update_attachment_metadata($attachment_id, $meta);
  update_post_meta($attachment_id, '_bizlife_seed_image', $relative_path);

  $cache[$relative_path] = (int) $attachment_id;
  return $cache[$relative_path];
}

/**
 * Remove previously seeded blog posts only.
 *
 * Safety: deletion is gated solely by meta `_bizlife_seed_blog` = `1`.
 * Title / slug matching must never be used here.
 *
 * @return int Deleted count.
 */
function bizlife_seed_purge_seed_blog() {
  $ids = get_posts(
    array(
      'post_type'      => 'post',
      'post_status'    => 'any',
      'posts_per_page' => -1,
      'fields'         => 'ids',
      'meta_key'       => '_bizlife_seed_blog',
      'meta_value'     => '1',
    )
  );

  foreach ($ids as $id) {
    wp_delete_post((int) $id, true);
  }

  return count($ids);
}

/**
 * Upsert one seeded blog post.
 *
 * @param array<string, mixed> $item     Seed row.
 * @param array<string, int>   $term_ids Category slug => term_id.
 * @return int|WP_Error
 */
function bizlife_seed_upsert_blog_post(array $item, array $term_ids) {
  $post_id = wp_insert_post(
    array(
      'post_type'     => 'post',
      'post_status'   => 'publish',
      'post_title'    => $item['title'],
      'post_name'     => $item['slug'],
      'post_content'  => $item['content'],
      'post_excerpt'  => $item['excerpt'],
      'post_date'     => $item['date'],
      'post_date_gmt' => get_gmt_from_date($item['date']),
    ),
    true
  );

  if (is_wp_error($post_id)) {
    return $post_id;
  }

  update_post_meta($post_id, '_bizlife_seed_blog', '1');

  $category_slug = $item['category'];
  if (!empty($term_ids[$category_slug])) {
    wp_set_post_categories($post_id, array($term_ids[$category_slug]), false);
  }

  $attachment_id = bizlife_seed_blog_ensure_attachment($item['image']);
  if ($attachment_id) {
    set_post_thumbnail($post_id, $attachment_id);
  }

  return $post_id;
}

$term_ids = bizlife_seed_blog_ensure_categories();
$deleted = bizlife_seed_purge_seed_blog();
$created = array();

foreach (bizlife_seed_blog_definitions() as $item) {
  $result = bizlife_seed_upsert_blog_post($item, $term_ids);
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
