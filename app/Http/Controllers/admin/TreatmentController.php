<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TreatmentRequest;
use App\School;
use App\Treatment;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $treatments=Treatment::paginate(20);

        return view('admin.treatments.index',['treatments'=>$treatments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools=School::all();
        return view('admin.treatments.create',['schools'=>$schools]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TreatmentRequest $request)
    {
        $data = $request->all();
        Treatment::create($data);
        return redirect(route('admin.treatments.index'));
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
    public function edit(Treatment $treatment)
    {
        $schools=School::all();
        return view('admin.treatments.edit',['schools'=>$schools,'treatment'=> $treatment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TreatmentRequest $request, Treatment $treatment)
    {
        $data = $request->all();
        $treatment->update($data);
        return redirect(route('admin.treatments.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return back();
    }

    public function cognitive(){
        return view ('admin.treatments.cognitive');
    }
}
