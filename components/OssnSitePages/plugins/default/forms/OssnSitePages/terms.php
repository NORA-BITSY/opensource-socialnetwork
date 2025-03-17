<?php
/**
 * Boatable Technologies LLC
 *
 * @package   Boatable Technologies LLC (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Boatable Technologies LLC License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 
$OssnSitePages = new OssnSitePages;
$OssnSitePages->pagename = 'terms';
$OssnSitePages = $OssnSitePages->getPage();
if($OssnSitePages) {
	$description = html_entity_decode($OssnSitePages->description);
} else {
	$description = '';
}
?>
<div>
	<label> <?php echo ossn_print('site:terms'); ?> </label>
	<textarea name="pagebody" class="ossn-editor"><?php echo $description; ?></textarea>
<div>
<div class="margin-top-10">
	<input type="submit" class="btn btn-success btn-sm" value="<?php echo ossn_print('save'); ?>"/>
</div>
