/**
 * CMSMS Mailto Plugin for TinyMCE 7.x
 *
 * This plugin provides a rich user interface for creating and editing CMSMS {mailto} Smarty tags.
 * It uses a WYSIWYG approach by rendering a non-editable `<span>` placeholder in the editor,
 * which is converted to a pure Smarty tag on save.
 */
tinymce.PluginManager.add('mailto', function(editor, url) {

    // Read configuration from the global JS object defined in the main config file.
    const config = window.CMSMS_TINY_CONFIG;
    if (!config || !config.mailto) {
        console.error("CMSMS_TINY_CONFIG or its 'mailto' property was not found.");
        return;
    }
    const mailto_data = config.mailto;

    // Register a custom icon for the mailto button, using an image path from the config.
    editor.ui.registry.addIcon('cmsms-mailto-icon', `<img src="${mailto_data.image}" />`);

    /**
     * Opens the main dialog window for creating or editing a mailto tag.
     */
    const openDialog = function() {
        const selection = editor.selection;
        const dom = editor.dom;
        const selectedNode = selection.getNode();
        // Check if the current selection is inside one of our existing placeholders.
        const mailtoNode = dom.getParent(selectedNode, 'span.cmsms-mailto-placeholder');

        // Set up the default data structure for the dialog form.
        let initialData = {
            address: '',
            text: selection.getContent({ format: 'text' }), // Use selected text as default link text.
            subject: '',
            cc: '',
            bcc: '',
            body: '',
            encoding: 'none'
        };

        // Helper function to parse attributes from a Smarty-like tag string.
        const parseAttrs = (str) => {
            const attrs = {};
            const regex = /(\w+)\s*=\s*'([^']*)'/g;
            let match;
            while ((match = regex.exec(str)) !== null) { attrs[match[1]] = match[2]; }
            return attrs;
        };

        // If we are editing an existing placeholder, parse its data-smarty-tag attribute to pre-fill the form.
        if (mailtoNode) {
            const smartyTag = mailtoNode.getAttribute('data-smarty-tag') || '';
            const attrs = parseAttrs(smartyTag);
            initialData.address = attrs.address || '';
            initialData.text = mailtoNode.innerText;
            initialData.subject = attrs.subject || '';
            initialData.cc = attrs.cc || '';
            initialData.bcc = attrs.bcc || '';
            initialData.body = attrs.body || '';
            initialData.encoding = attrs.encode || 'none';
        }

        // Define the structure and behavior of the dialog window.
        const dialogConfig = {
            title: mailto_data.title,
            size: 'large',
            body: {
                type: 'tabpanel',
                tabs: [
                    {
                        name: 'general', title: 'General',
                        items: [
                            { type: 'input', name: 'address', label: 'Email Address', placeholder: 'name@example.com' },
                            { type: 'input', name: 'text', label: 'Link Text' },
                            { type: 'input', name: 'subject', label: 'Subject' }
                        ]
                    },
                    {
                        name: 'advanced', title: 'Advanced',
                        items: [
                            { type: 'input', name: 'cc', label: 'CC' },
                            { type: 'input', name: 'bcc', label: 'BCC' },
                            { type: 'textarea', name: 'body', label: 'Message Body' },
                            { 
                                type: 'listbox', name: 'encoding', label: 'Encoding',
                                items: [
                                    { text: 'None', value: 'none' },
                                    { text: 'Hex', value: 'hex' },
                                    { text: 'JavaScript', value: 'javascript' },
                                    { text: 'JavaScript Charcode', value: 'javascript_charcode' }
                                ]
                            }
                        ]
                    }
                ]
            },
            buttons: [ { type: 'cancel', text: 'Close' }, { type: 'submit', text: 'Save', primary: true }],
            initialData: initialData,
            
            // This function is executed when the user clicks the "Save" button.
            onSubmit: function(dialogApi) {
                const data = dialogApi.getData();
                if (!data.address) {
                    if (mailtoNode) dom.remove(mailtoNode); // If address is cleared, remove the placeholder.
                    dialogApi.close();
                    return;
                }

                // 1. Build the raw Smarty tag string from the form data. This is the "source of truth".
                let smartyTag = `{mailto address='${data.address}'`;
                const linkText = data.text || data.address;
                smartyTag += ` text='${linkText}'`;
                if (data.subject) smartyTag += ` subject='${data.subject}'`;
                if (data.cc) smartyTag += ` cc='${data.cc}'`;
                if (data.bcc) smartyTag += ` bcc='${data.bcc}'`;
                if (data.body) smartyTag += ` body='${data.body}'`;
                if (data.encoding && data.encoding !== 'none') smartyTag += ` encode='${data.encoding}'`;
                smartyTag += '}';

                // 2. Build the attributes for our simple, non-editable <span> placeholder.
                const placeholderAttrs = {
                    'class': 'cmsms-mailto-placeholder',
                    'data-smarty-tag': smartyTag,
                    'contenteditable': 'false' // Prevent the user from directly editing the placeholder text.
                };

                // 3. Use TinyMCE's DOM utility to safely create the HTML string for the placeholder.
                const placeholderHtml = dom.createHTML('span', placeholderAttrs, dom.encode(linkText));
                
                // 4. Insert the generated HTML into the editor, replacing the selection.
                editor.insertContent(placeholderHtml);
                
                dialogApi.close();
            }
        };
        
        editor.windowManager.open(dialogConfig);
    };
    
    // Add a custom context menu (right-click) for our placeholders.
    editor.ui.registry.addContextMenu('mailto', {
        update: function(element) {
            // Show the menu only if the element is (or is inside) our placeholder span.
            return dom.getParent(element, 'span.cmsms-mailto-placeholder') ? 'editmailto' : '';
        }
    });

    // Define the menu item that will appear on right-click.
    editor.ui.registry.addMenuItem('editmailto', {
        text: 'Edit Mailto Link',
        icon: 'cmsms-mailto-icon',
        onAction: openDialog // The action is to simply open our main dialog.
    });
    
    // Register the main toolbar button.
    editor.ui.registry.addButton('mailto', {
        tooltip: mailto_data.title,
        icon: 'cmsms-mailto-icon',
        onAction: openDialog,
        stateSelector: 'span.cmsms-mailto-placeholder' // Highlight the button when the cursor is on a placeholder.
    });
    
    // Register the main menu item (e.g., under the "Insert" menu).
    editor.ui.registry.addMenuItem('mailto', {
        text: mailto_data.text,
        icon: 'cmsms-mailto-icon',
        onAction: openDialog
    });
});