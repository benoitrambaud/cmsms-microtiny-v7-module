<?php
// A
$lang['admindescription'] = 'Upgrades the core MicroTiny editor to TinyMCE v7, providing a modern, feature-rich editing experience with advanced CMSMS integration for linking and file management.';

// B
$lang['browse'] = 'Browse';

// C
$lang['cancel'] = 'Cancel';
$lang['class'] = 'Class';
$lang['cmsms_linker'] = 'Link to CMSMS Page';
$lang['css_styles_help'] = 'CSS-stylenames specified here are added to a dropdown box in the editor. Leaving the input field empty will keep the dropdown box hidden (default behavior).';
$lang['css_styles_help2'] = 'The styles can either be just the class name, or a classname with a new name to show.<br />
Must be separated by either commas or newlines.<br />
Example: mystyle1, My style name=mystyle2<br />
Result: a dropdown containing 2 entries, \'mystyle1\' and \'My style name\' resulting in the insertion of mystyle1, and mystyle2 respectively.<br />
Note: No checking for the actual existence of the stylenames is done. They are used blindly.';
$lang['css_styles_text'] = 'CSS Styles';

// D
$lang['description'] = 'Description';
$lang['dimensions'] = 'WxH';
$lang['dimension'] = 'Dimension';
$lang['dirinfo'] = 'Change working directory to';

// E
$lang['edit_image'] = 'Edit Image';
$lang['edit_profile'] = 'Edit Profile';
$lang['error_cantchangesysprofilename'] = 'You cannot change the name of a system profile';
$lang['error_missingparam'] = 'A required parameter was missing';
$lang['error_nopage'] = 'No page alias selected';
$lang['example'] = 'MicroTiny example';

// F
$lang['filepickertitle'] = 'CMSMS File picker';
$lang['friendlyname'] = 'MicroTinyV7 WYSIWYG editor';
$lang['fileview'] = 'File View';
$lang['filename'] = 'File Name';
$lang['filterby'] = 'Filter by';

// H
$lang['height'] = 'Height';
$lang['help'] = <<<EOT
<h3>What Does This Do?</h3>
<p><strong>MicroTinyV7</strong> is a modern, powerful replacement for the core MicroTiny module. It upgrades the editor to the latest stable version of <a href="https://www.tiny.cloud" target="_blank">TinyMCE</a>, providing a feature-rich, true WYSIWYG experience for editing content in CMS Made Simple.</p>
<p>It integrates seamlessly with content blocks on pages, module admin forms, and supports frontend editing, offering significantly more power and a better user experience than the original editor.</p>
<p>To use MicroTinyV7, you must select it as your WYSIWYG editor in your user preferences. Please go to "My Preferences > User Preferences" and choose "MicroTinyV7" from the "Select WYSIWYG to Use" dropdown menu.</p>

<h3>Upgraded Features</h3>
<p>This module is not just a version update; it's a complete overhaul of the editing experience with deep integration into CMSMS:</p>
<ul>
  <li><strong>Latest TinyMCE v7 Core:</strong> Enjoy a modern UI, enhanced performance, and a stable, powerful API.</li>
  <li><strong>Advanced CMSMS Linker:</strong> A completely rewritten internal linking tool with live, as-you-type page search and an intelligent editing workflow.</li>
  <li><strong>Full FilePicker Integration:</strong> Seamlessly uses the official CMSMS FilePicker module, including directory navigation and file uploads, with correct URL path resolution.</li>
  <li><strong>Professional Mailto Plugin:</strong> A powerful tool for creating and editing <code>{mailto}</code> Smarty tags. It uses visual placeholders in the editor (e.g., 📧 email@address.com) that are converted to pure Smarty tags on save. The dialog supports all parameters, including subject, cc, bcc, body, and encoding.</li>
  <li><strong>Custom Editor Styling:</strong> A dedicated stylesheet is loaded within the editor to style custom elements like the mailto placeholder, providing a true WYSIWYG feel.</li>
  <li><strong>Customizable Profiles:</strong> Retains the ability to configure separate profiles for Admin and Frontend editors.</li>
</ul>

<h3>How do I use it?</h3>
  <ul>
    <li>Install the module from the Module Manager.</li>
    <li>Select MicroTinyV7 as your WYSIWYG editor of choice in "My Preferences > User Preferences".</li>
    <li>(Optional) Customize the Admin and Frontend profiles under "Extensions > MicroTinyV7".</li>
  </ul>

