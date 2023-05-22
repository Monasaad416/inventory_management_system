<?php

namespace App\Exports;

use App\Models\ClientInvoice;
use Maatwebsite\Excel\Concerns\FromCollection;

class AccountStatementExport implements FromCollection
{
    public $from_date,$to_date,$client_id;
    public function __construct($from_date,$to_date,$client_id){
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->client_id = $client_id;
    }
    public function collection()
    {
        $clientInvoices = ClientInvoice::where( function($query) {
            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('client_invoice_date', [$this->from_date,$this->to_date]);

            }
            if(!empty($this->client_id) ){
                $query->where('client_id',$this->client_id);
            }
        })->paginate(20);
        return $clientInvoices;
    }


  
}
