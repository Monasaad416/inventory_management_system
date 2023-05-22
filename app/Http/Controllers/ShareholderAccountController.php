<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Shareholder;
use Illuminate\Http\Request;
use App\Models\ShareholderAccount;
use Illuminate\Support\Facades\Validator;

class ShareholderAccountController extends Controller
{

    public function getShareholdersByFounder($id)
    {
        $listOfShareholders = User::where('roles_name','["shareholder"]')->where('user_id',$id)->pluck('name','id');
        return response()->json($listOfShareholders);
    }
    public function index()
    {
        if(auth()->user()->roles_name == ["admin"]) {
            $data['accounts'] = ShareholderAccount::latest()->paginate(20);
        }
        elseif(auth()->user()->roles_name == ["founder"]) {
            $data['accounts'] = ShareholderAccount::where('user_id', auth()->user()->id )->latest()->paginate(20);
        }

        return view('pages.shareholders_accounts.index')->with($data);
    }


    public function create()
    {
        return view('pages.shareholders_accounts.create');
    }

    public function store(Request $request)
    {
        try {



            $validator = Validator::make($request->all(), [
                'notes' => 'nullable|string',
                'amount' => 'required|numeric',
                'type' => 'required',
                'user_id' => 'required|exists:users,id',
                'shareholder_id' => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            //return dd($request->all());
            $account = ShareholderAccount::create([
                'notes' => $request->notes ,
                'amount' => $request->amount,
                'type' => $request->type,
                'user_id' => $request->user_id,
                'shareholder_id' => $request->shareholder_id,

            ]);

            return redirect()->route('shareholders_accounts.index')->with('success','تم إضافة معاملة مالية جديدة للمساهم بنجاح');


        }
            catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data['account'] = ShareholderAccount::findOrFail($id);
        return view('pages.shareholders_accounts.edit')->with($data);
    }


    public function update(Request $request)
    {
        $account = ShareholderAccount::findOrFail($request->account_id);
        // return dd($request->all());
        try {

            $validator = Validator::make($request->all(), [
                'notes' => 'nullable|string',
                'amount' => 'nullable|numeric',
                'type' => 'nullable',
                'user_id' => 'nullable|exists:users,id',
                'shareholder_id' => 'nullable|exists:users,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            //return dd($request->all());
            $account->update([
                'notes' => $request->notes ,
                'amount' => $request->amount,
                'type' => $request->type,
                'user_id' => $request->user_id,
                'shareholder_id' => $request->shareholder_id,

            ]);
            return redirect()->route('shareholders_accounts.index')->with('update','تم تعديل المعاملة المالية للمؤسس بنجاح');

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
            ShareholderAccount::findOrFail($request->store_id)->delete();
            return redirect()->route('shareholders_accounts.index')->with('delete','تم حذف  المعاملة المالية للمؤسس بنجاح');


        }
            catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}

