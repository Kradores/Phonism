<?php

class Item
{
    private $id;
    private $name;
    private $quantity;
    private $price;
    private $shippingCost;
    private $tax;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of shippingCost
     */
    public function getShippingCost()
    {
        return $this->shippingCost;
    }

    /**
     * Set the value of shippingCost
     *
     * @return  self
     */
    public function setShippingCost($shippingCost)
    {
        $this->shippingCost = $shippingCost;

        return $this;
    }

    /**
     * Get the value of tax
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Set the value of tax
     *
     * @return  self
     */
    public function setTax($tax)
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Get the value of totalItemCost
     */
    public function getTotalCost()
    {
        return ($this->price + $this->shippingCost) * (1 + $this->tax);
    }

    /**
     * Get the value of totalItemCost
     */
    public function toArray()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "quantity" => $this->quantity,
            "price" => $this->price
        ];
    }
}
