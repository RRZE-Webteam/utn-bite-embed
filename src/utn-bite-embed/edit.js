import {__} from '@wordpress/i18n';
import {
	InspectorControls,
	useBlockProps
} from '@wordpress/block-editor';
import {PanelBody, SelectControl, Placeholder} from '@wordpress/components';
import {useEffect} from '@wordpress/element';
import ServerSideRender from "@wordpress/server-side-render";
import biteSources from '../data-sources/bite-sources.json'

const allowedDe = biteSources.de || [];
const allowedEn = biteSources.en || [];

const allowedValues = [...allowedDe, ...allowedEn];

export default function Edit({attributes, setAttributes}) {
	const {data} = attributes;
	const blockProps = useBlockProps();

	useEffect(() => {
		if ('function' === typeof wp?.enqueueScript) {
			wp.enqueueScript('utn-bite-embed');
		}
	}, []);

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={__('Bite Embed Settings', 'utn-bite-embed')}
					initialOpen={true}
				>
					<SelectControl
						label={__('Select a data listing', 'utn-bite-embed')}
						value={data}
						onChange={(newValue) => setAttributes({data: newValue})}
						options={[
							{label: '---', value: ''}, // The "placeholder" option
							...allowedValues.map((item) => ({
								label: item,
								value: item,
							})),
						]}
					/>
				</PanelBody>
			</InspectorControls>
			<div {...blockProps}>
				<Placeholder>
					<div>
						<h2>Select the BITE Data Source</h2>
						<hr/>
						<SelectControl
							label={__('Select a data listing', 'utn-bite-embed')}
							value={data}
							onChange={(newValue) => setAttributes({data: newValue})}
							options={[
								{label: '---', value: ''}, // The "placeholder" option
								...allowedValues.map((item) => ({
									label: item,
									value: item,
								})),
							]}
						/>
					</div>
				</Placeholder>
			</div>
		</>
	);
}
