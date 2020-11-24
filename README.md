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

4. Addition field for Mobile Money Network selection
   
    /**
    *Add Momo to billing address
    *NB: edit the wc-account-functions.php in the woocommerce includes file
    */
    add_filter( 'woocommerce_default_address_fields', 'romeo_add_field' )
    function romeo_add_field( $fields ) {

    	$fields['momo_network']   = array(
    		'label'        => 'Mobile Money Network',
    		'required'     => true,
    		'class'        => array( 'form-row-wide', 'my-custom-class' ),
    		'priority'     => 20,
    		'options'=>array(
    		        ''         => 'Please select mobile money network',
    		        'mtnmomo'  => 'MTN Momo',
    		        'airtel'   => 'AirtelTigo Money',
    		        'vodafone' => 'Voda Cash',
    		    ),
    	);
     
    	return $fields;
     
    }

Code to allow reroute to login/register page before checkout
/**
 * Redirect to Login/Registration Page from Checkout if customer is not logged in.
 * */
add_action('template_redirect','check_if_logged_in');

function check_if_logged_in(){
    $pageid = 301; // your checkout page id
    if(!is_user_logged_in() && is_page($pageid))
    {
        $url = add_query_arg(
            'redirect_to',
            get_permalink($pagid),
            site_url('/my-account/') // your my acount url
        );
        wp_redirect($url);
        exit;
    }
}
