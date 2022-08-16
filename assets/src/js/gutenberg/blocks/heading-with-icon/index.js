import {registerBlockType} from '@wordpress/blocks';
import {__} from '@wordpress/i18n';
import { RichText, InspectorControls} from '@wordpress/block-editor'
import{PanelBody, RadioControl} from '@wordpress/components'

import Edit from './edit';
import{getIconComponent} from './icons-map';

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
    save({attributes: {option, content}}) {
        const HeadingIcon = getIconComponent(option);
        return (
            <div className="aquila-icon-heading">
                <span className="aquila-icon-heading__heading"/>
                <HeadingIcon/>
            <RichText.Content tagName="h4" value={content}/>
            </div>
        )
    },
} );