@extends('layouts.app')

@section('content')

<div class="goals">

    <form method="POST" action="{{route('doctor.session.store')}}">
        @csrf
        <div class="row">
            <div class="col-lg-3 col-md-5 side-bar">
                <ul class="list-group">
                    @forelse($schools as $school)
                    <li class="list-group-item {{$treatment->school->id == $school->id ? 'active_dept' : '' }}">
                        <a href="{{route('doctor.schools.treatment',[$school->id, $patient_id])}}">
                            علاج {{$school->school}}
                        </a>
                    </li>
                    @empty
                    @endforelse

                </ul>
            </div>
            <div class="col-lg-9 col-md-7 all-treatments">
                <div class="all-treatments-content">
                    <h2>علاج {{$treatment->school->school}}</h2>
                    <div>
                        <div class="form-check text-right px-5">
                            <!-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> -->
                            <label class="form-check-label" for="exampleCheck1">
                                {{$treatment->treatment}}
                            </label>
                        </div>
                        <div class="info-treatment">
                            <div class="row">
                                <div class="col-lg-3 col-md-12">
                                    <select required name="type" class="form-control">
                                        <option selected disabled>نوع الجلسة </option>
                                        <option value="0">جماعية </option>
                                        <option value="1">فردية</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <select required name="num" class="form-control">
                                        <option disabled selected>عدد الجلسات</option>
                                        @for($i=1; $i < 30 ; $i++) <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                    </select>
                                </div>
                                <!-- <div class="col-lg-3 col-md-12">
                                    <select required class="form-control">
                                        <option>الالتزام الأسبوعى</option>
                                    </select>
                                </div> -->
                            </div>

                            <div class="mt-4">
                                <label class="form-check-label mb-2" for="exampleCheck1">
                                    موعد الجلسات
                                </label>
                                <div class="row">
                                    <div class="col-lg-3 col-md-12">
                                        <input value="التاريخ" required class="form-control"  type="date" name="date">
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <select required name="day" class="form-control">
                                            <option selected disabled>الأيام</option>
                                            @foreach($days as $day)
                                            <option value="{{$day}}">{{$day}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                      <input required type="text" name="from" class="timepicker form-control" placeholder="من الساعة...">
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                    <input required type="text" name="to" class="timepicker form-control" placeholder="إلى الساعة...">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4" style="margin-bottom: 70px;" >
                                <label class="form-check-label mb-2" for="exampleCheck1">
                                    المسؤل عن الجلسة
                                </label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input class="form-control"  name="doctor_id" readonly value="{{Auth::user()->name}}">
                                        <input required hidden name="doctor_id" value="{{Auth::user()->id}}">
                                    </div>

                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="form-check-label mb-2" for="exampleCheck1">
                                    أهداف الجلسة
                                </label>
                                <div>
                                    <div class="form-group">
                                        <div id="tools"></div>
                                        <div id="editor"></div>
                                        <textarea required hidden class="target-styling" name="description"></textarea>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="treatment_id" value="{{$treatment->id}} ">

                            <input type="hidden" name="user_id" value="{{$patient_id}}">

                        </div>
                        <div class="text-left my-5">
                            <input type="submit" class="btn btn-success add px-5 py-1" style="position: absolute;text-align: left !important;bottom: 211px;left: 171px;" value="حفظ">
                        </div>


                    </div>


                </div>


            </div>

        </div>


    </form>

</div>

@endsection
