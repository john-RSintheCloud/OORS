<?php
#
# Imagestream setup page
#

include '../../../application/bootstrap.php';
include '../../../include/authenticate.php'; if (!checkperm('a')) {exit ($lang['error-permissiondenied']);}
include '../../../include/general.php';

// Specify the name of this plugin and the heading to display for the page.
$plugin_name = 'imagestream';
$plugin_page_heading = $lang['imagestream_configuration'];

// Build the $page_def array of descriptions of each configuration variable the plugin uses.
$page_def[] = config_add_multi_rtype_select('imagestream_restypes', $lang['imagestream_resource_types_to_include']);
$page_def[] = config_add_text_input('imagestream_transitiontime', $lang['imagestream_transitiontime']);

// Do the page generation ritual -- don't change this section.
$upload_status = config_gen_setup_post($page_def, $plugin_name);
include '../../../include/header.php';
config_gen_setup_html($page_def, $plugin_name, $upload_status, $plugin_page_heading);
include '../../../include/footer.php';
