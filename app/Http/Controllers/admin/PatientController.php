<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Patient;
class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = User::where('user_role', '2')->paginate(30);
        return view('admin.patients.index', ['patients' => $patients]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.patients.create');
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
        $data['user_role'] = '2';
        $data['password'] = Hash::make($request->password);
        if ($request->file('image')) {
            $filName = time() . "." . $request->image->getClientOriginalExtension();
            $path = public_path() . '/images';
            $request->file('image')->move($path, $filName);
            $data['image'] = '/images/' . $filName;
        }
        $user = User::create($data);
        Patient::create(['user_id'=>$user->id]);
        return redirect(route('admin.patients.index'));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.patients.show', ['patient' => $user]);
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
        return view('admin.patients.edit', ['patient' => $user]);
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
        return redirect(route('admin.patients.index'));
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
    public function home()
    {
      return view('home');
    }
}
