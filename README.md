# Include Plugin directry Path
```php
define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
include( MY_PLUGIN_PATH . 'includes/admin-page.php');
include( MY_PLUGIN_PATH . 'includes/classes.php');
```

# Include css js image
```php
plugins_url();
```

# 1 Step:-
  * Go to Wordpress Folder
  * Go to wp-content folder
  * Go to the plugin folder
  * crate your own folder
  * and Create the file.php

# 2 Step:-
```php     
     <?php
   /**
    * Plugin Name:       My Basics Plugin
    * Plugin URI:        https://example.com/plugins/the-basics/
    * Description:       Handle the basics with this plugin.
    * Version:           1.10.3
    * Requires at least: 5.2
    * Requires PHP:      7.2
    * Author:            John Smith
    * Author URI:        https://author.example.com/
    * License:           GPL v2 or later
    * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
    * Text Domain:       my-basics-plugin
    * Domain Path:       /languages
    */
```
# 3 Step:- create admin menu and sab menu
```php
function add_my_custum_menu(){
  add_menu_page(
    "My Plugin",                  //Page Tittle
    "My Plugin",                  //Menu Tittle
    "manage_options",             //admin level
    "my-plugin",                  //page slug, Parent Slug
    "all_new",                  //callback function
    'dashicons-chart-area',       //icon url
    6                            //postion
    ); 

  add_submenu_page(
    'my-plugin',       // parent slug
    'Add New',    // page title
    'Add New',             // menu title
    'manage_options',           // capability
    'my-plugin', // slug
    'all_new' // callback
    );
  add_submenu_page(
    'my-plugin',       // parent slug
    'Add pages',    // page title
    'Add pages',             // menu title
    'manage_options',           // capability
    'all-pages', // slug
    'all_pages' // callback
    );

}
add_action("admin_menu", "add_my_custum_menu");

// 2 Type
function wpbc_admin_menu()
{
add_menu_page(__('Job Portal', 'wpjp'), __('Job Portal', 'wpjp'), 'activate_plugins', 'job_portal', 'job_portal_function','dashicons-chart-area','6');
add_submenu_page('job_portal', __('All Job Manager', 'wpjp'), __('All Job Manager', 'wpjp'), 'activate_plugins', 'job_portal', 'job_portal_function');
add_submenu_page('job_portal', __('Add New Job', 'wpjp'), __('Add New Job', 'wpjp'), 'activate_plugins', 'add_new_job', 'add_new_job_function');
}
add_action('admin_menu', 'wpbc_admin_menu');
/////////////////////////////


function all_new(){?>
  <h1>Add New</h1>
<?php }
function all_pages(){?>
  <h1>Add Pages</h1>
<?php }
```

# 4th //Create Database Table on Plugin Activation 
```php
function dynamic_create_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . "mmjobs1";

    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
            id int(9) NOT NULL AUTO_INCREMENT,
            first_name varchar(250) CHARACTER SET utf8 NOT NULL,
            last_name varchar(250) CHARACTER SET utf8 NOT NULL,
            contact int(10),
            email varchar(250) CHARACTER SET utf8 NOT NULL,
            job_tittle varchar(250),
            job_description varchar(250),
            company_name varchar(250),
            company_url varchar(250),
            created_at TIMESTAMP,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'dynamic_create_table');
```

# 5th:- Drop Table when Plugin Uninstalls
```php
function deactivate_table(){
   global $wpdb;
   $table_name = $wpdb->prefix . "mmjobs1";
     $wpdb->query( "DROP TABLE IF EXISTS $table_name" );
}
register_deactivation_hook( __FILE__, 'deactivate_table' );
```
__Drop Table when Plugin Delete__
```php
function deactivate_table(){
   global $wpdb;
   $table_name = $wpdb->prefix . "mmjobs1";
     $wpdb->query( "DROP TABLE IF EXISTS $table_name" );
}
register_uninstall_hook( __FILE__, 'deactivate_table' );
```

