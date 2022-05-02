<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nationalities = Nationality::paginate(30);
        return view('admin.nationalities.index',['nationalities'=>$nationalities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nationalities.create');
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


        if ($request->file('flag')) {
            $filName = time() . "." . $request->flag->getClientOriginalExtension();
            $path = public_path() . '/images';
            $request->file('flag')->move($path, $filName);
            $data['flag'] = '/images/'. $filName;
        }
        Nationality::create($data);
        return redirect(route('admin.nationalities.index'));
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
    public function edit(Nationality $nationality)
    {
        return view('admin.nationalities.edit',['nationality'=>$nationality]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nationality $nationality)
    {
        $data = $request->all();
        if ($request->file('flag')) {
            $filName = time() . "." . $request->flag->getClientOriginalExtension();
            $path = public_path() . '/images';
            $request->file('flag')->move($path, $filName);
            $data['flag'] = '/images/'. $filName;
        }
        $nationality->update($data);
        return redirect(route('admin.nationalities.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nationality $nationality)
    {
        $nationality->delete();
        return back();
    }
}
