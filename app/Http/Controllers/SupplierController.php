<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Section;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\SupplierInvoice;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\SupplierInvoiceDetail;
use Illuminate\Support\Facades\Validator;


class SupplierController extends Controller
{
    public function index()
    {
        $data['suppliers'] = User::where('roles_name','["supplier"]')->latest()->paginate(20);
        return view('pages.suppliers.index')->with($data);

    }


    public function create()
    {
        return view('pages.suppliers.create');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'phone' => 'required|string',
                'email' => 'nullable|email|unique:users,email',
                'address' => 'required|string',
                'notes' => 'required|string',
                'password' =>'required|string|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

          //return dd($request->all());
            $supplier = User::create([
                'name' => $request->name ,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'notes' => $request->notes,
                'roles_name' => ["supplier"],
                'password' => Hash::make($request->password),
            ]);


            $supplier->assignRole(["supplier"]);

            return redirect()->route('suppliers.index')->with('success','تم إضافة مورد  جديد بنجاح');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $supplier = User::where('roles_name','["supplier"]')->where('id',$id)->first();
        return view('pages.suppliers.edit',['supplier'=>$supplier]);
    }


    public function update(Request $request)
    {
        $supplier = User::where('roles_name','["supplier"]')->where('id',$request->id)->first();
        // return dd($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'nullable|string',
                'phone' => 'nullable|string',
                'email' => 'nullable|email|unique:users,email,'.$supplier->id,
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
            $supplier->update([
                'name' => $request->name ,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'notes' => $request->notes,
            ]);

            return redirect()->route('suppliers.index')->with('update','تم تعديل بيانات المورد  بنجاح');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        try {
            $supplier = User::where('roles_name','["supplier"]')->where('id',$request->id)->delete();
            return redirect()->route('suppliers.index')->with('delete','تم حذف  القسم بنجاح');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function balanceSheet($id)
    {
        $supplier = User::where('id',$id)->where('roles_name','["supplier"]')->first();
        $data['unpaid'] = $supplier->supplierInvoices()->where('status',1)->get();
        $data['paid'] = $supplier->supplierInvoices()->where('status',2)->get();
        $data['partiallyPaid'] = $supplier->supplierInvoices()->where('status',3)->get();
        $data['returns'] = $supplier->supplierInvoices()->where('status',4)->withTrashed()->get();
        //return(dd($data));
        return view('pages.suppliers.show',['supplier'=>$supplier])->with($data);
    }




    public function balanceSheetSearch(Request $request)
    {



        $purchases = SupplierInvoice::where( function($query) use($request) {
            if($request->from != null  && $request->to != null  ){
                $query->whereBetween('supplier_invoice_date', [$request->from,$request->to]);

            }
        })->where('user_id',auth()->user()->id)->sum('total');

        // $part_paid_purchases = SupplierInvoice::where( function($query) {
        //     if($request->from && $request->to != null ){
        //         $query->whereBetween('supplier_invoice_date', [$request->from,$request->to != null]);

        //     }
        //     if($request->supplier_id){
        //         $query->where('supplier_id',$request->supplier_id);
        //     }
        // })->sum('part_paid');

        // $outcomes = Outcome::where( function($query) {
        //     if($request->from != null && $request->to != null ){
        //         $query->whereBetween('created_at', [$request->from,$request->to != null]);

        //     }
        //     if($request->store){
        //         $query->where('outcomable_type','App\Models\Store');
        //     }
        //        if($request->supplier_id ){
        //         $query->where('outcomable_type','App\Models\Supplier')->where('outcomable_id',$request->supplier_id);
        //     }
        // })->sum('amount');

        $data['supplier'] = User::where('id',$request->supplier_id)->where('roles_name','["supplier"]')->first();
        if($request->status == 0){
            if($request->from != null && $request->to != null){
                $data['invoices'] = SupplierInvoice::where('user_id',$request->supplier_id)
                ->whereBetween('supplier_invoice_date', [$request->from,$request->to])->get();
                $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
                return view('pages.suppliers.search_result')->with($data);
            } else {
                $data['invoices'] = SupplierInvoice::where('user_id',$request->supplier_id)->get();
                $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
                return view('pages.suppliers.search_result')->with($data);
            }


        }
        elseif($request->status == 1){
            if($request->from != null && $request->to != null){
                $data['invoices'] = SupplierInvoice::where('user_id',$request->supplier_id)->where('status',1)
                ->whereBetween('supplier_invoice_date', [$request->from,$request->to])->get();
                    //return dd($data['invoices']);
                    $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
                return view('pages.suppliers.search_result')->with($data);
            } else {
                $data['invoices'] = SupplierInvoice::where('user_id',$request->supplier_id)->where('status',1)->get();
                    //return dd($data['invoices']);
                $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
                return view('pages.suppliers.search_result')->with($data);
            }


        }
          elseif($request->status == 2){
            if($request->from != null && $request->to != null){
                $data['invoices'] = SupplierInvoice::where('user_id',$request->supplier_id)->where('status',2)
                ->whereBetween('supplier_invoice_date', [$request->from,$request->to])->get();
                $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
                return view('pages.suppliers.search_result')->with($data);
            } else {
                $data['invoices'] = SupplierInvoice::where('user_id',$request->supplier_id)->where('status',2)->get();
                $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
                return view('pages.suppliers.search_result')->with($data);
            }

        }  elseif($request->status == 3){
            if($request->from != null && $request->to != null){
                $data['invoices'] = SupplierInvoice::where('user_id',$request->supplier_id)->where('status',3)
                ->whereBetween('supplier_invoice_date', [$request->from,$request->to])->get();
                $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
                return view('pages.suppliers.search_result')->with($data);
            } else {
                $data['invoices'] = SupplierInvoice::where('user_id',$request->supplier_id)->where('status',3)->get();
                $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
                return view('pages.suppliers.search_result')->with($data);
            }

        }elseif($request->status == 4){
            if($request->from != null && $request->to != null){
                $data['invoices'] = SupplierInvoice::where('user_id',$request->supplier_id)->where('status',4)
                ->whereBetween('supplier_invoice_date', [$request->from,$request->to])->get();
                $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
            } else {
                $data['invoices'] = SupplierInvoice::where('user_id',$request->supplier_id)->where('status',4)->get();
                $data['status'] =$request->staus;
                $data['from'] = $request->from;
                $data['to'] = $request->to;
                return view('pages.suppliers.search_result')->with($data);
            }

        }

    }


}
