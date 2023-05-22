<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Outcome;
use Livewire\Component;
use App\Models\Shareholder;
use App\Models\ClientInvoice;
use App\Models\FounderAccount;
use App\Models\SupplierInvoice;
use App\Models\ClientReturnItem;
use App\Models\ShareholderAccount;
use App\Models\SupplierReturnItem;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\FounderAccountController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FinancialComponent extends Component
{
    use AuthorizesRequests;
    public $client_id;
    public $shareholder_id;
    public $from_date;
    public $to_date;
    public $supplier_id;
    public $user_id;
    public $store;
    public function render()
    {
        if(Gate::allows("supplier")){
            $purchases = SupplierInvoice::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('supplier_invoice_date', [$this->from_date,$this->to_date]);
                }
         
            })->where('user_id',auth()->user()->id)->sum('total');

            
            $part_paid_purchases = SupplierInvoice::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('supplier_invoice_date', [$this->from_date,$this->to_date]);
                }
            })->where('user_id',auth()->user()->id)->sum('part_paid');

            $outcomes = Outcome::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

                }
                if(!empty($this->store) ){
                    $query->where('outcomable_type','App\Models\Store');
                }
                if(!empty($this->supplier_id) ){
                    $query->where('outcomable_type','App\Models\User')->where('outcomable_id',$this->supplier_id);
                }
            })->where('outcomable_type','App\Models\User')->where('outcomable_id',auth()->user()->id)->sum('amount');


             //returned Items
            $returnedItems = SupplierReturnItem::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                }
            })->where('supplier_id',auth()->user()->id)->sum('total');



            return view('livewire.financial-component',
            compact('purchases','outcomes','part_paid_purchases','returnedItems'));


        }

        if(Gate::allows("client")){
            $sales = ClientInvoice::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('client_invoice_date', [$this->from_date,$this->to_date]);
                }
            })->where('user_id',auth()->user()->id)->sum('total');

            
            $clientsPayments = ClientInvoice::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('client_invoice_date', [$this->from_date,$this->to_date]);
                }
            })->where('user_id',auth()->user()->id)->sum('part_paid');


            $clientInvoicesUserIds = ClientInvoice::where('user_id',auth()->user()->id)->pluck('user_id');

            $returnedItems = ClientReturnItem::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                }
            })->where('client_id',auth()->user()->id)->sum('total');


            
            return view('livewire.financial-component',
            compact('sales' ,'clientsPayments','returnedItems'));


        }
        if(Gate::allows("founder")){
            $sales = ClientInvoice::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('client_invoice_date', [$this->from_date,$this->to_date]);

                }
                if(!empty($this->client_id) ){
                    $query->where('user_id',$this->client_id);
            }
            })->sum('total');

            $purchases = SupplierInvoice::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('supplier_invoice_date', [$this->from_date,$this->to_date]);

                }
                if(!empty($this->supplier_id) ){
                    $query->where('user_id',$this->supplier_id);
                }
            })->sum('total');

            $part_paid_purchases = SupplierInvoice::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('supplier_invoice_date', [$this->from_date,$this->to_date]);

                }
                if(!empty($this->supplier_id) ){
                    $query->where('user_id',$this->supplier_id);
                }
            })->sum('part_paid');

            $outcomes = Outcome::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

                }
                if(!empty($this->store) ){
                    $query->where('outcomable_type','App\Models\Store');
                }
                if(!empty($this->supplier_id) ){
                    $query->where('outcomable_type','App\Models\User')->where('outcomable_id',$this->supplier_id);
                }
            })->sum('amount');


            $clientsPayments = ClientInvoice::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('client_invoice_date', [$this->from_date,$this->to_date]);
                }

                if(!empty($this->client_id) ){
                    $query->where('user_id',$this->client_id);
                }

            })->sum('part_paid');

            $shares = User::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                }
            })->where('roles_name','["shareholder"]')->where('user_id',auth()->user()->id)->sum('shares');
    
            $sharesValue = 0;
            $foundersValue = 0;

            //دفعات المساهمين

            $shareholdersPayments = ShareholderAccount::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                }

                if(!empty($this->shareholder_id)){
                    $query->where('shareholder_id',$this->shareholder_id);
                }

            })->where('user_id',auth()->user()->id)->where('type','profit')->sum('amount');

            //  راس مال المساهمين

            $shareholdersCapitals = ShareholderAccount::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                }

            })->where('user_id',auth()->user()->id)->where('type','capital')->sum('amount');

            //دفعات المؤسس
            $foundersPayments = FounderAccount::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                }

            })->where('user_id',auth()->user()->id)->where('type','profit')->sum('amount');

            //  راس مال المؤسس
            $foundersCapitals = FounderAccount::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                }

                if(!empty($this->user_id) ){
                    $query->where('user_id',$this->user_id);
                }

            })->where('id',auth()->user()->id)->where('type','capital')->sum('amount');


            $shareholders = $this->shareholder_id == null  ? auth()->user()->shareholders : User::where('id',$this->shareholder_id)->get();
            $firstProfit = $clientsPayments-$outcomes-$part_paid_purchases;

            foreach ($shareholders as $shareholder) {
                if($shares != 0){
                    $oneShare = $shareholder->shares;
                    $oneSharePercentage = $oneShare/$shares;
                    $sharesValue += $firstProfit*$oneSharePercentage * 0.5 ;
                    $foundersValue += $firstProfit*$oneSharePercentage * 0.5 ;

                } else {
                    $sharesValue = 0;
                    $foundersValue = 0;
                }

            }


            $shareholdersRest = $sharesValue -$shareholdersPayments;
            $foundersRest = $foundersValue -$foundersPayments;
      
            return view('livewire.financial-component',
            compact('sales' ,'shares','purchases','outcomes','clientsPayments','part_paid_purchases',
            'sharesValue','foundersValue','shareholdersPayments','shareholdersRest','foundersRest',
            'foundersPayments','foundersCapitals'));
        } 



        if(Gate::allows("shareholder")){

            $sales = ClientInvoice::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('client_invoice_date', [$this->from_date,$this->to_date]);

                }
                if(!empty($this->client_id) ){
                    $query->where('user_id',$this->client_id);
                }
            })->sum('total');

            $purchases = SupplierInvoice::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('supplier_invoice_date', [$this->from_date,$this->to_date]);

                }
                if(!empty($this->supplier_id) ){
                    $query->where('user_id',$this->supplier_id);
                }
            })->sum('total');

            $part_paid_purchases = SupplierInvoice::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('supplier_invoice_date', [$this->from_date,$this->to_date]);

                }
                if(!empty($this->supplier_id) ){
                    $query->where('user_id',$this->supplier_id);
                }
            })->sum('part_paid');

            $outcomes = Outcome::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

                }
                if(!empty($this->store) ){
                    $query->where('outcomable_type','App\Models\Store');
                }
                if(!empty($this->supplier_id) ){
                    $query->where('outcomable_type','App\Models\User')->where('outcomable_id',$this->supplier_id);
                }
            })->sum('amount');


            $clientsPayments = ClientInvoice::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('client_invoice_date', [$this->from_date,$this->to_date]);
                }

                if(!empty($this->client_id) ){
                    $query->where('user_id',$this->client_id);
                }

            })->sum('part_paid');

            $shares = User::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                }
            })->where('roles_name','["shareholder"]')->sum('shares');
    
            $sharesValue = 0;
            $foundersValue = 0;
            

            //دفعات المساهم

            $shareholderPayments = ShareholderAccount::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                }

            })->where('shareholder_id',auth()->user()->id)->where('type','profit')->sum('amount');

                //  راس مال المساهم
                $shareholderCapitals = ShareholderAccount::where( function($query) {
                    if(!empty($this->from_date) && !empty($this->to_date)  ){
                        $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                    }
                })->where('shareholder_id',auth()->user()->id)->where('type','capital')->sum('amount');

                //دفعات المؤسس
                // $foundersPayments = FounderAccount::where( function($query) {
                //     if(!empty($this->from_date) && !empty($this->to_date)  ){
                //         $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                //     }

                // })->where('user_id',auth()->user()->id)->where('type','profit')->sum('amount');

                //  راس مال المؤسس
                // $foundersCapitals = FounderAccount::where( function($query) {
                //     if(!empty($this->from_date) && !empty($this->to_date)  ){
                //         $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                //     }

                //     if(!empty($this->user_id) ){
                //         $query->where('user_id',$this->user_id);
                //     }

                // })->where('id',auth()->user()->id)->where('type','capital')->sum('amount');


                $shareholder =  User::where('id',auth()->user()->id)->first();
                $firstProfit = $clientsPayments-$outcomes-$part_paid_purchases;

       
                    if($shares != 0){
                        $oneShare = $shareholder->shares;
                        $oneSharePercentage = $oneShare/$shares;
                        $sharesValue += $firstProfit*$oneSharePercentage * 0.5 ;
                        $foundersValue += $firstProfit*$oneSharePercentage * 0.5 ;

                    } else {
                        $sharesValue = 0;
                        $foundersValue = 0;
                    }

                


                    $shareholderRest = $sharesValue -$shareholderPayments ?? null;
                






                    
            return view('livewire.financial-component',
            compact('sales' ,'shares','purchases','outcomes','clientsPayments','part_paid_purchases',
            'sharesValue','shareholderPayments','shareholderRest',
            ));
            

        }

        else{

        
            $sales = ClientInvoice::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('client_invoice_date', [$this->from_date,$this->to_date]);

                }
                if(!empty($this->client_id) ){
                    $query->where('user_id',$this->client_id);
                }
            })->sum('total');

            $purchases = SupplierInvoice::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('supplier_invoice_date', [$this->from_date,$this->to_date]);

                }
                if(!empty($this->supplier_id) ){
                    $query->where('user_id',$this->supplier_id);
                }
            })->sum('total');

            $part_paid_purchases = SupplierInvoice::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('supplier_invoice_date', [$this->from_date,$this->to_date]);

                }
                if(!empty($this->supplier_id) ){
                    $query->where('user_id',$this->supplier_id);
                }
            })->sum('part_paid');

            $outcomes = Outcome::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

                }
                if(!empty($this->store) ){
                    $query->where('outcomable_type','App\Models\Store');
                }
                if(!empty($this->supplier_id) ){
                    $query->where('outcomable_type','App\Models\User')->where('outcomable_id',$this->supplier_id);
                }
            })->sum('amount');


            $clientsPayments = ClientInvoice::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('client_invoice_date', [$this->from_date,$this->to_date]);
                }

                if(!empty($this->client_id) ){
                    $query->where('user_id',$this->client_id);
                }

            })->sum('part_paid');


            $firstProfit = $clientsPayments-$outcomes-$part_paid_purchases;
            // $shares = auth()->user()->shareholders->sum('shares');


            $sharesValue = 0;
            $foundersValue = 0;

            if(auth()->user()->roles_name == ["admin"]){

                $shares = User::where('roles_name','["shareholder"]')->where( function($query) {
                    if(!empty($this->from_date) && !empty($this->to_date)  ){
                        $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                    }


                })->sum('shares');

                $shareholders = User::where('roles_name','["shareholder"]')->where( function($query) {
                    if(!empty($this->from_date) && !empty($this->to_date)  ){
                        $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                    }

                    if(!empty($this->user_id) ){
                        $query->where('user_id',$this->user_id);
                    }

                })->get();


                //دفعات المساهمين

                $shareholdersPayments = ShareholderAccount::where( function($query) {
                    if(!empty($this->from_date) && !empty($this->to_date)  ){
                        $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                    }

                    if(!empty($this->user_id) ){
                        $query->where('user_id',$this->user_id);
                    }

                })->where('type','profit')->sum('amount');

                //  راس مال المساهمين

                $shareholdersCapitals = ShareholderAccount::where( function($query) {
                    if(!empty($this->from_date) && !empty($this->to_date)  ){
                        $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                    }

                })->where('type','capital')->sum('amount');

                //دفعات المؤسسين
                $foundersPayments = FounderAccount::where( function($query) {
                    if(!empty($this->from_date) && !empty($this->to_date)  ){
                        $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                    }

                    if(!empty($this->user_id) ){
                        $query->where('user_id',$this->user_id);
                    }

                })->where('type','profit')->sum('amount');

                //  راس مال المؤسسين
                $foundersCapitals = FounderAccount::where( function($query) {
                    if(!empty($this->from_date) && !empty($this->to_date)  ){
                        $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                    }

                    if(!empty($this->user_id) ){
                        $query->where('user_id',$this->user_id);
                    }

                })->where('type','capital')->sum('amount');
                    $shareholdersRest  = 0;
                    $foundersRest = 0;

                foreach ($shareholders as $shareholder) {
                    if($shares != 0){
                        $oneShare = $shareholder->shares;
                        $oneSharePercentage = $oneShare/$shares;
                        $sharesValue += $firstProfit * $oneSharePercentage * 0.5 ;
                        $foundersValue += $firstProfit * $oneSharePercentage * 0.5 ;


                        $shareholdersRest = $sharesValue -$shareholdersPayments;
                        $foundersRest = $foundersValue -$foundersPayments;

                    } else {
                        $sharesValue = 0;
                        $foundersValue = 0;
                    }
            
            
                }
          // $allShares = auth()->user()->roles_name == ["admin"] ? Shareholder::sum('shares') : auth()->user()->shareholders->sum('shares');

            return view('livewire.financial-component',
            compact('sales' ,'shares','purchases','outcomes','clientsPayments','part_paid_purchases',
            'sharesValue','foundersValue','shareholdersPayments','shareholdersRest','foundersRest',
            'foundersPayments'));

            }

  


        }
    }


    // public function test(){

    //         $shares = Shareholder::where( function($query) {
    //             if(!empty($this->from_date) && !empty($this->to_date)  ){
    //                 $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
    //             }

    //             if(!empty($this->user_id) ){
    //                 $query->where('user_id',$this->user_id);
    //             }

    //         })->sum('shares');

    //         $shareholders = Shareholder::where( function($query) {
    //             if(!empty($this->from_date) && !empty($this->to_date)  ){
    //                 $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
    //             }

    //             if(!empty($this->user_id) ){
    //                 $query->where('user_id',$this->user_id);
    //             }

    //         })->get();

    //         return dd($shares ,$shareholders);
    // }
}
