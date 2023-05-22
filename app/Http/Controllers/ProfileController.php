<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function editProfile($id)
    {
        $user = User::findOrFail($id);
        return view('pages.profile.edit',compact('user'));
    }

    public function updateProfile(Request $request)
    {
        //return dd($request->all());
        try{
            $request->validate([
                'name'=> 'string',
                'email' => [Rule::unique('users')->ignore($request->user()->id)],
                'notes'=> 'nullable|string',
                'address'=> 'string',
                'phone'=> 'string', [Rule::unique('users')->ignore($request->user()->id)],
                'passwors' => 'string|confirmed'

            ]);


            $user = User::where('id', $request->user_id)->first();


            if($request->password !== null){
                $newPassword = Hash::make($request->password);
                $user->update([
                    'name'=> $request->name,
                    'email' => $request->email,
                    'address'=> $request->address,
                    'notes'=> $request->notes,
                    'phone'=> $request->phone,
                    'password' => $newPassword,
                ]);
                 return redirect()->route('profile.edit',auth()->user()->id)->with('update','تم تعديل الملف الشخصي بنجاح');
            }
            else {
                $user->update([
                    'name'=> $request->name,
                    'email' => $request->email,
                    'address'=> $request->address,
                    'notes'=> $request->notes,
                    'phone'=> $request->phone,
                ]);
                 return redirect()->route('profile.edit',auth()->user()->id)->with('update','تم تعديل الملف الشخصي بنجاح');
            }


        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
