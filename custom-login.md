```php
<?php
/**
 * Template Name: Login14-04

 */

if ( is_user_logged_in() ) {
    wp_redirect( home_url('/checkout') );
}
// Function start
function login_failed() { 
    wp_redirect( home_url( '/login14/?failed' ) );  
    exit;  
}
add_action( 'wp_login_failed', 'login_failed' ); 
function redirect_login_page() {

    $login_page  = home_url( '/login14/' );  
    $page_viewed = basename($_SERVER['REQUEST_URI']);  
 
    if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {  
        wp_redirect($login_page);  
        exit;  
    }  
}  
add_action('init','redirect_login_page');

 
 
function verify_username_password( $user, $username, $password ) {  

    $login_page  = home_url( '/login14/' );  
    if( $username == "" || $password == "" ) {  
        wp_redirect( $login_page . "?empty" );  
        exit;  
    }  
}  
add_filter( 'authenticate', 'verify_username_password', 1, 3);  

function logout_page() {

    $login_page  = home_url( '/login14/' );  
    wp_redirect( $login_page . "?logout" );  
    exit;  
}  
add_action('wp_logout','logout_page');

 // <!-- function end -->
   
if ( $_POST['action'] == 'log-in' ) {
   
    # Submit the user login inputs
    $login = wp_login( $_POST['user-name'], $_POST['password'] );
    $login = wp_signon( array( 'user_login' => $_POST['user-name'], 'user_password' => $_POST['password'], 'remember' => $_POST['remember-me'] ), false );
       
    # Redirect to account page after successful login.
    if ( $login->ID ) {
        wp_redirect( home_url('account') );      
    }  
}
     
get_header();
   
?>

<div id="content" role="main" class = "user-login" >   
    <h2 class="page-title"><?php the_title(); ?></h2>
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <?php
        # Output header error messages.
        if ( isset($_GET['failed']) ) {  
            echo '<p class="input-error">Invalid username and / or password.</p>';  
        } elseif ( isset($_GET['empty']) ) {  
            echo '<p class="input-error">Username and/or Password is empty.</p>';  
        } elseif (isset($_GET['logout'])) {  
            echo '<p class="input-error">You are now logged out.</p>';  
        }
    ?>
       
<form action="<?php the_permalink(); ?>" method="post" class="sign-in">
    <p>
        <label for="user-name"><?php _e('Username'); ?></label><br />
        <input type="text" name="user-name" id="user-name" value="<?php echo wp_specialchars( $_POST['user-name'], 1 ); ?>" />
    </p>
    <p>
        <label>Password</label><br />
        <input type="password" name="password" id="password" />
    </p>
    <p>
        <input type="submit" name="submit" value="<?php _e('Log in'); ?>" id = "yellow-button" />
        <input type="hidden" name="action" value="log-in" />
    </p>   
</form>
   
    <?php endwhile; ?>
   
</div>
<?php        
    
get_footer();



//SELECT order_id FROM `wp_wc_order_stats` ORDER by `order_id` DESC LIMIT 1
?>

```
