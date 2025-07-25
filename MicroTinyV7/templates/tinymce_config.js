/**
 * Main TinyMCE 7 Initialization Configuration for MicroTinyV7
 *
 * This file is a Smarty template that generates the final JavaScript configuration
 * for the TinyMCE editor instance. It bridges the gap between the PHP/CMSMS backend
 * and the client-side editor.
 */

// --- Define a global configuration object ---
// This object serves as a centralized namespace to safely pass server-side data
// (like language strings and URLs) from Smarty to our custom JavaScript plugins.
// This avoids polluting the global scope and makes the data easily accessible.
var CMSMS_TINY_CONFIG = {
    // The relative path to the site's uploads directory (e.g., "uploads").
    // This is crucial for correctly constructing file URLs.
    uploads_path: '{$uploads_path|escape:javascript}',
    // The base URL of the CMSMS installation.
    base_url: '{root_url}/',
    
    // Configuration specific to the cmsms_linker plugin.
    linker: {
        text: '{$MT->Lang('cmsms_linker')|escape:javascript}',
        title: '{$MT->Lang('title_cmsms_linker')|escape:javascript}',
        url: '{$linker_url}',
        autocomplete_url: '{$getpages_url}',
        image: '{$MT->GetModuleURLPath()}/lib/images/cmsmslink.gif',
        prompt_page: '{$MT->Lang('prompt_linker')|escape:javascript}',
        prompt_page_info: '{$MT->Lang('info_linker_autocomplete')|escape:javascript}',
        prompt_alias: '{$MT->Lang('prompt_selectedalias')|escape:javascript}',
        prompt_alias_info: '{$MT->Lang('tooltip_selectedalias')|escape:javascript}',
        prompt_text: '{$MT->Lang('prompt_texttodisplay')|escape:javascript}',
        prompt_class: '{$MT->Lang('prompt_class')|escape:javascript}',
        prompt_rel: '{$MT->Lang('prompt_rel')|escape:javascript}',
        prompt_target: '{$MT->Lang('prompt_target')|escape:javascript}',
        tab_general: '{$MT->Lang('tab_general_title')|escape:javascript}',
        tab_advanced: '{$MT->Lang('tab_advanced_title')|escape:javascript}',
        target_none: '{$MT->Lang('none')|escape:javascript}',
        target_new_window: '{$MT->Lang('newwindow')|escape:javascript}',
        loading_info: '{$MT->Lang('loading_info')|escape:javascript}'
    },
    
    // Configuration specific to the mailto plugin.
    mailto: {
        text: '{$MT->Lang('mailto_text')|escape:javascript}',
        title: '{$MT->Lang('mailto_image')|escape:javascript}',
        image: '{$MT->GetModuleURLPath()}/lib/images/mailto.gif',
        prompt_insert: '{$MT->Lang('prompt_insertmailto')|escape:javascript}',
        prompt_email: '{$MT->Lang('prompt_email')|escape:javascript}',
        prompt_anchor_text: '{$MT->Lang('prompt_anchortext')|escape:javascript}',
        prompt_link_text: '{$MT->Lang('prompt_linktext')|escape:javascript}'
    },
    
    // Configuration for the external FilePicker module.
    filepicker: {
        title: '{$MT->Lang('filepickertitle')|escape:javascript}',
        url: '{$filepicker_url}&field=',
        browser_title: '{$MT->Lang('title_cmsms_filebrowser')|escape:javascript}'
    }
};


