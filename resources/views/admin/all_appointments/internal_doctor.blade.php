@extends('layouts.app')

@section('content')


<div class="main-content">
    <div>

    </div>
    <h2 class="text-center">اختر طبيب لعرض المواعيد الخاصة به</h2>
    <div class="row depts">
        @forelse($doctors as $doctor)
        <div class="col-md-3">
            <div class="depts-content">

                <a href="{{route('admin.sessions.doctors.show',$doctor->id)}}">
                    <div>
                        <img class="img-dept" src="{{asset($doctor->image)}}" alt="doctor">
                    </div>
                    <p>
                        {{$doctor->name}}
                    </p>
                </a>
            </div>


        </div>
        @empty

        <div class="alert alert-danger  text-center d-flex justify-content-center">
            <p class=""> لا يوجد مواعيد حاليا</p>

        </div>
        @endforelse


    </div>

</div>

@endsection
