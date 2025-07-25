# MicroTinyV7 for CMS Made Simple

A modern TinyMCE 7 integration for CMS Made Simple 2.x. This module replaces the core MicroTiny editor, upgrading it from the outdated TinyMCE v4 to the powerful and modern TinyMCE v7.

## Why This Module?

CMS Made Simple 2.x is a stable and reliable platform, but its core WYSIWYG editor, MicroTiny, is locked to an older version of TinyMCE. This limits content editors and developers who want to leverage modern editor features.

**MicroTinyV7** is designed to bridge this gap, providing a feature-rich, modern editing experience without requiring a full migration to CMSMS 3.x. It is a self-contained, drop-in replacement that enhances the core functionality of CMSMS.

## Key Features

This module isn't just a version bump. It's a complete overhaul of the editor integration, with deep respect for the CMSMS ecosystem.

*   **🚀 TinyMCE 7 Upgrade:** The latest stable version of the powerful TinyMCE editor, with its modern UI, improved performance, and enhanced API.
*   **🔗 Advanced CMSMS Linker:** A completely rewritten internal linking tool with:
    *   Live, asynchronous page search as you type.
    *   A clean, tabbed interface for advanced options.
    *   Intelligent editing that shows all possible matches when you edit an existing link.
*   **🖼️ Native FilePicker Integration:** Seamlessly integrates with the official CMSMS `FilePicker` module.
    *   Uses the full-featured `FilePicker` interface, including directory navigation and file uploads.
    *   A custom "shim" ensures compatibility between the modern TinyMCE API and the `FilePicker`'s communication method.
    *   Correctly handles site-specific `uploads_url` configurations.
*   **✉️ Professional Mailto Plugin:** A powerful tool for creating `{mailto}` Smarty tags with a true WYSIWYG experience.
    *   **Visual Placeholders:** Inserts a clean, styled placeholder (e.g., 📧 `email@address.com`) in the editor instead of the raw `{mailto}` tag.
    *   **Full Parameter Support:** A tabbed dialog allows you to set all `{mailto}` parameters: `address`, `text`, `subject`, `cc`, `bcc`, `body`, and `encode`.
    *   **Smarty Tag Conversion:** Placeholders are automatically converted to pure `{mailto}` tags on save, and back to visual placeholders on load.
    *   **Right-Click Editing:** Easily edit existing mailto placeholders via a context menu.
*   **🎨 Custom Editor Styling:** Includes a `content.css` file to style custom elements (like the mailto placeholder) within the editor, providing a better visual experience.
*   **✅ Self-Contained and Safe:** As a separate module, it does not modify any core CMSMS files. You can switch back to the original MicroTiny at any time.

## Installation Guide

> **IMPORTANT:** Always create a full backup of your website's files and database before installing any new modules.

### Prerequisites
*   A running installation of **CMS Made Simple 2.x**.

### Steps

1.  **Download the Module**
    *   Download the latest release package from the [GitHub Releases page](https://github.com/your-username/your-repo/releases) (replace with your actual link).

2.  **Upload the Module**
    *   Unzip the downloaded package.
    *   You will find a directory named `MicroTinyV7`.
    *   Using FTP or your hosting file manager, upload the entire `MicroTinyV7` directory to the `modules` folder of your CMSMS installation. The final path should be `/modules/MicroTinyV7/`.

3.  **Install and Activate**
    *   Log in to your CMSMS Admin Panel.
    *   Navigate to `Extensions > Module Manager`.
    *   Find **MicroTinyV7** in the list of available modules and click the "Install" button. The module will be installed and activated.

4.  **Select the New Editor**
    *   Navigate to `My Preferences > User Preferences`.
    *   Find the dropdown menu labeled **"WYSIWYG editor to use"**.
    *   Select **MicroTinyV7** from the list.
    *   Click "Submit" to save your changes.

5.  **Clear Cache**
    *   Navigate to `Site Admin > System Maintenance`.
    *   Click the "Clear Cache" button.
    *   It is also recommended to clear your web browser's cache to ensure all new scripts are loaded correctly.

That's it! When you go to edit a page or GCB, you will now see the new TinyMCE 7 editor.

## License

This module is released under the [GNU General Public License v2 or later](https://www.gnu.org/licenses/gpl-2.0.html), consistent with CMS Made Simple.
