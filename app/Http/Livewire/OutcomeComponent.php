<?php

namespace App\Http\Livewire;

use App\Exports\OutcomesExport;
use App\Models\Outcome;
use Livewire\Component;
use App\Models\Supplier;
use Excel;

class OutcomeComponent extends Component
{
    public $supplier_id;
    public $store;
    public $from_date;
    public $to_date;
    public function render()
    {
        $outcomes = Outcome::where( function($query) {
            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

            }
            if(!empty($this->supplier_id) ){
                $query->where('outcomable_type','App\Models\User')->where('outcomable_id',$this->supplier_id);
            }
            if(!empty($this->store) ){
                $query->where('outcomable_type','App\Models\Store');
            }

        })->paginate(20);
        return view('livewire.outcome-component',compact('outcomes'));
    }




    public function export()
    {
        $from_date= $this->from_date;
        $to_date = $this->to_date;
        $supplier_id = $this->supplier_id;
        $store = $this->store;


        return Excel::download(new OutcomesExport( $from_date,$to_date,$supplier_id,$store), 'outcome.xlsx');
    }
}
