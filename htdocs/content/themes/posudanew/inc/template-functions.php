<?php

  use Illuminate\Support\Facades\View;
  use Themosis\Support\Facades\Action;
  use Themosis\Support\Facades\Filter;


  /**
   * Adds custom classes to the array of body classes.
   *
   * @param array $classes Classes for the body element.
   *
   * @return array
   */
  Filter::add('body_class', function ($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
      $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
      $classes[] = 'no-sidebar';
    }

    return $classes;
  });

  /**
   * Add a pingback url auto-discovery header for single posts, pages, or attachments.
   */
  Action::add('wp_head', function () {
    if (is_singular() && pings_open()) {
      echo '<link rel="pingback" href="' . esc_url(get_bloginfo('pingback_url')) . '">';
    }
  });

  /**
   * Set the content width in pixels, based on the theme's design and stylesheet.
   */
  Action::add('after_setup_theme', function () {
    $GLOBALS['content_width'] = 640;
  }, 0);

  /**
   * Включение поддержки bootstrap меню
   */
  Action::add('after_setup_theme', 'register_navwalker');

  function register_navwalker() {
    require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
  }

  /*
   * Отключение автозагрузки основных шаблонов WooCommerce
   */
  Action::remove('init', ['WC_Template_Loader', 'init'], 1);

  /*
   * URL сайта доступно глобально
   */
//  View::composer(['/', 'category', 'product'], function($view){
//    $theme_url = app('wp.theme')->getUrl();
//    $view->with('theme_url', $theme_url);
//  });
  View::share(['theme_url' => app('wp.theme')->getUrl()]);
  global $product;
  View::share(['product' => $product]);