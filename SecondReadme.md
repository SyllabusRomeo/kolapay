```ruby
/**
 * Make fields read only.
 * 
 * */
 /*disable phone editing of billing address from checkout page*/
 add_action('woocommerce_checkout_fields','readonly_billing_email',10,1);
 
 function readonly_billing_email($checkout_fields){
     $checkout_fields['billing']['billing_email']['custom_attributes'] = array('readonly' => 'readonly');
     return $checkout_fields;
 }
 
// add_action('woocommerce_checkout_fields','customization_readonly_billing_fields',10,1);
// function customization_readonly_billing_fields($checkout_fields){
//     $current_user = wp_get_current_user();;
//     $user_id = $current_user->ID;
//     foreach ( $checkout_fields['billing'] as $key => $field ){
//         if($key == 'billing_address_1' || $key == 'billing_address_2'){
//             $key_value = get_user_meta($user_id, $key, true);
//             if( strlen($key_value)>0){
//                 $checkout_fields['billing'][$key]['custom_attributes'] = array('readonly'=>'readonly');
//             }
//         }
//     }
//     return $checkout_fields;
// }
```
