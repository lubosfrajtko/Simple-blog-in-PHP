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
include_once 'partials/header.php';
?>

<div class="container">
	<h1 class="heading-delete">Are you sure you wanna do this ? </h1>
	<form class="delete-form group" action="<?= BASE_URL ?>/_admin/delete-item.php" method="post">
		<input type="hidden" name="post_id" value="<?= $post->id ?>">
		<div class="delete-post">
			<a href="<?= get_post_link($post) ?>"><h2><?= $post->title ?></h2></a>
			<time> / <?= $post->time ?> </time>
		</div>
		<button type="submit">
			Delete post
		</button>
		<a class="delete-back" href="<?= get_post_link($post) ?>">back</a>

	</form>

</div


<?php include_once 'partials/footer.php'; ?>