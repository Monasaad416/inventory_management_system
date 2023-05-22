<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\FounderAccount;
use Illuminate\Support\Facades\Validator;

class FounderAccountController extends Controller
{
    public function index()
    {
        if(auth()->user()->roles_name == ["admin"]) {
            $data['accounts'] = FounderAccount::latest()->paginate(20);
        }
        elseif(auth()->user()->roles_name == ["founder"]) {
            $data['accounts'] = FounderAccount::where('user_id', auth()->user()->id )->latest()->paginate(20);
        }

        return view('pages.founders_accounts.index')->with($data);
    }


    public function create()
    {
        return view('pages.founders_accounts.create');
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'notes' => 'nullable|string',
                'amount' => 'required|numeric',
                'user_id' => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            //return dd($request->all());
            $account = FounderAccount::create([
                'notes' => $request->notes ,
                'amount' => $request->amount,
                'user_id' => $request->user_id,

            ]);

            return redirect()->route('founders_accounts.index')->with('success','تم إضافة معاملة مالية جديدة للمؤسس بنجاح');


        }
            catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data['account'] = FounderAccount::findOrFail($id);
        return view('pages.founders_accounts.edit')->with($data);
    }


    public function update(Request $request)
    {
        $account = FounderAccount::findOrFail($request->account_id);
        // return dd($request->all());
        try {
                $validator = Validator::make($request->all(), [
                    'notes' => 'nullable|string',
                    'amount' => 'nullable|numeric',

                    'user_id' => 'nullable|exists:users,id',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
                }

                $account->update([
                    'notes' => $request->notes ,
                    'amount' => $request->amount,

                    'user_id' => $request->user_id,

                ]);
                return redirect()->route('founders_accounts.index')->with('update','تم تعديل المعاملة المالية للمؤسس بنجاح');

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
            FounderAccount::findOrFail($request->store_id)->delete();
            return redirect()->route('founders_accounts.index')->with('delete','تم حذف  المعاملة المالية للمؤسس بنجاح');


        }
            catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
