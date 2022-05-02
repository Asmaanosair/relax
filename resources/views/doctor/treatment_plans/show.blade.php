@extends('layouts.app')

@section('content')


<div class="goals">

    @if(count($sessions)>0)
    <div class="row">
        <div class="col-md-1 side-bar">
            <!-- <ul class="list-group">
                    <li class="list-group-item active_dept">
                        <a href="">
                            قسم1
                        </a>
                    </li>
                </ul> -->
        </div>


        <div class="col-md-11 all-treatments">

            <div class="patient col-md-8">
                <div class="img-person-patient">
                    <img src="{{$patient->image}}" alt="">
                </div>

                <span class="name">
                    {{$patient->name}}
                </span>
                <span class="patient-plan">
                    خطة علاج المريض
                </span>
            </div>

            <div class="all-treatments-content h-auto">
                <table class="w-100 text-center">
                    <tr>
                        <td>
                            أيام الأسبوع
                        </td>
                        @foreach($sessions as $session)
                        <td>من
                            <span>{{$session->from}}</span>
                            <span>الى</span>
                            <span>{{$session->to}}</span>

                        </td>
                        @endforeach

                    </tr>

                    @foreach($days as $day)

                    <tr>
                        <td>{{$day}}</td>
                        @foreach($sessions as $session)
                        <td>
                            @if($session->day ==$day )
                            <span class="badge badge-success">
                                {{$session->num}}
                            </span>
                            <a type="button" class="dropdown-item" data-toggle="modal" data-target="#Modal{{$session->id}}">
                                <p>
                                    {{$session->treatment}}
                                </p>
                            </a>
                            <div>
                                <span class="name" style=" border-radius: 35px;padding: 0px 22px 0px 28px;">
                                    {{$session->name}}
                                    <span style="display: block; color:green ; position:relative;top: -3px;">
                                        {{$session->type != '0'  ? 'فردية' :' جماعيه' }}
                                    </span>
                                </span>

                            </div>
                            @endif

                            <!-- Modal -->
                            <div class="modal fade" id="Modal{{$session->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{route('doctor.treatment_plans.update',$session->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">  أهداف الجلسة وحالتها</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div style="height:200px;  overflow-y:auto">
                                                    <div>أهداف الجلسة </div>
                                                    {!!$session->description!!}
                                                </div>
                                                @if($session->doctor_id ==  Auth::user()->id)
                                                <div class="mt-3 text-center">
                                                    <hr>
                                                    <div> حالة الجلسة التى ستظهر للمريض</div>
                                                    <div class="d-flex justify-content-center">
                                                    <select name="status" class="form-control col-md-6">
                                                        @foreach($all_status as $status)
                                                        <option {{$loop->index == $session->status ? 'selected' : ''}} value="{{$loop->index}}">
                                                            {{$status}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </div>

                                                </div>

                                            </div>
                                          
                                            <div class="modal-footer d-flex justify-content-around">
                                                <input type="submit" class="btn btn-warning "  value="تغيير الحالة">
                                                <a class="btn btn-success"  href="{{route('doctor.session.edit',$session->id)}}">تعديل الجلسة</a>
                                                <a class="btn btn-danger"  href="{{route('doctor.session.delete',$session->id)}}" >حذف الجلسة</a>
                                            </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                        @endforeach

                    </tr>

                    @endforeach

                </table>

            </div>

        </div>


    </div>

    @else
    <div class="alert alert-danger  text-center d-flex justify-content-center" style="margin:100px">
        <p class=""> لا يوجد جلسات محددة حتى الان</p>

    </div>
    @endif
</div>




@endsection
