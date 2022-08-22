/**
 * Register block styles.
*/


import {registerBlockStyle} from '@wordpress/blocks';
import {__} from '@wordpress/i18n';



/**
 * Quote Block Styles
 * 
 * @type {Array}
 */
//add styling in _quote.scss
//import to blocks.scss
const layoutStyleQuote =[
    {
        name: 'layout-dark-background',
        label:__('Layout style dark background', 'aquila')
    }
]

//create different layouts in an array
//The name argument becomes the class prepended by “is-style”
//us this class for styling
//loop through the array and register these items
//register when dom is ready
//import it to blocks.scss
// then importimport to src/js/blocks.js


const layoutStyleButton = [

    {name: 'layout-border-blue-fill',
    label: __('Blue outline', 'aquila')
    },
    {name: 'layout-border-white-no-fill',
    label: __('White outline - to be used with dark background', 'aquila')
    }
];

const register = () => {

    layoutStyleQuote.forEach((layoutStyle)=> registerBlockStyle(
        'core/quote',
        layoutStyle

        )
    );
    layoutStyleButton.forEach(layoutStyle => registerBlockStyle(
        'core/button',
        layoutStyle
    ))
}

/**
 * register style on dom ready
 */

wp.domReady( () =>{
    register();
})