<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Inside_department;
use App\Treatment_goal;
use App\User;
use Illuminate\Http\Request;

class Treatment_goalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $departments = Inside_department::all();
        $inside_department_first = Inside_department::first();
        if ($inside_department_first) {

            $inside_department_first_id =  $inside_department_first->id;
        } else {
            $inside_department_first_id = null;
        }

        $goal= Treatment_goal::where('user_id',$id)->get()->first();

        return view('admin.treatments.goals',['goal'=>$goal , 'id'=>$id , 'departments' => $departments,  'department_id' => $inside_department_first_id,]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goals= Treatment_goal::where('user_id',$id)->get()->first();
        return view('admin.treatments.create_goals',['goals'=>$goals , 'id'=>$id ]);
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
        $goals= Treatment_goal::where('user_id',$id)->get()->first();
        if(!$goals){
            Treatment_goal::create(['user_id'=>$id, 'goals'=>$request->goals]);
        }
        else{
            $goals->update(['user_id'=>$id , 'goals'=>$request->goals]);
        }

        return redirect(route('doctor.treatment_goals.show',$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
