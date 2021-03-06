<?php

  /**
   * Edit this file in order to add WordPress sidebars to your theme.
   *
   * @see https://developer.wordpress.org/reference/functions/register_sidebar/
   */
  return [
      [
          'name' => __('Левая боковая панель', THEME_TD),
          'id' => 'left-sidebar',
          'description' => __('Место для вывода меню', THEME_TD),
          'class' => 'custom',
          'before_widget' => '<div>',
          'after_widget' => '</div>',
          'before_title' => '<h2>',
          'after_title' => '</h2>',
      ]
  ];
