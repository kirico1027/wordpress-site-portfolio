<?php
/**
 * Front page — Works section.
 *
 * Latest published Works posts for the slider (static: top-works.html).
 *
 * @package BizLife
 */

$works_archive_href = bizlife_get_works_archive_url();
$works_query        = bizlife_get_works_query(BIZLIFE_WORKS_FRONT_COUNT);
?>
<section class="section works">
  <div class="container works__header">
    <div class="works__intro">
      <?php
      get_template_part(
        'template-parts/sections/section-heading',
        null,
        array(
          'en'    => 'Works',
          'title' => '実績紹介',
        )
      );
      get_template_part(
        'template-parts/sections/section-body',
        null,
        array(
          'blockClass' => 'works__text js-scroll-reveal',
          'modifier'   => '',
          'text'       => '業種や形態問わず、さまざまなクライアント様にご活用いただいております。<br />新しい福利厚生の形として事業規模や用途に合わせご支援が可能です。',
        )
      );
      ?>
    </div>
    <?php
    get_template_part(
      'template-parts/sections/btn-more',
      null,
      array(
        'href'     => $works_archive_href,
        'label'    => '一覧をみる',
        'modifier' => 'btn-more--header js-scroll-reveal',
      )
    );
    ?>
  </div>
  <?php if ($works_query->have_posts()) : ?>
    <div class="works__slider-wrap js-scroll-reveal">
      <div class="works__slider" tabindex="0">
        <?php while ($works_query->have_posts()) : ?>
          <?php
          $works_query->the_post();
          get_template_part(
            'template-parts/cards/works-card',
            null,
            bizlife_get_works_card_args(get_post())
          );
          ?>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      </div>
    </div>
  <?php else : ?>
    <?php wp_reset_postdata(); ?>
    <div class="container">
      <p class="works__empty"><?php esc_html_e('現在、実績はありません。', 'bizlife'); ?></p>
    </div>
  <?php endif; ?>
</section>
