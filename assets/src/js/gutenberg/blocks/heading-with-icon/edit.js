import { RichText } from "@wordpress/block-editor";


const Edit = (props) => {

    const {content} = props.attributes;

    console.warn("edit attributes", props);

    return (
        <div className="aquila-icon-heading">
            <span className="aquila-icon-heading__heading"/>
            <RichText
                tagName="h4"
                className={props.className}
                value = {content}
                onChange={(content) => props.setAttributes({content:content})}
                placeholder='Write your heading here'
               
            /> 
            
        </div>
    );
}

export default Edit;