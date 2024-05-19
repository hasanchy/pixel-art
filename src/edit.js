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

	const blockProps = useBlockProps({
    className: 'pixel-art-block',
    style: { fontSize: size + 'px', lineHeight: '1' }
});

const onChangeSize = (newSize) => {
    setAttributes({ size: newSize });
};

	const svg = (
		<svg width={size} height={size} xmlns="http://www.w3.org/2000/svg">
  <rect width="16" height="16" x="0" y="0" fill="red" />
  <rect width="32" height="32" x="32" y="0" fill="gold" />
  <rect width="32" height="32" x="64" y="0" fill="red" />
  <rect width="32" height="32" x="96" y="0" fill="#000" />
  <rect width="32" height="32" x="0" y="32" fill="orange" />
  <rect width="32" height="32" x="32" y="32" fill="red" />
  <rect width="32" height="32" x="64" y="32" fill="purple" />
  <rect width="32" height="32" x="96" y="32" fill="grey" />
  <rect width="32" height="32" x="0" y="64" fill="blue" />
  <rect width="32" height="32" x="32" y="64" fill="cyan" />
  <rect width="32" height="32" x="64" y="64" fill="pink" />
  <rect width="32" height="32" x="96" y="64" fill="red" />
  <rect width="32" height="32" x="0" y="96" fill="rose" />
  <rect width="32" height="32" x="32" y="96" fill="purple" />
  <rect width="32" height="32" x="64" y="96" fill="orange" />
  <rect width="32" height="32" x="96" y="96" fill="yellow" />
  Sorry, your browser does not support inline SVG.  
</svg>
	);

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
        Here
        {svg}
      </div>
    </>
	);
}
