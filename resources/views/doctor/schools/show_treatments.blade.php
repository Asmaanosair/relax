@extends('layouts.app')

@section('content')


<div class="main-content">

    <h2 class="text-center">اختر الجلسة</h2>
    <div>
        <!-- <a href= class="btn btn-success add-department">
            <span class="plus"> +</span>
            <span class="text">اضافة مريض جديد </span>
        </a> -->
    </div>
    <div class="row depts">
        @forelse($treatments as $treatment)
        <div class="col-md-3">
            <div class="depts-content">
                <a href="{{route('doctor.schools.session',[$treatment->id , $patient_id])}}">
                    <div>
                        <img class="img-dept" src="{{asset('img/session.jpg')}}" alt="treatment">
                    </div>
                    <p>
                        {{$treatment->treatment}}

                    </p>
                </a>
            </div>


        </div>
        @empty

        <div class="alert alert-danger  text-center d-flex justify-content-center">
            <p class=""> لا يوجد جلسات حاليا </p>

        </div>
        @endforelse


    </div>

</div>

@endsection
