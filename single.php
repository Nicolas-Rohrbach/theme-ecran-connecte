<?php get_header(); ?>
<section id="content">
    <?php if(have_posts()) : ?>
        <?php while(have_posts()) : the_post(); ?>
            <article class= "post" id="post-<?php the_ID(); ?>">
                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                <div class= "post_content"><?php the_content(); ?></div>
            </article>
        <?php endwhile; ?>
        <div class="comments-template"> <?php comments_template(); ?> </div>
        <?php previous_post_link() ?> <?php next_post_link() ?>
    <?php else : ?> <p>Désolé, aucun article ne correspond à vos critères.</p>
    <?php endif; ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
</body>
</html>