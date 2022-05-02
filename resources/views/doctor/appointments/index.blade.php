@extends('layouts.app')

@section('content')


<div class="main-content">
  
    <h2 class="text-center">المرضى</h2>
    <div class="row depts">

  
        @forelse($appointments as $appointment)
        {{!$patient = App\User::where('id',$appointment->user_id)->get()->first()}}
        <div class="col-md-3">
            <div class="depts-content">
                <a href="{{route('doctor.doctor_patients.show',$patient->id)}}">
                    <div>
                        <img class="img-dept" src="{{$patient->image}}" alt="patient">
                    </div>
                    <p>
                        {{$patient->name}}
                    </p>
                </a>
            </div>
        </div>
        @empty
        <div class="alert alert-danger  text-center d-flex justify-content-center">
            <p class=""> لا يوجد مرضى حاليا</p>

        </div>

        @endforelse


    </div>

</div>

@endsection
