<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#f8f3e9">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main">本文へ移動</a>
<header class="site-header" data-header>
  <div class="shell site-header__inner">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Dear Minto ホーム">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/mark.png'); ?>" alt="" width="48" height="48">
      <span><b>Dear Minto</b><small>AI for everyday work</small></span>
    </a>
    <button class="menu-button" type="button" aria-expanded="false" aria-controls="mobile-nav" data-menu>
      <span></span><span></span><span></span><em>メニュー</em>
    </button>
    <nav class="site-nav" id="site-nav" aria-label="メインメニュー">
      <?php wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'menu_class' => 'site-nav__list', 'fallback_cb' => 'dear_minto_menu_fallback']); ?>
    </nav>
  </div>
</header>
<nav class="mobile-nav" id="mobile-nav" aria-label="スマートフォンメニュー">
  <?php dear_minto_menu_fallback(); ?>
</nav>
<main id="main">
