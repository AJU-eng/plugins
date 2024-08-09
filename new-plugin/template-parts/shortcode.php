<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
     




    $args = array(
        'post_type' => 'post',
        'posts_per_page' => (int) get_option('numberOfpages'),
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => get_option('categories'),
            ),
        ),
    );

    $theQuery = new WP_Query($args);
    ?>
    <?php $columns = (int)   get_option('numberOfColumns') ?>
    <?php error_log($columns)?>
   <div style="display:grid; grid-template-columns: repeat(<?php echo (int) get_option('columCount') ?>, 1fr); "> 
    
        <?php if ($theQuery->have_posts()):
            while ($theQuery->have_posts()):
                $theQuery->the_post(); ?>
                

                    <div >
                        <div>
                            <?php if (has_post_thumbnail()): ?>
                                <img class="front-thumb" src=" <?php echo get_option('thumbnail') === 'true'? the_post_thumbnail_url() :'' ?>" alt="">

                            <?php endif; ?>
                        </div>
                        <div>
                            <h2><?php the_title() ?></h2>
                            <?php echo customLength(get_option('excerptCount')) ?>
                            <a href="<?php the_permalink() ?>"><button class="Read-more"><?php echo get_option('buttonText')  ?></button></a>
                            <?php echo "<br/> <br/>" ?>
                        </div>
                    </div>
                



            <?php endwhile; endif; ?>


            <?php 
               function customLength($limit){
                   $excerpt = get_the_excerpt();
                 return   wp_trim_words($excerpt, $limit);
            
               }


?>
    </div>
</body>

</html>