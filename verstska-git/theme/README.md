# VERSTKADOC Document DTP — custom WordPress theme v0.2.0

This version changes the architecture so editable business content is stored in the WordPress database rather than being embedded in PHP templates.

## Architecture

- **Theme:** presentation, templates, CSS, JavaScript, layout and display logic.
- **Companion plugin `VERSTKADOC Content`:** editable site content and structured Service/Case data.
- **WordPress database:** the actual text, descriptions, service cards, case cards, home-page fields and site settings.

Changing or replacing the theme no longer requires retyping the site copy.

## What moved out of PHP

The following front-page content is now editable in WordPress:

- Hero eyebrow, title, lead, buttons, note and document graphic text.
- Services section heading/intro and all service-card titles/descriptions.
- Five workflow steps.
- Two audience cards.
- Cases section and case cards.
- Quote section copy.
- Brand tagline, footer description and footer section labels.

The top navigation remains a normal WordPress menu. Its labels and ordering are edited in WordPress, not in the PHP template.

## Installation / upgrade

1. Keep a local copy of the previous theme.
2. Install and activate the companion plugin first: `verstkadoc-content`.
3. Upload this theme over the existing `wp-content/themes/verstkadoc-document-dtp/` directory and keep the same folder name.
4. Activate **VERSTKADOC Document DTP**.
5. Open the page configured as the static front page. The **VERSTKADOC Home Content** panel contains the editable homepage fields.
6. Use **Services** and **Cases** in the WordPress Dashboard to edit the structured cards.
7. Use **Settings → VERSTKADOC Content** for global editable site text such as the footer description and contact email.

The plugin seeds the current prototype content only when the corresponding content is empty/missing. It does not intentionally overwrite existing page text.

## Important

The quote form is still presentation-only. Sending mail, file uploads and anti-spam belong in the companion/business plugin layer rather than the theme.

The theme remains intentionally lightweight and is not tied to Elementor or another page builder.
