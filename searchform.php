<?php ?>
<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
        <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
        <input type="submit" id="searchsubmit" value="Chercher" />
</form>