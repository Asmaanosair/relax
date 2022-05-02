<?php

namespace App\Http\Controllers\admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\Clinic;
use App\Nationality;
use App\Doctor;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles =Role::all();
        $all_roles=['منفذ النشاط','الأخصائى الإجتماعى ','الأخصائى النفسى','الطبيب النفسى'];
        if($roles->count()==0){
            for($i=0; $i<count($all_roles) ; $i++){
                Role::create(['role'=>$all_roles[$i] ]);
            }
            return redirect(route('admin.doctors.index'));
         }

       $doctors= User::where('user_role', '1')->paginate(30);
       return view('admin.doctors.index',['doctors'=>$doctors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $natioanlities = Nationality::all();
        return view('admin.doctors.create',[
         'roles'=>$roles,
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
        $data['user_role'] = '1';
        $data['password'] = Hash::make($request->password);
        if ($request->file('image')) {
            $filName = time() . "." . $request->image->getClientOriginalExtension();
            $path = public_path() . '/images';
            $request->file('image')->move($path, $filName);
            $data['image'] = '/images/' . $filName;
        }
        $user = User::create($data);

        Doctor::create([
            'details'=>$request->details,
            'user_id'=>$user->id,
            'price'=>$request->price,
            'role_id'=>$request->role_id,
            'nationality_id'=>$request->nationality_id,
        ]);
            return redirect(route('admin.doctors.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::where('user_id',$id)->get()->first();

        return view('admin.doctors.show',['doctor'=>$doctor]);
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
        $roles = Role::all();
        $natioanlities = Nationality::all();

        return view('admin.doctors.edit',[
        'doctor'=>$user,
        'roles'=>$roles,
        'nationalities'=>$natioanlities,

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

        $user->doctor->update([
            'details'=>$request->details,
            'user_id'=>$user->id,
            'price'=>$request->price,
            'role_id'=>$request->role_id,
            'nationality_id'=>$request->nationality_id,
        ]);
        return redirect(route('admin.doctors.index'));
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

    public function showDoctor($id)
    {
        $doctor = Doctor::where('id',$id)->get()->first();

        return view('admin.doctors.show',['doctor'=>$doctor]);
    }
}
