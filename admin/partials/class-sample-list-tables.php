<?php

// class Sample_List_Table{
//     public function generate_table(){
?>
<!-- <table class="wp-list-table widefat fixed books">
        <thead>
            <tr>
                <th><?php _e("Book name", "sample-plugin"); ?></th>
                <th><?php _e("SKU", "sample-plugin"); ?></th>
                <th><?php _e("Author", "sample-plugin"); ?></th>
            </tr>
        </thead>
        <tbody> -->
<?php 
        // $args = array(
        //     'post_type' => array('books'),
        //     'posts_per_page' => -1
        // );
        // $query = new WP_Query($args);
        // if($query->have_posts(  )){
        //     while($query->have_posts(  )){
        //         echo "<tr>";
        //         $query->the_post();
        //         $sku = get_post_meta( get_the_ID(  ), "sp_sku", true );
        //         $author = get_post_meta( get_the_ID(  ), "sp_author", true );
        //         echo "<td>".get_the_title().    "</td>";
        //         echo "<td>".$sku.    "</td>";
        //         echo "<td>".$author.    "</td>";

        //         echo "</tr>";
        //     }
        // }
?>
        <!-- </tbody> -->
<!-- </table> -->
<?php
//     }

// }

if(! class_exists('WP_List_Table') ){
    require_once ABSPATH."wp-admin/includes/class-wp-list-table.php";
}

class Sample_List_Table extends WP_List_Table{
    public function __construct(){
        parent::__construct([
            'singular'  => __("Book", "sample-plugin"),
            'plural'    => __("Books", "sample-plugin"),
            'ajax'      => false
        ]);
    }

    public static function get_books($per_page = 5, $page_number = 1){
        global $wpdb;

        $sql = "SELECT * FROM {$wpdb->prefix}customers";

        if(!empty($_REQUEST['orderby'])){
            $sql .= ' ORDER BY '. esc_sql( $_REQUEST['orderby'] );
            $sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
        }
    }
}