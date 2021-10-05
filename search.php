<?php get_header(); ?>

<div class="content">
	<? if (have_posts()) : ?>
		<header>
			<h1><? printf(__('Результаты поиска: %s'), '<span>' . get_search_query() . '</span>'); ?></h1>
			<br />
			<? get_search_form(); ?>
		</header>
		<?php while (have_posts()) : the_post(); ?>
			<br />
			<?php get_template_part('template-parts/article') ?>
		<?php endwhile ?>
	<? else : ?>
		<header>
			<h1><? printf(__('По запросу: %s'), '<span>' . get_search_query() . '</span>'); ?></h1>
			<p>Ничего не найдено, попробуйте еще раз.</p>
			<br />
			<? get_search_form(); ?>
		</header>
	<? endif; ?>
</div>

<?php get_footer(); ?>