<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;

use App\Models\User;



use App\Models\Outcome;

use App\Models\Shareholder;
use Illuminate\Http\Request;
use App\Models\ClientInvoice;
use App\Models\FounderAccount;
use App\Models\SupplierInvoice;
use Illuminate\Validation\Rule;
use App\Models\ShareholderAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ShareholderController extends Controller
{

    public function index()
    {
        $data['shareholders'] = User::where('roles_name','["shareholder"]')->latest()->paginate(20);
        return view('pages.shareholders.index')->with($data);
    }


    public function create()
    {
        return view('pages.shareholders.create');
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
                'shares' => 'nullable|numeric',
                'share_value' => 'nullable|numeric',
                'user_id' => 'required|exists:users,id',
                'password' =>'required|string|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            //return dd($request->all());
            $shareholder = User::create([
                'name' => $request->name ,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'notes' => $request->notes,
                'shares' => $request->shares,
                'share_value' => $request->share_value,
                'user_id' => $request->user_id,
                'password' => Hash::make($request->password),
                'roles_name' => ["shareholder"],
            ]);
            $shareholder->assignRole(["shareholder"]);


            return redirect()->route('shareholders.index')->with('success','تم إضافة مساهم جديد بنجاح');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {

        $data['shareholder'] = User::where('roles_name','["shareholder"]')->where('id',$id)->first();
        return view('pages.shareholders.edit')->with($data);
    }

    public function update(Request $request)
    {
        // return dd($request->all());
        $shareholder = User::where('roles_name','["shareholder"]')->where('id',$request->id)->first();
        // return dd($request->all());
        try {
                $validator = Validator::make($request->all(), [
                'name' => 'nullable|string',
                'phone' => 'nullable|string',
                'email' => 'nullable|email|unique:users,email,'.$shareholder->id,
                'address' => 'nullable|string',
                'notes' => 'nullable|string',
                'shares' => 'nullable|numeric',
                'share_value' => 'nullable|numeric',
                'user_id' => 'nullable|exists:users,id',
                'password' =>'nullable|string|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            // return dd($request->all());
            $shareholder->update([
                'name' => $request->name ,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'notes' => $request->notes,
                'shares' => $request->shares,
                'share_value' => $request->share_value,
                'user_id' =>$request->founder_id,
                // 'password' => Hash::make($request->password),
                'role_id' => ["shareholder"],
            ]);

            return redirect()->route('shareholders.index')->with('update','تم تعديل بيانات المساهم  بنجاح');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy(Request $request)
    {

        try {
            $shareholders =  User::where('roles_name','["shareholder"]')->where('id',$request->id)->first();
            return redirect()->route('shareholders.index')->with('delete','تم حذف  المساهم بنجاح');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



        public function balanceSheet($id)
    {
        $shareholder = User::where('roles_name','["shareholder"]')->where('id',$id)->first();

        //حساب الارباح من المساهمين
        $founder = $shareholder->user;

        //return dd($founder);
        $sales = ClientInvoice::sum('total');

        $purchases = SupplierInvoice::sum('total');

        $part_paid_purchases = SupplierInvoice::sum('part_paid');
        $outcomes = Outcome::sum('amount');
        $clientsPayments = ClientInvoice::sum('part_paid');



        $firstProfit = $clientsPayments-$outcomes-$part_paid_purchases;
        $shares = User::where('roles_name','["shareholder"]')->sum('shares');
        $shareholderProfit = $firstProfit/$shares * $shareholder->shares * 0.5;
        //return dd($shareholderProfit);

        // $sharesValue = 0 ;
        // $shareholderValue = 0;
        // $shares = 0;
        // foreach($shareholders as $shareholder){
        //     if($shares != 0){
        //         $oneShare = $shareholder->shares;
        //         $oneSharePercentage = $oneShare/$shares;
        //         $sharesValue += $firstProfit * $oneSharePercentage * 0.5 ;
        //         $shareholderValue += $firstProfit * $oneSharePercentage * 0.5 ;

        //     } else {
        //         $sharesValue = 0;
        //         $shareholdersValue = 0;
        //     }


        //         //  $shareholdersRest = $sharesValue -$shareholdersPayments;
        //         //  $shareholdersRest = $shareholdersValue -$shareholdersPayments;

        // }

        $data['profit'] = ShareholderAccount::where('shareholder_id',$shareholder->id)->where('type',"profit")->get();
        $accountCapital = ShareholderAccount::where('shareholder_id',$shareholder->id)->where('type' , "capital")->sum('amount');
        $accountProfit = ShareholderAccount::where('shareholder_id',$shareholder->id)->where('type' , "profit")->sum('amount');

        return view('pages.shareholders.show',['shareholder'=>$shareholder,'accountCapital' => $accountCapital,'accountProfit'=>$accountProfit,'shareholderProfit' => $shareholderProfit])->with($data);
    }




    public function balanceSheetSearch(Request $request)
    {
        //return dd($request->all());

        $shareholder = User::where('roles_name','["shareholder"]')->where('id',$request->shareholder_id)->first();
        $from = $request->from;
        $to = $request->to;
        $type = $request->type;


        $accounts = ShareholderAccount::where( function($query) use($request){
            if($request->from != null && $request->to !=null ) {
                $query->whereBetween('created_at', [$request->from,$request->to]);
            }
            if($request->type == "capital"){
                $query->where('type','capital');
            }
            elseif($request->type == "profit"){
                $query->where('type','profit');
            }
        })->where('shareholder_id',$shareholder->id)->paginate(20);




        return view('pages.shareholders.search_result',compact('accounts','shareholder','from','to','type'));

    }
}