# listing Show
```php
<?php
global $wpdb;

    $table = new Custom_Table_Example_List_Tab();
    $table->prepare_items();

    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'wpjp'), count($_REQUEST['id'])) . '</p></div>';
    }
    ?>

<div class="wrap">

    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('Job Poratal', 'wpjp')?> <a class="add-new-h2"
         href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=add-new-job');?>"><?php _e('Add new', 'wpjp')?></a>
    </h2>
    <?php echo $message; ?>

    <form id="contacts-table" method="POST">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php $table->search_box('Search', 'search_id'); ?>
        <?php $table->display() ?>
    </form>

</div>
<?php
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}
class Custom_Table_Example_List_Tab extends WP_List_Table
 {
  function get_columns() 
  {
        $columns = [
            'cb'      => '<input type="checkbox" />',
            'name'    => __( 'position'),
            'company_name' => __( 'Company Name'),
            'email'    => __( 'Email'),
            'phone'    => __( 'Phone'),
            'company_url'    => __( 'Company Url'),
            'company_location'    => __( 'Location'),
        ];
        return $columns;
    }
    
    function get_sortable_columns()
    {
        $sortable_columns = array(
            'name'      => array('name', true),
            'company_name'  => array('company_name', true),
            'email'     => array('email', true),
            'phone'     => array('phone', true),
            'company_url'   => array('company_url', true),
            'company_location'       => array('company_location', true),  
            
        );
        return $sortable_columns;
    }
    function column_default($item, $column_name)
    {
        return $item[$column_name]; // data fatch
    } 
    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',$item['id']
        );
    }
    function column_name($item)
    {

        $actions = array(
            'edit' => sprintf('<a href="?page=add-new-job&id=%s">%s</a>', $item['id'], __('Edit')),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Delete')),

        );

        return sprintf('%s %s',
            $item['name'],
            $this->row_actions($actions)
        );
    }
    function process_bulk_action()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'job_list'; 

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
    }
     function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }
    function prepare_items()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'job_list'; 

        $per_page = 2; 

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);       
        $this->process_bulk_action();
        $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name");

        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'id';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'asc';

        $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);


        $this->set_pagination_args(array(
            'total_items' => $total_items, 
            'per_page' => $per_page,
            'total_pages' => ceil($total_items / $per_page) 
        ));
    }
 
 
 }
```

# Insert And Update
```php
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<?php
$name = $_POST['name'];
$email = $_POST['email'];
$company_name = $_POST['company_name'];
$company_url = $_POST['company_url'];
$phone = $_POST['phone'];
$company_location = $_POST['company_location'];


if (isset($_POST['insert'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . "job_list";

        $wpdb->insert(
                $table_name, //table
                array('name' => $name, 'company_name' => $company_name, 'email' => $email, 'phone' => $phone,'company_url' => $company_url,'company_location' => $company_location), //data
                array('%s', '%s') //data format			
        );
        //$message.="Job inserted";
        echo "<script>location.replace('admin.php?page=all-job-manager');</script>";
    }

if(isset($_GET['id']))
	{	
global $wpdb;
$id = $_GET['id'];
 $table_name = $wpdb->prefix . "job_list";
 $rowsu = $wpdb->get_results("SELECT * from $table_name where id='$id'");
 foreach ($rowsu as $row) {
	 $name =  $row->name; 
	 $email = $row->email;
	 $company_name = $row->company_name;
	 $company_url = $row->company_url; 
   $phone = $row->phone; 
   $company_location = $row->company_location; 


}}

if(isset($_POST['Updatebutton']))
	{
		
$name = $_POST['name'];
$email = $_POST['email'];
$company_name = $_POST['company_name'];
$company_url = $_POST['company_url'];
$phone = $_POST['phone'];
$company_location = $_POST['company_location'];
	
global $wpdb;
$table_name = $wpdb->prefix . "job_list";

	 $wpdb->query("UPDATE $table_name SET name='$name',email='$email',phone='$phone',company_name='$company_name',company_url='$company_url',company_location='$company_location' WHERE id='$id'");  
	 $updatemessage.="Job Update Successfully";
  	//echo "<script>location.replace('admin.php?page=crud.php');</script>";
		
	}
?> 



<?php if (isset($updatemessage)): ?><div class="updated"><p><?php echo $updatemessage; ?></p></div><?php endif; ?>
<form name="addjobform" id="addjobform" action="#" method="post">

    <div class="form-row">
  <div class="form-group col-md-6">
      <label>Position</label>
      <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" placeholder="Enter Job Tittle">
    </div>
    <div class="form-group col-md-6">
      <label>Company Name</label>
      <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $company_name; ?>"placeholder="Enter Company Name">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>email</label>
      <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" placeholder="Enter Your Email">
    </div>
    <div class="form-group col-md-6">
      <label>Mobile</label>
      <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" placeholder="Enter Company URL">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Company Location</label>
      <input type="text" class="form-control" id="company_location" name="company_location" value="<?php echo $company_location; ?>"placeholder="Enter Your Email">
    </div>
    <div class="form-group col-md-6">
      <label>Company URL</label>
      <input type="text" class="form-control" id="company_url" name="company_url" value="<?php echo $company_url; ?>" placeholder="Enter Company URL">
    </div>
  </div>

  <!-- <input type='submit' name="insert" value='Save' class='btn btn-primary'> -->

  <?php if(isset($_GET['id'])){ ?>
	<input type='submit' name="Updatebutton" value='Update' class='btn btn-primary'>
<?php } else{?>
<input type='submit' name="insert" value='Save' class='btn btn-primary'>
<?php }	?>

</form>
```




