<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage mbm-media
 * @since 1.0.0
 * Template Name: صفحه فرود
 */

get_header();

if(is_login())
{
	get_template_part('template-parts/content', 'chat');
}
else
{
	get_template_part('template-parts/content', 'login');
}

get_footer();
