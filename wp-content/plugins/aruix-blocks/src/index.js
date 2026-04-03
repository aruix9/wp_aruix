import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, RangeControl, SelectControl } from '@wordpress/components';
import { registerBlockVariation } from '@wordpress/blocks';

import { useEffect, useState } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';

import './style.scss';
import './editor.scss';

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
        },
        layout: {
            type: 'string',
            default: 'list'
        }
    },

    // Editor render function.
    edit({ attributes, setAttributes }) {
        const { postsToShow } = attributes;
        const [projects, setProjects] = useState([]);

        useEffect(() => {
            apiFetch({ path: `/wp/v2/project?per_page=${postsToShow}` })
                .then(data => setProjects(data));
        }, [postsToShow]);

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
                        <SelectControl
                            label="Layout"
                            value={attributes.layout}
                            options={[
                                { label: 'List', value: 'list' },
                                { label: 'Grid', value: 'grid' }
                            ]}
                            onChange={(value) => setAttributes({ layout: value })}
                        />
                    </PanelBody>
                </InspectorControls>

                {/* Block preview in editor */}
                <div className={`aruix-projects ${attributes.layout}`}>
                    {projects.length === 0 ? (
                        <p>Loading...</p>
                    ) : (
                        projects.map(project => (
                            <p
                                key={project.id}
                                dangerouslySetInnerHTML={{
                                    __html: project.title.rendered
                                }}
                            />
                        ))
                    )}
                </div>
            </>
        );
    },

    // Save function - returns null for dynamic blocks.
    save() {
        return null;
    }
});

registerBlockVariation('aruix/latest-projects', {
    name: 'projects-list',
    title: 'Projects List',
    description: 'Display projects in list layout',
    attributes: {
        layout: 'list',
        postsToShow: 3
    },
    isDefault: true
});

registerBlockVariation('aruix/latest-projects', {
    name: 'projects-grid',
    title: 'Projects Grid',
    description: 'Display projects in grid layout',
    attributes: {
        layout: 'grid',
        postsToShow: 6
    }
});