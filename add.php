<?php 



include_once 'partials/header-post.php';

?>
<div class="container">
    <h1 class="heading-edit">Add new post</h1>

    <form class="edit-form" action="<?= BASE_URL?>/_admin/add-item.php" method="post">

        <input class="input input-category" type="text" name="category" value="" placeholder="Category">
        <input class="input input-title" type="text" name="title" value="" placeholder="Title">
        <input class="input input-image" type="text" name="image" value="" placeholder="Image">
        <textarea class="input input-text" name="text" id="" cols="30" rows="10" placeholder="Text"></textarea>
        <div class="tags">
            <?php foreach ( get_all_tags( $post->id ) as $tag ):?>
                <label class="checkbox">
                    <input type="checkbox" name="tags[]" value="<?= $tag->id ?>" <?= isset( $tag->checked)  && $tag->checked ? 'checked' : ''?>>
                     <?= plain($tag->tag) ?> 
                </label>
             <?php endforeach ?>
        </div>
        <div class="edit-links">
            <button type="submit" class="edit">Add post</button>
            <a class="edit-back" href="<?= BASE_URL ?>"> back </a>
        </div>
    </form>
    <form class="new-tag" action="<?= BASE_URL?>/_admin/new-tag.php" method="post">
        <input type="text" name="newtag">
        <button type="submit">Add new tag</button>
    </form>

</div>








<?php include_once 'partials/footer.php'?>
