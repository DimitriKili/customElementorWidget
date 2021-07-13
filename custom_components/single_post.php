<?php

namespace WPC;

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}


class Single_Post extends \Elementor\Widget_Base
{

  public function get_name()
  {
    return 'single-post';
  }

 //dit de de titel van de widget in de elementor tool bar
  public function get_title()
  {
    return 'Post';
  }

//icoon van de widget
  public function get_icon()
  {
    return 'fa fa-grip-vertical';
  }
//de basis getegorien
  public function get_categories()
  {
    return ['basic'];
  }

  protected function _register_controls() {
    //dit is de inhoud  tab
    $this->start_controls_section('post_selection', [
        'label' => 'Bericht',
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT
    ]);

    //hier kunnen we de naam verandere dat boven de control2 select komt 
    //post wordt in post_select.php gezet bij data.name op lijn 32
    //label wordt in post_select.php gezet bij data.label op lijn 28
    $this->add_control('post', [
        'label' => 'bericht',
        'type' => 'wpc-post-select',
    ]);
    
    
    //deze switcher laat de titel zien of niet
    $this->add_control(
			'show_title',
			[
				'label' => __( 'Show title' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

    //hier kan je de kleur aanpassen van de titel
    $this->add_control(
			'title_color',
			[
				'label' => __( 'change color title'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				],
			]
		);

    //deze switcher laat de beschrijving (eerste tekst) zien of niet
    $this->add_control(
			'show_excerpt',
			[
				'label' => __( 'Show excerpt, first tekst'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

    //hier kan je de kleur aanpassen van de beschrijving  (eerste tekst) 
    $this->add_control(
			'excerpt_color',
			[
				'label' => __( 'change color first tekst'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				],
			]
		);

    //deze switcher laat de tweede beschrijving (tweede tekst) zien of niet
    $this->add_control(
			'show_content',
			[
				'label' => __( 'Show content, second tekst'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


    //deze switcher laat de thumbnail foto zien of niet
    $this->add_control(
			'show_thumbnail',
			[
				'label' => __( 'Show thumbnail'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
		  ]
		);

   


    $this->end_controls_section();
  }





  protected function render() {


     //echo 'yooooooo';

    $settings = $this->get_settings_for_display();

    if(isset($settings['post']) && is_numeric($settings['post'])){
        $post = get_post($settings['post']);
        $selectedPost = $post->ID;
        ?>
          <div class="info-container" >
        <?php

          if ( 'yes' === $settings['show_title'] ) {
            echo '<h1 style="color: '. $settings['title_color'].'">'.$post->post_title.'</h1>';
          }

          if ( 'yes' === $settings['show_excerpt'] ) {
            echo '<p style="color: '. $settings['excerpt_color'].'">'.$post->post_excerpt.'</p>';
          }

          if ( 'yes' === $settings['show_content'] ) {
            echo '<p style="color: red">'.$post->post_content.'</p>';
          }
          if ( 'yes' === $settings['show_thumbnail'] ) {
            echo '<img class="single_post__thumbnail"; src="'.get_the_post_thumbnail($selectedPost).'';
          } 
        ?>
          </div>
        <?php
        //echo '<h1  class="single_post__title">'.$post->post_title.'</h1>';
        //echo '<p class="single_post__excerpt">'.$post->post_excerpt.'</p>';
        //echo '<p class="single_post__content">'.$post->post_content.'</p>';
        //echo '<img class="single_post__thumbnail"; src="'.get_the_post_thumbnail($selectedPost).'';

    }

  }

}
?>
<style>
/*hardcoded css voor de afbeelding */

.single_post__thumbnail{
  width: 300px;
  display: block;
  margin-left: auto;
  margin-right: auto;
} 

</style>