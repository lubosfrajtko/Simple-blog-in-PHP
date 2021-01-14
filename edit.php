<?php 

$id = segment(2);

try { 
    $post = get_post($id);
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

$page_name = $post->title;

if( !$post ){
    redirect('/');
}

include_once 'partials/header-post.php';

?>
<div class="container">
    <h1 class="heading-edit">Edit <?= $page->title ?></h1>

    <form class="edit-form" action="<?= BASE_URL?>/_admin/edit-item.php" method="post">

        <input class="input input-category" type="text" name="category" value="<?= $post->category ?>">
        <input class="input input-title" type="text" name="title" value="<?= $post->title ?>">
        <input class="input input-image" type="text" name="image" value="<?= $post->image ?>">
        <textarea class="input input-text" name="text" id="" cols="30" rows="10"><?= plain( $post->text )?></textarea>
        <div class="tags">
            <?php foreach ( get_all_tags( $post->id ) as $tag ):?>
                <label class="checkbox">
                    <input type="checkbox" name="tags[]" value="<?= $tag->id ?>" <?= isset( $tag->checked)  && $tag->checked ? 'checked' : ''?>>
                     <?= plain($tag->tag) ?> 
                </label>
             <?php endforeach ?>
        </div>
        <input name="post_id" value="<?= $post->id ?>" type="hidden">
        <div class="edit-links">
            <button type="submit" class="edit">Edit post</button>
            <a class="edit-back" href="<?= get_post_link($post)?>"> back </a>
        </div>

    </form>
    <form class="new-tag" action="<?= BASE_URL?>/_admin/new-tag.php" method="post">
        <input type="text" name="newtag">
        <button type="submit">Add new tag</button>
    </form>

</div>








<?php include_once 'partials/footer.php'?>
