<?php
if (is_page('first-ai-task-check')) { get_template_part('template-parts/diagnosis'); return; }
if (is_page('blog')) { get_template_part('home'); return; }
get_header();
?>
<?php while(have_posts()): the_post(); ?><header class="page-hero"><div class="shell"><p class="eyebrow"><span></span> DEAR MINTO</p><h1><?php the_title(); ?></h1></div></header><article class="content-wrap"><div class="entry-content"><?php the_content(); ?></div></article><?php endwhile; ?>
<?php get_footer(); ?>
