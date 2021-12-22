<?php

class address
{
    private $address_city;
    private $address_street;
    private $address_country;
    private $address_nearest_point;
    private $address_map;

    public function getAddressCity()
    {
        return $this->address_city;
    }

    public function getAddressStreet()
    {
        return $this->address_street;
    }

    public function getAddressCountry()
    {
        return $this->address_country;
    }

    public function getAddressNearestPoint()
    {
        return $this->address_nearest_point;
    }

    public function getAddressMap()
    {
        return $this->address_map;
    }
}