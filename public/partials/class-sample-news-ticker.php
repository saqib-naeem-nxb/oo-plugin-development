<?php

class Sample_News_Ticker{
    public function __construct(){
        
    }
    public function shortcode( $atts = [], $content = null){

        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
        $ticker_atts = shortcode_atts( [
            "classes" => "",
        ], $atts, $tags );

        $content = $this->content();
        $output = '<div class="sample-news-ticker '.$ticker_atts['classes'].'">';

        foreach($content as $each){
            $output .= $each;
        }

        $output .= '</div>';


        return $output;
    }

    public function init(){
        add_shortcode( "sample-newsticker", array($this, "shortcode") );
    }

    private function content(){
        return array(
            '<p>Hello World</p>',
            '<p>WordPress development</p>',
            '<p>Software Engineering</p>',
        );
    }
}
?>