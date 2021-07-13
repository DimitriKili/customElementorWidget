<?php

namespace WPC;

class Post_Select extends \Elementor\Base_Control {


    //hier halen we de control (control2 select) op als we heb gebruiken.
    public function get_type() {
        return 'wpc-post-select';
    }

    /*
    door de functie enqueue kunnen we javascript gebruiken omdat dit een php bestand is maaken we een nieuw javascript bestand aan post_select.js
    waar al het javascript gebeurt. dus roepen we hier het javascript bestand post_select.js op en stoppen we het in een Elementor javascript map
    */
    public function enqueue()
    {
        wp_register_script( 'wpc_post_select', get_stylesheet_directory_uri() . '/custom_controls/post_select.js', ['jquery'], '1.0.0', true );
        wp_enqueue_script( 'wpc_post_select' );
    }

    //hierdoor haald de widget alle berichten op
    //dit is de control2 select box hierin komen de titels van alle aangemaakte WordPress berichten 
    public function content_template() {

        ?>

            <div>
                <!-- dit wordt de titel dat boven de select box staat de titel kan veranderd worden in single_post.php op lijn 46 -->
                <label class="elementor-control-title">{{{ data.label }}}</label>
                <!-- hier maken we de select box (control2 select) hierin komen de titels van alle aangemaakte WordPress berichten -->
                <!-- alles wat in de select box komt willen we opslaan in data.name hiervoor gebruiken we javascript -->
                <select class="post-select" style="width:100%"></select>
                <!-- id van gekozen bericht opslaan data-setting vertelt Elementor dat dit moet worden opgeslagen data.name...  -->
                <input type="hidden" class="post-select-save-value" data-setting="{{ data.name }}" />
            
            </div>

        <?php

    }

}