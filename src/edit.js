/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, RangeControl } from '@wordpress/components';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */

export default function Edit(props) {
  const { attributes: { size }, setAttributes } = props;

	const blockProps = useBlockProps();

const onChangeSize = (newSize) => {
    setAttributes({ size: newSize });
};

	return (
    <>
      <InspectorControls>
        <PanelBody title={__('Pixel Art Settings', 'pixel-art-block')}>
          <RangeControl
            label={__('Size', 'pixel-art-block')}
            value={size}
            onChange={onChangeSize}
            min={128}
            max={200}
          />
        </PanelBody>
      </InspectorControls>
      <div {...blockProps}>
        Pixel Art Drawing Placeholder
      </div>
    </>
	);
}
