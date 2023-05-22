<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Outcome;
use Illuminate\Http\Request;
use App\Models\ClientInvoice;
use App\Models\FounderAccount;
use App\Models\SupplierInvoice;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FounderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['founders'] = User::where('roles_name','["founder"]')->paginate(20);
        return view('pages.founders.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('pages.founders.create',compact('roles'));
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
            $user = User::create([
                'name' => $request->name ,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'notes' => $request->notes,
                'password' => Hash::make($request->password),
                'roles_name' => ["founder"]
            ]);
            $user->assignRole(["founder"]);
            return redirect()->route('founders.index')->with('success','تم إضافة مؤسس  جديد بنجاح');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(User $founder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $data['founder'] = User::findOrFail($id);
        return view('pages.founders.edit')->with($data);
    }

    public function update(Request $request)
    {
        // return dd($request->all());
        $founder = User::findOrFail($request->id);
        // return dd($request->all());
        try {
               $validator = Validator::make($request->all(), [
                    'name' => 'nullable|string',
                    'phone' => 'nullable|string',
                    'email' => 'nullable|email|unique:users,email,'.$founder->id,
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
            $founder->update([
                'name' => $request->name ,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'notes' => $request->notes,
                'password' => Hash::make($request->password),
                'roles_name' => ["founder"]

            ]);

            return redirect()->route('founders.index')->with('update','تم تعديل بيانات المساهم بنجاح');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /*
    public function destroy($id)
    {
    $founders = founders::findOrFail($id);
        $founders->delete();

        return redirect()->route('founders.index')->with('delete', 'تم حذف المساهم بنجاح');

    }
    */
    public function destroy(Request $request)
    {
        try {
            $founders = User::findOrfail($request->id)->delete();
            return redirect()->route('founders.index')->with('delete','تم حذف  المؤسس بنجاح');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }




        public function balanceSheet($id)
    {
        $founder = User::where('roles_name','["founder"]')->where('id',$id)->first();
        //حساب الارباح من للمؤسسين
        $shareholders = $founder->shareholders;

        $sales = ClientInvoice::sum('total');

        $purchases = SupplierInvoice::sum('total');

        $part_paid_purchases = SupplierInvoice::sum('part_paid');
        $outcomes = Outcome::sum('amount');
        $clientsPayments = ClientInvoice::sum('part_paid');



        $firstProfit = $clientsPayments-$outcomes-$part_paid_purchases;

        $sharesValue = 0 ;
        $founderValue = 0;
        $shares = 0;
        foreach($shareholders as $shareholder){
            if($shares != 0){
                $oneShare = $shareholder->shares;
                $oneSharePercentage = $oneShare/$shares;
                $sharesValue += $firstProfit * $oneSharePercentage * 0.5 ;
                $founderValue += $firstProfit * $oneSharePercentage * 0.5 ;

            } else {
                $sharesValue = 0;
                $foundersValue = 0;
            }


                //  $shareholdersRest = $sharesValue -$shareholdersPayments;
                //  $foundersRest = $foundersValue -$foundersPayments;

        }

        $data['profit'] = FounderAccount::where('user_id',$founder->id)->where('type',"profit")->get();
        $accountCapital = FounderAccount::where('user_id',$founder->id)->where('type' , "capital")->sum('amount');
        $accountProfit = FounderAccount::where('user_id',$founder->id)->where('type' , "profit")->sum('amount');

        return view('pages.founders.show',['founder'=>$founder,'accountCapital' => $accountCapital,'accountProfit'=>$accountProfit,'sharesValue' => $sharesValue,'foundersValue'=>$founderValue])->with($data);
    }




    public function balanceSheetSearch(Request $request)
    {

        $founder = User::where('roles_name','["founder"]')->where('id',$request->founder_id)->first();
        $from = $request->from;
        $to = $request->to;
        $type = $request->type;


        $accounts = FounderAccount::where( function($query) use($request){
            if($request->from && $request->to) {
                $query->whereBetween('created_at', [$request->from,$request->to]);
            }
            if($request->type == 'capital'){
                $query->where('type','capital');
            }
            elseif($request->type == 'profit'){
                $query->where('type','profit');
            }
        })->where('user_id',$founder->id)->paginate(20);




        return view('pages.founders.search_result',compact('accounts','founder','from','to','type'));

    }
}
