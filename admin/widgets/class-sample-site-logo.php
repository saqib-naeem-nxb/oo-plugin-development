<?php

class Sample_Site_Logo_Widget extends WP_Widget{
    public function __construct(){
        parent::__construct("my-yext", "My Textt");

        add_action( "widgets_init", function(){
            register_widget( "my_widget" );
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

    public function form(){}

    public function update(){}
}
?>