<?php 
//Remove “Update Cart” button and Do It Automatically on Quantity Change
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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Refresh page when delete the product on cart page
// in footer.php
<script>
if(jQuery(".page-id-16406").length){
	jQuery('body').on('updated_cart_totals',function() {
	   location.reload(); // uncomment this line to refresh the page.
	});
}
<script>
