<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class Cart
{
    public $items=[];
    public $totalQty;
    public $totalprice;
    public function __Construct($cart=null) {
        if($cart) {
            $this->items=$cart->items;
            $this->totalQty=$cart->totalQty;
            $this->totalprice=$cart->totalprice;
        }
        else {
            $this->items=[];
            $this->totalQty=0;
            $this->totalprice=0;
        }
    }
    public function add($course)
    {
        $item=[
            "id"=>$course->id,
            "title"=>$course->title,
            "description"=>$course->description,
            "price"=>$course->price,
            "image"=>$course->photo->filename,
            "qty"=>0,
        ];
        if(!array_key_exists($course->id,$this->items)) {
            $this->items[$course->id]=$item;
            $this->totalQty +=1;
            $this->totalprice +=$course->price;
        }
        else {
            // $this->totalQty +=1;
            // $this->totalprice +=$course->price;
        }
        $this->items[$course->id]['qty'] +=1;
    }
    public function remove($id)
    {
        if(array_key_exists($id,$this->items))
        {
            $this->totalQty -=$this->items[$id]['qty'];
            $this->totalprice -=$this->items[$id]['qty'] * $this->items[$id]['price'];
            unset($this->items[$id]);
        }
    }
}
