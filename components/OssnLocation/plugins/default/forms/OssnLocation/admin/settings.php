<?php
/**
 * Boatable Technologies LLC
 *
 * @package   Boatable Technologies LLC
 * @author    Rafael Amorim <amorim@rafaelamorim.com.br>
 * @copyright (C) OpenTeknik LLC
 * @license   Boatable Technologies LLC License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 ?>
 <div>
	<label>MapBox API <a target="_blank" href="https://www.mapbox.com/"> https://www.mapbox.com/</a></label>
    <input type="text" value="<?php echo ossn_location_api_key();?>" name="mapbox_api_key" autocomplete="off"/>
</div>
<div>
	<input type="submit" value="<?php echo ossn_print('save');?>" class="btn btn-success btn-sm" />
</div>