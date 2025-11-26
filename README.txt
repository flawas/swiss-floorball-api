=== Swiss Floorball API ===
Contributors: flawas
Donate link: https://flaviowaser.ch/
Tags: floorball, api, swiss floorball
Requires at least: 5.0
Tested up to: 5.9
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

This plugin allows you to display Swiss Floorball data in your WordPress site.

== Installation ==

1. Upload `swiss-floorball-api.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the 'Swiss Floorball API' settings page in the WordPress admin panel
4. Configure the plugin settings

== Frequently Asked Questions ==

= Is it free? =

Yes, it is free.

= How do I use it? =

Insert the shortcodes into your post or pages and select the data you want to display.

== Changelog ==

= 1.0.0 =
* Initial release

= 0.0.3 =
* Error handling
* Added support for further data
* Added support for further shortcodes

= 0.0.2 =
* Added support for shortcodes

= 0.0.1 =
* Initial development

== Upgrade Notice ==

= 1.0.0 =
No upgrade notice.

== Examples ==

= Display a Team List =
Use this shortcode to show all teams of a specific club:

[suh-calendars club_id="637"]

= Display a Team Calendar =
Use this shortcode to show the calendar of a specific team:

[suh-calendars team_id="427892"]
