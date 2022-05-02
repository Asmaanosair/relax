<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PaymentMethod;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinics = PaymentMethod::paginate(32);

        return view('admin.payment_method.index',['clinics'=>$clinics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment_method.create');
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
        PaymentMethod::create($data);
        return redirect(route('admin.payment_method.index'));
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
    public function edit(PaymentMethod $clinic)
    {
        return view('admin.payment_method.edit',['clinic'=>$clinic]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $clinic)
    {
        $data = $request->all();
        if ($request->file('image')) {
            $filName = time() . "." . $request->image->getClientOriginalExtension();
            $path = public_path() . '/images';
            $request->file('image')->move($path, $filName);
            $data['image'] = '/images/'. $filName;
        }
        $clinic->update($data);
        return redirect(route('admin.payment_method.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $clinic)
    {
        $clinic->delete();
        return back();
    }
}
