<?php
class Item {
    private $id;
    private $name;
    private $quantity;
    private $price;

    public function __construct($id, $name, $quantity, $price) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function getId() 
    {
        return $this->id;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getQuantity() 
    {
        return $this->quantity;
    }

    public function getPrice() 
    {
        return $this->price;
    }
}

class Customer {
    private $first_name;
    private $last_name;
    private $addresses = [];

    public function setFirstName($firstName) 
    {
        $this->first_name = $firstName;
    }

    public function getFirstName() 
    {
        return $this->first_name;
    }

    public function setLastName($lastName) 
    {
        $this->last_name = $lastName;
    }

    public function getLastName() 
    {
        return $this->last_name;
    }

    public function getCustomerName() 
    {
        return $this->first_name . " " . $this->last_name;
    }    

    public function addAddress($address) 
    {
        $this->addresses[] = $address;
    }

    public function getAddresses() 
    {
        return $this->addresses;
    }

    public function setSelectedAddress($address) 
    {
        $this->selectedAddress = $address;
    }

    public function getSelectedAddress() 
    {
        return $this->selectedAddress;
    }    
}

class Address {
    private $line1;
    private $line2;
    private $city;
    private $state;
    private $zip;

    public function __construct($line1, $line2, $city, $state, $zip) 
    {
        $this->line1 = $line1;
        $this->line2 = $line2;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
    }

    public function getLine1() 
    {
        return $this->line1;
    }

    public function getLine2() 
    {
        return $this->line2;
    }

    public function getCity() 
    {
        return $this->city;
    }

    public function getState() 
    {
        return $this->state;
    }

    public function getZip() 
    {
        return $this->zip;
    }
}

class Cart {
    private $customer;
    private $items = [];
    private $tax_rate = 0.07;

    public function setCustomer($customer) 
    {
        $this->customer = $customer;
    }

    public function getCustomer() 
    {
        return $this->customer;
    }

    public function addItem($item) 
    {
        $this->items[] = $item;
    }

    public function getItems() 
    {
        return $this->items;
    }

    public function getItemCost($item)
    {
        $itemCost = 0;
        $itemCost += $item->getPrice() + $this->tax_rate + $this->getShippingCost($this->getCustomer());
        return $itemCost;
    }

    public function getShippingCost($customer) 
    {
        $shippingRate = $this->fetchShippingRateFromAPI($customer->getSelectedAddress());
        $shippingCost = $shippingRate * $someCalculation;
        return $shippingCost;
    }

    public function getSubtotal() 
    {
        $subtotal = 0;
        foreach ($this->items as $item) {
            $subtotal += $item->getPrice() * $item->getQuantity();
        }
        return $subtotal;
    }

    public function getTotal() 
    {
        $subtotal = $this->getSubtotal();
        $tax = $subtotal * $this->tax_rate;
        return $subtotal + $tax;
    }
}
