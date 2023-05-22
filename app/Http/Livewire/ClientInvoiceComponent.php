<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Product;
use App\Models\Section;
use Livewire\Component;

class ClientInvoiceComponent extends Component
{
    public $products = [] ;
    protected $product_code;
    public $cities;


    public function mount() {
          $this->products = Product::all();
    }

    public function insertProduct(){
        $this->product_code  = Product::where('product_code', '=', $this->product_code)->first();
        dd($this->product_code);
    }
    public function render()
    {
        $this->products = Product::all();
        $sections = Section::all();
        $clients = User::where('roles_name',"['client']")->get();
        return view('livewire.client-invoice-component',compact('sections','clients'));
    }
}
