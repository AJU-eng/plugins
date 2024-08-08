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
        'posts_per_page' => -1,
    );

    $theQuery = new WP_Query($args);
    ?>
    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">

        <?php if ($theQuery->have_posts()):
            while ($theQuery->have_posts()):
                $theQuery->the_post(); ?>
                <div style="display:flex; justify-content:center;">

                    <div class="blog-div">
                        <div>
                            <?php if ($theQuery->has_post_thumbnail()): ?>
                                <img class="front-thumb" src="<?php the_post_thumbnail_url() ?>" alt="">

                            <?php endif; ?>
                        </div>
                        <div>
                            <h2><?php the_title() ?></h2>
                            <?php the_excerpt() ?>
                            <a href="<?php the_permalink() ?>"><button class="Read-more">Read more</button></a>
                            <?php echo "<br/> <br/>" ?>
                        </div>
                    </div>
                </div>



            <?php endwhile; endif; ?>
    </div>
</body>

</html>