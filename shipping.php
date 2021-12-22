<?php

class shipping
{
    public $shipping_name;
    public $shipping_cost;
    public $shipping_tax;

    public function calculate_tax($address){
        if ($this->shipping_name == 'aramex'){
            if ($address->address_country == 'egypt'){
                return $this->shipping_tax + .14;
            }
            elseif ($address->address_country == 'kuwait'){
                return $this->shipping_tax + .1;
            }
        }
        elseif($this->shipping_name == 'fedex'){
            if ($address->address_country == 'egypt'){
                return $this->shipping_tax + .20;
            }
            elseif ($address->address_country == 'kuwait'){
                return $this->shipping_tax + .13;
            }
        }
    }

    public function notify($message){
        /**
         * TODO
         * we need to add channel to send notification to shipping company but not now
         */
    }
}