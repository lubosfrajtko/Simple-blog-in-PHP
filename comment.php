<?php

require_once '_inc/config.php';


$post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);
$comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

if(!$comment)
{
    redirect('back');
}

if(!$post_id)
{
    redirect('back');
}

$insert = $db->prepare(" INSERT INTO comments
                             ( post_id, comment )
                             VALUES (:post_id, :comment )");

$insert->execute([
    'post_id' => $post_id,
    'comment' => $comment
]);

if($insert){

    redirect('back');

}