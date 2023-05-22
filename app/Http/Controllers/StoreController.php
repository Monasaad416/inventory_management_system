<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index()
    {
        $data['stores'] = Store::latest()->paginate(20);
        return view('pages.stores.index')->with($data);
    }


    public function create()
    {
        return view('pages.stores.create');
    }

    public function store(Request $request)
    {
        try {
           
            $request->validate([
                'details' => 'required|string',
                'amount' => 'required|numeric',
            ]);
            //return dd($request->all());
            $store = Store::create([
                'details' => $request->details ,
                'amount' => $request->amount,
            ]);


            $store->outcome()->create([
                'outcomable_type' =>  'App\Models\Store',
                'outcomable_id' => $store->id,
                'amount' => $store->amount,
                'details' => $store->details,
            ]);

            return redirect()->route('stores.index')->with('success','تم إضافة مصروف جديد بنجاح');
        
        // } catch (Throwable $th) {
 
        //     return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        // }
        }
            catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data['store'] = Store::findOrFail($id);
        return view('pages.stores.edit')->with($data);
    }


    public function update(Request $request)
    {
        $store = Store::findOrFail($request->store_id);
        // return dd($request->all());
        try {
             $request->validate([
                'details' => 'required|string',
                'amount' => 'required|numeric',
            ]);
            // return dd($request->all());
            $store->update([
                'details' => $request->details ,
                'amount' => $request->amount,
            ]);


            
            $store->outcome()->update([
                'outcomable_type' =>  'App\Models\Store',
                'outcomable_id' => $store->id,
                'amount' => $request->amount,
                'details' =>$request->details ,
            ]);

            return redirect()->route('stores.index')->with('update','تم تعديل بيانات المصروف بنجاح');
        
        // } catch (Throwable $th) {
 
        //     return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        // }

        }
            catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        try {
            $store = Store::findOrfail($request->store_id)->delete();
            return redirect()->route('stores.index')->with('delete','تم حذف  المصروف بنجاح');
              
        // } catch (Throwable $th) {
 
        //     return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        // }

        }
            catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
