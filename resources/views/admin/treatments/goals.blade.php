@extends('layouts.app')

@section('content')

<div class="goals">
    <div class="row">

        <div class="col-md-8 goals-container " >
            <h2 class="mb-3">أهداف خطة العلاج</h2>
            <div class="the-goals" style="min-height:65vh">
                <div class="patient-goals" dir="rtl">
                    @if($goal != null)
                    {!! $goal->goals !!}
                    @else
                    <div class="alert alert-danger  text-center d-flex justify-content-center">
                        <p class=""> لا يوجد خطة حاليا</p>

                    </div>

                    @endif



                </div>
                <div class="text-left my-1" style="    position: absolute;left: 100px;bottom: 49px;">
                    <a href="{{route('doctor.schools.patient',$id)}}" class="btn btn-success add add-data text-light">
                        التالى
                    </a>

                    <a href="{{route('doctor.treatment_goals.edit',$id)}}" class="btn btn-success add add-data text-light">
                        اضافة خطة
                    </a>
                </div>
            </div>


        </div>

    </div>

</div>
@endsection
