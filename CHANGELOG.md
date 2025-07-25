# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2023-10-27

This is the first stable release of MicroTinyV7, a complete replacement for the core MicroTiny editor in CMS Made Simple 2.x. This release focuses on modernization, robust integration, and an enhanced user experience.

### Added

-   **Advanced Mailto Plugin:** Full support for the `{mailto}` Smarty tag with a rich dialog, visual placeholders in the editor, and a right-click context menu for easy editing.
-   **Live Page Search:** The CMSMS Linker now features an as-you-type search for finding content pages quickly.
-   **Intelligent Link Editing:** When editing an existing link, the Linker now re-populates the search with the page title, showing all possible matches for context.
-   **Custom Editor Styling:** A dedicated `content.css` is now loaded in the editor to style custom elements like the mailto placeholder for a true WYSIWYG feel.

### Changed

-   **Major Editor Upgrade:** Core editor upgraded from TinyMCE v4.x to the latest stable **TinyMCE v7**, providing a modern UI and improved performance.
-   **Rewritten CMSMS Linker:** The internal page linker plugin has been completely rebuilt for the new TinyMCE 7 API.
-   **Robust FilePicker Integration:** Switched to integrating with the official CMSMS FilePicker module, restoring full functionality like uploads and directory navigation.
-   **Clean Code Architecture:** Custom plugins are now located in a separate `/cmsms_plugins` directory, making future TinyMCE library updates safe and simple.
-   **Centralized Configuration:** A global `CMSMS_TINY_CONFIG` JavaScript object is now used to cleanly pass all necessary data from the CMSMS backend to the editor's plugins.
