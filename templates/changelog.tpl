<h3>Version 1.0.0 - Initial Release</h3>

<p>This is the first stable release of MicroTinyV7, a complete replacement for the core MicroTiny editor in CMS Made Simple 2.x. This release focuses on modernization, robust integration, and an enhanced user experience.</p>

<h4><i class="fa fa-rocket"></i> Major Editor Upgrade</h4>
<ul>
    <li>The core editor has been upgraded from TinyMCE v4.x to the latest stable <strong>TinyMCE v7</strong>. This brings a modern user interface, significant performance improvements, and a more powerful API.</li>
</ul>

<h4><i class="fa fa-magic"></i> Completely Rewritten CMSMS Linker</h4>
<ul>
    <li>The internal page linker plugin has been rebuilt from the ground up for the new API.</li>
    <li>Features a <strong>live, as-you-type page search</strong> that queries the database asynchronously.</li>
    <li>An intelligent editing workflow pre-fills the search field and visually highlights the currently selected page in the results, making edits intuitive.</li>
</ul>

<h4><i class="fa fa-envelope"></i> Advanced Mailto Plugin with WYSIWYG Placeholders</h4>
<ul>
    <li>Full support for the native CMSMS <strong><code>{mailto}</code> Smarty tag</strong>.</li>
    <li>Introduces <strong>visual placeholders</strong> in the editor (e.g., 📧 email@address.com) for a true WYSIWYG experience. The placeholders are converted to pure Smarty tags on save, and back to placeholders on load.</li>
    <li>A tabbed dialog provides access to all <code>{mailto}</code> parameters, including <code>subject</code>, <code>cc</code>, <code>bcc</code>, <code>body</code>, and <code>encode</code>.</li>
    <li>Existing mailto placeholders can be easily edited via a <strong>right-click context menu</strong>.</li>
</ul>

<h4><i class="fa fa-image"></i> Robust FilePicker Integration</h4>
<ul>
    <li>Seamlessly integrates with the official CMSMS <strong>FilePicker module</strong>, restoring full functionality including directory navigation and file uploads.</li>
    <li>A custom JavaScript "shim" bridges the communication gap between the modern TinyMCE v7 API and the FilePicker's callback system.</li>
    <li>Correctly resolves all image and file paths based on the site's specific <code>uploads_url</code> configuration, eliminating broken links.</li>
</ul>

<h4><i class="fa fa-cogs"></i> Technical & Architectural Improvements</h4>
<ul>
    <li><strong>Custom Editor Styling:</strong> A dedicated <code>content.css</code> file is now loaded within the editor to style custom elements like the mailto placeholder.</li>
    <li><strong>Clean Code Architecture:</strong> All custom plugins are located in a dedicated <code>/cmsms_plugins</code> directory, completely separate from the core TinyMCE library, making future updates simple and safe.</li>
    <li><strong>Centralized Configuration:</strong> A global <code>CMSMS_TINY_CONFIG</code> JavaScript object is used to cleanly pass all necessary data from the CMSMS backend to the editor's plugins.</li>
</ul>