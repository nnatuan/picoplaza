<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
function add_cart($id, $qty)
{
    $new_item = array(
        array(
            'id' => $id,
            'qty' => $qty
        )
    );
    $cart     = array();
    if (isset($_SESSION["cart"])) {
        $found = false;
        foreach ($_SESSION["cart"] as $cart_itm) {
            if ($cart_itm["id"] == $id) {
                $cart[] = array(
                    'id' => $cart_itm["id"],
                    'qty' => $qty + $cart_itm["qty"]
                );
                $found  = true;
            } else {
                $cart[] = array(
                    'id' => $cart_itm["id"],
                    'qty' => $cart_itm["qty"]
                );
            }
        }
        if ($found == false) {
            $_SESSION["cart"] = array_merge($cart, $new_item);
        } else {
            $_SESSION["cart"] = $cart;
        }
    } else {
        $_SESSION["cart"] = $new_item;
    }
}
function update_cart($id, $qty)
{
    $new_item = array(
        array(
            'id' => $id,
            'qty' => $qty
        )
    );
    $cart     = array();
    if (isset($_SESSION["cart"])) {
        $found = false;
        foreach ($_SESSION["cart"] as $cart_itm) {
            if ($cart_itm["id"] == $id) {
                $cart[] = array(
                    'id' => $cart_itm["id"],
                    'qty' => $qty
                );
                $found  = true;
            } else {
                $cart[] = array(
                    'id' => $cart_itm["id"],
                    'qty' => $cart_itm["qty"]
                );
            }
        }
        if ($found == false) {
            $_SESSION["cart"] = array_merge($cart, $new_item);
        } else {
            $_SESSION["cart"] = $cart;
        }
    } else {
        $_SESSION["cart"] = $new_item;
    }
}
function remove_cart($id)
{
    foreach ($_SESSION["cart"] as $cart_itm) {
        if ($cart_itm["id"] != $id) {
            $cart[] = array(
                'id' => $cart_itm["id"],
                'qty' => $cart_itm["qty"]
            );
        }
        $_SESSION["cart"] = $cart;
    }
}
function empty_cart()
{
    $_SESSION["cart"]      = NULL;
    $_SESSION["cname"]     = NULL;
    $_SESSION["cemail"]    = NULL;
    $_SESSION["cphone"]    = NULL;
    $_SESSION["cquantity"] = NULL;
    $_SESSION["cnote"]     = NULL;
    $_SESSION["ntotal"]    = NULL;
}
