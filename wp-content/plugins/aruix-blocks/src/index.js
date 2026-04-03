import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, RangeControl } from '@wordpress/components';

// Register the latest-projects block.
registerBlockType('aruix/latest-projects', {
    title: 'Latest Projects', // Block title in inserter.
    icon: 'list-view', // Dashicon for block type.
    category: 'widgets', // Category in block inserter.

    // Define block attributes (data stored with block).
    attributes: {
        postsToShow: {
            type: 'number', // Attribute type.
            default: 3 // Default value.
        }
    },

    // Editor render function.
    edit({ attributes, setAttributes }) {
        const { postsToShow } = attributes;
        return (
            <>
                {/* Sidebar settings panel */}
                <InspectorControls>
                    <PanelBody title="Settings">
                        <RangeControl
                            label="Number of Projects" // Label for the control.
                            value={postsToShow} // Current value.
                            onChange={(value) => setAttributes({ postsToShow: value })} // Update attribute.
                            min={1} // Minimum value.
                            max={10} // Maximum value.
                        />
                    </PanelBody>
                </InspectorControls>

                {/* Block preview in editor */}
                <p>Showing {postsToShow} projects (Preview)</p>
            </>
        );
    },

    // Save function - returns null for dynamic blocks.
    save() {
        return null;
    }
});