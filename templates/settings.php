<div class="wrap">
	<h1>Offerstack Settings</h1>
	<form method="post" action="options.php">
		<?php 
		settings_fields( 'offerstack-settings' );
		do_settings_sections( 'offerstack-settings' );
		?>
	<br><br>
			<table>
				<tr>
	                <th>Default Keyword</th>
	                <td><input type="text" placeholder="Offer Keyword" name="offer_keyword" value="<?php echo esc_attr( get_option('offer_keyword') ); ?>" size="50" /></td>
	            </tr>
	            <tr>
	                <th>Offerstack API Key</th>
	                <td><textarea placeholder="offerstack.io API Key to list get offers" name="api_key" rows="5" cols="50"><?php echo esc_attr( get_option('api_key') ); ?></textarea></td>
	            </tr>
	            <tr>
	                <td></td>
	                <td><?php submit_button(); ?></td>
	            </tr>
	 
	        </table>

	</form>
</div>