<?php

use PHPUnit\Framework\TestCase;

require_once 'user.php';
require_once 'address.php';
require_once 'shipping.php';
require_once 'products.php';
require_once 'shipping.php';
require_once 'order.php';


class OrderTest extends TestCase
{
    public function testOrderHaveReceipt(){
        $address = new address();
        $address->o_city = 'cairo';
        $address->o_street = 'el tahrir';
        $address->o_country = 'egypt';

        $shipping = new shipping();
        $shipping->s_name = 'aramex';
        $shipping->s_tax = 13;
        $shipping->s_cost = 10;

        $product = new products();
        $product->_name = 't-shirt';
        $product->_price = 50;
        $product->_quantity= 30;
        $product->_category = 'men';
        $product->_attributes = ['size' => 'small','color' => 'red'];

        $user = new user();
        $user->name = 'ahmed mohamed';
        $user->address = $address;

        $order = new order();
        $order->o_user = $user;
        $order->p_products = [$product];
        $order->s_tax = .02;
        $order->p_shipping = $shipping;
        $order->order = $product->_price;
        $order->change_status('delivering');
        $print_receipt = $order->print_receipt();
        $this->assertEquals('total price : 83.16 #|# user name : ahmed mohamed #|# product name : t-shirt category : men price : 60 #|# size small #|# color red',$print_receipt);
    }
}
