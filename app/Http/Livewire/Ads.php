<?php

namespace App\Http\Livewire;

use App\Models\Ad;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;


class Ads extends Component
{

    /** TODO Controller for ads */


    /** TODO public variables */
    use WithFileUploads;
    public $ads;
    public $searchstr;
    public $url;
    public $itemID;
    public $type = 1;
    public $itemArray = [];
    public $file1;
    public $fileName;

//    TODO Eventlisteners
    public $listeners =
        [
            'uploaded' => 'render'
        ];

    public function boot()
    {
        $this->itemArray = \App\Models\Item::query()->where('Description', $this->searchstr)->orWhere('FullName', $this->searchstr)->limit(5)->get();
        $this->ads = Ad::query()->get();
    }

    public function searchItem()
    {
//        TODO search for products for ads
        $this->itemArray = \App\Models\Item::query()->where('Description', 'LIKE', '%' . $this->searchstr .'%')->orWhere('FullName', 'LIKE', '%' . $this->searchstr .'%')->limit(5)->get();
//        $this->itemArray = DB::connection('qb_sales')->table('view_item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('type', 'ItemInventory')->orWhere('FullName', 'LIKE', '%' . $this->searchstr . '%')->where('type', 'ItemInventory')->orderBy('Description', 'ASC')->limit(5)->get();
    }

    public function render()
    {
        return view('livewire.ads');
    }
    public function loadType()
    {

    }
    public function addItem($prodID)
    {
//        TODO link product to ad
        $this->itemID = $prodID;
        $this->itemArray = [];
    }

    public function uploadAd()
    {
        $adv = new Ad();
        if ($this->type == 1)
        {
            $adv->type = 1;
            $adv->typeFullName = 'Product';
            $this->file1->store('public/ads');
            $adv->fileName = $this->file1->hashName();
            $adv->prodID = $this->itemID;
            $adv->save();
            $this->emit('uploaded');

        }

        return redirect('upload/ads');
    }

    public function deleteAd($adID)
    {
        Ad::query()->where('id', $adID)->delete();
    }
}
