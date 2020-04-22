<?php if(get_theme_mod('sidebar_right_display', 'show') == 'show') : ?>
    <!-- SIDEBAR -->
    <aside id="sidebar" class="col-md-4 order-md-2 text-center sidebar" role="complementary">
        <?php if (! function_exists('dynamic_sidebar') || ! dynamic_sidebar('Colonne Droite')) :
            the_widget('WidgetInformation');
        endif; ?>
    </aside>
<?php endif; ?>