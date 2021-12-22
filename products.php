<?php

class products
{
    private $product_name;
    private $product_quantity;
    private $product_category;
    private $product_attributes;
    private $product_price;

    public function getName(){
        return $this->product_name;
    }

    public function getQuantity(){
        return $this->product_quantity;
    }

    public function getCategory(){
        return $this->product_category;
    }

    public function getAttributes(){
        return $this->product_attributes;
    }

    public function getPrice(){
        return $this->product_price;
    }
    
    public function calculatePrice(){
        foreach ($this->product_attributes as $key => $attribute){
            if ($key == 'size'){
                if ($attribute == 'small') {
                    $this->product_price -= 10;
                }
                elseif ($attribute == 'medium') {
                    $this->product_price += 20;
                }
                elseif ($attribute == 'large') {
                    $this->product_price += 50;
                }
                else {
                    throw new exception("error in size");
                }
            }
            elseif ($key == 'color'){
                if ($attribute == 'white') {
                    $this->product_price -= 15;
                }
                elseif ($attribute == 'red') {
                    $this->product_price += 20;
                }
                elseif ($attribute == 'blue') {
                    $this->product_price += 18;
                }
                else {
                    throw new exception("error in color");
                }
            }
            else {
                throw new exception("error in attribute");
            }
        }
        return $this->product_price;
    }
}