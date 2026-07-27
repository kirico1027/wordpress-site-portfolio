<?php
/**
 * Front page — Services section.
 *
 * @package BizLife
 */
?>
<section class="section services">
  <div class="container services__inner">
    <div class="services__intro">
      <?php
      get_template_part(
        'template-parts/sections/section-heading',
        null,
        array(
          'en'    => 'Service',
          'title' => '事業内容',
        )
      );
      get_template_part(
        'template-parts/sections/section-body',
        null,
        array(
          'blockClass' => 'services__text js-scroll-reveal',
          'modifier'   => '',
          'text'       => 'Biz Lifeでは現代のテクノロジーとライフスタイルに即した福利厚生プログラムとして、社員の悩みや不安に寄り添い、健康で幸せな職場環境を構築します。',
        )
      );
      get_template_part(
        'template-parts/sections/btn-more',
        null,
        array(
          'href'     => home_url('/service/'),
          'label'    => 'サービスについて',
          'modifier' => 'js-scroll-reveal',
        )
      );
      ?>
    </div>
    <ul class="services__list">
      <?php
      get_template_part(
        'template-parts/cards/service-card',
        null,
        array(
          'num'   => '01',
          'title' => 'みんなの福利厚生クラウド',
          'en'    => 'Employee Welfare Cloud',
          'desc'  => 'デジタルストレスやデジタル関連の不安を軽減し、デジタルデバイスを適切に活用するための支援を提供します。',
          'href'  => home_url('/service/') . '#service-detail-01-heading',
        )
      );
      get_template_part(
        'template-parts/cards/service-card',
        null,
        array(
          'num'   => '02',
          'title' => 'つながるワークフロー',
          'en'    => 'AI Workflow Assistant',
          'desc'  => '社員が効果的にタスクを管理し、仕事を遂行するためトレーニングを通じて支援を提供します。',
          'href'  => home_url('/service/') . '#service-detail-02-heading',
        )
      );
      get_template_part(
        'template-parts/cards/service-card',
        null,
        array(
          'num'   => '03',
          'title' => 'あなたのメンタルコーチ',
          'en'    => 'Personal Mentor Support',
          'desc'  => 'リラクゼーションアプリの提供を通じて、社員個人個人のメンタルヘルスをサポートし、ストレスや不安を軽減します。',
          'href'  => home_url('/service/') . '#service-detail-03-heading',
        )
      );
      ?>
    </ul>
  </div>
</section>
