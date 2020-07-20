# kolapay. 
This is a woocommerce payment plugin with local mobile payment options enabled.
The plugin was built specifically for mobile payments in Ghana.
This plugin can however be updated to suite any local mobile money payment.

# Requirements
1. You need to install Woocommerce plugin for your ecommerce store. Without it the pugin would force an error.
2. Add this line of code to the abstract-wc-order.php file in woocommerce/includes/abstracts folder.
   This code snippet gets the meta data from the checkout form to your local API
	/**
	 * Get Momo Details for Api.
	 *
	 * @param  string $request payment_number or paying_network.
	 * @return string
	 */
 	public function get_momo_data( $request = null) {
		return $this->get_meta($request);
	}
3. Upload kolapy-plugin
