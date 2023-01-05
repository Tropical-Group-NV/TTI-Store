<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BTWCalculator extends Component
{
    public $retail = 0;
    public $retailBtw= 0;
    public $invoicePrice= 0;
    public $percentageRet= 0;
    public $priceRet= 0;
    public $btwRet= 0;
    public $pricePerTray= 0;
    public $pricePerBottle= 0;
    public $stuks;
    public $priceType;

    public function boot()
    {
//        $this->invoicePrice = number_format(((0.1 * $this->retail) + $this->retail) * ($this->percatageRate/100) + ((0.1 * $this->retail) + $this->retail), 2);
    }
    public function calculate($retailPrice, $perc)
    {
        $this->retail = $retailPrice ;
        $this->percentageRet = $perc;
        $this->invoicePrice =  number_format((0.1 * $this->retail) + $this->retail, 2) ;
        $this->retailBtw =  number_format((0.1 * $this->retail), 2);
        $this->priceRet =  number_format(($this->percentageRet/100) * ($this->retail) + ($this->retail), 2);
        $this->btwRet = number_format(0.1 * (($this->percentageRet/100) * ($this->retail) + ($this->retail)), 2) ;
        $this->pricePerTray = number_format((0.1 * ((($this->percentageRet/100) * ($this->retail)) + ($this->retail))) + (($this->percentageRet/100) * ($this->retail) + ($this->retail)) , 2)  ;
        $this->pricePerBottle = number_format((((0.1 * ((($this->percentageRet/100) * ($this->retail)) + ($this->retail))) + (($this->percentageRet/100) * ($this->retail) + ($this->retail))) / 6), 2);
//        $this->invoicePrice = number_format(((0.1 * $this->retail) + $this->retail) * ($this->percatageRate/100) + ((0.1 * $this->retail) + $this->retail), 2);
    }
    public function render()
    {
        return view('livewire.btw-calculator');
    }
}
