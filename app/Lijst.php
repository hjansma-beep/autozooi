<?php
namespace App;
class Lijst
{
        public $items = null;
        public $totalQty = 0;
        public $totalPrice = 0;
        public function __construct($oldLijst)
        {
            if ($oldLijst) {
                $this->items = $oldLijst->items;
                $this->totalQty = $oldLijst->totalQty;
                $this->totalPrice = $oldLijst->totalPrice;
            }
        }
        public function add($item, $id) {
            $storedItem = ['qty' => 0, 'price' => $item->prijs, 'item' => $item];
            if ($this->items) {
                if (array_key_exists($id, $this->items)) {
                    $storedItem = $this->items[$id];
                }
            }
            $storedItem['qty']++;
            $storedItem['price'] = $item->prijs * $storedItem['qty'];
            $this->items[$id] = $storedItem;
            $this->totalQty++;
            $this->totalPrice += $item->prijs;
        }    
        public function removeItem($id) {
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['price'];
            unset($this->items[$id]);
        }


}