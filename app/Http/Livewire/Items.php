<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Items extends Component
{

    public $search2;
    public $search_str;
    public $search_sw = 0;
    public $count = 0;
    public $message;
    public $list;

    public function sug_search()
    {
        if ($this->search_sw == 0)
        {
            if (strlen($this->search2) > 0)
            {
                $this->search_sw = 1;
            }
        }
        else
        {
            if (strlen($this->search2) > 0)
            {
                $this->list = DB::connection('epas')->table('item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search2 . '%')->orderBy('TimeModified', 'DESC')->limit(10)->get();
            }
        }
    }

    public function mount()
    {
        if (isset($_REQUEST['search']))
        {
            $this->search_str = $_REQUEST['search'];

        }
        $this->list = DB::connection('epas')->table('item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search2 . '%')->orderBy('TimeModified', 'DESC')->limit(10)->get();

    }

//    protected $listeners = ['count_up' => 'increment'];



    public function render(Request $request)
    {
        $items = DB::connection('epas')->table('item')->where('IsActive', '0')->orderBy('TimeModified', 'DESC')->limit(10)->get();
        if ($this->search_str != null)
        {
            return view('livewire.items', ['items' =>  DB::connection('epas')->table('item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search_str . '%')->orderBy('TimeModified', 'DESC')->paginate(10)]);
//            return view('livewire.items', ['items' =>  DB::connection('epas')->table('item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $_REQUEST['search'] . '%')->orderBy('TimeModified', 'DESC')]);
        }
        else
        {
            return view('livewire.items', ['items' =>  DB::connection('epas')->table('item')->where('IsActive', '1')->orderBy('TimeModified', 'DESC')->paginate(10)]);
//            return view('livewire.items', ['items' =>  DB::connection('epas')->table('item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search2 . '%')->orderBy('TimeModified', 'DESC')]);
        }
//        return view('livewire.items');
    }



    public function increment()
    {
        $this->count++;
    }
}
