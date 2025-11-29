=== Swiss Floorball API ===
Contributors: flaviowaser
Donate link: https://flaviowaser.ch/
Tags: floorball, api, swiss floorball, unihockey, sports
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display Swiss Floorball (Swiss Unihockey) data like games, rankings, and players on your WordPress site using the official API v2.

== Description ==

The **Swiss Floorball API** plugin allows you to easily integrate data from Swiss Unihockey into your WordPress website. Whether you are a club wanting to display your teams' schedules and rankings, or a fan site tracking the league, this plugin provides a comprehensive set of shortcodes to display real-time data.

**Features:**

*   **Club Integration:** Set your Club ID once and automatically display all your club's teams and games.
*   **Calendars:** Show upcoming games for specific teams, clubs, or leagues with ICS subscription links.
*   **Rankings:** Display current league tables for any group.
*   **Game Details:** Show detailed game events and summaries.
*   **Player Stats:** Display individual player profiles and national team players.
*   **Topscorers:** Show lists of top scorers for a league.
*   **Responsive Design:** Data tables are styled to be responsive and look good on mobile devices.

== Installation ==

1.  Upload the `swiss-floorball-api` folder to the `/wp-content/plugins/` directory.
2.  Activate the plugin through the 'Plugins' menu in WordPress.
3.  Go to **Settings > Swiss Floorball API** in your WordPress admin panel.
4.  Enter your **Club ID** (e.g., `427892`) and the **Current Season** (e.g., `2025`).
5.  Save changes.

== Frequently Asked Questions ==

= Where do I find my Club ID? =
You can find your Club ID on the Swiss Unihockey website or by using the `[suh-clubs]` shortcode to list all clubs and their IDs.

= How do I display a specific team's calendar? =
Use the shortcode `[suh-calendars team_id="12345"]`. You can find the Team ID in the URL of the team's page on the Swiss Unihockey website or via the API.

= Can I customize the look? =
Yes, the plugin includes a basic stylesheet, but you can override the CSS classes (prefixed with `.sfa-`) in your theme's custom CSS.

== Screenshots ==

1.  **Plugin Settings**: Configure your Club ID and the current season.
2.  **Club Games**: Example of the `[suh-club-games]` shortcode output showing upcoming matches.
3.  **League Ranking**: Example of the `[suh-rankings]` shortcode displaying a league table.
4.  **Team Calendar**: The responsive calendar view with ICS export link.

== Changelog ==

= 1.0.0 =
*   Initial release with support for API v2.
*   Added shortcodes for calendars, rankings, teams, and players.
*   Implemented responsive table design.

= 0.0.3 =
*   Added error handling.
*   Expanded data support.

= 0.0.1 =
*   Initial development.

== Shortcodes ==

*   `[suh-club-teams]`: List all teams of the configured club.
*   `[suh-club-games]`: List all games of the configured club.
*   `[suh-team-games team_id="..."]`: List games for a specific team.
*   `[suh-calendars team_id="..." | club_id="..."]`: Show upcoming games and ICS link.
*   `[suh-rankings season="..." league="..." game_class="..." group="..."]`: Show league rankings.
*   `[suh-topscorers season="..." league="..." game_class="..." group="..."]`: Show topscorer list.
*   `[suh-game-events game_id="..."]`: Show events for a specific game.
*   `[suh-player player_id="..."]`: Show player profile.
