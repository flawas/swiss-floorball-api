<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       plugin_name.com/team
 * @since      1.0.0
 *
 * @package    PluginName
 * @subpackage PluginName/admin/partials
 */
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap sfa-admin-wrap">
	<div class="sfa-admin-header">
		<h1>⚙️ Einstellungen</h1>
		<p>Konfigurieren Sie Ihre Swiss Unihockey API Verbindung</p>
	</div>

	<div class="sfa-form-section">
		<h2>Plugin Einstellungen</h2>
		<?php settings_errors(); ?>
		<p class="sfa-helper-text">Geben Sie hier die erforderlichen Informationen für die Verbindung zur Swiss Unihockey API ein.</p>
		
		<form method="POST" action="options.php">  
			<?php 
				settings_fields( 'settings_page_general_settings' );
				do_settings_sections( 'settings_page_general_settings' ); 
			?>             
			<?php submit_button('Einstellungen speichern'); ?>  
		</form>
	</div>

	<div class="sfa-card">
		<h3>ℹ️ Hilfe</h3>
		<p><strong>Club Number:</strong> Die eindeutige ID Ihres Clubs bei Swiss Unihockey</p>
		<p><strong>Club Name:</strong> Der offizielle Name Ihres Clubs</p>
		<p><strong>Aktuelle Saison:</strong> Das Jahr der aktuellen Saison (z.B. 2024)</p>
	</div>
</div>