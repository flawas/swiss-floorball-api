<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://flaviowaser.ch
 * @since      1.0.0
 *
 * @package    Swiss_Floorball_Api
 * @subpackage Swiss_Floorball_Api/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
		        <div id="icon-themes" class="icon32"></div>  
		        <h2>Swiss Unihockey Plugin Einstellungsübersicht</h2>
				<table>
					<tr>
						<th>Setting</th>
						<th>Value</th>
					</tr>
					<tr>
						<td>Swiss Floorball API URL</td>
						<td><strong><?php echo get_option('swissfloorball_api_url');?></strong></td>
					</tr>
					<tr>
						<td>Swiss Floorball Club ID</td>
						<td><strong><?php echo get_option('swissfloorball_club_number');?></strong></td>
					</tr>
					<tr>
						<td>Swiss Floorball Team Name</td>
						<td><strong><?php echo get_option('swissfloorball_club_name');?></strong></td>
					</tr>
                    <tr>
						<td>Aktuelle Saison</td>
						<td><strong><?php echo get_option('swissfloorball_actual_season');?></strong></td>
					</tr>
				</table>
</div>

<?php
#get_club_games_table(get_option('swissfloorball_club_number'), get_option('swissfloorball_actual_season'));
# Vereinsübersicht einblenden
get_club_teams(get_option('swissfloorball_club_number'));
get_club_games(get_option('swissfloorball_club_number'), get_option('swissfloorball_actual_season'));
get_team_games(429599, get_option('swissfloorball_actual_season'));

?>