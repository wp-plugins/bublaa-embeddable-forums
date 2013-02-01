<?php
/*
Template Name: Bublaa Template
*/
global $bublaa;
$bublaa_options = $bublaa->get_options();
?>

<?php
	get_header();
?>
<?php
	init_bublaa();
?>
<?php
if($bublaa_options["showFooter"]) {
	get_footer();
}
?>


