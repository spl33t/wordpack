<?php get_header();
the_post() ?>

	<main class="page-body">
		<article>
			<header>
				<h1 class="single-post__title"> <?php the_title() ?> </h1>
				<?php get_template_part('/template-parts/meta') ?>
			</header>
			<br />
			<?php the_content() ?>
			</br>
		</article>

		<section class="comments">
			<?php if (comments_open() || get_comments_number()) :
				comments_template();
			endif; ?>
		</section>
	</main>

<?php get_footer() ?>