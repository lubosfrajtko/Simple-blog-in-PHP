<?php

function get_posts( $auto_format = true )
{

    global $db;

    $query = $db->query(" SELECT p.*, GROUP_CONCAT(t.tag SEPARATOR '~||~') AS tags
        FROM posts p
        LEFT JOIN posts_tags pt ON (p.id = pt.post_id)
        LEFT JOIN tags t ON (t.id = pt.tag_id)
        GROUP BY p.id 
        ORDER BY created_at DESC LIMIT 6 ");

    if( $query->rowCount())
    {
        $results = $query->fetchAll( PDO::FETCH_ASSOC);

        if( $auto_format )
        {
            $results = array_map('format_post', $results);
        }
    }
    else
    {
        $results = [];
    }

    return $results;



}

function get_posts_second( $auto_format = true )
{

    global $db;

    $query = $db->query(" SELECT p.*, GROUP_CONCAT(t.tag SEPARATOR '~||~') AS tags
    FROM posts p
    LEFT JOIN posts_tags pt ON (p.id = pt.post_id)
    LEFT JOIN tags t ON (t.id = pt.tag_id)
    GROUP BY p.id 
    ORDER BY created_at DESC LIMIT 6 OFFSET 6");

    if( $query->rowCount())
    {
        $results = $query->fetchAll( PDO::FETCH_ASSOC);

        if( $auto_format )
        {
            $results = array_map('format_post', $results);
        }
    }
    else
    {
        $results = [];
    }

    return $results;



}

function get_random_posts( $auto_format = true )
{

    global $db;

    $query = $db->query(" SELECT p.*, GROUP_CONCAT(t.tag SEPARATOR '~||~') AS tags
        FROM posts p
        LEFT JOIN posts_tags pt ON (p.id = pt.post_id)
        LEFT JOIN tags t ON (t.id = pt.tag_id)
        GROUP BY p.id 
        ORDER BY RAND() LIMIT 6 ");

    if( $query->rowCount())
    {
        $results = $query->fetchAll( PDO::FETCH_ASSOC);

        if( $auto_format )
        {
            $results = array_map('format_post', $results);
        }
    }
    else
    {
        $results = [];
    }

    return $results;



}

function get_posts_by_tag( $tag ='',  $auto_format = true )
{

    if( !$tag && !$tag = segment(2)){
        return false;
    }

    $tag = urldecode($tag);
    $tag = filter_var( $tag, FILTER_SANITIZE_STRING);
        
    global $db;

    $query = $db->prepare(" SELECT p.*, GROUP_CONCAT(t.tag SEPARATOR '~||~') AS tags
    FROM posts p
    LEFT JOIN posts_tags pt ON (p.id = pt.post_id)
    LEFT JOIN tags t ON (t.id = pt.tag_id)
    WHERE t.tag = :tag
    GROUP BY p.id ");

    $query->execute([ 'tag'=>$tag ]);

    if( $query->rowCount())
    {
        $results = $query->fetchAll( PDO::FETCH_ASSOC);

        if( $auto_format )
        {
            $results = array_map('format_post', $results);
        }
    }
    else
    {
        $results = [];
    }

    return $results;



}

function get_post( $id = 0, $auto_format = true ){


    if( !$id && !$id = segment(2)){
        return false;
    }

    //id must be integer
    if( ! filter_var( $id, FILTER_VALIDATE_INT)){
        return false;
    }

    global $db;

    $query = $db->prepare(" SELECT p.*, GROUP_CONCAT(t.tag SEPARATOR '~||~') AS tags
    FROM posts p
    LEFT JOIN posts_tags pt ON (p.id = pt.post_id)
    LEFT JOIN tags t ON (t.id = pt.tag_id)
    LEFT JOIN comments c ON (p.id = c.post_id)
    WHERE p.id = :id
    GROUP BY p.id ");

   $query->execute([ 'id'=>$id ]);


    if( $query->rowCount() === 1 )
    {
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if( $auto_format )
        {
            $result = format_post( $result );
        }
    }
    else
    {
        $result = [];
    }

    return $result;
}


function format_post( $post )
{
    //remove unselessly charts
    $post = array_map('trim', $post);

    //remove htmls special charts
    $post['title'] = plain($post['title']);
    $post['text'] = plain($post['text']);
    $post['category'] = plain($post['category']);
    $post['slug'] = plain($post['slug']);
    $post['image'] = plain($post['image']);
    $post['tags'] = isset($post['tags']) ? explode('~||~', $post['tags'] ): [];
    $post['tags'] = array_map('plain', $post['tags']);
    
    $post['comments'] = plain($post['comments']);

    //create link /post/id/slug
    $post['link'] = get_post_link( $post );
    $post['edit_link'] = get_edit_link ( $post );
    $post['delete_link'] = get_delete_link ( $post );

    //create tags links
    if ( $post['tags']) foreach( $post['tags'] as $tag){
        $post['tags_links'][$tag] = BASE_URL.'/tag/'.urlencode($tag);
        $post['tags_links'][$tag] = filter_var($post['tags_links'][$tag], FILTER_SANITIZE_URL);
    }
    
    /*format date*/
	$post['timestamp'] = strtotime( $post['created_at']);
	$post['time'] = date('j M Y, G:i', $post['timestamp']);
    $post['date'] = date('Y-m-d', $post['timestamp']);

    //image path
    $post['image_path'] = asset('/img/'.$post['image']);

    //format text
    $post['text'] = filter_url($post['text']);
    $post['text'] = add_paragraphs($post['text']);
    
    return (object) $post;
}

function get_post_link( $post, $type = 'post' )
	{
		if( is_object( $post ))
		{
			$id = $post->id;
			$slug = $post->slug;
		}else
		{
			$id = $post['id'];
			$slug = $post['slug'];
		}

		$link = BASE_URL. "/$type/$id";

		if ($type === 'post')
		{
			 $link .= "/$slug";
		}

		$link = filter_var( $link, FILTER_SANITIZE_URL);

		return $link;

    }

    function get_add_link( $post, $type = 'post' )
	{
		if( is_object( $post ))
		{
			$slug = $post->slug;
		}else
		{
			$slug = $post['slug'];
		}

        $new = 'new';

		$link = BASE_URL. "/$type/$new";

		if ($type === 'post')
		{
			 $link .= "/$slug";
		}

		$link = filter_var( $link, FILTER_SANITIZE_URL);

		return $link;

    }

    
    function get_edit_link( $post )
    {
        return get_post_link( $post, $type = 'edit');
    }

    function get_delete_link( $post )
    {
        return get_post_link( $post, $type = 'delete');
    }

    
	function get_all_tags( $post_id = 0 )
	{
		global $db;

		$query = $db->query("
			SELECT * FROM tags
			ORDER BY tag ASC
		");

		$results = $query->rowCount() ? $query->fetchAll( PDO::FETCH_OBJ ) : [];

		if ( $post_id )
		{
			$query = $db->prepare("
				SELECT t.id FROM tags t
				JOIN posts_tags pt ON t.id = pt.tag_id
				WHERE pt.post_id = :pid
			");

			$query->execute([
				'pid' => $post_id
			]);

			if ( $query->rowCount() )
			{
				$tags_for_post = $query->fetchAll( PDO::FETCH_COLUMN );

				foreach ( $results as $key => $tag )
				{
					if ( in_array( $tag->id, $tags_for_post ) ) {
						$results[$key]->checked = true;
					}
				}
			}
		}

		return $results;
	}

    function validate_post()
    {
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING);
        $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $tags = filter_input(INPUT_POST, 'tags', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);

        if(isset($_POST['post_id'])){

            $post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);

            if( !$post_id )
            {
                flash()->error('What are you trying for?');
            }
            }
            else{
                $post_id = false;
            }

        if ( !$category = trim($category))
        {
            flash()->message('You forgot write category');
        }

        if ( !$title = trim($title))
        {
            flash()->error('You forgot write title');
        }

        if ( !$image = trim($image))
        {
            flash()->error('You forgot load image');
        }

        if ( !$text = trim($text))
        {
            flash()->error('You forgot write text');
        }

        if( flash()->hasMessages())
        {
            return false;
        }

        return compact('category', 'title', 'image', 'text', 'tags', 'post_id',
                $category, $title, $image, $text, $tags, $post_id);

    }

    function get_comments( $id= 0)
    {

        if( !$id && !$id = segment(2)){
            return false;
        }
        //id must be integer
        if( ! filter_var( $id, FILTER_VALIDATE_INT)){
            return false;
        }

        global $db;

        $comments = $db->prepare(" SELECT c.comment, c.created_at
                                    FROM posts p
                                    JOIN comments c ON c.post_id = p.id
                                    WHERE p.id = :post_id
                                    GROUP BY c.id DESC ");


        $comments->execute([
            'post_id' => $id
        ]);

        if( $comments->rowCount() )
        {

            $results = $comments->fetchAll(PDO::FETCH_OBJ);
           
        }
        else
        {
            $results = [];
        }

        return $results;


    }