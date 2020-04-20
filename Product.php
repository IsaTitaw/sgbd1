<?php 
//objet metier - entities



class Product {
    private $pk;
    private $name;
    private $price;
    private $vat;
    private $price_vat;
    private $price_total;
    private $quantity;
    
    function __construct($pk, $name, $price, $vat, $quantity) {
        $this->pk = $pk;
        $this->name = $name;
        $this->price = $price;
        $this->vat = $vat;
        $this->price_vat = $this->computeVat($price, $vat);
        $this->price_total = $this->computeTotal($price, $this->price_vat);
        $this->quantity = $quantity;
    }

    function computeVat($price, $vat){
        return $price*($vat/100);
    }

    function computeTotal($price, $price_vat){
        return $price+$price_vat;
    }
    
    function __get($property) {
        if (property_exists($this, $property)) {
			return $this->$property;
		}
    }
    
    function __set($property, $value) {
        if (property_exists($this, $property)) {
			$this->$property = $value;
		}
    }
}
