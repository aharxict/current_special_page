<?php
/*
Plugin Name: Current Special Page for www.alliedbuildings.com
Description: Add custom post type for the scheduled page.
Version: 1.0
Author: AHAPX
License: GPL2
*/


require_once("cs_special.php");
require_once("cs_options.php");
require_once("plugin/acf/acf.php");

$special = new Special();
$options = new Options();

require_once("cs_vendor_functions.php");
require_once("cs_acf_fields.php");
?>