# Changelog

All notable changes to this project will be documented in this file.

## [1.0.0] - 2026-03-30

### Initial Release

Extracted from XOOPS Core 2.5 (`htdocs/xoops_lib/vendor/xoops/smarty-extensions/`) into a standalone Composer package.

### Features

* **AbstractExtension** base class with `getModifiers()`, `getFunctions()`, `getBlockHandlers()`, and Smarty 4 `register()` method
* **ExtensionRegistry** — central registry that auto-detects Smarty 4 vs 5 and uses the appropriate registration path
* **Smarty5Adapter** — wraps any AbstractExtension into a `\Smarty\Extension\Base` subclass for Smarty 5 compatibility
* **TextExtension** — `excerpt`, `truncate_words`, `nl2p`, `highlight_text`, `reading_time`, `pluralize`, `extract_hashtags`
* **FormatExtension** — `format_date`, `relative_time`, `format_currency`, `number_format`, `bytes_format`, `format_phone_number`, `gravatar`, `datetime_diff`, `get_current_year`
* **NavigationExtension** — `generate_url`, `generate_canonical_url`, `url_segment`, `social_share`, `render_breadcrumbs`, `render_pagination`, `render_qr_code`, `render_alert`, `parse_url`, `strip_protocol`, `slugify`, `youtube_id`, `linkify`
* **DataExtension** — `array_to_csv`, `base64_encode_file`, `embed_pdf`, `generate_xml_sitemap`, `generate_meta_tags`, `get_referrer`, `get_session_data`, `array_filter`, `array_sort`, `pretty_print_json`, `get_file_size`, `get_mime_type`, `is_image`, `strip_html_comments`
* **SecurityExtension** — `generate_csrf_token`, `validate_csrf_token`, `has_user_permission`, `is_user_logged_in`, `user_has_role`, `sanitize_string`, `sanitize_url`, `sanitize_filename`, `sanitize_string_for_xml`, `mask_email`, `obfuscate_text`, `hash_string`, `xo_permission` block handler
* **FormExtension** — `form_open` (with automatic CSRF token injection), `form_close`, `form_input`, `create_button`, `render_form_errors`, `validate_form`, `validate_email`, `display_error`
* **XoopsCoreExtension** — `xo_get_config`, `xo_get_current_user`, `xo_get_module_info`, `xo_get_notifications`, `xo_module_url`, `xo_render_block`, `xo_render_menu`, `xo_avatar`, `xo_debug`, `translate` modifier
* **RayDebugExtension** — `ray`, `ray_context`, `ray_dump`, `ray_table` functions and `ray` modifier (silent no-op when Ray unavailable)

### Infrastructure

* PSR-4 autoloading under `Xoops\SmartyExtensions\`
* PHPUnit 11 test suite with full coverage
* PHPStan level max static analysis
* PHP_CodeSniffer PSR-12 enforcement
* GitHub Actions CI matrix: PHP 8.2–8.5 with lowest-deps and coverage runs
* Codecov, SonarCloud, and Qodana integrations
* Dependabot and Renovate for automated dependency updates
* CodeRabbit AI code review configuration
