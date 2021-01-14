<?php 

require_once '../_inc/config.php';

if( !$data = validate_post()){
    redirect('back');
}

extract($data);


//update category,title,image,text
$update_post = $db->prepare(" UPDATE posts SET
                                category = :category,
                                title = :title,
                                image = :image,
                                text = :text
                                WHERE id = :post_id ");

$update_post->execute([
    'category' => $category,
    'title' => $title,
    'image' => $image,
    'text' => $text,
    'post_id'=> $post_id
]);

//remove all tags

$remove_tags = $db->prepare(" DELETE FROM posts_tags
                              WHERE post_id = :post_id ");

$remove_tags->execute([
    'post_id' => $post_id
]);                              

if( isset($tags) && $tags = array_filter($tags))
{
    foreach( $tags as $tag_id)
    {
        $insert_tags = $db->prepare(" INSERT INTO posts_tags
                                     VALUES (:post_id, :tag_id)
                                    ");

        $insert_tags->execute([
            'post_id' => $post_id,
            'tag_id' => $tag_id
        ]);
    }
}
                        


if(!$update_post->rowCount())
{
    flash()->error('You nothing changed');
    redirect('back');

}

if($update_post->rowCount())
{
    flash()->success('You change it ');
    redirect('back');

}

