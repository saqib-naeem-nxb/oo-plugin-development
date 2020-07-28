<?php

class Sample_Site_Logo_Widget extends WP_Widget{

    public $args = array(
        'before_title'  =>  '<h4 class="widgettitle">',
        'after_title'  =>   '</h4>',
        'before_widget'  => '<div class="widget-wrap">',
        'after_widget'  =>  '</div>'
    );

    public function __construct(){
        parent::__construct("sample-txt-widget", "My Textt");

        add_action( "widgets_init", function(){
            register_widget( "Sample_Site_Logo_Widget" );
        } );
    }

    public function widget( $args, $instence){
        echo $args['before_widget'];

        if( !empty($instence['title']) ){
            echo $args['before_title'].apply_filters( "widget_title", $instence['title'] ). $args['after_title'];
        }

        echo '<div class="textwidget">';

        echo esc_html__( $instence['text'], "sample-plugin" );

        echo '</div>';

        echo $args['after_widget'];
    }

    public function form( $instence ){
        print_r($instence);
        $title = !empty( $instence['title'] ) ? $instence['title'] : esc_html__( "nan", "sample-plugin" );
        $text = !empty( $instence['text'] ) ? $instence['text'] : esc_html__( "nan", "sample-plugin" );

?>
<p>
    <label for="<?= esc_attr( $this->get_field_id('title') ) ?>"><?= esc_html__( "Title: ", "sample-plugin" ) ?></label>
    <input type="text" name="<?php echo esc_attr( $this->get_field_name('title') );?>" id="<?php echo esc_attr( $this->get_field_id("title") ); ?>" class="widefat" value="<?=  esc_attr( $title ); ?>">
</p>
<p>
    <label for="<?= esc_attr( $this->get_field_id("text") ); ?>"><?= esc_html__( "text: ", "sample-plugin" ); ?></label>
    <textarea name="<?php echo esc_attr( $this->get_field_name("text") )?>" id="<?php echo $this->get_field_id("text") ?>" cols="30" rows="10" class="widefat"><?= esc_attr( $text );?></textarea>
</p>
<?php
    }

    public function update($new_instence, $old_instence){
        $instence = array();

        $instence['title'] = (!empty($new_instence['title'])) ? strip_tags($new_instence['title']) : "";
        $instence['text'] = (!empty($new_instence['text'])) ? strip_tags($new_instence['text']) : "";

        return $instence;
    }
}
?>