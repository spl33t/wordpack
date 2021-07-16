<?php get_header();
the_post() ?>

<main class="page-body">
	<article>
		<header>
			<h1 class="single-post__title"> <?php the_title() ?> </h1>
			<div class="meta">
				<time><?php the_time('d F Y') ?></time>
				&nbsp; / &nbsp;
				<?php the_category(', ') ?>
			</div>
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