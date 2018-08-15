<div class="wrap">
	<h1>Offerstack Settings</h1>
	<form method="post" action="options.php">
		<?php 
		settings_fields( 'offerstack-settings' );
		do_settings_sections( 'offerstack-settings' );

		$offer_keyword = esc_attr( get_option('offer_keyword') );
		$api_key = esc_attr( get_option('api_key') );
		$selected_theme = esc_attr( get_option('offers_theme') );
		?>
	<br><br>
			<table>
				<tr>
	                <th>Default Keyword</th>
	                <td><input type="text" placeholder="Offer Keyword" name="offer_keyword" value="<?php echo $offer_keyword?>" size="50" /></td>
	            </tr>
	            <tr>
	                <th>Offerstack API Key</th>
	                <td><textarea placeholder="offerstack.io API Key to list get offers" name="api_key" rows="5" cols="50"><?php echo  $api_key?></textarea></td>
	            </tr>
	            <tr>
	                <th>Offerstack Theme</th>
	                <td>
	                	<select name="offers_theme">
						   <option <?php echo ($selected_theme == 'theme-default' ) ? 'selected' : ''?> value="theme-default">Default Theme</option>
						   <option <?php echo ($selected_theme == 'theme-1' ) ? 'selected' : ''?> value="theme-1">Compact Theme 1</option>
						</select>
	                </td>
	            </tr>
	            <tr>
	                <td></td>
	                <td><?php submit_button(); ?></td>
	            </tr>
	 
	        </table>

	</form>
</div>