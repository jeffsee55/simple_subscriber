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

<?php
if( get_site_option( 'ss_email_list' ) ) {
  foreach( get_site_option( 'ss_email_list' ) as $subscriber ) {
    echo '<tr id=""><td class="email column-email" data-colname="Email"><a href="mailto: ' . $subscriber . '">' . $subscriber . '</a></td>';
  };
} else {
    echo '<tr id=""><td class="email column-email" data-colname="Email">No subscribers</td>';
}

?>
<form method="get">

<p class="search-box">
  <label class="screen-reader-text" for="user-search-input">Search Users:</label>
  <input type="search" id="user-search-input" name="s" value="">
  <input type="submit" id="search-submit" class="button" value="Search Users"></p>
	<input type="hidden" id="_wpnonce" name="_wpnonce" value="958df243ce"><input type="hidden" name="_wp_http_referer" value="/wp-admin/users.php">  <div class="tablenav top">
    <div class="alignleft actions bulkactions">
	    <label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
			<select name="action" id="bulk-action-selector-top">
				<option value="-1">Bulk Actions</option>
				<option value="remove">Remove</option>
			</select>
			<input type="submit" id="doaction" class="button action" value="Apply">
	  </div>
  	<div class="alignleft actions">
			<label class="screen-reader-text" for="new_role">Change role to…</label>
			<select name="new_role" id="new_role">
				<option value="">Change role to…</option>
				<option value="subscriber">Subscriber</option>
				<option value="contributor">Contributor</option>
				<option value="author">Author</option>
				<option value="editor">Editor</option>
				<option value="administrator">Administrator</option>
			</select>
			<input type="submit" name="changeit" id="changeit" class="button" value="Change"></div><div class="tablenav-pages one-page"><span class="displaying-num">2 items</span>
			<span class="pagination-links"><span class="tablenav-pages-navspan" aria-hidden="true">«</span>
			<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
			<span class="paging-input"><label for="current-page-selector" class="screen-reader-text">Current Page</label><input class="current-page" id="current-page-selector" type="text" name="paged" value="1" size="1" aria-describedby="table-paging"> of <span class="total-pages">1</span></span>
			<span class="tablenav-pages-navspan" aria-hidden="true">›</span>
			<span class="tablenav-pages-navspan" aria-hidden="true">»</span></span></div>
		  <br class="clear">
  </div>
	<h2 class="screen-reader-text">Users list</h2><table class="wp-list-table widefat fixed striped users">
  <thead>
  <tr>
  	<td id="cb" class="manage-column column-cb check-column">
			<label class="screen-reader-text" for="cb-select-all-1">Select All</label>
			<input id="cb-select-all-1" type="checkbox">
		</td>
		<th scope="col" id="username" class="manage-column column-username column-primary sortable desc"><a href="http://selongheights.ntb.dev/wp-admin/users.php?orderby=login&amp;order=asc"><span>Username</span><span class="sorting-indicator"></span></a>
		</th>
		<th scope="col" id="name" class="manage-column column-name sortable desc"><a href="http://selongheights.ntb.dev/wp-admin/users.php?orderby=name&amp;order=asc"><span>Name</span><span class="sorting-indicator"></span></a>
		</th><th scope="col" id="email" class="manage-column column-email sortable desc"><a href="http://selongheights.ntb.dev/wp-admin/users.php?orderby=email&amp;order=asc"><span>Email</span><span class="sorting-indicator"></span></a>
		</th>
		<th scope="col" id="role" class="manage-column column-role">Role
		</th>
		<th scope="col" id="posts" class="manage-column column-posts num">Posts
		</th>
	</tr>
  </thead>

  <tbody id="the-list" data-wp-lists="list:user">

	<tr id="user-1">
		<th scope="row" class="check-column">
			<label class="screen-reader-text" for="user_1">Select jeffsee55</label>
			<input type="checkbox" name="users[]" id="user_1" class="administrator" value="1">
		</th><td class="username column-username has-row-actions column-primary" data-colname="Username">
			<img alt="" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="avatar avatar-32 photo" height="32" width="32" style="background:#eee;"> <strong><a href="http://selongheights.ntb.dev/wp-admin/profile.php?wp_http_referer=%2Fwp-admin%2Fusers.php">jeffsee55</a></strong>
			<br>
			<div class="row-actions"><span class="edit"><a href="http://selongheights.ntb.dev/wp-admin/profile.php?wp_http_referer=%2Fwp-admin%2Fusers.php">Edit</a></span>
			</div>
			<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
		</td>
		<td class="name column-name" data-colname="Name">Jeff See</td>
		<td class="email column-email" data-colname="Email"><a href="mailto:jeffsee.55@gmail.com">jeffsee.55@gmail.com</a>
		</td>
		<td class="role column-role" data-colname="Role">Administrator</td>
		<td class="posts column-posts num" data-colname="Posts"><a href="edit.php?author=1" class="edit"><span aria-hidden="true">1</span><span class="screen-reader-text">1 post by this author</span></a>
		</td>
	</tr>
	</tbody>

</table>
</form>
