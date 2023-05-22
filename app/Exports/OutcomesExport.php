<?php

namespace App\Exports;

use App\Models\Outcome;
use Maatwebsite\Excel\Concerns\FromCollection;

class OutcomesExport implements FromCollection
{
    
    public $from_date,$to_date,$supplier_id,$store;
    public function __construct($from_date,$to_date,$supplier_id,$store){
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->supplier_id = $supplier_id;
        $this->store = $store;
    }
    public function collection()
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
        return $outcomes;
    }


        public function headings(): array
    {
        return ["outcomable_type", "amount", "details" ,'created_at'];
    }
}
