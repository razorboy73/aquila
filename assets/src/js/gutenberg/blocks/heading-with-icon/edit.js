import { InspectorControls, RichText } from "@wordpress/block-editor";
import { PanelBody, RadioControl } from "@wordpress/components";
import { __ } from "@wordpress/i18n";
import{getIconComponent} from './icons-map';

const Edit = ({className,attributes, setAttributes}) => {

    const {option, content} = attributes;
    console.warn('option: ', option);
// get the icon
    const HeadingIcon = getIconComponent(option);
    console.warn('options and component', option, HeadingIcon);



    return (
        <div className="aquila-icon-heading">
            <span className="aquila-icon-heading__heading">
                <HeadingIcon/>
            </span>
            <RichText
                tagName="h4"
                className={className}
                value = {content}
                onChange={(content) => setAttributes({content:content})}
                placeholder={__('Write your heading here','aquila')}
               
            /> 
            <InspectorControls>
                <PanelBody
                title = {__('Block Settings', 'aquila')}
                >
                    <RadioControl
                    label={__('Select Icon', 'aquila')}
                    help="Controls icon selection"
                    selected={ option }
                    options={ [
                        { label: __('Do\'s', 'aquila'), value: 'dos' },
                        { label: __('Don\'ts', 'aquila'), value: 'donts' },
                    ] }
                    onChange={ ( option ) => { setAttributes({option}) } }
                />

                </PanelBody>
            </InspectorControls>
            
        </div>
    );
}

export default Edit;