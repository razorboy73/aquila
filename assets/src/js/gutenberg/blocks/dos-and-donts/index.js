import {registerBlockType} from '@wordpress/blocks';
import {__} from '@wordpress/i18n';
import { InnerBlocks} from '@wordpress/block-editor';


import Edit from './edit';


// Register the block
registerBlockType( 'aquila-blocks/dos-and-donts', {
    title: __( "Dos and dont's", 'aquila' ),
    description: __( 'Add headings and text', 'aquila' ),
    icon: 'editor-table',
    category:'aquila',
    edit: Edit,
    save() {
        return (
            <div className="aquila-dos-and-donts">
               <InnerBlocks.Content />
            </div>
        )
    },
} );