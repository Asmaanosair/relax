@extends('layouts.app')

@section('content')


<div class="main-content show-profile" dir="rtl">
    <h2 class="text-center my-5">المعلومات الشخصية للمريض</h2>
    <div class="row text-right">
        <div class="col-md-5">
            <img src="{{$patient->image}}" alt="patient" class="image-edit">
        </div>
        <div class="col-md-4">
            <div>
                <label>اسم المريض</label>
                <div class="hr"></div>
                <p>{{$patient->name}}</p>
            </div>
            <div>
                <label>البريد الألكترونى</label>
                <div class="hr"></div>
                <p>{{$patient->email}}</p>
            </div>
            <div>
                <label>تاريخ الميلاد</label>
                <div class="hr"></div>
                <p>{{$patient->birthday}}</p>
            </div>

        </div>


        <div class="col-md-3">
            <div>
                <label>النوع</label>
                <div class="hr"></div>
                <p>{{$patient->gender}}</p>
            </div>

            <div>
                <label>رقم الموبايل</label>
                <div class="hr"></div>
                <p>{{$patient->phone}}</p>
            </div>
            <div>
            <label>القسم الداخلى</label>
            <div class="hr"></div>
            {{! $inside_department_patient = App\Department_patient::where('patient_id', $patient->id )->get() }}
            @if($inside_department_patient->count()>0 )
                {{! $inside_department_patient = App\Department_patient::where('patient_id', $patient->id )->get()->last() }}
                {{! $inside_department = App\Inside_department::where('id',$inside_department_patient->first()->inside_department_id)->get()->first() }}
                <p>{{$inside_department->name}}</p>
                @else
                <p>لا يوجد فى اى قسم داخلى</p>
            @endif
            </div>
        </div>
    </div>



</div>

@endsection
