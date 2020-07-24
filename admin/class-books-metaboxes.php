<?php

class Books_Metaboxes{

    public function create_metabox(){

        add_meta_box( 
            "book_information", 
            "Book Information", 
            array($this, "metabox_html"), 
            "books", 
            "normal", 
            "low" 
        );

    }


    public function metabox_html($post){

        $sp_sku = get_post_meta( $post->ID, "sp_sku", true );
        $sp_author = get_post_meta( $post->ID, "sp_author", true );
?>
<table class="form-table">
    <tr>
        <th>
            <label for="sp_sku"><?= __("SKU", "sample-plugin"); ?></label>        
        </th>
        <td>
            <input type="text" name="sp_sku" id="sp_sku" value="<?php echo (isset($sp_sku)) ? $sp_sku : ""; ?>" class="regular-text">        
        </td>
    </tr>
    <tr>
        <th>
            <label for="sp_author"><?= __("Book Author Name", "sample-plugin"); ?></label>        
        </th>
        <td>
            <input type="text" name="sp_author" id="sp_author" value="<?php echo (isset($sp_author)) ? $sp_author : ""; ?>" class="regular-text">        
        </td>
    </tr>
</table>
<?php
    }

    public function save(  ){
        $sku    = sanitize_text_field( $_POST['sp_sku'] );
        $author = sanitize_text_field( $_POST['sp_author'] );
        $post_id = get_the_ID(  );
        update_post_meta( $post_id, "sp_sku", $sku );
        update_post_meta( $post_id, "sp_author", $author );
    }
}