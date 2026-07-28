<?php
/**
 * Page template: Download (slug: download).
 *
 * Phase 2: static HTML form markup. CF7 integration later (Phase 3).
 *
 * @package BizLife
 */

get_header();

$document_cover_src = get_theme_file_uri('assets/img/download/document-cover.png');
?>
<main class="download-page">
  <?php
  get_template_part(
    'template-parts/page-hero',
    null,
    array(
      'heroModifier'  => 'page-hero--light',
      'heroHeadingId' => 'download-hero-heading',
      'heroTitleEn'   => 'Download',
      'heroTitleJa'   => '資料ダウンロード',
      'heroImgSrc'    => '',
    )
  );
  ?>

  <section class="download-content" aria-labelledby="download-intro-heading">
    <div class="container download-content__inner">
      <div class="download-intro">
        <figure class="download-intro__figure">
          <img
            class="download-intro__img"
            src="<?php echo esc_url($document_cover_src); ?>"
            alt="3分でわかる BizLife 資料カバー"
            width="400"
            height="210"
          />
        </figure>
        <div class="download-intro__body">
          <h2 id="download-intro-heading" class="download-intro__title">この資料でわかること</h2>
          <ul class="download-intro__list">
            <li class="download-intro__item">
              <span class="material-icons download-intro__check" aria-hidden="true">check</span>
              <span class="download-intro__text">BizLifeの３つのサービスが分かる</span>
            </li>
            <li class="download-intro__item">
              <span class="material-icons download-intro__check" aria-hidden="true">check</span>
              <span class="download-intro__text">サービス導入後の効果事例が分かる</span>
            </li>
            <li class="download-intro__item">
              <span class="material-icons download-intro__check" aria-hidden="true">check</span>
              <span class="download-intro__text">具体的な導入フローが分かる</span>
            </li>
            <li class="download-intro__item">
              <span class="material-icons download-intro__check" aria-hidden="true">check</span>
              <span class="download-intro__text">これから求められる福利厚生が分かる</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="download-form">
        <h2 id="download-form-heading" class="u-visually-hidden">資料ダウンロードフォーム</h2>
        <form class="download-form__form" action="#" method="post" novalidate aria-labelledby="download-form-heading">
          <div class="download-form__field">
            <label class="download-form__label" for="download-name">
              お名前<span class="download-form__required" aria-hidden="true">*</span>
              <span class="u-visually-hidden">（必須）</span>
            </label>
            <input
              class="download-form__input"
              id="download-name"
              name="name"
              type="text"
              placeholder="お名前"
              autocomplete="name"
              required
            />
          </div>

          <div class="download-form__field">
            <label class="download-form__label" for="download-furigana">
              フリガナ<span class="download-form__required" aria-hidden="true">*</span>
              <span class="u-visually-hidden">（必須）</span>
            </label>
            <input
              class="download-form__input"
              id="download-furigana"
              name="furigana"
              type="text"
              placeholder="フリガナ"
              autocomplete="off"
              required
            />
          </div>

          <div class="download-form__field">
            <label class="download-form__label" for="download-email">
              メールアドレス<span class="download-form__required" aria-hidden="true">*</span>
              <span class="u-visually-hidden">（必須）</span>
            </label>
            <input
              class="download-form__input"
              id="download-email"
              name="email"
              type="email"
              placeholder="メールアドレス"
              autocomplete="email"
              required
            />
          </div>

          <div class="download-form__field">
            <label class="download-form__label" for="download-email-confirm">
              メールアドレス（確認用）<span class="download-form__required" aria-hidden="true">*</span>
              <span class="u-visually-hidden">（必須）</span>
            </label>
            <input
              class="download-form__input"
              id="download-email-confirm"
              name="email_confirm"
              type="email"
              placeholder="メールアドレス（確認用）"
              autocomplete="email"
              required
            />
          </div>

          <div class="download-form__field">
            <label class="download-form__label" for="download-tel">電話番号</label>
            <input
              class="download-form__input"
              id="download-tel"
              name="tel"
              type="tel"
              placeholder="電話番号"
              autocomplete="tel"
            />
          </div>

          <div class="download-form__field">
            <label class="download-form__label" for="download-company">
              会社名<span class="download-form__required" aria-hidden="true">*</span>
              <span class="u-visually-hidden">（必須）</span>
            </label>
            <input
              class="download-form__input"
              id="download-company"
              name="company"
              type="text"
              placeholder="会社名"
              autocomplete="organization"
              required
            />
          </div>

          <div class="download-form__field download-form__field--agree">
            <label class="download-form__agree">
              <input class="download-form__checkbox" type="checkbox" name="privacy" value="1" required />
              <span class="download-form__agree-text">プライバシーポリシーに同意する</span>
            </label>
          </div>

          <div class="download-form__actions">
            <button class="download-form__submit" type="submit">送信する</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
