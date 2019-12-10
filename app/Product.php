<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $items = null;
        public $totalQty = 0;
        public $totalPrice = 0;

        public function add($qty, $price, $item, $id) {
            $storedItem = ['qty' => $qty, 'price' => $price, 'item' => $item];
            $storedItem['price'] = $item->prijs * $storedItem['qty'];
            $this->items[$id] = $storedItem;
            $this->totalQty += $storedItem['qty'];
            $this->totalPrice += $storedItem['price'];
        }    
}
