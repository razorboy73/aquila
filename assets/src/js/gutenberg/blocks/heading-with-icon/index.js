import {registerBlockType} from '@wordpress/blocks';
import {__} from '@wordpress/i18n';


// Register the block
registerBlockType( 'aquila-blocks/heading', {
    title: __('Heading with Icon', 'aquila'),
    description:  __("Add heading and select icon", 'aquila'),
    icon: 'admin-customizer',
    category:'aquila',

    edit: function(){
        return <div> Hello world (from the editor)</div>;
    },
    save: function () {
        return <div> Hola mundo (from the frontend) </div>;
    },
} );