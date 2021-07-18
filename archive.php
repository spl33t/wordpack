<?php get_header(); ?>


<main class="page-body">
	<div class="content">
		<?php if (have_posts()) : ?>

			<header class="page-header">
				<?php
				the_archive_title('<h1 class="page-title">', '</h1>');
				?>
			</header>

		<?php while (have_posts()) :
				the_post();

				the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');


				the_content(
					sprintf(
						wp_kses(

							__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentynineteen'),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					)
				);

			endwhile;
		endif; ?>
	</div>
</main>


<?php get_footer(); ?>