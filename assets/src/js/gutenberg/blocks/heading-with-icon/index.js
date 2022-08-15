import {registerBlockType} from '@wordpress/blocks';
import {__} from '@wordpress/i18n';
import { RichText} from '@wordpress/block-editor'
import Edit from './edit';

// Register the block
registerBlockType( 'aquila-blocks/heading', {
    title: __('Heading with Icon', 'aquila'),
    description:  __("Add heading and select icon", 'aquila'),
    icon: 'admin-customizer',
    category:'aquila',
    attributes:{
        options:{
            type: 'string',
            default: 'dos'
        },
        content: {
            type: 'string',
            source: 'html',
            selector: 'h4',
            default: __('Dos', 'aquila')
        },
    },

    edit: Edit,
    save({attributes: {content}}) {
        console.warn('save', content);
        return (
            <div className="aquila-icon-heading">
                <span className="aquila-icon-heading__heading"/>
            <RichText.Content tag="h4" value={content}/>
            </div>
        )
    },
} );