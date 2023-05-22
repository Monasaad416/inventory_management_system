<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Outcome;
use App\Models\Product;
use App\Models\Section;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\ClientInvoice;
use App\Models\SupplierInvoice;
use App\Models\ShareholderAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        if (Gate::allows('admin')) { 

            $data['suppliers'] = User::where('roles_name','["supplier"]')->get();
            $data['clients'] = User::where('roles_name','["client"]')->get();
            $data['sections'] = Section::all();
            $data['products'] = Product::all();

            $data['suppliersInvoicesPaid'] = SupplierInvoice::where('status',2)->sum('part_paid');
            $data['suppliersInvoicesUnPaid'] = SupplierInvoice::where('status',1)->sum('total');
            $data['suppliersInvoicesPartPaid'] = SupplierInvoice::where('status',3)->sum('part_paid');
            $data['suppliersInvoicesRetutn'] = SupplierInvoice::where('status',4)->sum('total');
            $data['suppliersInvoicesPartRetutn'] = SupplierInvoice::where('status',5)->sum('total');


            $data['clientsInvoicesPaid'] = ClientInvoice::where('status',2)->sum('part_paid');
            $data['clientsInvoicesUnPaid'] = ClientInvoice::where('status',1)->sum('total');
            $data['clientsInvoicesPartPaid'] = ClientInvoice::where('status',3)->sum('part_paid');
            $data['clientsInvoicesRetutn'] = ClientInvoice::where('status',4)->sum('total');
            $data['clientsInvoicesPartRetutn'] = ClientInvoice::where('status',5)->sum('total');

            return view('pages.dashboard.index')->with($data);
        }

        if (Gate::allows('client')) { 
            
            $client = User::where('roles_name','["client"]')->where('id',auth()->user()->id)->first();

            
            $data['clientInvoices'] = ClientInvoice::where('user_id',$client->id)->latest()->paginate(20);
            $data['clientInvoicesPaid'] = ClientInvoice::where('status',2)->where('user_id',$client->id)->sum('part_paid');
            $data['clientInvoicesUnPaid'] = ClientInvoice::where('status',1)->where('user_id',$client->id)->sum('total');
            $data['clientInvoicesPartPaid'] = ClientInvoice::where('status',3)->where('user_id',$client->id)->sum('part_paid');
            $data['clientInvoicesRetutn'] = ClientInvoice::where('status',4)->where('user_id',$client->id)->sum('total');
            $data['clientInvoicesPartRetutn'] = ClientInvoice::where('status',5)->where('user_id',$client->id)->sum('total');

            return view('pages.dashboard.client_index',compact('client'))->with($data);
        }

        if (Gate::allows('supplier')) { 
   
            
            $supplier = User::where('roles_name','["supplier"]')->where('id',auth()->user()->id)->first();
       //     return dd($supplier);

            
            $data['supplierInvoices'] = SupplierInvoice::where('user_id',$supplier->id)->latest()->paginate(20);
            $data['supplierInvoicesPaid'] = SupplierInvoice::where('status',2)->where('user_id',$supplier->id)->sum('part_paid');
            $data['supplierInvoicesUnPaid'] = SupplierInvoice::where('status',1)->where('user_id',$supplier->id)->sum('total');
            $data['supplierInvoicesPartPaid'] = SupplierInvoice::where('status',3)->where('user_id',$supplier->id)->sum('part_paid');
            $data['supplierInvoicesRetutn'] = SupplierInvoice::where('status',4)->where('user_id',$supplier->id)->sum('total');
            $data['supplierInvoicesPartRetutn'] = SupplierInvoice::where('status',5)->where('user_id',$supplier->id)->sum('total');






            return view('pages.dashboard.supplier_index',compact('supplier'))->with($data);
        }

        if (Gate::allows('founder')) { 
   
            
            $founder = User::where('roles_name','["founder"]')->where('id',auth()->user()->id)->first();

            $data['shareholders'] = User::where('roles_name','["shareholder"]')->where('user_id',$founder->id)->latest()->paginate(20);

            return view('pages.dashboard.founder_index')->with($data);
        }
  
        if (Gate::allows('shareholder')) { 
            $shareholder = User::where('roles_name','["shareholder"]')->where('id',auth()->user()->id)->first();

        //حساب الارباح من المساهمين
        $founder = $shareholder->user;

        //return dd($founder);
        $sales = ClientInvoice::sum('total');

        $purchases = SupplierInvoice::sum('total');

        $part_paid_purchases = SupplierInvoice::sum('part_paid');
        $outcomes = Outcome::sum('amount');
        $clientsPayments = ClientInvoice::sum('part_paid');



        $firstProfit = $clientsPayments-$outcomes-$part_paid_purchases;
        $shares = User::where('roles_name','["shareholder"]')->sum('shares');
        $shareholderProfit = $firstProfit/$shares * $shareholder->shares * 0.5;
        
        $profit = ShareholderAccount::where('shareholder_id',$shareholder->id)->where('type',"profit")->get();
        $accountCapital = ShareholderAccount::where('shareholder_id',$shareholder->id)->where('type' , "capital")->sum('amount');
        $accountProfit = ShareholderAccount::where('shareholder_id',$shareholder->id)->where('type' , "profit")->sum('amount');

        return view('pages.shareholders.show',['shareholder'=>$shareholder,
        'accountCapital' => $accountCapital,'accountProfit'=>$accountProfit,
        'shareholderProfit' => $shareholderProfit,'profit' => $profit]);
        }
    }

    public function calculator()
    {
        return view('pages.calculator.index');
    }


}
