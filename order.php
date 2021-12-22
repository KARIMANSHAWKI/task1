<?php

class order
{
    public $products;
    public $order_user;
    public $product_shipping;
    public $order_inv_num;
    public $order_status;
    public $shipping_tax;
    public $order_price;
    public $order_is_done;

    public function change_status($status,$extra = false){
        if ($status == 'pending') {
            $this->order_status = 'pending';
        }
        elseif ($status == 'accepted') {
            $this->order_status = 'accepted';
            $this->order_user->notify("your order accepted");
            $total_price = 0;
            foreach ($this->products as $product){
                $total_price = $product->calculate_price();
            }
            if ($extra){
                $tax = $this->shipping_tax * 2;
                $tax = $tax + ($this->order_price * $tax);
                if ($tax == 0){
                    $_tax = 1;
                    $this->order_price *= $_tax;
                }
            }
            $this->order_price = $total_price;
        }
        elseif ($status == 'processing') {
            $this->order_status = 'processing';
            $this->order_user->notify("your order is processing");
        }
        elseif ($status == 'delivering') {
            $this->order_status = 'delivering';
            $this->order_user->notify("your order is delivering");
            $this->o_inv_num = rand(1,10);
            $this->product_shipping->notify('we have order, we need to delivery it');
            $t = 0;
            foreach ($this->products as $product){
                $t = $product->calculate_price();
            }
            $this->order_price = $t;
            $tax = $this->shipping_tax + $this->product_shipping->calculate_tax($this->order_user->address);
            $this->order_price += $tax + $this->product_shipping->s_cost ;
        }
        elseif ($status == 'received') {
            $this->order_status = 'pending';
            $this->order_is_done = true;
        }
        elseif ($status == 'rejected') {
            $this->order_status = 'pending';
            $this->order_user->notify("your order is rejected");
        }
        else {
            throw new exception("internal error ");
        }
    }

    public function print_receipt(){
        $receipt = '';
        if ($this->order_status == 'delivering'){
            $receipt .= "total price : " . $this->order_price
                     . ' #|# user name : ' . $this->order_user->name;
            foreach ($this->products as $product){
                $receipt .= ' #|# product name : ' . $product->_name
                        . ' category : ' . $product->_category
                        . ' price : ' . $product->product_price;
                foreach ($product->product_attributes as $key => $attribute){
                    $receipt .= ' #|# ' . $key . ' ' . $attribute;
                }
            }
            return $receipt;
        }
        else{
            throw new Exception("internal error ");
        }
    }
}