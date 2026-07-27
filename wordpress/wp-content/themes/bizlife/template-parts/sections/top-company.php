<?php
/**
 * Front page — Company section.
 *
 * @package BizLife
 */
?>
<section class="section company">
  <div class="container company__inner">
    <div class="company__content">
      <?php
      get_template_part(
        'template-parts/sections/section-heading',
        null,
        array(
          'en'    => 'Company',
          'title' => '会社について',
        )
      );
      ?>
      <div class="company__text js-scroll-reveal">
        <?php
        get_template_part(
          'template-parts/sections/section-body',
          null,
          array(
            'blockClass' => 'company__text-paragraph',
            'modifier'   => 'section-body--company',
            'text'       => '企業だけでなくその先にいる従業員にしっかりと目を向け、「人ベース」で企業成長を促進させる事がBiz Lifeの目指す姿です。',
          )
        );
        get_template_part(
          'template-parts/sections/section-body',
          null,
          array(
            'blockClass' => 'company__text-paragraph',
            'modifier'   => 'section-body--company',
            'text'       => 'また、ご支援する企業様の成長は私たちの成長にもつながります。',
          )
        );
        ?>
      </div>
      <?php
      get_template_part(
        'template-parts/sections/btn-more',
        null,
        array(
          'href'     => home_url('/company/'),
          'label'    => '会社概要',
          'modifier' => 'js-scroll-reveal',
        )
      );
      ?>
    </div>
    <div class="company__visual">
      <div class="company__visual-scaler">
        <div class="company__collage">
          <div class="company__collage-row company__collage-row--top">
            <figure class="company__figure company__figure--main js-scroll-reveal js-company-collage-reveal">
              <img src="<?php echo esc_url(get_theme_file_uri('assets/img/top/company-01.png')); ?>" alt="" width="335" height="223" />
            </figure>
            <span class="company__shape company__shape--orange js-scroll-reveal js-company-collage-reveal" aria-hidden="true"></span>
          </div>
          <div class="company__collage-row company__collage-row--bottom">
            <span class="company__shape company__shape--blue js-scroll-reveal js-company-collage-reveal" aria-hidden="true"></span>
            <figure class="company__figure company__figure--sub js-scroll-reveal js-company-collage-reveal">
              <img src="<?php echo esc_url(get_theme_file_uri('assets/img/top/company-02.png')); ?>" alt="" width="200" height="133" />
            </figure>
            <span class="company__shape company__shape--tag js-scroll-reveal js-company-collage-reveal" aria-hidden="true"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
