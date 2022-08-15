<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Items extends Component
{

    public $readyToLoad = false;

    public function loadPosts()
    {
        $this->readyToLoad = true;
     }
    public $value = '';

    public function render(Request $request)
    {
        $items = DB::connection('epas')->table('item')->where('IsActive', '0')->orderBy('TimeModified', 'DESC')->limit(10)->get();
        if (isset($_REQUEST['search']))
        {
            return view('livewire.items', ['items' =>  DB::connection('epas')->table('item')->where('IsActive', '0')->where('description', 'LIKE', '%' . $request->search . '%')->whereNot('BarCodeValue', '')->orderBy('TimeModified', 'DESC')->paginate(10)]);
        }
        else
        {
            return view('livewire.items', ['items' =>  DB::connection('epas')->table('item')->where('IsActive', '0')->whereNot('BarCodeValue', '')->orderBy('TimeModified', 'DESC')->paginate(10)]);
        }
    }




    public function increment()
    {
       $this->value++;
    }
}
