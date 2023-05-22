<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Client;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\ClientInvoice;
use App\Models\ClientReturnItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ClientInvoiceController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->roles_name == ["admin"] || auth()->user()->roles_name == ["founder"] || auth()->user()->roles_name == ["shareholder"]){
             $clientsInvoices= ClientInvoice::latest()->paginate(20);
             return view('pages.clients-invoices.index' ,compact('clientsInvoices'));
        }

         elseif(auth()->user()->roles_name == ['client']){
             $clientsInvoices= ClientInvoice::where('user_id' , auth()->user()->id)->latest()->paginate(20);
             return view('pages.clients-invoices.index' ,compact('clientsInvoices'));
        }


    }

    public function getProdsBySection($id)
    {
        $list_prods = Product::where('section_id',$id)->select('product_name','sale_price' ,'purchase_price','id' ,'store_amount','unit')->get();
        return response()->json($list_prods);
    }

    public function create()
    {
        $data['products'] = Product::all();
        $data['sections'] = Section::all();
        $data['clients'] = User::where('roles_name',"['client']")->get();
        return view('pages.clients-invoices.create')->with($data);
    }

    public function store(Request $request)
    {
        try{
            //return dd($request->all());
            $latestclientInvoice = clientInvoice::orderBy('created_at','DESC')->first();
            if(!$latestclientInvoice){

                $invoiceNumber = 'C-00000001';
                } else {
                    $invoiceNumber = 'C-'.str_pad($latestclientInvoice->id + 1, 8, "0", STR_PAD_LEFT);
                }

            $status = clientInvoice::getStatus();
            // return dd($request->status);

            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'product_ids' => 'required|array',
                'product_ids.*' => 'required|exists:products,id',
                'client_id' => 'required|exists:users,id',
                'discount' => 'nullable|numeric',
                'part_paid' => 'nullable|numeric',
                'note' => 'nullable|string',
                'invoice_date' => 'required|date',
                'due_date' => 'required|date',
                'status' => 'required|numeric|in:'.implode(',',$status),
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput()->with('product_ids[]',$request->product_ids);
            }

            $newQty = array_values(array_filter($request->qty));
            $newPrice = array_filter($request->sale_price, function ($value) {
                return $value != null && $value != 0;
            });
            $newPrice = array_values($newPrice); // reset array keys
            $newUnit = array_filter($request->unit, function ($value) {
                return $value === 'متر' || $value === 'كجم';
            });
            $newUnit = array_values($newUnit); // reset array keys


            clientInvoice::create([
                'client_invoice_number' => $invoiceNumber,
                'client_invoice_date' => $request->invoice_date,
                'due_date' => $request->due_date,
                'user_id' => $request->client_id,
                'product_id' => $request->product_id,
                'discount' => $request->discount,
                'part_paid' => $request->part_paid ? $request->part_paid : 0,
                'status' => $request->status,
                'note' => $request->note,
                'payment_date' => $request->payment_date,
            ]);

            $client_invoice = clientInvoice::latest()->first();


            $totalprice = 0;
            $totalInvoicePrice = 0;
            foreach($request->product_ids as $key => $id) {
                $client_invoice->products()->attach([$id => [
                    'qty' => $newQty[$key],
                    'product_price' => $newPrice[$key],
                    'unit' => $newUnit[$key],
                    'total' => $newQty[$key] * $newPrice[$key] ,],
                ]);


                $product = Product::where('id', $id)->first();
                $product_price = $newPrice[$key];
                $total = $product_price * $newQty[$key];
                $totalprice += $total  ;

                $productQty = $product->store_amount;

                $product->store_amount = $productQty - $newQty[$key] ;
                $product->save();
            }


            $invoiceItems = DB::table('client_invoice_product')->where('client_invoice_id', $client_invoice->id)->get();
            foreach ($invoiceItems as $item){
                $item_price = $item->product_price * $item->qty;
                $totalInvoicePrice += $item_price;
            }

            if($request->discount ) {
                $client_invoice->update([
                    'total' => $totalInvoicePrice - $request->discount,
                ]);
            } else {
                $client_invoice->update([
                    'total' => $totalInvoicePrice,
                ]);
            }




        DB::commit();
        return redirect()->route('clients-invoices.index')->with('success', 'تم إضافة فاتورة عميل جديدة بنجاح'  );
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function show($id)
    {
        $invoice= clientInvoice::findOrFail($id);
        // $data['invoice_details'] = InvoiceDetails::where('invoice_id',$invoice->id)->get();
        // $data['invoice_attachments']  = InvoiceAttachment::where('invoice_number',$invoice->invoice_number)->get();
        return view('pages.clients-invoices.show',['invoice'=>$invoice]);
    }


    public function edit($id)
    {
        $data['invoice'] = clientInvoice::findOrFail($id);
        $data['products'] = Product::all();
        $data['clients'] = User::where('roles_name','["client"]')->get();
        $data['sections'] = Section::all();
        $data['productsIds'] = clientInvoice::findOrFail($id)->products()->pluck('product_id')->toArray();
        return view('pages.clients-invoices.edit')->with($data);
    }

        public function update(Request $request)
    {
        try{
        //return dd($request->all());

        $client_invoice = ClientInvoice::findOrFail($request->invoice_id);
        $status = ClientInvoice::getStatus();

            $validator = Validator::make($request->all(), [
                'product_ids' => 'nullable|array',
                'product_ids.*' => 'nullable|exists:products,id',
                'client_id' => 'nullable|exists:users,id',
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

            $client_invoice->update([
                'client_invoice_date' => $request->invoice_date,
                'due_date' => $request->due_date,
                'user_id' => $request->client_id,
                'status' => $request->status,
                'note' => $request->note,
                'discount' => $request->discount,
                'payment_date' => $request->payment_date,
            ]);



             if($request->has('product_ids')){



                $newQty = array_values(array_filter($request->qty));

                $newPrice = array_filter($request->sale_price, function ($value) {
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
                $pivotRow = DB::table('client_invoice_product')->where('product_id', $product->id)->where('client_invoice_id',$client_invoice->id)->first();


                $total = $newPrice[$key] * $newQty[$key];

                $totalprice += $total  ;

                $productQty = $product->store_amount;


                $invoiceQty = $pivotRow ? $pivotRow->qty : 0;


                    $newAmount = $productQty+$invoiceQty - $newQty[$key];





                    //return dd($newAmount);


                $client_invoice->products()->detach($id);
                $product->update([
                        'store_amount' => $newAmount,
                ]);



                    $client_invoice->products()->attach([$id => [
                        'qty' => $newQty[$key],
                        'product_price' => $newPrice[$key],
                        'unit' => $newUnit[$key],
                        'total' => $newPrice[$key] * $newQty[$key] ,],
                    ]);
                }


                $invoiceItems = DB::table('client_invoice_product')->where('client_invoice_id', $client_invoice->id)->get();
                foreach ($invoiceItems as $item){
                    $item_price = $item->product_price * $item->qty;

                    $totalInvoicePrice += $item_price;
                    //return dd( $totalInvoicePrice);


                }

                if($request->discount ) {

                    $client_invoice->update([
                        'total' => $totalInvoicePrice - $request->discount,
                    ]);
                } else {
                    $client_invoice->update([
                        'total' => $totalInvoicePrice,
                    ]);
                }
            }


            return redirect()->route('clients-invoices.index')->with('update', 'تم تعديل فاتورة العميل بنجاح'  );

        } catch (Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }





    public function print_invoice($invoice_id)
    {
        $invoice = clientInvoice::findOrFail($invoice_id);
        return view('invoices.print_invoice',['invoice'=>$invoice]);
    }




    public function editItem($pivotId)
    {
        $pivotRow = DB::table('client_invoice_product')->where('id', '=', $pivotId)->first();
        return view('pages.clients-invoices.edit_item',['pivotRow' => $pivotRow]);
    }


    public function updateItem(Request $request)
    {
        try{
            //return dd($request->item_id);
            $pivotRow = DB::table('client_invoice_product')->where('id', '=', $request->item_id)->first();
            //return dd($pivotRow->client_invoice_id);
            $invoice_id = $pivotRow->client_invoice_id;

            $invoice  = clientInvoice::findOrFail($invoice_id);
            $oldInvoiceQty = $pivotRow->qty;

            $request->validate([
                'qty' => 'nullable|numeric',
                // 'staus' => 'nullable|numeric|in:1,2,3',
            ]);

            $invoice->products()->updateExistingPivot($pivotRow->product_id,[
                'qty' => $request->qty,
                'total' =>  $pivotRow->product_price * ($request->qty) ,
            ]);

            $product = Product::where('id',$pivotRow->product_id)->first();
            $oldAmount = $product->store_amount;

            $newAmount = $oldAmount + $oldInvoiceQty - $request->qty;
            $product->update([
                'store_amount' => $newAmount,
            ]);

            //update invoice total price
            $invoiceItems = DB::table('client_invoice_product')->where('client_invoice_id', $pivotRow->client_invoice_id)->get();
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



            return redirect()->route('clients-invoices.show',$invoice_id)->with('update', ' تم تعديل كمية البند ورصيد المخزن بنجاح'  );
          } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function returnItemView($item_id)
    {
        $data['pivotRow']  = DB::table('client_invoice_product')->where('id', '=', $item_id)->first();
        return view('pages.clients-invoices.return-item')->with($data);
    }
      public function returnItem(Request $request)
    {
        try{
            // DB::beginTransaction();
            $pivotRow = DB::table('client_invoice_product')->where('id', '=', $request->item_id)->first();

            $invoice_id = $pivotRow->client_invoice_id;
            $invoice  = clientInvoice::findOrFail($invoice_id);
            $product = Product::where('id',$pivotRow->product_id)->first();

            ClientReturnItem::create([
                'product_id' => $product->id,
                'client_invoice_id'=> $invoice->id,
                'client_id' => $invoice->user->id,
                'price' => $pivotRow->product_price,
                'qty' => $pivotRow->qty,
                'total'=> $pivotRow->product_price * $pivotRow->qty,
            ]);

            $invoice->products()->updateExistingPivot($pivotRow->product_id,[
                'status' => 'returned',
            ]);



            $oldAmount = $product->store_amount;

            $newAmount = $oldAmount + $pivotRow->qty;

            $product->store_amount = $newAmount;
            $product->save();

            //$invoice->products()->detach($pivotRow->product_id);

            //update invoice total price
            $invoiceItems = DB::table('client_invoice_product')->where('client_invoice_id', $invoice->id)->get();

            //return dd($invoiceItems);

            $totalInvoicePrice = 0;
            foreach ($invoiceItems as $item){
                $item_price = $item->product_price * $item->qty;
                if($item->status != 'returned'){
                    $totalInvoicePrice += $item_price;
                }


            }


           $invoiceDiscount = $invoice->discount ? $invoice->discount  : 0;


           $invoiceItemsCount = $invoice->products()->count();
           if($invoiceItemsCount == $invoice->products()->where('status','returned')->count()){

                $invoice->update([
                    'status' => 4,
                    'total' => 0.00 ,
                    'discount' => 0.00,
                ]);
                // DB::commit();

                return redirect()->route('clients-invoices.index')->with('update', ' تم تحويل البند إلي مرتجع وإعادته إلي رصيد المخزن بنجاح'  );
           } else{
              $invoice->update([
                'status' => 5,
                 'total' => $totalInvoicePrice - $invoiceDiscount ,
            ]);

            // DB::commit();
            return redirect()->route('clients-invoices.show',$invoice_id)->with('update', ' تم تحويل البند إلي مرتجع وحذفة من فاتورة العميل وإعادته إلي رصيد المخزن بنجاح'  );

           }

          


          } catch (Exception $e) {
            // DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function returnPartOfItemView($item_id)
    {
        $data['pivotRow']  = DB::table('client_invoice_product')->where('id', '=', $item_id)->first();
        return view('pages.clients-invoices.return-item-part')->with($data);
    }
    public function returnPartOfItem(Request $request)
    {
        try{
            DB::beginTransaction();
            //return dd($request->item_id);
            $pivotRow = DB::table('client_invoice_product')->where('id', '=', $request->item_id)->first();
            //return dd($pivotRow);

            $invoice_id = $pivotRow->client_invoice_id;
            // return dd($pivotRow);

            $invoice  = clientInvoice::findOrFail($invoice_id);
            $product = Product::where('id',$pivotRow->product_id)->first();

            ClientReturnItem::create([
                'product_id' => $product->id,
                'client_invoice_id'=> $invoice->id,
                'client_id' => $invoice->user->id,
                'price' => $pivotRow->product_price,
                'qty' =>  $request->return_qty,
                'total'=> $pivotRow->product_price *  $request->return_qty,
            ]);


            $qty = $pivotRow->qty;
            $totalReturn = $pivotRow->product_price * $request->return_qty;
            $total = $pivotRow->total - $totalReturn;



            $invoice->products()->updateExistingPivot($pivotRow->product_id,[
                'qty' => $qty - $request->return_qty,
                'total' => $total,
                'status' => 'partially_returned'

            ]);



            $oldAmount = $product->store_amount;
            $newAmount = $oldAmount + $request->return_qty;
            $product->update([
                'store_amount' => $newAmount,
            ]);



            //update invoice total price
            $invoiceItems = DB::table('client_invoice_product')->where('client_invoice_id', $pivotRow->client_invoice_id)->get();
            //return dd($invoiceItems);
            $totalInvoicePrice = 0;
            foreach ($invoiceItems as $item){
                $item_price = $item->product_price * $item->qty;
                $totalInvoicePrice += $item_price;
            }


            $invoiceDiscount = $invoice->discount ? $invoice->discount  : 0;
            $invoice->update([
                'total' => $totalInvoicePrice - $invoiceDiscount ,
                'status' => 5,
            ]);



            DB::commit();
            return redirect()->route('clients-invoices.show',$invoice_id)->with('update', ' تم تحويل جزء من البند إلي مرتجع وإعادته إلي رصيد المخزن بنجاح'  );

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }



    public function returnInvoice(Request $request){
        try{

            DB::beginTransaction();
            $invoice= clientInvoice::findOrFail($request->invoice_id);
            //return dd($invoice);




            $invoiceItems = DB::table('client_invoice_product')->where('client_invoice_id', $invoice->id)->get();
            //return dd($invoiceItems);

            foreach ($invoiceItems as $item){
                $product = Product::where('id',$item->product_id)->first();


                $pivotRow = DB::table('client_invoice_product')->where('product_id', '=', $product->id)->first();


                ClientReturnItem::create([
                    'product_id' => $product->id,
                    'client_invoice_id'=> $invoice->id,
                    'client_id' => $invoice->user->id,
                    'price' => $item->product_price,
                    'qty' =>  $item->qty,
                    'total'=> $item->product_price *  $item->qty,
                ]);


                $invoice->products()->updateExistingPivot($item->product_id,[
                    'status' => 'returned',
                ]);


                $product->update([
                    'store_amount' => $product->store_amount + $pivotRow->qty ,
                ]);
            }



            $invoice->update([
                'status' => 4 ,// returned
                'total' => 0.00,
                'discount' => 0.00,
            ]);

            //invoice->delete();


            DB::commit();
            return redirect()->route('clients-invoices.index')->with('update', ' تم تحويل كل البنود إلي مرتجع و  وإعادتها إلي رصيد المخزن بنجاح'  );
          } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
}


    public function partiallyPaidInvoice(Request $request){
        $invoice = ClientInvoice::findOrFail($request->invoice_id);

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
                 return redirect()->route('clients-invoices.index')->with('success', 'تم سداد جزء من الفاتورة بنجاح'  );

           }elseif($difference = $request->partially_paid) {

                 $invoice->update([
                    'part_paid' => $invoice->part_paid + $request->partially_paid,
                    'status' => 2,//paid
                ]);
                 return redirect()->route('clients-invoices.index')->with('success', ' تم سداد كامل مبلغ الفاتورة بنجاح');

        }
        } elseif($invoice->total == $invoice->part_paid){
            return redirect()->route('clients-invoices.index')->with('delete', 'إنتبه تم سداد مبلغ الفاتورة بالكامل لاحقا    '  );
           } else {
                 return redirect()->route('clients-invoices.indeلعملاءx')->with('delete', 'إنتبه المبلغ الذي تم إدخالة أكبر من المبلغ المتبقي لسداد الفاتورة'  );
           }

    }




    public function printInvoice($invoice_id)
    {
        $invoice = ClientInvoice::findOrFail($invoice_id);
        $client = User::where('id',$invoice->user_id)->where('roles_name','["client"]')->first();
        return view('pages.clients-invoices.print_invoice',['invoice'=>$invoice ,'client'=>$client]);
    }


    public function assignUnitView($pivotId)
    {
        $pivotRow = DB::table('client_invoice_product')->where('id', '=', $pivotId)->first();
        return view('pages.clients-invoices.assign_unit',['pivotRow' => $pivotRow]);
    }


    public function assignUnit(Request $request)
    {
        $pivotRow = DB::table('client_invoice_product')->where('id', '=', $request->item_id)->first();
        return dd("kkkkkkkkkkk");
    }

}
