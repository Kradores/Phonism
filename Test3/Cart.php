<?php

class Cart
{
    private $id;
    private $items;
    private $shippingAddress;

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
     * Get the value of items
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Get the value of items
     */
    public function getItemsToArray()
    {
        $itemsArray = array();
        /** @var Item $item */
        foreach ($this->items as $item) {
            $itemsArray[] = $item->toArray();
        }

        return $itemsArray;
    }

    /**
     * Set the value of items
     *
     * @return  self
     */
    public function setItems(array $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Append to items
     *
     * @return  self
     */
    public function addItem(Item $item)
    {
        if (is_array($this->items)) {
            $this->items = array_push($item);
        } else {
            $this->items = [$item];
        }

        return $this;
    }

    /**
     * Get Item by item id
     *
     * @return  Item
     */
    public function getItem(int $id)
    {
        /** @var Item $item */
        foreach ($this->items as $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }
    }

    /**
     * Get the value of shippingAddress
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    /**
     * Set the value of shippingAddress
     *
     * @return  self
     */
    public function setShippingAddress($shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;

        return $this;
    }

    /**
     * Set items shipping cost
     *
     * @return  self
     */
    public function setItemsShippingCost()
    {
        /** @var Item $item */
        foreach ($this->items as $item) {
            $item->setShippingCost(
                // API::GetItemShippingCost(
                //     $item->getName(),
                //     $this->getShippingAddress()
                // )
                10
            );
        }

        return $this;
    }

    /**
     * Get subtotal
     * 
     * @return int
     */
    public function getSubtotal()
    {
        $subtotal = 0;
        /** @var Item $item */
        foreach ($this->items as $item) {
            $subtotal += $item->getPrice() + $item->getShippingCost();
        }

        return $subtotal;
    }

    /**
     * Get cart total cost
     * 
     * @return int
     */
    public function getTotalCost()
    {
        $total = 0;
        /** @var Item $item */
        foreach ($this->items as $item) {
            $total += $item->getTotalCost();
        }

        return $total;
    }
}
