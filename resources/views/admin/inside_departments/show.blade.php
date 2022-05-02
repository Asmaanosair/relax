@extends('layouts.app')

@section('content')


<div class="main-content show-profile" dir="rtl">
    <h2 class="text-center my-5">المعلومات الخاصة بالقسم</h2>
    <div class="row text-right">
        <div class="col-md-5">
            <img src="{{asset('/img/department.jpg')}}" alt="inside_department" class="image-edit">
        </div>
        <div class="col-md-4">
            <div>
                <label>اسم القسم</label>
                <div class="hr"></div>
                <p>{{$inside_department->name}}</p>
            </div>
            @if( $doctor_check_admin= $inside_department->getDoctorName($inside_department->admin_id) )
            <div>
                <label>  رئيس القسم</label>
                <div class="hr"></div>
                <a href="{{route('admin.show.the.doctor',$inside_department->admin_id)}}">
                <p>{{  $doctor_check_admin }}</p
                ></a>
            </div>
            @endif
        
            @if( $doctor_check_psychologist= $inside_department->getDoctorName($inside_department->psychologist_id) )
            <div>
                <label>الطبيب النفسى</label>
                <div class="hr"></div>
                <a href="{{route('admin.show.the.doctor',$inside_department->psychologist_id)}}">
                <p>{{  $doctor_check_psychologist}}</p>
                </a>
            </div>
            @endif

            @if( $doctor_check_psychologist_helper= $inside_department->getDoctorName($inside_department->psychologist_helper_id) )
            <div>
                <label>الأخصائى النفسى</label>
                <div class="hr"></div>
                <a href="{{route('admin.show.the.doctor',$inside_department->psychologist_helper_id)}}">
                <p>{{  $doctor_check_psychologist_helper}}</p>
                </a>
            </div>
            @endif
            @if( $doctor_check_sociologist= $inside_department->getDoctorName($inside_department->sociologist_id) )
            <div>
                <label>الأخصائى الأجتماعى</label>
                <div class="hr"></div>
                <a href="{{route('admin.show.the.doctor',$inside_department->sociologist_id)}}">
                <p>{{  $doctor_check_sociologist}}</p>
                </a>
            </div>
            @endif
            @if( $doctor_check_activity_executor= $inside_department->getDoctorName($inside_department->activity_executor_id) )
            <div>
                <label>منفذ النشاط</label>
                <div class="hr"></div>
                <a href="{{route('admin.show.the.doctor',$inside_department->activity_executor_id)}}">
                <p>{{ $doctor_check_activity_executor }}</p>
               </a>
            </div>
            @endif

        </div>


        <div class="col-md-3">
            <div>
                <label>نشاط ثابت</label>
                <div class="hr"></div>
                <p>
                    <ul>
                    {!!$inside_department->getPermanentActivities()!!}
                    </ul>
                </p>
            </div>
            <div>
                <label>نشاط متغير</label>
                <div class="hr"></div>
                <p>
                <ul>
                    {!!$inside_department->getVariableActivities()!!}
                    </ul>
                </p>
            </div>

            <div>
                <label>المرضى</label>
                <div class="hr"></div>
                <p>
                <ul>
                    @forelse($patients as $patient)
                    {{!$the_patient = App\User::find($patient->patient_id)}}
                              <a href="{{route('admin.patients.show' , $the_patient->id)}}">
                                <li value="{{$patient->id}}"> {{$the_patient->name}} </li>
                              </a>
                        @empty
                        <p>لا يوجد مرضى</p>
                    @endforelse
                </ul>
                </p>
            </div>
        </div>
    </div>



</div>

@endsection
