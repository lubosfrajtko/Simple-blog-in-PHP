<?php

require_once '../_inc/config.php';

$new_tag = filter_input(INPUT_POST, 'newtag', FILTER_SANITIZE_STRING);

if($new_tag)
{

    $insert = $db->prepare(" INSERT INTO tags
                            (tag)
                            VALUES(:tag)");
    $insert->execute([
        ':tag' => $new_tag
    ]);

}

if($insert){
    redirect('back');
}


