@extends('layouts.app')

@section('content')

<div class="goals">

    <form method="POST" action="{{route('doctor.session.update',$session->id)}}">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row">
                <div class=" col-md-12 all-treatments">
                    <div class="all-treatments-content">
                        <h2>{{$session->treatment->treatment}}</h2>
                        <div>
                            <div class="form-check text-right px-5">
                                <!-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> -->
                                <label class="form-check-label" for="exampleCheck1">
                                    علاج ب{{$session->treatment->school->school}}
                                </label>
                            </div>
                            <div class="info-treatment">
                                <div class="row">
                                    <div class="col-lg-3 col-md-12">
                                        <select required name="type" class="form-control">
                                            <option selected disabled>نوع الجلسة </option>
                                            <option {{$session->type == '0' ? 'selected' : ''}} value="0">جماعية </option>
                                            <option {{$session->type == '1' ? 'selected' : ''}} value="1">فردية</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <select required name="num" class="form-control">
                                            <option disabled selected>عدد الجلسات</option>
                                            @for($i=1; $i < 30 ; $i++) <option {{$session->num == $i ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
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
                                            <input value="{{$session->treatmentAppointment->date}}" required class="form-control" type="date" name="date">
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <select required name="day" class="form-control">
                                                <option selected disabled>الأيام</option>
                                                @foreach($days as $day)
                                                <option {{$session->treatmentAppointment->day == $day ? 'selected' : ''}} value="{{$day}}">{{$day}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <input type="text" value="{{$session->treatmentAppointment->from}}" name="from" class="timepicker form-control" placeholder="من الساعة...">
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <input type="text" value="{{$session->treatmentAppointment->to}}" name="to" class="timepicker form-control" placeholder="إلى الساعة...">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4" style="margin-bottom: 70px;">
                                    <label class="form-check-label mb-2" for="exampleCheck1">
                                        المسؤل عن الجلسة
                                    </label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input class="form-control" name="doctor_id" readonly value="{{Auth::user()->name}}">
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
                                            <textarea required hidden class="target-styling" name="description">{{$session->description}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="treatment_id" value="{{$session->treatment_id}} ">

                                <input type="hidden" name="user_id" value="{{$session->patient_id}}">

                            </div>
                            <div class="text-left my-5">
                                <input type="submit" class="btn btn-success add px-5 py-1" style="position: absolute;text-align: left !important;bottom: 211px;left: 171px;" value="تعديل الجلسة">
                            </div>


                        </div>


                    </div>


                </div>

            </div>

        </div>
    </form>

</div>

@endsection
