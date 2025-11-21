<?php

function cartCount()
{
    $cart = session('cart', []);

    return collect($cart)->sum('quantity');
}
