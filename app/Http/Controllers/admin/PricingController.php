<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pricing;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pricings=Pricing::get();
        return view("admin.pricings.index",['pricings'=>$pricings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pricings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pricing::create($request->all());
        return redirect(route('admin.pricings.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pricing $pricing)
    {
        return view("admin.pricings.show",['pricing'=>$pricing]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(pricing $pricing)
    {
        return view("admin.pricings.edit",['pricing'=>$pricing]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pricing $pricing)
    {
        $pricing->update($request->all());
        return redirect(route('admin.pricings.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pricing $pricing)
    {
        $pricing->delete();
        return back();
    }

    public function pricing()
    {
        $pricings=Pricing::get();

        return view("admin.pricings.pricing",['pricings'=>$pricings]);

    }
}
