
<?php

add_filter('woocommerce_gateway_description', 'kolatech_kolapay_description_fields', 20, 2);
add_action('woocommerce_checkout_process', 'kolatech_kolapay_description_fields_validation');
add_action('woocommerce_checkout_update_order_meta', 'kolatech_kolapay_checkout_update_order_meta', 10, 1);
add_action('woocommerce_admin_order_data_after_billing_address', 'kolatech_kolapay_order_data_after_billing_address', 10, 1);
add_action('woocommerce_order_item_meta_end', 'kolatech_kolapay_order_item_meta_end', 10, 3);



function kolatech_kolapay_description_fields($description, $payment_id){
    
    if('kolapay' !== $payment_id){
        return $description;
    }

    ob_start();
    
    echo '<div style="display: block; width: 100px; height:auto;">';
    echo '<img src="'.plugins_url('../assets/Kolapay_Checkout_Logo_1.png', __FILE__) .'">';

    woocommerce_form_field(
        'payment_number',
        array(
            'type'     => 'text',
            'label'    => __('Mobile Money Number', 'kolapay-woo'),
            'class'    => array('form-row', 'form-row-wide'),
            'required' => true,
        )
    );
    woocommerce_form_field(
        'paying_network',
        array(
            'type'     => 'select',
            'label'    => __('Payment Network', 'kolapay-woo'),
            'class'    => array('form-row', 'form-row-wide'),
            'required' => true,
            'options'  => array(
                'none'       => __('Select Network', 'kolapay-woo'),
                'MTN'        => __('MTN Momo', 'kolapay-woo'),
                'AIRTELTIGO' => __('AirtelTigo Cash', 'kolapay-woo'),
                'VODAFONE'   => __('Voda Cash', 'kolapay-woo'),
            ),
        )
    );
    echo '</div>';

    $description .= ob_get_clean();

    return $description;
}

function kolatech_kolapay_description_fields_validation(){
    if('kolapay' === ['$payment_method'] && ! isset($_POST['payment_number']) || empty($_POST['payment_number'])){
        wc_add_notice('Please enter your number to be billed', 'error');
    }
}

function kolatech_kolapay_checkout_update_order_meta($order_id){
    if (isset($_POST['payment_number']) && ! empty($_POST['payment_number']) && isset($_POST['paying_network']) && ! empty($_POST['paying_network'])) {
        update_post_meta($order_id, 'payment_number', $_POST['payment_number']);
        update_post_meta($order_id, 'paying_network', $_POST['paying_network']);
    }
}

function kolatech_kolapay_order_data_after_billing_address($order){
    echo '<p><strong>'. __('Mobile Money Number: ', 'kolapay-woo').'</strong><br/>'. get_post_meta($order ->get_id(), 'payment_number', true) .'</p>';
}

function kolatech_kolapay_order_item_meta_end($item_id, $item, $order){
    echo '<p><strong>'. __('Mobile Money Number: ', 'kolapay-woo').'</strong><br/>'. get_post_meta($order ->get_id(), 'payment_number', true) .'</p>';
}

























?>