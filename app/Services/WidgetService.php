<?php

namespace App\Services;

use Illuminate\Support\Arr;

class WidgetService
{
    public $pack;
    protected $order;
    public $packSizes;
    
    public function __construct() {
        $this->pack = [];
        $this->packSizes = [];    
    }

    function find_packs($packs, $order) {
        $this->packSizes = $packs;
        $smallOrEqualValuesToOrder = Arr::where($packs, function ($pack) use ($order){
            //Identify small or equal-sized packages corresponding to the order.
            return $pack <= $order;
        });
        
        if(!$smallOrEqualValuesToOrder){
           array_push($this->pack, min($packs));
           return array_count_values($this->pack);
           //If not, then return the smallest value, as it will fulfill the order.
        };

        array_push($this->pack, max($smallOrEqualValuesToOrder));
        //Pack the largest available size.
        $order = $order - max($smallOrEqualValuesToOrder);
        //Deduct the quantity of the largest available size from the order.
        if($order){
            //Re-run this function if additional widgets are needed to fulfill the order.
            $this->find_packs($packs, $order);
        }
        $this->send_min_packages();
        //This function attempts to send the minimum number of packages required to fulfill the order.
        return array_count_values($this->pack);
    }

    function send_min_packages(){
        $moreThanTwoCounts = Arr::where(array_count_values($this->pack), function ($pack){
            return $pack > 1;
        });
        //Identify the packed packages with a count greater than 1.
        foreach ($moreThanTwoCounts as $value => $count) {
            //Loop through all packages with a count greater than 1 (moreThanTwoCounts).
            $nValue = 0;
            for ($i = 0; $i < $count; $i++) {
                $nValue  = $nValue + $value;
            }
            //Sum up values to check if a larger package exists with the same quantity of widgets.
            $in_array= in_array($nValue, $this->packSizes);
            if($in_array){
                //If it exists?
                $nPacks = array_filter($this->pack, function ($pack) use ($value) {
                    return $pack !== $value;
                });
                //Then, remove all those packages and send one large package instead.
                array_push($nPacks,$nValue);
                $this->pack = $nPacks;
            }
        }
    }
}