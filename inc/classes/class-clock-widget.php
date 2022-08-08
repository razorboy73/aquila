<?php
/**
* Purpose of class: clock widget
 * 
* @package Aquila
*/
namespace AQUILA_THEME\Inc;
use AQUILA_THEME\Inc\Traits\Singleton;



/* widget process involves:
* 1. extending the class
* 2. register widget with register_widget(Name of Class )
* 3. add_action('widgets_init', function)
* 4 make sure there is a widget area called sidebar
* 5 Remember the impact of namespaces
*/
use WP_Widget;	


class Clock_Widget extends WP_widget{
use Singleton;
     public function __construct(){
         //actual widget process
         //construct: Set up your widget with a description, name, and display width in your admin.
                 parent::__construct(
                         'clock_widget',//foo_widget - Base ID
                         'Clock',// Foo_Widget -  Name
                         array('description'=> __(' ',''),) // (description and text domain)args
                 );
    }
         /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         * Process the widget options and display the HTML on your page. 
         * The args parameter provides the HTML you can use to display the widget
         * title class and widget content class.
         * @param array args     Widget arguments.  Display arguments including:
         * 'before_title', 'after_title', 'before_widget', and 'after_widget'.
         * @param array instance Saved values from database.
         */




    public function widget($args, $instance){
         //output content of widget on front end
         extract( $args );
        
         $title = apply_filters( 'widget_title', $instance['title'] );
         echo $before_widget;
         if ( ! empty( $title ) ) {
                 echo $before_title . $title . $after_title;
         }

         ?>
         <!-- clock code -->
         <section class="card">
            <div class="clock card-body">
                <span id="time"></span>
                <span id="ampm"></span>
                <span id="time-emoji"></span>
            </div>
         </section>
         <?php
         //echo __( 'Hello, World!', '' );// title and text domain
         echo $after_widget;
    }




         /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array instance Previously saved values from database.
         */
    public function form($instance){
         //output options form in the admin
                 if ( isset( $instance[ 'title' ] ) ) {
                    $title = $instance[ 'title' ];
                 }
                 else {
                    $title = __( 'Clock', '' );//'Default title', 'text_domain' 
                 }
                 ?>
                 <p>
                    <label for='<?php echo $this->get_field_name( 'title' ); ?>'><?php _e( 'Title:', 'aquila' ); ?></label>
                    <input class='widefat' id='<?php echo $this->get_field_id( 'title' ); ?>' name='<?php echo $this->get_field_name( 'title' ); ?>' type='text' value='<?php echo esc_attr( $title ); ?>' />
                  </p>
                 <?php
    }




         /**
         * Sanitize widget form values as they are saved.
         *
         * @see WP_Widget::update()
         *
         * @param array new_instance Values just sent to be saved.
         * @param array old_instance Previously saved values from database.
         *
         * @return array Updated safe values to be saved.
         */
    public function update($new_instance, $old_instance){
         //process widget options to be save to wp_options table
                 $instance = array();
                 $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
                 return $instance;
    }

}

