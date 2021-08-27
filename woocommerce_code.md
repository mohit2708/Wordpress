##### Remove “Update Cart” button and Do It Automatically on Quantity Change
```php
  //function.php
add_action( 'wp_footer', 'cart_update_qty_script' );
function cart_update_qty_script() {
    if (is_cart()) :
    ?>
  <script>
    jQuery('div.woocommerce').on('change', '.qty', function(){
        jQuery("[name='update_cart']").prop("disabled", false);
        jQuery("[name='update_cart']").trigger("click"); 
    });
    </script>
    <?php
    endif;
}
//in css
.woocommerce button[name="update_cart"],
.woocommerce input[name="update_cart"] {
	display: none;
}
```

##### Refresh page when delete the product on cart page
```php
// in footer.php
<script>
if(jQuery(".page-id-16406").length){
	jQuery('body').on('updated_cart_totals',function() {
	   location.reload(); // uncomment this line to refresh the page.
	});
}
<script>
```
##### Add button similar to add to cart button in single product page
```php
//function.php
add_action('woocommerce_after_add_to_cart_button','cmk_additional_button');
function cmk_additional_button() {
	echo '<button type="submit" class="button alt">Make an Offer</button>';
}
```

##### Add Text Before and After Add to Cart button
```php
add_action( 'woocommerce_before_add_to_cart_button', 'misha_before_add_to_cart_btn' );
function misha_before_add_to_cart_btn(){
	echo 'Some custom text here';
}
```
```php
add_action( 'woocommerce_after_add_to_cart_button', 'misha_after_add_to_cart_btn' );
function misha_after_add_to_cart_btn(){
	echo 'Some custom text here';
}
```

##### Add text On Shop / Product Category Pages
```php
add_filter( 'woocommerce_loop_add_to_cart_link', 'misha_before_after_btn', 10, 3 );

function misha_before_after_btn( $add_to_cart_html, $product, $args ){
	$before = ''; // Some text or HTML here
	$after = ''; // Add some text or HTML here as well

	return $before . $add_to_cart_html . $after;
}
```
	
