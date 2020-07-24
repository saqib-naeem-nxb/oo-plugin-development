<?php 

class Sample_Plugin_Menu{

    private $list_tables;

    public function __construct(){
        $this->load_dependencies();
        $this->list_tables = new Sample_List_Table();

    }
    private function load_dependencies(){
        require_once plugin_dir_path( dirname(__FILE__) ). "admin/partials/class-sample-list-tables.php";
    }

    public function add_main_menu(){
        add_menu_page( 
            "Sample Page", 
            "Sample Plugin", 
            "manage_options", 
            "sample-plugin", 
            array($this, "menu_page_content_html"), 
            "", 
            100 
        );
    }

    public function menu_page_content_html(){
        if(current_user_can( "manage_options" )):
?>

<div class="wrap">
    <h1><?php echo get_admin_page_title(  ) ?></h1>
    <?php $this->list_tables->generate_table(); ?>
</div>

<?php
        endif;
    }


}