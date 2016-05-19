<?php get_header(); ?>
<div class="b_content clearfix" id="main">

    <!-- start content -->
    <div class="b_page clearfix">
        <div id="content">
            <!--left side-->
            <div <?php post_class( 'post' )?>>
            <?php
                get_template_part( 'loop' , '404' );
            ?>
            </div>
        </div>

        <!-- right sidebar -->
        <?php
            layout::get_side( 'right' , 0 , '404' );
        ?>
    </div>
</div>
<?php get_footer(); ?>