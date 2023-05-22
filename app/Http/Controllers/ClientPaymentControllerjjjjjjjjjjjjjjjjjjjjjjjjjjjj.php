<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\ClientPayment;
use Illuminate\Support\Facades\Validator;

class ClientPaymentController extends Controller
{
    public function index()
    {
        $data['clientPayments'] = ClientPayment::latest()->paginate(20);
        return view('pages.clients_payments.index')->with($data);
    }


    public function create()
    {
        return view('pages.clients_payments.create');
    }

    public function store(Request $request)
    {
        //return dd($request->all());
        try {

            $validator = Validator::make($request->all(), [
                'details' => 'required|string',
                'amount' => 'required|numeric',
                'client_id' => 'required|exists:clients,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            //return dd($request->all());
            $clientPayment = clientPayment::create([
                'details' => $request->details ,
                'amount' => $request->amount,
                'client_id' => $request->client_id,
            ]);


            $client = Client::findOrFail($request->client_id);


            return redirect()->route('clients_payments.index')->with('success','تم إضافة مصروف جديد بنجاح');

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
        $data['clientPayment'] = clientPayment::findOrFail($id);
        return view('pages.clients_payments.edit')->with($data);
    }


    public function update(Request $request)
    {
        $client_expense = clientPayment::findOrFail($request->client_expense_id);
        // return dd($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'details' => 'nullable|string',
                'amount' => 'nullable|numeric',
                'client_id' => 'nullable|exists:clients,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            // return dd($request->all());
            $client_expense->update([
                'details' => $request->details ,
                'amount' => $request->amount,
                'client_id' => $request->client_id,
            ]);

            return redirect()->route('clients_payments.index')->with('update','تم تعديل بيانات المصروف بنجاح');

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
            return redirect()->route('clients_payments.index')->with('delete','تم حذف  المصروف بنجاح');

        // } catch (Throwable $th) {

        //     return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        // }

        }
            catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
