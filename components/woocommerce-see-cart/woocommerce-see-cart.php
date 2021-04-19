<?php
add_action( 'woocommerce_checkout_before_order_review_heading', function (){
	?>
	<a href="/cart">&larr; See cart</a>
	<?php
});