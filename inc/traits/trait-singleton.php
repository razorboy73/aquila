<?php
/**
 * Singleton trait which implements Singleton pattern in any class in which this trait is used.
 *
 * Using the singleton pattern in WordPress is an easy way to protect against
 * mistakes caused by creating multiple objects or multiple initialization
 * of classes which need to be initialized only once.
 *
 * With complex plugins, there are many cases where multiple copies of
 * the plugin would load, and action hooks would load (and trigger) multiple
 * times.
 *
 * If you're planning on using a global variable, then you should implement
 * this trait. Singletons are a way to safely use globals; they let you
 * access and set the global from anywhere, without risk of collision.
 *
 * If any method in a class needs to be aware of "state", then you should
 * implement this trait in that class.
 *
 * If any method in the class need to "talk" to another or be aware of what
 * another method has done, then you should implement this trait in that class.
 *
 * If you specifically need multiple objects, then use a normal class.
 *
 * @package Aquila
 */
//remember to include this in the functions.php
namespace AQUILA_THEME\Inc\Traits;

trait Singleton{

    protected function __construct(){
    }

    final public function __clone(){
    //prevents object cloning
    }

    //create get instance function to make sure it is used 
    //in different classes
    //The final keyword prevents child classes from overriding a method or 
    //constant by prefixing the definition with final. If the class itself 
    //is being defined final then it cannot be extended.
    //make it static so it can be access without an instance of the class

    final public static function get_instance(){
        //returns a new or exsiting singleton instance of the class
        //create a variable to hold an instance of the class
        static $instance = [];
      
    
        //create a variable to hold the name of the class that has been
        //called
        // get_called_class Gets the name of the class the static method is called in.
        $called_class = get_called_class();
        //isset determines if a variable is declared and is different than null
        //check to see if an instance of the called class  has been set
        //if not, set it by adding it to the instance array
        if( !isset($instance[$called_class])){

            $instance[$called_class] = new $called_class();

            //if any of the plugins want to hook in, include a do action

            do_action( sprintf( 'aquila_theme_singleton_init_%s', $called_class ) ); // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores


        }
        
        return $instance[ $called_class ];

    }
}