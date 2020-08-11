<?php

require_once dirname(__FILE__) . "/Item.php";
require_once dirname(__FILE__) . "/Customer.php";
require_once dirname(__FILE__) . "/Cart.php";

// dummy data

$item1 = new Item;
$item1->setId(159159);
$item1->setName("CocaCola 1L");
$item1->setQuantity(3);
$item1->setPrice(2.95);
$item1->setTax(0.07);

$item2 = new Item;
$item2->setId(259259);
$item2->setName("Apple iPhone 8");
$item2->setQuantity(1);
$item2->setPrice(364);
$item2->setTax(0.07);

$item3 = new Item;
$item3->setId(359359);
$item3->setName("Touch glass");
$item3->setQuantity(1);
$item3->setPrice(4.50);
$item3->setTax(0.07);

$cart = new Cart;
$cart->setId(123123123);
$cart->setShippingAddress(
    array(
        "address" => "3362  Devils Hill Road",
        "city" => "Terry",
        "state" => "Mississippi",
        "zip" => 39170
    )
);
$cart->setItems([$item1, $item2, $item3]);
$cart->setItemsShippingCost();

$customer = new Customer;
$customer->setFirstName("Marco");
$customer->setLastName("Burns");
$customer->setAddress(
    array(
        "address_1" => "3362  Devils Hill Road",
        "address_2" => "3360  Devils Hill Road",
        "city" => "Terry",
        "state" => "Mississippi",
        "zip" => 39170
    )
);
$customer->setCart($cart);

/*
- Customer Name
- Customer Addresses
- Items in Cart
- Where Order Ships
- Cost of item in cart, including shipping and tax
- Subtotal and total for all items
*/

// Customer Name - Full or First ?
$customerFullName = $customer->getFullName();
$customerFirstName = $customer->getFirstName();

// Customer Addresses
$customerAddress = $customer->getAddress();

// Items in Cart
$itemsInCart = $cart->getItems();
// or 
$itemsInCart = $customer->getCart()->getItemsToArray();
// or get single item by id
$singleItem = $customer->getCart()->getItem(259259);

// Where Order Ships
$shippingAddress = $cart->getShippingAddress();

// Cost of item in cart, including shipping and tax
$totalItemCost = $singleItem->getTotalCost();

// Subtotal and total for all items
$subtotal = $cart->getSubtotal();
$totalCost = $cart->getTotalCost();

print_r([
    "customer_name" => $customerFullName,
    "customer_address" => $customerAddress,
    "items_in_cart" => $itemsInCart,
    "shipping_address" => $shippingAddress,
    "item" => [
        "item_name" => $singleItem->getName(),
        "total_item_cost" => $totalItemCost
    ],
    "subtotal" => $subtotal,
    "total" => $totalCost
]);
