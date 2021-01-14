<?php 

$id = segment(2);

if( $id == 'new'){

    include_once 'add.php';
    die();

}
if( $id == '_admin'){

    include_once '_admin/add-comment.php';
    die();

}

try { 
    $post = get_post($id);
    $random_results = get_random_posts(); 
    $comments = get_comments($id);
}
catch( PDOException $e ){
    $post = false;
    $random_results = false;
}

$page_name = $post->title;

if( !$post ){
    redirect('/');
}


include_once 'partials/header-post.php';
?>

<header>
    <img class="background" src="<?= $post->image_path ?>" alt="">
</header>

<div class="container-post group">

    <div class="one-post">
        <article class="post group">
            <a href="<??>"><h4><?= $post->category ?></h4></a>
            <div class="links">
                <a href="<?= $post->edit_link ?>" class="edit-link">edit</a>
                <a href="<?= $post->delete_link ?>" class="delete-link"><i class="far fa-trash-alt"></i></a>
            </div>
            <h1><?= $post->title ?></h1>
            <time class="post-time"> / <?= $post->time ?> </time>
            <p><?= $post->text ?> </p>
            <?php if( $post->tags ):?>
				<?php foreach ( $post->tags_links as $tag => $tag_link) :?>	
					<a href="<?= $tag_link ?>" class="tag-link"> <?= $tag ?></a>
				<?php endforeach?>
			<?php endif?>
        </article>
    </div>

    <div class="old-posts">
        <h2 class="heading-old-posts">watch also</h2>
        <?php  if( count( $random_results ) ) : foreach( $random_results as $random_post) :?>
            <article id="<?= $random_post->id ?>" class="old-post">
                <header>
                    <a href="<?= $random_post->link ?>">
                        <h2><?= $random_post->title ?></h2>
                     </a>
                </header> 
                <time datetime="<?= $random_post->date ?>">
                     <?= $random_post->time ?>
                </time>
                
            </article>

        <?php endforeach; else :?>
            <p>we got nothing</p>
        <?php endif ?>
    </div>
    <section class="section-comments">
        <h3>Comments</h3>
        <form class="form-add" action="<?= BASE_URL.'/post' ?>/comment" method="post">
            <input name="post_id" value="<?= $post->id ?>" type="hidden">
            <textarea name="comment" id="" cols="30" rows="10"></textarea>
            <button type="submit">Add</button>
        </form>
        <div class="comments">
            <?php foreach($comments as $comment):?>
                <div class="comment">
                    <time><?= date('j M Y, G:i', strtotime($comment->created_at))?></time>
                    <p class="comment-text"><?= plain( $comment->comment )?></p>
                    <div class="likes">
                        <a class="like-link" href=""><i class="far fa-thumbs-up"></i></a>
                        <p class="like-number">0</p>
                        <a class="dislike-link" href=""><i class="far fa-thumbs-down"></i></a>
                        <p class="dislike-number">0</p>
                    </div>
                </div>    
            <?php endforeach?>
        </div> 
    </section>
           
</div>







<?php include_once 'partials/footer.php'?>