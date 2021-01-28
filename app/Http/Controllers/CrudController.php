<?php

namespace App\Http\Controllers;

use App\emp;
use App\cities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('crud.index', ['emp_details' => emp::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $data = cities::select('city_state')->distinct()->get();
        // dd($data);
        // $city_data = cities::all();
        return view('crud.create', ['state_data' => cities::select('city_state')->distinct()->get()]);
    }

    public function cities(Request $request)
    {

        // dd($request);
        $selected = $request->get('state');
        $data = cities::where('city_state',$selected)->get();
        $output = "";
        foreach($data as $row){
            $output .= '<option value="'.$row->city_name.'">'.$row->city_name.'</option>';
        }
        return $output;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // // validation
        $request->validate([
            'name'=>'bail|required|min:3|max:20',
            'email'=>'required|min:7|max:49',
            'city'=>'required|min:3|max:99',
            'number'=>'required|min:10|max:10',
            'img'=>'required',
        ]);

        $newEmp = new emp();
        $newEmp->emp_name = $request->input('name');
        $newEmp->emp_email = $request->input('email');
        $newEmp->emp_city = $request->input('city');
        $newEmp->emp_phone = $request->input('number');

        //image upload
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . "." . $ext;
            $file->move('uploads/emp_img/' , $filename);
            $newEmp->emp_img = $filename;
        }

        $newEmp->save();
        return redirect()->route('emp.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $em = emp::find($id);
        // return view('crud.edit',compact($em));
        return view('crud.edit', ['em' => emp::find($id),'state_data' => cities::select('city_state')->distinct()->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->only('up_img'));
        // // validation
        $request->validate([
            'up_name'=>'bail|required|min:3|max:20',
            'up_email'=>'required|min:7|max:49',
            'city'=>'required|min:3|max:99',
            'up_phone'=>'required|min:10|max:10'
            // 'up_img'=>'required',

        ]);
        // saving all data into db
        $em = emp::find($id);
        $em->emp_name =  $request->input('up_name');
        $em->emp_email = $request->input('up_email');
        $em->emp_city = $request->input('city');
        $em->emp_phone = $request->input('up_phone');

        //image update
        if ($request->hasFile('up_img')) {
            $file = $request->file('up_img');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . "." . $ext;
            $file->move('uploads/emp_img/' , $filename);
            $em->emp_img = $filename;
        }

        $em->save();
        return redirect('/emp')->with('success', 'Emp Details updated!');
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $em = emp::find($id);
        $em->delete();
        return redirect('/emp');
    }
}
