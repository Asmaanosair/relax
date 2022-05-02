<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role; 
use App\Clinic; 
use App\Nationality;
use App\Doctor_clinic;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash; 


class Doctor_clinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $doctors= User::where('user_role', '3')->paginate(30);
       return view('admin.doctor_clinics.index',['doctors'=>$doctors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $natioanlities = Nationality::all();
        $clinics= Clinic::all();
        return view('admin.doctor_clinics.create',[
         'clinics'=>$clinics,
         'nationalities'=>$natioanlities,
       
         ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['user_role'] = '3';
        $data['password'] = Hash::make($request->password);
        if ($request->file('image')) {
            $filName = time() . "." . $request->image->getClientOriginalExtension();
            $path = public_path() . '/images';
            $request->file('image')->move($path, $filName);
            $data['image'] = '/images/' . $filName;
        }
        $user = User::create($data);

        Doctor_clinic::create([
            'details'=>$request->details,
            'user_id'=>$user->id,
            'price'=>$request->price,
            'job_title'=>$request->job_title,
            'nationality_id'=>$request->nationality_id,
            'clinic_id'=>$request->clinic_id
        ]);
        return redirect(route('admin.doctor_clinics.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $doctor = Doctor_clinic::where('user_id',$id)->get()->first();
        $clinic = Doctor_clinic::where('user_id', $id)->first();
        
        return view('admin.doctor_clinics.show')->with('doctor', $clinic);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    
        $user = User::find($id);
        $natioanlities = Nationality::all();
        $clinics= Clinic::all();
       
        return view('admin.doctor_clinics.edit',[
        'doctor'=>$user,
        'nationalities'=>$natioanlities,
        'clinics'=>$clinics
        ] 
    );
        
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
        $user = User::find($id);
        $data = $request->except('password');
        if (isset($request->password) and strlen($request->password) > 8) {
            $data['password'] = Hash::make($request->password);
        }
        if ($request->file('image')) {
            $filName = time() . "." . $request->image->getClientOriginalExtension();
            $path = public_path() . '/images';
            $request->file('image')->move($path, $filName);
            $data['image'] = '/images/' . $filName;
        }
        $user->update($data);

        $user->doctorClinic->update([
            'details'=>$request->details,
            'user_id'=>$user->id,
            'price'=>$request->price,
            'job_title'=>$request->job_title,
            'nationality_id'=>$request->nationality_id,
            'clinic_id'=>$request->clinic_id
        ]);
        return redirect(route('admin.doctor_clinics.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back();
    }
}