<h3>About HTML, TinyMCE, and Content Editing</h3>
  <ul>
    <li><strong>WYSIWYG Environment:</strong>
       <p>This editor provides a high-fidelity environment that closely matches the final output on your website. However, differences can still occur due to complex site-specific stylesheets or advanced HTML structures not represented in the editor's style dropdowns.</p>
    </li>

    <li><strong>Content Editing, Not Site Design:</strong>
      <p>As with any CMS, the WYSIWYG editor is intended for managing content within predefined areas of your page templates. It is a powerful tool for content editors, not a website design tool. Complex layout and design should be handled within your site's templates and stylesheets.</p>
    </li>

    <li><strong>Smarty Tags in Content:</strong>
      <p>While this editor is more robust, it is still a best practice to avoid mixing complex Smarty logic directly within WYSIWYG-enabled content areas. For pages requiring heavy Smarty logic, consider using non-WYSIWYG content blocks and restricting edit access to knowledgeable users.</p>
      <p>The custom Mailto plugin is an exception, as it is specifically designed to manage the <code>{mailto}</code> tag in a user-friendly way.</p>
    </li>
  </ul>

<h3>About Images and Media</h3>
  <p>This module integrates with the official CMSMS <strong>FilePicker</strong> module. When you click the "Browse" icon in the Image or Media dialogs, it will open the full-featured FilePicker, allowing you to navigate, upload, and select files. This provides a much more powerful and consistent experience than the original MicroTiny file browser.</p>

<h3>FAQ:</h3>
  <dl>
    <dt>Q: How do I add more plugins or buttons to the toolbar?</dt>
      <dd>A: The toolbars and available plugins can be configured by editing the Admin and Frontend profiles under "Extensions > MicroTinyV7". You can enable or disable many of TinyMCE's standard plugins and arrange the toolbar buttons to fit your needs.</dd>
    <br/>
    <dt>Q: I cannot get the MicroTinyV7 editor to work in the Admin interface. What can I do?</dt>
      <dd>A: Please check the following:
        <ol>
          <li>Check the CMSMS Admin log, your server's PHP error log, and your browser's JavaScript console for errors.</li>
          <li>Ensure that MicroTinyV7 is selected as the "WYSIWYG to use" in your user preferences.</li>
          <li>Verify that the WYSIWYG is not disabled for the specific content block in the page template (e.g., <code>{content wysiwyg=false}</code>).</li>
        </ol>
      </dd>
    <br/>
    <dt>Q: How do I insert a line break (<code><br/></code>) instead of a new paragraph?</dt>
      <dd>A: Press [Shift]+[Enter] instead of just the [Enter] key.</dd>
  </dl>

<h3>Caching:</h3>
  <p>To improve performance, MicroTinyV7 generates and caches its JavaScript configuration file. This cache is automatically refreshed when settings change. This functionality can be disabled for debugging purposes by adding <code>\$config["mt_disable_cache"] = true;</code> to your config.php file.</p>

<h3>See Also:</h3>
<ul>
  <li>The <code>{content}</code> and <code>{cms_textarea}</code> tags in the "Extensions > Tags" help section.</li>
  <li>The official <a href="https://www.tiny.cloud/docs/tinymce/7/" target="_blank">TinyMCE Documentation</a> for more information on the editor itself.</li>
</ul>
EOT;

// I
$lang['image'] = 'Image';
$lang['info_linker_autocomplete'] = 'Begin by typing a few characters...';

// L
$lang['loading_info'] = 'Loading...';

