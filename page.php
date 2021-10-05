<?php get_header();
the_post(); ?>


<div class="content">
	<header>
		<h1 class="single-page__title"><?php the_title() ?> </h1>
	</header>
	<br />
	<?php the_content() ?>
</div>


<?php get_footer() ?>