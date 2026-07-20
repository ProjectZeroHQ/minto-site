<?php get_header(); ?>
<header class="page-hero"><div class="shell"><p class="eyebrow"><span></span> AI WORK JOURNAL</p><h1><?php the_title(); ?></h1><p><?php echo esc_html(get_the_date('Y.m.d')); ?>　・　Dear Minto編集部</p></div></header>
<?php while(have_posts()): the_post(); ?><article class="content-wrap"><div class="entry-content"><?php the_content(); ?></div><nav class="post-nav"><div><?php previous_post_link('← %link','前の記事'); ?></div><div><?php next_post_link('%link →','次の記事'); ?></div></nav></article><?php endwhile; ?>
<?php get_footer(); ?>

