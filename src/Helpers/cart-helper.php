<?php


/**
 *
 */
function recently_viewed_items(){

    return 'recently_viewed_items';
}

/**
 * this is cart helper functions
 */
function cartValue($key){

    $value = $count = 0;
    if(session()->has($key))
    {

        if($carts = session()->get($key)){

            foreach($carts as $index => $cart){
                $value += ((float)$cart['price']* (float)$cart['qty']);
                $count += 1;
            }
        }
    }

    return (object) ['count'=>$count, 'value'=>number_format((float)$value, 2, '.', '')];
}

function cart($key){

    return session()->get($key)??0;
}

function currency()
{
    return '£';
}

/**
 * Calculate and return monitary value
 */

function money($value)
{
    return number_format((float)$value, 2, '.', '');
}

/**
 * This should return the discount value of coupon code
 */
function cart_discount()
{
    try{
        $amount = 0;

        if($discounts = session()->get('discounts')??''){

            foreach($discounts as $discount)
            {
                $amount += $discount->value??0;
            }
        }

        return money($amount);

    }catch(\Exception $e){
        return 0.00;
    }
}

/**
 * Calculate sub Total and return monetary value and the weight
 */
function total()
{

    // clear_seesion();

    $total = [
        "total"     => 0,
        "weight"    => 0,
        "shipping"  => 0,
    ];

    try{

        if($carts = cart('cart'))
        {

            foreach($carts as $index => $cart)
            {
                $total['total'] += (float)($cart['qty']*clean_number($cart['price']));
                $total['weight'] += ((float)$cart['qty']*(float)$cart['size']);
            }

            $total['shipping'] = shipping($total['total']);
        }
        return (object)$total;

    }catch(\Exception $e){
        // throw exception of die
        return (object) $total;
    }
}

/**
 * Calculate shipping charge
 */
// function shipping($weight)
// {
//     $shipping = 0;

// 	if($weight <= 15 ){
// 		$shipping = (float) env('APP_SHIPPING_CHARGE');
// 	}else if($weight > 15 && $weight <= 20){
// 		$shipping = 9.99;
// 	}else if($weight > 20 && $weight <= 30){
// 		$shipping = 12.99;
// 	}else if($weight > 30){
// 		$extra = env('APP_SHIPPING_EXTRA_CHARGE'); // 50p or £1/3 = 0.3
// 		$shipping = ((((float)$weight - 30) * (float)$extra) + 12.99);
// 	}
// 	return $shipping;
// }

function shipping( $total )
{
    $shipping = env('APP_SHIPPING_CHARGE');

    $subtotal = $total;

    if($subtotal > 60){
        $shipping = 10.99;
    }

    if($subtotal > 90){
        $shipping = 13.99;
    }

    if($subtotal > 120){
        $shipping = 16.99;
    }
    return $shipping;
}

function delivery_charge(){

    try
    {
        $total = (array)total();
        $order_total = (object) $total;

        $shipping = $order_total->shipping;

        if(env('APP_DELIVERY_DISCOUNTED'))
        {
            $shipping = $order_total->shipping / 2;
        }

        return $shipping;

    }catch(\Exception $e){
        return 0;
    }
}

function clean_number($string)
{
    return preg_replace('~[^A-Za-z\.\d\s-]+~u', '', $string);
}

/**
 * -----------------------  CHECKOUT HELPERS ----------------- */

function _final_charge(float $discount = 0)
{
    $total = money((float) total()->total??0) ;

    $shipping_charge = ((float) total()->shipping ?? 0);

    return ( $total += ($shipping_charge - $discount) ) - cart_discount();
}

function _shipping_discount(float $value, bool $is_percent = true): float
{
    $shipping_charge = total()->shipping ?? 0;

    if($is_percent)
    {
        return ($shipping_charge * $value) / 100;
    }

    return $shipping_charge - $value;
}

function _shipping_estimate(): string
{
    $weight = total()->weight ?? 0;
    $charge = money(total()->shipping??0);

    $shipping = env('APP_SHIPPING_WEIGHT') ? $weight . 'kg = £' . $charge : '£' . $charge;

    return $shipping;
}

/**
 * @return object|null
 */
function _voucher(): ?object
{
    $voucher = session()->get('voucher');

    $voucher = (object) $voucher;

    return $voucher;
}

/**
 * @return int
 */
function get_options_delivery(){

    return session()->get(env('APP_CART_DELIVERY_OPTION_MODE')) ? 1 : 0;
}

function is_pickup_mode() {

    if(get_options_delivery() == 0){
        return false;
    }

    return true;
}

/**
 * This mewrge the functionality of option deliver with default charge
 */
function set_options_shipping($option){

    session()->put(env('APP_CART_DELIVERY_OPTION'), $option);
}

function get_option_shipping(){

    $delivery_charge = (float) delivery_charge();

    $option = session()->get(env('APP_CART_DELIVERY_OPTION')) ?? 0;

    switch($option){
        case 2: $delivery_charge = 6.99; break;
        case 3: $delivery_charge = 0.1; break;
        case 1:
        case 0:
            $delivery_charge = total()->shipping ?? 6.99;
            break;
    }

    return $delivery_charge;
}

function clear_seesion(){

    $store_keys = [
        'checkout', 'cart', 'carts', 'delivery_charge','order_code',
        env('APP_CART_DELIVERY_OPTION')
    ];

    foreach($store_keys as $key){

        session()->forget($key);
        session()->save();
    }

}