// M
$lang['mailto_image'] = 'Create a mail image';
$lang['mailto_text'] = 'Create a mail link';
$lang['mailto_title'] = 'Create a mail link';
$lang['msg_cancelled'] = 'Operation canceled';
$lang['mthelp_allowcssoverride'] = 'If enabled, then any code that initializes a MicroTiny WYSIWYG area will be able to specify the name of a stylesheet to use instead of the default stylesheet specified above.';
$lang['mthelp_dfltstylesheet'] = 'Associate a stylesheet with editors using this profile.  This allows the WYSIWYG editor to appear similar to the website appearance.';
$lang['mthelp_profileallowimages'] = 'Allow the editor to embed images and videos into the text area.  For very tightly controlled designs the content editors may only be able to select images, or videos for specific areas of a web page.';
$lang['mthelp_profileallowtables'] = 'Allow the editor to embed and manipulate tables for tabular data.  Note:  This should not be used for controlling page layout, but only for tabular data.';
$lang['mthelp_profilelabel'] = 'A description for this profile.  The description cannot be edited for system profiles.';
$lang['mthelp_profilename'] = 'The name for this profile.  The name of system profiles cannot be edited.';
$lang['mthelp_profilemenubar'] = 'Indicates if the menubar should be enabled in the viewable profiles.  The menubar typically has more options than the toolbar';
$lang['mthelp_profilestatusbar'] = 'This flag indicates if the statusbar at the bottom of the WYSIWYG area should be enabled.  The status bar displays some useful scope information for advanced editors, and other useful information';
$lang['mthelp_profileresize'] = 'This flag indicates if the WYSIWYG area can be resized.  In order for resize abilities to work the statusbar must be enabled';

// N
$lang['newwindow'] = 'New window';
$lang['none'] = 'None';

// O
$lang['ok'] = 'Ok';

// P
$lang['prompt_linker'] = 'Enter Page title';
$lang['prompt_linktext'] = 'Link Text';
$lang['prompt_profiles'] = 'Profiles';
$lang['prompt_selectedalias'] = 'Selected Page alias';
$lang['profiledesc___admin__'] = 'This profile is used by all users who are authorized to use this editor, and have chosen this editor as their WYSIWYG editor';
$lang['profiledesc___frontend__'] = 'This profile is used for all frontend requests where this WYSIWYG editor is allowed';
$lang['profile_admin'] = 'Admin Editors';
$lang['profile_allowcssoverride'] = 'Allow blocks to override the selected stylesheet';
$lang['profile_allowimages'] = 'Allow images';
$lang['profile_allowresize'] = 'Allow resize';
$lang['profile_allowtables'] = 'Allow tables';
$lang['profile_dfltstylesheet'] = 'Stylesheet for editor';
$lang['profile_frontend'] = 'Frontend Editors';
$lang['profile_label'] = 'Label';
$lang['profile_name'] = 'Profile name';
$lang['profile_menubar'] = 'Show menubar';
$lang['profile_showstatusbar'] = 'Show statusbar';
$lang['prompt_name'] = 'Name';
$lang['prompt_target'] = 'Target';
$lang['prompt_class'] = 'Class attribute';
$lang['prompt_email'] = 'Email address';
$lang['prompt_insertmailto'] = 'Insert/edit a mail link';
$lang['prompt_anchortext'] = 'Anchor text';
$lang['prompt_rel'] = 'Rel attribute';
$lang['prompt_texttodisplay'] = 'Text to display';

// S
$lang['savesettings'] = 'Save settings';
$lang['settings'] = 'Settings';
$lang['settingssaved'] = 'Settings saved';
$lang['size'] = 'Size';
$lang['submit'] = 'Submit';
$lang['switchgrid'] = 'Switch to grid view';
$lang['switchlist'] = 'Switch to list view';
$lang['switchimage'] = 'Show image files';
$lang['switchvideo'] = 'Show video files';
$lang['switchaudio'] = 'Show audio files';
$lang['switcharchive'] = 'Show archive files';
$lang['switchfiles'] = 'Show files';
$lang['switchreset'] = 'Show all';

// T
$lang['tooltip_selectedalias'] = 'This field is read only';
$lang['title_cmsms_linker'] = 'Create a link to a CMSMS content page';
$lang['title_cmsms_filebrowser'] = 'Select a file';
$lang['title_edit_profile'] = 'Edit profile';
$lang['tmpnotwritable'] = 'The configuration could not be written to the tmp directory! Please fix this...';
$lang['tab_general_title'] = 'General';
$lang['tab_advanced_title'] = 'Advanced';
$lang['type'] = 'Type';

// U
$lang['usestaticconfig_help'] = 'This generates a static configuration file instead of the dynamic one. Works better on some servers (for instance when running PHP as CGI)';
$lang['usestaticconfig_text'] = 'Use static config';

// W
$lang['width'] = 'Width';

// V
$lang['view_source'] = 'View Source';

// Y
$lang['youareintext'] = 'Current Directory';

?>