<?php get_header();
the_post(); ?>

	<main class="page-body">
		<header>
			<h1 class="single-page__title"><?php the_title() ?> </h1>
		</header>
		<br />
		<?php the_content() ?>
	</main>

<?php get_footer() ?>