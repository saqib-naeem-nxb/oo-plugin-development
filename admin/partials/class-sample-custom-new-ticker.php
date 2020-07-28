<?php

class Sample_Custom_News_Ticker{
    public function menu_item(){
        add_menu_page( 
            "New Ticker", 
            "News Ticker", 
            "manage_options", 
            "news-ticker", 
            array($this, "news_ticker_page_html"), 
            "", 
            102 
        );
        
    }

    public function news_ticker_page_html(){
        echo '<div class="wrap">';
        echo '<h1>'.get_admin_page_title(  ).'</h1>';
?>
<form action="options.php" method="POST">
<table class="form-table">
<tr>
<th><label for="">Ticker classes</label></th>
<td><input type="text" name="sp_ticker_classes" id="" class="regular-text" value=""></td>
</tr>

<tr>
<th></th>
<td><?php  submit_button( "Save"); ?></td></tr>
</table>
</form>
<?php
        echo '</div>';
    }


}

    public function register_settings(){
        register_setting( "news_ticker", "news_tick_classes" );
    }

?>