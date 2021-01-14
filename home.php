
<?php 
try { 
    $results_first = get_posts(); 
    $results_second = get_posts_second();
    $random_results = get_random_posts();
}
catch( PDOException $e ){
    $error = date('j M Y, G:i'). PHP_EOL;
	$error .= '--------------------'. PHP_EOL;
	/* vytiahneme si tu spravu a zapiseme si ze ta chyba bola v tomto subore a v tomto riadku */
	$error .= $e->getMessage() . 'in [ '. __FILE__ . ' : '. __LINE__ .'] '. PHP_EOL . PHP_EOL;

	/*tato funkcia je sikovna lebo najprv skontroluje ci tento subor existuje ak ano tak na jeho 
	koniec prida ten error*/
	file_put_contents( APP_PATH .'/_inc/error.log', $error.PHP_EOL, FILE_APPEND);
}


include 'partials/header.php';

?>

<div class="container group">
    <h1 class="heading-new-posts">new posts</h1>
    <ul class="pages-links">
		<li><a href="#first">1</a></li>
        <li><a href="#second">2</a></li>
    </ul>   
    <div class="new-posts" id="first"> 
        <?php  if( count( $results_first ) ) : foreach( $results_first as $post) :?>
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

    <div class="new-posts" id="second">
        <?php  if( count( $results_second ) ) : foreach( $results_second as $post) :?>
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

    
    <div class="old-posts">
        <h2 class="heading-old-posts">watch also</h2>
        <?php  if( count( $random_results ) ) : foreach( $random_results as $post) :?>
            <article id="<?= $post->id ?>" class="old-post">
                <header>
                    <a href="<?= $post->link ?>">
                        <h2><?= $post->title ?></h2>
                     </a>
                </header> 
                <time datetime="<?= $post->date ?>">
                     <?= $post->time ?>
                </time>
                
            </article>

        <?php endforeach; else :?>
            <p>we got nothing</p>
        <?php endif ?>
    </div>

</div>


<?php include 'partials/footer.php';?>