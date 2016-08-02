<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       jeffseedesigns.com
 * @since      1.0.0
 *
 * @package    Simple_Subscriber
 * @subpackage Simple_Subscriber/admin/partials
 */
?>

<div class="wrap">
<h1>Newsletter Subscribers</h1>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<table class="wp-list-table widefat fixed striped users">
	<thead>
	<tr>
		<th scope="col" id="email" class="manage-column column-email sortable desc"><a href="http://ntb.dev/wp-admin/users.php?orderby=email&amp;order=asc"><span>Email</span><span class="sorting-indicator"></span></a></th></tr>
	</thead>

	<tbody id="the-list" data-wp-lists="list:user">
		
  <?php
    foreach( get_site_option( 'ss_email_list' ) as $subscriber ) {
      echo '<tr id=""><td class="email column-email" data-colname="Email"><a href="mailto: ' . $subscriber . '">' . $subscriber . '</a></td></tr>';
    };
  ?>

</table>
</div>
