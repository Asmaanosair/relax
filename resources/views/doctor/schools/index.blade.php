@extends('layouts.app')

@section('content')

<div class="goals">
    <div class="row">

        <div class="col-md-12 goals-container">
            <h2 class="mb-3 px-3 text-center" >اختر المدرسة</h2>
            <div class="container">
                <div class="row">
                    @forelse($schools as $school)
                    <div class="col-md-6">
                        <a href="{{route('doctor.schools.treatment',[$school->id, $patient_id] )}}">
                            <div class="plan">

                                <img class="w-100 h-100" src="{{asset($school->image)}}" alt="plan image">
                                <div class="d-flex align-items-center over-layer-plan">
                                    <div class="plan-text">
                                        <p>{{$school->school}}</p>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="alert alert-danger  text-center d-flex justify-content-center" style="margin:100px">
                        <p class=""> لا يوجد مدارس حاليا</p>
                    </div>
                    @endforelse

                </div>
            </div>

        </div>

    </div>

</div>

@endsection
