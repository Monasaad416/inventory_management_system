<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Product;
use App\Models\Section;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $data['products'] = Product::latest()->paginate(20);
        return view('pages.products.index')->with($data);
    }


    public function create()
    {
        $data['sections'] = Section::all();
        return view('pages.products.create')->with($data);
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'product_name' => 'required|string',
                'product_code' => 'required|string',
                'description' => 'required|string',
                'section_id' => 'required|exists:sections,id',
                'store_amount' => 'required|string',
                'purchase_price' => 'required|numeric',
                'sale_price' => 'required|numeric',
            ]);


            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            //return dd($request->all());
            Product::create([
                'product_name' => $request->product_name ,
                'product_code' => $request->product_code ,
                'description' => $request->description,
                'section_id' => $request->section_id,
                'store_amount' => $request->store_amount,
                'purchase_price' => $request->purchase_price,
                'sale_price' => $request->sale_price,
                'unit' =>$request->unit,
            ]);

            return redirect()->route('products.index')->with('success','تم إضافة منتج جديد بنجاح');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data['product'] = product::findOrFail($id);
        $data['sections'] = Section::all();

        return view('pages.products.edit')->with($data);
    }


    public function update(Request $request)
    {
        $product = Product::findOrFail($request->id);
        // return dd($request->all());
        try {
           $validator = Validator::make($request->all(), [
                'product_name' => 'nullable|string',
                'product_code' => 'nullable|string',
                'description' => 'nullable|string',
                'section_id' => 'nullable|exists:sections,id',
                'store_amount' => 'nullable|string',
                'purchase_price' => 'nullable|numeric',
                'sale_price' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            // return dd($request->all());
            $product->update([
                'product_name' => $request->product_name ,
                'product_code' => $request->product_code ,
                'description' => $request->description,
                'section_id' => $request->section_id,
                'store_amount' => $request->store_amount,
                'purchase_price' => $request->purchase_price,
                'sale_price' => $request->sale_price,
                'unit' =>$request->unit,
            ]);

            return redirect()->route('products.index')->with('update','تم تعديل بيانات المنتج بنجاح');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }return redirect()->back()->withErrors(['error' => $e->getMessage()]);

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
            $product = product::findOrfail($request->id)->delete();
            return redirect()->route('products.index')->with('delete','تم حذف  المنتج بنجاح');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
