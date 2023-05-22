<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Product;
use App\Models\Section;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\SupplierInvoice;
use App\Models\SupplierReturnItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SupplierInvoiceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['suppliersInvoices'] = SupplierInvoice::latest()->paginate(20);
        return view('pages.suppliers-invoices.index')->with($data);
    }
    public function getSuppliersBySection($section_id)
    {
        $list_suppliers = User::where('roles_name','["supplier"]')->where('section_id',$section_id)->pluck('name','id');
        return response()->json($list_suppliers);
    }
    public function getProdsBySection($section_id)
    {
        $list_prods = Product::where('section_id',$section_id)->select('product_name','purchase_price' ,'id' ,'store_amount','unit')->get();
        return response()->json($list_prods);
    }

    public function create()
    {
        $data['products'] = Product::all();
        $data['sections'] = Section::all();
        $data['suppliers'] = User::where('roles_name','["supplier"]')->get();
        return view('pages.suppliers-invoices.create')->with($data);
    }

    public function store(Request $request)
    {
        try{

            $latestSupplierInvoice = SupplierInvoice::orderBy('created_at','DESC')->first();
            if(!$latestSupplierInvoice){

                $invoiceNumber = 'S-00000001';
                } else {
                    $invoiceNumber = 'S-'.str_pad($latestSupplierInvoice->id + 1, 8, "0", STR_PAD_LEFT);
                }

            $status = SupplierInvoice::getStatus();
            // return dd($request->status);

            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'product_ids' => 'required|array',
                'product_ids.*' => 'required|exists:products,id',
                'supplier_id' => 'required|exists:users,id',
                'part_paid' => 'nullable|numeric',
                'discount' => 'nullable|numeric',
                'note' => 'nullable|string',
                'invoice_date' => 'required|date',
                'due_date' => 'nullable|date',
                'status' => 'required|numeric|in:'.implode(',',$status),
                'unit' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }


            $newQty = array_values(array_filter($request->qty));
            $newPrice = array_filter($request->purchase_price, function ($value) {
                return $value != null && $value != 0;
            });

            $newPrice = array_values($newPrice); // reset array keys
            $newUnit = array_filter($request->unit, function ($value) {
                return $value === 'متر' || $value === 'كجم';
            });

            $newUnit = array_values($newUnit); // reset array keys
            //return dd($newUnit);

            SupplierInvoice::create([
                'supplier_invoice_number' => $invoiceNumber,
                'supplier_invoice_date' => $request->invoice_date,
                'due_date' => $request->due_date,
                'user_id' => $request->supplier_id,
                'part_paid' => $request->part_paid ? $request->part_paid : 0,
                'product_id' => $request->product_id,
                'discount' => $request->discount,
                'status' => $request->status,
                'note' => $request->note,
                'payment_date' => $request->payment_date,
            ]);

            $invoice = SupplierInvoice::latest()->first();
            // $invoice->products()->sync($request->product_ids);

            $totalprice = 0;
            $totalInvoicePrice = 0;
            foreach($request->product_ids as $key => $id) {
                $invoice->products()->attach([$id => [
                    'qty' => $newQty[$key],
                    'product_price' => $newPrice[$key],
                    'unit' => $newUnit[$key],
                    'total' => $newPrice[$key] * $newQty[$key]],
                ]);


               $product = Product::where('id', $id)->first();
               $product_price = $newPrice[$key];
               $totalprice += $product_price * $newQty[$key];
               $productQty = $product->store_amount;

               $product->store_amount = $productQty + $newQty[$key] ;
               $product->save();

            }

            $invoiceItems = DB::table('product_supplier_invoice')->where('supplier_invoice_id', $invoice->id)->get();
            foreach ($invoiceItems as $item){
                $item_price = $item->product_price * $item->qty;
                $totalInvoicePrice += $item_price;

                $invoiceProduct = Product::where('id', $item->product_id)->first();
                $invoiceProduct->update([
                    'purchase_price' => $item->product_price,
                ]);
            }

            if($request->discount ) {
                $invoice->update([
                    'total' => $totalInvoicePrice - $request->discount,
                ]);
            } else {
                $invoice->update([
                    'total' => $totalInvoicePrice,
                ]);
            }


        DB::commit();
        return redirect()->route('suppliers-invoices.index')->with('success', 'تم إضافة فاتورة مورد جديدة بنجاح'  );

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function show($id)
    {
        $invoice= SupplierInvoice::findOrFail($id);
        // $data['invoice_details'] = InvoiceDetails::where('invoice_id',$invoice->id)->get();
        // $data['invoice_attachments']  = InvoiceAttachment::where('invoice_number',$invoice->invoice_number)->get();
        return view('pages.suppliers-invoices.show',['invoice'=>$invoice]);
    }


    public function edit($id)
    {
        $data['invoice'] = SupplierInvoice::findOrFail($id);
        $data['products'] = Product::all();
        $data['suppliers'] = User::where('roles_name','["supplier"]')->get();
        $data['sections'] = Section::all();
        $data['productsIds'] = SupplierInvoice::findOrFail($id)->products()->pluck('product_id')->toArray();
        return view('pages.suppliers-invoices.edit')->with($data);
    }

    public function update(Request $request)
    {
   try{
    //return dd($request->all());
        $invoice = SupplierInvoice::findOrFail($request->invoice_id);
        $status = SupplierInvoice::getStatus();

              $validator = Validator::make($request->all(), [
                'product_ids' => 'nullable|array',
                'product_ids.*' => 'nullable|exists:products,id',
                'supplier_id' => 'nullable|exists:users,id',
                'part_paid' => 'nullable|numeric',
                'discount' => 'nullable|numeric',
                'note' => 'nullable|string',
                'invoice_date' => 'nullable|date',
                'due_date' => 'nullable|date',
                'status' => 'nullable|numeric|in:'.implode(',',$status),
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $invoice->update([
                'supplier_invoice_date' => $request->invoice_date,
                'due_date' => $request->due_date,
                'supplier_id' => $request->supplier_id,
                'part_paid' => $request->part_paid ,
                'product_id' => $request->product_id,
                'discount' => $request->discount,
                'status' => $request->status,
                'note' => $request->note,
                'payment_date' => $request->payment_date,
            ]);

            if($request->has('product_ids')){



                $newQty = array_values(array_filter($request->qty));
                $newPrice = array_filter($request->purchase_price, function ($value) {
                    return $value != null && $value != 0;
                });
                $newPrice = array_values($newPrice); // reset array keys
                $newUnit = array_filter($request->unit, function ($value) {
                    return $value === 'متر' || $value === 'كجم';
                });

                $newUnit = array_values($newUnit); // reset array keys


                $totalprice = 0;
                $totalInvoicePrice = 0;
                foreach($request->product_ids as $key => $id) {

                $product = Product::where('id', $id)->first();
                $pivotRow = DB::table('product_supplier_invoice')->where('product_id', $product->id)->where('supplier_invoice_id',$invoice->id)->first();


                $total = $newPrice[$key] * $newQty[$key];

                $totalprice += $total  ;

                $productQty = $product->store_amount;


                $invoiceQty = $pivotRow ? $pivotRow->qty : 0;


                $newAmount = $productQty-$invoiceQty + $newQty[$key];





                    //return dd($newAmount);

                $product->update([
                        'store_amount' => $newAmount,
                ]);
                $invoice->products()->detach($id);




                    $invoice->products()->attach([$id => [
                        'qty' => $newQty[$key],
                        'product_price' => $newPrice[$key],
                        'unit' => $newUnit[$key],
                        'total' => $newPrice[$key] * $newQty[$key] ,],
                    ]);
                }


                $invoiceItems = DB::table('product_supplier_invoice')->where('supplier_invoice_id', $invoice->id)->get();
                foreach ($invoiceItems as $item){
                    $item_price = $item->product_price * $item->qty;

                    $totalInvoicePrice += $item_price;
                    //return dd( $totalInvoicePrice);

                    $invoiceProduct = Product::where('id', $item->product_id)->first();
                    $invoiceProduct->update([
                        'purchase_price' => $item->product_price,
                    ]);
                }

                if($request->discount ) {

                    $invoice->update([
                        'total' => $totalInvoicePrice - $request->discount,
                    ]);
                } else {
                    $invoice->update([
                        'total' => $totalInvoicePrice,
                    ]);
                }
            }




        return redirect()->route('suppliers-invoices.index')->with('update', 'تم تعديل فاتورة المورد بنجاح'  );
        } catch (Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    // public function destroy(Request $request)
    // {
    //     $invoice = SupplierInvoice::findOrFail($request->invoice_id);
    //     if($request->archive_invoice == 'archive'){
    //         $invoice->Delete()->with('delete','تم حذف فاتورة المورد بنجاح');
    //     }else {
    //         $invoice->forceDelete()->with('delete','تم حذف فاتورة المورد بنجاح');
    //     }
    //     return redirect()->back();
    // }






    public function printInvoice($invoice_id)
    {
        $invoice = SupplierInvoice::findOrFail($invoice_id);
        $supplier = User::where('roles_name','["supplier"]')->where('id',$invoice->user_id)->first();
        return view('pages.suppliers-invoices.print_invoice',['invoice'=>$invoice ,'supplier'=>$supplier]);
    }



    public function editItem($pivotId)
    {

        $pivotRow = DB::table('product_supplier_invoice')->where('id', '=', $pivotId)->first();
        return view('pages.suppliers-invoices.edit_item',['pivotRow' => $pivotRow]);
    }


    public function updateItem(Request $request)
    {
        try{

            $pivotRow = DB::table('product_supplier_invoice')->where('id', '=', $request->item_id)->first();

            //return dd($pivotRow->supplier_invoice_id);
            $invoice_id = $pivotRow->supplier_invoice_id;


            $invoice  = SupplierInvoice::findOrFail($invoice_id);
            $oldInvoiceQty = $pivotRow->qty;

            $request->validate([
                'qty' => 'nullable|numeric',
                // 'staus' => 'nullable|numeric|in:1,2,3',
            ]);

            $product = Product::where('id',$pivotRow->product_id)->first();
            $oldAmount = $product->store_amount;

            $invoice->products()->updateExistingPivot($pivotRow->product_id,[
                'qty' => $request->qty,
                'total' => $pivotRow->product_price * $request->qty,
            ]);

            $newAmount = $oldAmount - $oldInvoiceQty + $request->qty;
            $product->update([
                'store_amount' => $newAmount,
            ]);

            //update invoice total price
            $invoiceItems = DB::table('product_supplier_invoice')->where('supplier_invoice_id', $pivotRow->supplier_invoice_id)->get();
            //return dd($invoiceItems);
             $totalInvoicePrice = 0;
            foreach ($invoiceItems as $item){
                $item_price = $item->product_price * $item->qty;
                $totalInvoicePrice += $item_price;
            }

            $invoiceDiscount = $invoice->discount ? $invoice->discount  : 0;
            $invoice->update([
                'total' => $totalInvoicePrice - $invoiceDiscount ,
            ]);



            return redirect()->route('suppliers-invoices.show',$invoice_id)->with('update', ' تم تعديل كمية البند ورصيد المخزن بنجاح'  );
          } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function returnItemView($item_id)
    {
        $data['pivotRow']  = DB::table('product_supplier_invoice')->where('id', '=', $item_id)->first();
        return view('pages.suppliers-invoices.return-item')->with($data);
    }
      public function returnItem(Request $request)
    {
        try{


            $pivotRow = DB::table('product_supplier_invoice')->where('id', '=', $request->item_id)->first();
               //return dd($pivotRow);

            $invoice_id = $pivotRow->supplier_invoice_id;

            $invoice  = SupplierInvoice::findOrFail($invoice_id);


            $product = Product::where('id',$pivotRow->product_id)->first();
            //return dd($pivotRow->product_price);
            $oldAmount = $product->store_amount;
            $newAmount = $oldAmount - $pivotRow->qty;

            SupplierReturnItem::create([
                'product_id' => $product->id,
                'supplier_invoice_id'=> $invoice->id,
                'supplier_id' => $invoice->user->id,
                'price' => $pivotRow->product_price,
                'qty' => $pivotRow->qty,
                'total'=> $pivotRow->product_price * $pivotRow->qty,
            ]);

            $invoice->products()->detach($pivotRow->product_id);



            $product->update([
                'store_amount' => $newAmount,
            ]);

            $qty = $pivotRow->qty;
            $newQty = $qty - $request->return_qty;
            $total = $pivotRow->product_price * $newQty ;
            $invoice->update([
                'status' => 5,
                'qty' => $newQty,
                'total' => $total ,
            ]);


             //update invoice total price
            $invoiceItems = DB::table('product_supplier_invoice')->where('supplier_invoice_id', $pivotRow->supplier_invoice_id)->get();
            //return dd($invoiceItems);
             $totalInvoicePrice = 0;
            foreach ($invoiceItems as $item){
                $item_price = $item->product_price * $item->qty;
                $totalInvoicePrice += $item_price;
            }


            $invoice->update([
                'total' => $totalInvoicePrice,
            ]);





           $invoiceItemsCount = $invoice->products()->count();
           if(!$invoiceItemsCount > 0){
              $invoice->delete();
              return redirect()->route('suppliers-invoices.index',$invoice_id)->with('update', ' تم تحويل البند إلي مرتجع وحذف فاتورة المورد وخصمه المخزن بنجاح'  );
           }
            return redirect()->route('suppliers-invoices.show',$invoice_id)->with('update', ' تم تحويل البند إلي مرتجع وحذفة من الفاتورة ورصيد المخزن بنجاح'  );
          } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function returnPartOfItemView($item_id)
    {
        $data['pivotRow']  = DB::table('product_supplier_invoice')->where('id', '=', $item_id)->first();
        return view('pages.suppliers-invoices.return-item-part')->with($data);
    }
    public function returnPartOfItem(Request $request)
    {
        try{
            DB::beginTransaction();
            //return dd($request->item_id);
            $pivotRow = DB::table('product_supplier_invoice')->where('id', '=', $request->item_id)->first();

            //return dd($pivotRow->supplier_invoice_id);
            $invoice_id = $pivotRow->supplier_invoice_id;
            $invoice  = SupplierInvoice::findOrFail($invoice_id);
            $qty = $pivotRow->qty;
            $returnQty = $request->return_qty;

            $product = Product::where('id',$pivotRow->product_id)->first();
             //return dd($product);
            $oldAmount = $product->store_amount;
            $newAmount = $oldAmount - $request->return_qty;


            SupplierReturnItem::create([
                'product_id' => $product->id,
                'supplier_invoice_id'=> $invoice->id,
                'supplier_id' => $invoice->user->id,
                'price' => $pivotRow->product_price,
                'qty' => $returnQty,
                'total'=> $pivotRow->product_price * $returnQty,
            ]);

            $invoice->products()->updateExistingPivot($pivotRow->product_id,[

                'qty' => $qty - $returnQty,
                'total' => $pivotRow->total - ($pivotRow->product_price * $request->return_qty ) ,
                'status' => 'partially_returned'

            ]);


            $product->update([
                'store_amount' => $newAmount,
            ]);

            $invoice->update([
                'status' => 5,
            ]);

                //update invoice total price
            $invoiceItems = DB::table('product_supplier_invoice')->where('supplier_invoice_id', $invoice->id)->get();
            //return dd($invoiceItems);
            $totalInvoicePrice = 0;
            foreach ($invoiceItems as $item){
                $item_price = $item->product_price * $item->qty;
                $totalInvoicePrice += $item_price;
            }


            $invoiceDiscount = $invoice->discount ? $invoice->discount  : 0;
            $invoice->update([
                'total' => $totalInvoicePrice - $invoiceDiscount ,
            ]);



            DB::commit();
            return redirect()->route('suppliers-invoices.show',$invoice_id)->with('update', ' تم تحويل جزء من البند إلي مرتجع وخصمه من  ورصيد المخزن بنجاح'  );
          } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }



    public function returnInvoice(Request $request){
        try{
            DB::beginTransaction();
            $invoice= SupplierInvoice::findOrFail($request->invoice_id);
            $invoiceItems = DB::table('product_supplier_invoice')->where('supplier_invoice_id', $invoice->id)->get();


            foreach ($invoiceItems as $item){
                $product = Product::where('id',$item->product_id)->first();
                $pivotRow = DB::table('product_supplier_invoice')->where('product_id', '=', $product->id)->first();

                $product->update([
                    'store_amount' => $product->store_amount - $pivotRow->qty ,
                ]);

                SupplierReturnItem::create([
                    'product_id' => $product->id,
                    'supplier_invoice_id'=> $invoice->id,
                    'supplier_id' => $invoice->user->id,
                    'price' => $pivotRow->product_price,
                    'qty' => $pivotRow->qty,
                    'total'=> $pivotRow->product_price * $pivotRow->qty,
                ]);

            }


            $invoice->update([
                'status' => 4 ,// returned
            ]);





            // $invoice->delete();


            DB::commit();
            return redirect()->route('suppliers-invoices.index')->with('update', ' تم تحويل كل البنود إلي مرتجع و تغيير حالة الفاتورة إلي مرتجع وتعديل رصيد المخزن بنجاح'  );
          } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function partiallyPaidInvoice(Request $request){
        $invoice = SupplierInvoice::findOrFail($request->invoice_id);

        if($invoice->total > $invoice->part_paid){
           $difference = $invoice->total - $invoice->part_paid;
        //    return dd($difference);

           $request->validate([
                'partially_paid' => 'required|numeric',
           ]);

           if($difference > $request->partially_paid) {
                $invoice->update([
                    'part_paid' =>$invoice->part_paid + $request->partially_paid,
                    'status' => 3//parially paid
                ]);


                 return redirect()->route('suppliers-invoices.index')->with('success', 'تم سداد جزء من الفاتورة بنجاح'  );

           }elseif($difference == $request->partially_paid) {

                 $invoice->update([
                    'part_paid' => $invoice->part_paid + $request->partially_paid,
                    'status' => 2,//paid
                ]);
                 return redirect()->route('suppliers-invoices.index')->with('success', ' تم سداد كامل مبلغ الفاتورة بنجاح');

        }
        } elseif($invoice->total == $invoice->part_paid){
            return redirect()->route('suppliers-invoices.index')->with('delete', 'إنتبه تم سداد مبلغ الفاتورة بالكامل لاحقا    '  );
           } else {
                 return redirect()->route('suppliers-invoices.index')->with('delete', 'إنتبه المبلغ الذي تم إدخالة أكبر من المبلغ المتبقي لسداد الفاتورة'  );
           }

    }
}








