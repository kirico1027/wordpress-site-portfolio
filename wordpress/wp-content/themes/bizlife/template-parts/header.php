<header class="top-header">
  <div class="top-header__inner">
    <a class="top-header__logo" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url(get_theme_file_uri('assets/img/common/logo-header.svg')); ?>" alt="BizLife" width="104" height="24" /></a>
    <nav id="top-header-nav" class="top-header__nav" aria-label="メインナビゲーション">
      <a class="top-header__nav-link top-header__nav-link--home" href="<?php echo esc_url(home_url('/')); ?>">
        <span class="top-header__nav-link-inner">
          <span class="top-header__nav-link-swap">
            <span class="top-header__nav-link-en">Home</span>
            <span class="top-header__nav-link-ja">ホーム</span>
          </span>
        </span>
      </a>
      <a class="top-header__nav-link" href="<?php echo esc_url(home_url('/about/')); ?>">
        <span class="top-header__nav-link-inner">
          <span class="top-header__nav-link-swap">
            <span class="top-header__nav-link-en">About</span>
            <span class="top-header__nav-link-ja">私たちについて</span>
          </span>
        </span>
      </a>
      <a class="top-header__nav-link" href="<?php echo esc_url(home_url('/service/')); ?>">
        <span class="top-header__nav-link-inner">
          <span class="top-header__nav-link-swap">
            <span class="top-header__nav-link-en">Service</span>
            <span class="top-header__nav-link-ja">サービス</span>
          </span>
        </span>
      </a>
      <a class="top-header__nav-link" href="<?php echo esc_url(home_url('/works/')); ?>">
        <span class="top-header__nav-link-inner">
          <span class="top-header__nav-link-swap">
            <span class="top-header__nav-link-en">Works</span>
            <span class="top-header__nav-link-ja">実績</span>
          </span>
        </span>
      </a>
      <a class="top-header__nav-link" href="<?php echo esc_url(home_url('/recruit/')); ?>">
        <span class="top-header__nav-link-inner">
          <span class="top-header__nav-link-swap">
            <span class="top-header__nav-link-en">Recruit</span>
            <span class="top-header__nav-link-ja">採用情報</span>
          </span>
        </span>
      </a>
      <a class="top-header__nav-link" href="<?php echo esc_url(home_url('/blog/')); ?>">
        <span class="top-header__nav-link-inner">
          <span class="top-header__nav-link-swap">
            <span class="top-header__nav-link-en">Blog</span>
            <span class="top-header__nav-link-ja">ブログ</span>
          </span>
        </span>
      </a>
      <a class="top-header__nav-link top-header__nav-link--contact" href="<?php echo esc_url(home_url('/contact/')); ?>">
        <span class="top-header__nav-link-inner">
          <span class="top-header__nav-link-swap">
            <span class="top-header__nav-link-en">Contact</span>
            <span class="top-header__nav-link-ja">お問い合わせ</span>
          </span>
        </span>
      </a>
    </nav>
    <button type="button" class="top-header__menu-toggle" aria-expanded="false" aria-controls="top-header-nav" aria-label="メニューを開く">
      <span class="top-header__menu-toggle-bar" aria-hidden="true"></span>
      <span class="top-header__menu-toggle-bar" aria-hidden="true"></span>
      <span class="top-header__menu-toggle-bar" aria-hidden="true"></span>
    </button>
  </div>
  <div class="top-header__backdrop" aria-hidden="true"></div>
</header>
