<?php 

require_once '../_inc/config.php';


if( !$data = validate_post()){
    redirect('back');
}

extract($data);
$slug = slugify($title);


$insert = $db->prepare(" INSERT INTO posts
                             ( category, title, image, text, slug )
                             VALUES (:category, :title, :image, :text, :slug )");

$insert->execute([
    'category' => $category,
    'title' => $title,
    'image' => $image,
    'text' => $text,
    'slug' => $slug
]);                        

if( !$insert )
{
    flash()->error('Failed to add post');
    redirect('back');
}

$post_id = $db->lastInsertId();

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

flash()->success('The post has been added');
redirect('/');