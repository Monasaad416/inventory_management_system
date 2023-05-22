<?php

namespace App\Http\Livewire;

use App\Exports\AccountStatementExport;
use Excel;
use Livewire\Component;
use App\Models\ClientInvoice;

class AccountStatementComponent extends Component
{
    public $client_id;
    public $from_date;
    public $to_date;
    public function render()
    {


        $clientInvoices = ClientInvoice::where( function($query) {
            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('client_invoice_date', [$this->from_date,$this->to_date]);

            }
            if(!empty($this->client_id) ){
                $query->where('client_id',$this->client_id);
            }

        })->paginate(20);
        return view('livewire.account-statement-component',compact('clientInvoices'));
    }


    public function export()
    {
        $from_date= $this->from_date;
        $to_date = $this->to_date;
        $client_id = $this->client_id;

        return Excel::download(new AccountStatementExport( $from_date,$to_date,$client_id), 'account-statement.xlsx');
    }
}
