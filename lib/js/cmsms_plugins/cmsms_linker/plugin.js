/**
 * CMSMS Linker Plugin for TinyMCE 7.x
 *
 * This plugin provides a rich user interface for creating and editing internal links
 * to CMS Made Simple content pages. It features a live, asynchronous page search
 * and an intelligent editing workflow.
 */
tinymce.PluginManager.add('cmsms_linker', function(editor, url) {

    // Read configuration from the global JS object defined in the main config file.
    const config = window.CMSMS_TINY_CONFIG;
    if (!config || !config.linker) {
        console.error("CMSMS_TINY_CONFIG or its 'linker' property was not found.");
        return;
    }
    const linker_data = config.linker;

    // Register a custom icon for the linker button, using an image path from the config.
    editor.ui.registry.addIcon('cmsms-link-icon', `<img src="${linker_data.image}" />`);

    /**
     * Opens the main dialog window for creating or editing a link.
     */
    const openDialog = function() {
        const selection = editor.selection;
        const dom = editor.dom;
        const selectedElm = selection.getNode();
        const anchorElm = dom.getParent(selectedElm, 'a[href]');

        // Gather initial data from the selected element, if any, to pre-fill the form.
        let initialData = {
            page: '', alias: '', text: anchorElm ? (anchorElm.innerText || anchorElm.textContent) : selection.getContent({ format: 'text' }),
            href: anchorElm ? dom.getAttrib(anchorElm, 'href') : '', target: anchorElm ? dom.getAttrib(anchorElm, 'target') : '',
            classname: anchorElm ? dom.getAttrib(anchorElm, 'class') : '', rel: anchorElm ? dom.getAttrib(anchorElm, 'rel') : ''
        };
        if (selectedElm.nodeName === 'IMG') { initialData.text = ''; }

        let debounceTimeout;
        let currentLinkFullLabel = null; // Stores the full label (e.g., "Home (1)") of the link being edited.

        /**
         * Performs a live search via fetch and populates the results panel in the dialog.
         * @param {string} query The search term.
         * @param {Object} dialogApi The API instance of the current dialog.
         */
        const performSearch = (query, dialogApi) => {
            const resultsPanel = document.querySelector('.cmsms-linker-results');
            if (!resultsPanel) return;

            // Apply debounce only when the user is actively typing.
            const applyDebounce = (query === dialogApi.getData().page);
            
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                fetch(`${linker_data.autocomplete_url}&term=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(results => {
                        if (results && results.length > 0) {
                            let html = '<ul style="list-style: none; margin: 0; padding: 0;">';
                            results.forEach(item => {
                                // Highlight the currently selected link in the results list for better UX.
                                let liStyle = 'cursor: pointer; padding: 5px 8px; border-bottom: 1px solid #eee;';
                                if (item.label === currentLinkFullLabel) {
                                     liStyle += ' background-color: #d4edda; font-weight: bold;';
                                }
                                html += `<li style="${liStyle}" data-alias="${item.value}" data-label="${item.label}">${item.label}</li>`;
                            });
                            html += '</ul>';
                            resultsPanel.innerHTML = html;

                            // Add event listeners to each dynamically created result item.
                            resultsPanel.querySelectorAll('li').forEach(li => {
                                li.onmouseover = () => { if (li.getAttribute('data-label') !== currentLinkFullLabel) li.style.backgroundColor = '#e0e0e0'; };
                                li.onmouseout = () => { if (li.getAttribute('data-label') === currentLinkFullLabel) li.style.backgroundColor = '#d4edda'; else li.style.backgroundColor = 'transparent'; };
                                li.onclick = () => {
                                    const fullLabel = li.getAttribute('data-label');
                                    const alias = li.getAttribute('data-alias');
                                    
                                    // Update dialog data with the new selection.
                                    dialogApi.setData({ page: fullLabel, alias: alias, href: `{cms_selflink href='${alias}'}` });
                                    dialogApi.setEnabled('alias', false);
                                    currentLinkFullLabel = fullLabel;
                                    
                                    // Clean the title and re-run the search to provide context and show other potential matches.
                                    const match = fullLabel.match(/^(.*?)\s*\(\s*[\d.]+\s*\)$/);
                                    let pageTitleOnly = match ? match[1].trim() : fullLabel;
                                    performSearch(pageTitleOnly, dialogApi);
                                };
                            });
                        } else {
                            resultsPanel.innerHTML = `<p style="padding: 5px 8px; color: #777;">${linker_data.no_results || 'No results found.'}</p>`;
                        }
                    }).catch(error => { console.error('Autocomplete fetch error:', error); });
            }, applyDebounce ? 300 : 0);
        };

        // Main configuration object for the dialog window.
        const dialogConfig = {
            title: linker_data.title, width: 750, height: 520,
            body: {
                type: 'tabpanel',
                tabs: [
                    {
                        name: 'general', title: linker_data.tab_general,
                        items: [
                            { type: 'input', name: 'page', label: linker_data.prompt_page, placeholder: linker_data.prompt_page_info },
                            { type: 'htmlpanel', name: 'searchresults', html: '<div class="cmsms-linker-results" style="height: 150px; overflow-y: auto; border: 1px solid #ccc; background: #fdfdfd; border-radius: 3px;"></div>' },
                            { type: 'input', name: 'alias', label: linker_data.prompt_alias, disabled: true },
                            { type: 'input', name: 'text', label: linker_data.prompt_text },
                            { type: 'input', name: 'href', visible: false } // Hidden field for the final {cms_selflink} tag.
                        ]
                    },
                    {
                        name: 'advanced', title: linker_data.tab_advanced,
                        items: [
                            { type: 'listbox', name: 'target', label: linker_data.prompt_target, items: [ { text: linker_data.target_none, value: '' }, { text: linker_data.target_new_window, value: '_blank' } ] },
                            { type: 'input', name: 'classname', label: linker_data.prompt_class },
                            { type: 'input', name: 'rel', label: linker_data.prompt_rel }
                        ]
                    }
                ]
            },
            buttons: [ { type: 'cancel', text: 'Close' }, { type: 'submit', text: 'Save', primary: true }],
            initialData: initialData,
            
            // Trigger search when the user types in the 'page' field.
            onChange: function(dialogApi, details) {
                if (details.name === 'page') {
                    currentLinkFullLabel = null; // Reset visual selection when user types a new search.
                    const query = dialogApi.getData().page;
                    performSearch(query, dialogApi);
                }
            },
            
            // Handle link insertion or update when the user clicks "Save".
            onSubmit: function(dialogApi) {
                const data = dialogApi.getData();
                if (!data.href) { editor.execCommand('unlink'); dialogApi.close(); return; }
                const linkAttrs = { href: data.href, target: data.target ? data.target : null, rel: data.rel ? data.rel : null, class: data.classname ? data.classname : null };
                if (anchorElm) { // If editing an existing link, update its attributes.
                    editor.dom.setAttribs(anchorElm, linkAttrs);
                    if (data.text !== initialData.text) { anchorElm.innerText = data.text; }
                    editor.selection.select(anchorElm);
                } else { // Otherwise, create a new link.
                    editor.insertContent(editor.dom.createHTML('a', linkAttrs, editor.dom.encode(data.text)));
                }
                dialogApi.close();
            }
        };
        
        // Open the dialog and get its API instance.
        const dialogApi = editor.windowManager.open(dialogConfig);

        // If editing an existing cms_selflink, pre-populate the dialog with its information.
        if (initialData.href.indexOf('cms_selflink') !== -1) {
            const r = initialData.href.match(/href='([^']*)'/);
            if (r && r.length >= 2) {
                const alias = r[1];
                dialogApi.setData({ page: linker_data.loading_info });
                fetch(`${linker_data.autocomplete_url}&alias=${alias}`)
                    .then(response => response.json())
                    .then(res => {
                        if (res && res.label) {
                            currentLinkFullLabel = res.label;
                            // Extract just the page title to trigger a search for all similar pages.
                            const match = res.label.match(/^(.*?)\s*\(\s*[\d.]+\s*\)$/);
                            let pageTitleOnly = match ? match[1].trim() : res.label;
                            dialogApi.setData({ page: pageTitleOnly });
                            // Manually trigger a search to provide context to the user.
                            performSearch(pageTitleOnly, dialogApi);
                        }
                    });
            }
        }
    };

    // Register the main toolbar button.
    editor.ui.registry.addButton('cmsms_linker', { tooltip: linker_data.title, icon: 'cmsms-link-icon', onAction: openDialog, stateSelector: 'a[href]' });
    
    // Register the main menu item (e.g., under the "Insert" menu).
    editor.ui.registry.addMenuItem('cmsms_linker', { text: linker_data.text, icon: 'cmsms-link-icon', onAction: openDialog, stateSelector: 'a[href]' });
});