<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::paginate(32);
        return view('admin.schools.index',['schools'=>$schools]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.schools.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();


        if ($request->file('image')) {
            $filName = time() . "." . $request->image->getClientOriginalExtension();
            $path = public_path() . '/images';
            $request->file('image')->move($path, $filName);
            $data['image'] = '/images/'. $filName;
        }
        School::create($data);
        return redirect(route('admin.schools.index'));
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
    public function edit(School $school)
    {
        return view('admin.schools.edit',['school'=>$school]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $data = $request->all();
        if ($request->file('image')) {
            $filName = time() . "." . $request->image->getClientOriginalExtension();
            $path = public_path() . '/images';
            $request->file('image')->move($path, $filName);
            $data['image'] = '/images/'. $filName;
        }
        $school->update($data);
        return redirect(route('admin.schools.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();
        return back();
    }
}
