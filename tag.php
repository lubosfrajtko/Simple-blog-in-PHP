<?php include 'partials/header-post.php';

$tag = urldecode( segment(2) );
$tag = plain( $tag );
try { 
    $results = get_posts_by_tag( $tag ); 
}
catch( PDOException $e ){
    $post = false;
}
?>

<div class="container group">   
    <h1 class="heading-tags"><?= $tag ?></h1>
    <div class="tag-posts">
        <?php  if( count( $results ) ) : foreach( $results as $post) :?>
             <article id="post-<?= $post->id ?>" class="new-post">

                <header>
                    <a href="<?= $post->link ?>"><img src="<?= $post->image_path ?>" alt=""></a>
                </header>
                <a href="">
                    <h5 class="new-post-category"><?= $post->category ?></h5>
                </a>
                 <a href="<?= $post->link ?>">
                    <h2 class="new-post-title"><?= $post->title ?></h2>
                </a>
                <time datetime="<?= $post->date ?>">
                    <?= $post->time ?>
                </time>
                <a href="<?= $post->link ?>" class="more">More -></a>
                
            </article>

        <?php endforeach; else :?>
           <p>we got nothing</p>
        <?php endif ?>
    </div>
</div>


<?php include 'partials/footer.php';?>