// This is the actual tinymce initialization
tinymce.init({
    selector: '{if isset($mt_selector) && $mt_selector != ''}{$mt_selector}{else}textarea.MicroTinyV7{/if}',
    language: '{$languageid}',
    license_key: 'gpl', // Use the LGPL license to remove the evaluation notice.
    
    // Load our custom CMSMS integration plugins.
    external_plugins: {
        'cmsms_linker': '{$MT->GetModuleURLPath()}/lib/js/cmsms_plugins/cmsms_linker/plugin.js',
        'mailto': '{$MT->GetModuleURLPath()}/lib/js/cmsms_plugins/mailto/plugin.js'
    },
    
    // IMPORTANT: Allow our custom span and its data attribute for the mailto placeholder.
    // Without this, TinyMCE's cleanup process would strip our placeholder, breaking the functionality.
    extended_valid_elements: 'span[class|data-smarty-tag|contenteditable]',

    // General Settings
    document_base_url: '{root_url}/',
    relative_urls: true,
    menubar: {if (bool)$mt_profile.menubar}true{else}false{/if},
    statusbar: {if (bool)$mt_profile.showstatusbar}true{else}false{/if},
    resize: {if (bool)$mt_profile.allowresize}'bottom'{else}false{/if},
    browser_spellcheck: true,
    paste_as_text: true,

    // Load custom CSS for the editor content area. This styles our placeholders.
    content_css: '{$MT->GetModuleURLPath()}/css/content.css'
    {if isset($mt_cssname) && $mt_cssname != ''}
        , '{cms_stylesheet name=$mt_cssname nolinks=1}'
    {/if}
    ,

{if $isfrontend}
    // Simplified toolbar and plugins for frontend editing.
    toolbar: 'undo | bold italic underline | alignleft aligncenter alignright alignjustify indent outdent | bullist numlist | link{if $mt_profile.allowimages} | image{/if}',
    plugins: 'autolink lists hr pagebreak searchreplace wordcount code fullscreen insertdatetime link {if $mt_profile.allowimages} media image{/if} {if $mt_profile.allowtables}table{/if}',
{else}
    // Full-featured toolbar and plugins for the admin backend.
    image_advtab: true,
    toolbar: 'undo redo | cut copy paste | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify indent outdent | bullist numlist | anchor link unlink mailto cmsms_linker {if $mt_profile.allowimages} | image {/if}',
    plugins: 'autolink lists link mailto cmsms_linker charmap anchor searchreplace wordcount code fullscreen insertdatetime {if $mt_profile.allowtables}table{/if} {if $mt_profile.allowimages}media image{/if}',
{/if}
    
    // --- Callbacks ---
    // Handles URL conversion to respect CMSMS's relative URL structure.
    url_converter: {literal}function(url, node, on_save) {
        var activeEditor = tinymce.activeEditor;
        if (!activeEditor || !activeEditor.settings) return url;
        var settings = activeEditor.settings;
        if (!settings.convert_urls || (node && node.nodeName == 'LINK') || url.indexOf('file:') === 0 || url.length === 0) return url;
        if (url.indexOf('cms_selflink') != -1) {
            decodeURI(url);
            url = url.replace(/%20/g, ' ');
            return url;
        }
        if (settings.relative_urls) return activeEditor.documentBaseURI.toRelative(url);
        url = activeEditor.documentBaseURI.toAbsolute(url, settings.remove_script_host);
        return url;
    },{/literal}

    // Integrates with the external CMSMS FilePicker module.
    file_picker_callback: {literal}function(callback, value, meta) {
        const config = window.CMSMS_TINY_CONFIG.filepicker;
        if (!config) { console.error("Filepicker configuration not found."); return; }
        let picker_url = config.url;
        let picker_title = config.browser_title;
        if (meta.filetype === 'image') picker_title = 'Select an Image';
        if (meta.filetype === 'media') picker_title = 'Select Media';
        
        // This "shim" bridges the gap between the old FilePicker's communication method
        // and TinyMCE 7's modern postMessage API.
        if (!top.document.CMSFileBrowser) top.document.CMSFileBrowser = {};
        top.document.CMSFileBrowser.onselect = function(inst, file_rel_url) {
            const cmsms_config = window.CMSMS_TINY_CONFIG;
            let path_inside_uploads = file_rel_url.replace(/\\/g, '/');
            if (path_inside_uploads.startsWith('/')) path_inside_uploads = path_inside_uploads.substring(1);
            let final_url = cmsms_config.uploads_path + '/' + path_inside_uploads;
            window.parent.postMessage({ mceAction: 'setFile', url: final_url }, '*');
        };

        tinymce.activeEditor.windowManager.openUrl({
            title: picker_title, url: picker_url,
            width: 900, height: 600,
            buttons: [ { type: 'cancel', text: 'Close' } ],
            onMessage: function(dialogApi, message) {
                if (message.mceAction === 'setFile') {
                    const fileUrl = message.url;
                    let fileMeta = {};
                    function getBasename(path) { let base = path.substring(path.lastIndexOf('/') + 1); if (base.lastIndexOf(".") != -1) base = base.substring(0, base.lastIndexOf(".")); return base; }
                    if (meta.filetype === 'image') fileMeta.alt = getBasename(fileUrl);
                    if (meta.filetype === 'file') fileMeta.text = getBasename(fileUrl);
                    callback(fileUrl, fileMeta);
                    if (top.document.CMSFileBrowser) top.document.CMSFileBrowser.onselect = null;
                    dialogApi.close();
                }
            },
            onClose: function() {
                if (top.document.CMSFileBrowser) top.document.CMSFileBrowser.onselect = null;
            }
        });
    },{/literal}
    
    // Setup custom event handlers for placeholder conversion.
    setup: function(editor) {
        {literal}
        editor.on('change', function(e) {
            $(document).trigger('cmsms_formchange');
        });

        // Convert Smarty tags to visual placeholders when loading content into the editor.
        editor.on('BeforeSetContent', function(e) {
            if (e.content) {
                const regex = /\{mailto([^}]+)\}/g;
                e.content = e.content.replace(regex, function(match, attrsStr) {
                    const parseAttrs = (str) => {
                        const attrs = {};
                        const attrRegex = /(\w+)\s*=\s*'([^']*)'/g;
                        let attrMatch;
                        while ((attrMatch = attrRegex.exec(str)) !== null) { attrs[attrMatch[1]] = attrMatch[2]; }
                        return attrs;
                    };
                    const attrs = parseAttrs(attrsStr);
                    const linkText = attrs.text || attrs.address || 'mailto link';
                    const smartyTag = match.replace(/"/g, '"');
                    
                    // Build the placeholder using a simple, non-editable span.
                    return `<span class="cmsms-mailto-placeholder" data-smarty-tag="${smartyTag}" contenteditable="false">${linkText}</span>`;
                });
            }
        });

        // Convert placeholders back to raw Smarty tags when getting content (on save).
        editor.on('GetContent', function(e) {
            const doc = new DOMParser().parseFromString(e.content, 'text/html');
            const placeholders = doc.querySelectorAll('span.cmsms-mailto-placeholder');
            placeholders.forEach(function(placeholder) {
                const smartyTag = placeholder.getAttribute('data-smarty-tag');
                if (smartyTag) {
                    const textNode = doc.createTextNode(smartyTag);
                    placeholder.parentNode.replaceChild(textNode, placeholder);
                }
            });
            e.content = doc.body.innerHTML;
        });
        {/literal}
    }
});