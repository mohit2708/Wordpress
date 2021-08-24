![admin_menu](https://github.com/mohit2708/Wordpress/blob/wordpress-codeing/img/admin_menu.PNG)
<?php
add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( 'My Top Level Menu Example', 'Top Level Menu', 'manage_options', 'myplugin/myplugin-admin-page.php', 'myplguin_admin_page', 'dashicons-tickets', 6  );
	add_submenu_page( 'myplugin/myplugin-admin-page.php', 'My Sub Level Menu Example', 'Sub Level Menu', 'manage_options', 'myplugin/myplugin-admin-sub-page.php', 'myplguin_admin_sub_page' ); 


	add_submenu_page( 'myplugin/myplugin-admin-page.php', 'My Sub Level Menu Example', 'Sub Level Menu1', 'manage_options', 'myplugin-admin-sub-page.php', 'myplguin_admin_sub_page' ); 
}
function myplguin_admin_page(){
	?>
	<div class="wrap">
		<h2>Welcome To My Plugin</h2>
	</div>
	<?php
}function myplguin_admin_sub_page(){
	?>
	<div class="wrap">
		<h2>Welcome To My Plugin</h2>
	</div>
	<?php
}
?>
