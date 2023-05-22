<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\ClientInvoice;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index()
    {
        $data['clients'] = User::where('roles_name','["client"]')->latest()->paginate(20);
        return view('pages.clients.index')->with($data);
    }


    public function create()
    {
        return view('pages.clients.create');
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'phone' => 'required|string',
                'email' => 'nullable|email|unique:users,email',
                'address' => 'required|string',
                'notes' => 'nullable|string',
                'password' =>'required|string|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            //return dd($request->all());
            $client = User::create([
                'name' => $request->name ,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'notes' => $request->notes,
                'roles_name' => ["client"],
                'password' => Hash::make($request->password),
            ]);


            $client->assignRole(["client"]);
            return redirect()->route('clients.index')->with('success','تم إضافة عميل  جديد بنجاح');
        }
        catch (Exception $e) {

        // //return dd($client);
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);

    }
}

   public function edit($id)
    {
        $data['client'] = User::where('id',$id)->where('roles_name','["client"]')->first();
        return view('pages.clients.edit')->with($data);
    }

    public function update(Request $request)
    {
        $client = User::where('id',$request->id)->where('roles_name','["client"]')->first();
        // return dd($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'nullable|string',
                'phone' => 'nullable|string',
                'email' => 'nullable|email|unique:users,email,'.$client->id,
                'address' => 'nullable|string',
                'notes' => 'nullable|string',
                'password' =>'nullable|string|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            
            // return dd($request->all());
            $client->update([
                'name' => $request->name ,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'notes' => $request->notes,
            ]);

            return redirect()->route('clients.index')->with('update','تم تعديل بيانات العميل  بنجاح');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy(Request $request)
    {

        try {
            $client = User::where('id',$request->id)->where('roles_name','["client"]')->delete();
            return redirect()->route('clients.index')->with('delete','تم حذف  العميل بنجاح');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


        public function balanceSheet($id)
    {
        $client = User::where('id',$id)->where('roles_name','["client"]')->first();
        $data['unpaid'] = $client->clientInvoices()->where('status',1)->get();
        $data['paid'] = $client->clientInvoices()->where('status',2)->get();
        $data['partiallyPaid'] = $client->clientInvoices()->where('status',3)->get();
        $data['returns'] = $client->clientInvoices()->where('status',4)->withTrashed()->get();
       // return(dd($data));
        return view('pages.clients.show',['client'=>$client])->with($data);
    }




    public function balanceSheetSearch(Request $request)
    {
        //return dd($request->all());
        $data['client'] = User::where('id',$request->client_id)->where('roles_name','["client"]')->first();
        if($request->status == 0){

            if($request->from != null && $request->to != null){
                 $data['invoices'] = ClientInvoice::where('user_id',$request->client_id)
                 ->whereBetween('client_invoice_date', [$request->from,$request->to])
                 ->get();
                            $data['status'] =$request->staus;
           $data['from'] = $request->from;
           $data['to'] = $request->to;
           return view('pages.clients.search_result')->with($data);
            } else {
                 $data['invoices'] = ClientInvoice::where('user_id',$request->client_id)->get();
                            $data['status'] =$request->staus;
           $data['from'] = $request->from;
           $data['to'] = $request->to;
           return view('pages.clients.search_result')->with($data);
            }



        }
        elseif($request->status == 1){

             if($request->from != null && $request->to != null){
                $data['invoices'] = clientInvoice::where('user_id',$request->client_id)->where('status',1)
                ->whereBetween('client_invoice_date', [$request->from,$request->to])->get();
                    //return dd($data['invoices']);
                $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
                return view('pages.clients.search_result')->with($data);
             } else {

                $data['invoices'] = clientInvoice::where('user_id',$request->client_id)->where('status',1)->get();
                    //return dd($data['invoices']);
                $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
                return view('pages.clients.search_result')->with($data);

             }


        }
          elseif($request->status == 2){
            if($request->from != null && $request->to != null){
                $data['invoices'] = clientInvoice::where('user_id',$request->client_id)->where('status',2)
                ->whereBetween('client_invoice_date', [$request->from,$request->to])->get();

                $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
                return view('pages.clients.search_result')->with($data);
            } else {
                $data['invoices'] = clientInvoice::where('user_id',$request->client_id)->where('status',2)->get();

                $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
                return view('pages.clients.search_result')->with($data);
            }

        }  elseif($request->status == 3){
            if($request->from != null && $request->to != null){
                $data['invoices'] = clientInvoice::where('user_id',$request->client_id)->where('status',3)
                ->whereBetween('client_invoice_date', [$request->from,$request->to])->get();
                $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
                return view('pages.clients.search_result')->with($data);
             } else {
                    $data['invoices'] = clientInvoice::where('user_id',$request->client_id)->where('status',3)->get();
                    $data['status'] =$request->staus;
                    $data['from'] = $request->from;
                    $data['to'] = $request->to;
                    return view('pages.clients.search_result')->with($data);
             }

        }elseif($request->status == 4){
            if($request->from != null && $request->to != null){
                $data['invoices'] = clientInvoice::where('user_id',$request->client_id)->where('status',4)
                ->whereBetween('client_invoice_date', [$request->from,$request->to])->get();
                $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
                return view('pages.clients.search_result')->with($data);
            } else {
                $data['invoices'] = clientInvoice::where('user_id',$request->client_id)->where('status',4)->get();
                $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
                return view('pages.clients.search_result')->with($data);
            }

        }

    }
}
