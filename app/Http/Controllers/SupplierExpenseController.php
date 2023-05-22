<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Store;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\SupplierExpense;
use Illuminate\Support\Facades\Validator;

class SupplierExpenseController extends Controller
{
    public function index()
    {


        if(auth()->user()->roles_name == ["supplier"] ){
            $data['suppliersExpenses'] = SupplierExpense::where('user_id',auth()->user()->id)->latest()->paginate(20);
            return view('pages.suppliers_expenses.index')->with($data);
        } else {
            $data['suppliersExpenses'] = SupplierExpense::latest()->paginate(20);
            return view('pages.suppliers_expenses.index')->with($data);
        }

    }


    public function create()
    {
        return view('pages.suppliers_expenses.create');
    }

    public function store(Request $request)
    {
        //return dd($request->all());
        try {
            $request->validate([

            ]);

            $validator = Validator::make($request->all(), [
                'details' => 'required|string',
                'amount' => 'required|numeric',
                'supplier_id' => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            //return dd($request->all());
            $supplierExpense = SupplierExpense::create([
                'details' => $request->details ,
                'amount' => $request->amount,
                'user_id' => $request->supplier_id,
            ]);
            $data['suppliers'] = User::where('roles_name','["supplier"]')->get();

            $supplier = User::where('id',$request->supplier_id)->first();


            $supplier->outcome()->create([
                'outcomable_type' =>  'App\Models\Supplier',
                'outcomable_id' => $supplierExpense->user_id,
                'amount' => $supplierExpense->amount,
                'details' => $supplierExpense->details,
            ]);

            return redirect()->route('suppliers_expenses.index')->with('success','تم إضافة مصروف جديد بنجاح');

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
        $data['supplierExpense'] = SupplierExpense::findOrFail($id);
        return view('pages.suppliers_expenses.edit')->with($data);
    }


    public function update(Request $request)
    {
        $supplier_expense = SupplierExpense::findOrFail($request->supplier_expense_id);
        // return dd($request->all());
        try {
                $validator = Validator::make($request->all(), [
                    'details' => 'nullable|string',
                    'amount' => 'nullable|numeric',
                    'supplier_id' => 'nullable|exists:users,id',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
                }
                // return dd($request->all());
                $supplier_expense->update([
                    'details' => $request->details ,
                    'amount' => $request->amount,
                    'user_id' => $request->supplier_id,
                ]);

                $supplier_expense->user->outcome()->update([
                    'outcomable_type' =>  'App\Models\User',
                    'outcomable_id' => $supplier_expense->user_id,
                    'amount' => $request->amount,
                    'details' =>$request->details ,
                ]);


                return redirect()->route('suppliers_expenses.index')->with('update','تم تعديل بيانات المصروف بنجاح');

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
            return redirect()->route('suppliers_expenses.index')->with('delete','تم حذف  المصروف بنجاح');

        // } catch (Throwable $th) {

        //     return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        // }

        }
            catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
