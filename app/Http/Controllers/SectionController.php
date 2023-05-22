<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Section;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sections'] = Section::latest()->paginate(20);
        return view('pages.sections.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['suppliers'] = User::where('roles_name','["supplier"]')->get();
        return view('pages.sections.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
                $validator = Validator::make($request->all(), [
                    'section_name' => 'required|string',
                    'description' => 'required|string',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
                }
            //return dd($request->all());
            Section::create([
                'section_name' => $request->section_name ,
                'description' => $request->description,
                'created_by' => Auth::user()->name,
            ]);

            return redirect()->route('sections.index')->with('success','تم إضافة قسم  جديد بنجاح');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $section = Section::findOrFail($id);
         $suppliers = User::where('roles_name','["supplier"]')->get();

        return view('pages.sections.edit',['section'=>$section,'suppliers'=>$suppliers]);
    }


    public function update(Request $request)
    {
        //return dd($request->all());
        $section = Section::findOrFail($request->section_id);
        //return dd($section);
        try {
            $request->validate([
                'section_name' => 'nullable|string',
                'description' => 'nullable|string',
            ]);

            $section->update([
                'section_name' => $request->section_name ,
                'description' => $request->description,
                'created_by' => Auth::user()->name,
            ]);
            return redirect()->route('sections.index')->with('update','تم تعديل بيانات القسم بنجاح');
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
            $section = section::findOrfail($request->id)->delete();
            return redirect()->route('sections.index')->with('delete','تم حذف  القسم بنجاح');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
