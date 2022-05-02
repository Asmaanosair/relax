@extends('layouts.app')

@section('content')


<div class="main-content">

    <h2 class="text-center">المرضى</h2>


    <div class="goals">
        <div class="row">
            <div class="col-md-3 side-bar">
                <!-- <ul class="list-group">
                    <li class="list-group-item active_dept">
                        <a>

                        </a>
                    </li>

                </ul> -->
            </div>
            <div class="col-md-9 goals-container">

                <div class="section-search">
                    <div class="form-group has-search col-md-6">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control search" placeholder="ابحث عن مريض...">
                    </div>
                </div>

                <div class="statitics">
                    <div class="row ">

                        <div class="col-lg-4 col-md-6 text-center statitic">
                            <div class="d-flex align-items-center statitic-content">
                                <div class="icon">
                                    <img src="{{asset('img/person3.PNG')}}" alt="">
                                </div>
                                <div>
                                    <p class="counter">{{$patients_id->count()}}</p>
                                    <p>المرضى</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 text-center statitic">
                            <div class="d-flex align-items-center statitic-content">
                                <div class="icon">
                                    <img src="{{asset('img/calender.PNG')}}" alt="">
                                </div>
                                <div>
                                    <a href="{{route('doctor.doctor_appointments.index')}}">
                                        <p class="counter">{{$appointments->count()}}</p>
                                        <p> كل المواعيد</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="results">
                @forelse($patients_id as $patient_id)

                {{!$patient = App\User::where('id',$patient_id->user_id)->get()->first()}}
                    <div class="result">
                        <div class="img-person-result">
                            <a href="{{route('doctor.doctor_patients.show',$patient->id)}}">
                                <img src="{{$patient->image=='avatar2.png'?'/images/avatar2.png' :$patient->image }}" alt="patient">
                            </a>
                        </div>
                        <a href="{{route('doctor.appointment_patients.show',$patient->id)}}">
                            <span class="name">
                            {{$patient->name}}
                            </span>
                            <span class="number">

                            </span>
                        </a>
                    </div>

                    @empty
                <div class="alert alert-danger  text-center d-flex justify-content-center" style="margin:100px">
                    <p class=""> لا يوجد مرضى حاليا</p>
                </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>


</div>

@endsection
