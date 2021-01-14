<?php
require_once '../_inc/config.php';

$post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);


if( !$post_id )
{
    flash()->error('What are you trying to dooooo');
    redirect('back');
}

$delete = $db->prepare(" DELETE FROM posts
                         WHERE id = :post_id");

$delete->execute([
    'post_id' => $post_id
]);      

if(!$delete)
{
    flash()->error('nothing deleted');
    redirect('back');
}


$delete_tags = $db->prepare(" DELETE FROM posts_tags
                              WHERE post_id = :post_id");

$delete_tags->execute([
    'post_id' => $post_id
]);                             


if(!$delete_tags)
{
    flash()->error('nothing deleted');
    redirect('back');
}

    flash()->success('You deleted post');
    redirect('/');
