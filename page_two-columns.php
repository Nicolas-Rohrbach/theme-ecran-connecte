<?php /* Template Name: Colonne droite */ ?>
<?php get_header(); ?>
        <main id="content-twocolumns">
            <section>
                <?php if(have_posts()) :
                    while(have_posts()) : the_post(); ?>
                        <article class= "post" id="post-<?php the_ID(); ?>">
                            <h2><a href="<?php //the_permalink(); ?>" title="<?php //the_title(); ?>"><?php //the_title(); ?></a></h2>
                            <div class= "post_content"><?php the_content(); ?></div>
                        </article>
                    <?php endwhile; ?>
                <?php endif; ?>
            </section>
        </main>
        <?php get_sidebar(); ?>
        <?php include_once 'template-parts/footer/footer_front.php'; ?>
    </body>
</html>