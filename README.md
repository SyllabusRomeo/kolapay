# kolapay
This is a woocommerce payment plugin with local mobile payment options enabled.
The plugin is built specifically for the mobile payment options in Ghana.
This plugin can however be updated to suite any local mobile money payment.

# Requirements
1. Install Woocommerce plugin for your ecommerce store.
2. Add this line of code to the **abstract-wc-order.php** file in ***woocommerce/includes/abstracts*** folder.
   This code snippet gets the meta data from the checkout form to your local API
   ```ruby
	/**
	 * Get Momo Details for Api.
	 *
	 * @param  string $request payment_number or paying_network.
	 * @return string
	 */
 	public function get_momo_data( $request = null) {
		return $this->get_meta($request);
	}
	```
3. Upload kolapy-plugin

4. Code to allow reroute to **login/register** page before checkout Insert this code in the ***functions.php*** file of theme file.
   Video illusration can be found here: https://www.youtube.com/watch?v=x-39Q04uWP8 
  ```ruby
  /**
   * Redirect to Login/Registration Page from Checkout if customer is not logged in.
   * */
 
  add_action('template_redirect','check_if_logged_in');
  function check_if_logged_in(){
      $pageid = 251; // your checkout page id
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
  ```
  
