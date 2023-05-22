<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ClientInvoice;
use App\Exports\AccountStatementExport;

class IncomeComponent extends Component
{

    public $client_id;
    public $from_date;
    public $to_date;
    public function render()
    {
        $incomes = ClientInvoice::where( function($query) {
            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('client_invoice_date', [$this->from_date,$this->to_date]);
            }

            if(!empty($this->client_id) ){
                $query->where('client_id',$this->client_id);
            }

        })->where('part_paid', '>' , '0')->paginate(20);
            return view('livewire.income-component',compact('incomes'));

    }




    public function export()
    {
        $from_date= $this->from_date;
        $to_date = $this->to_date;
        $client_id = $this->client_id;



        return Excel::download(new AccountStatementExport( $from_date,$to_date,$client_id), 'clients.xlsx');

    }
}
