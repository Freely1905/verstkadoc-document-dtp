# VERSTKADOC Content v0.1.0

Companion plugin for the VERSTKADOC custom WordPress theme.

## Why a plugin?

The theme should be replaceable without replacing the website's business content. This plugin owns the structured content and settings so that theme updates can safely change PHP/CSS/JS while the text remains in the WordPress database.

## Provides

- Front-page editable fields.
- Five editable workflow steps.
- Two editable audience blocks.
- Services custom post type.
- Cases custom post type.
- Global editable site settings.
- Starter-content migration from the v0.1 theme copy.

The migration is intentionally conservative: it fills missing data and does not overwrite non-empty page content.

If the plugin is activated before a static front page is configured, the starter homepage fields are seeded automatically once a front page exists.
