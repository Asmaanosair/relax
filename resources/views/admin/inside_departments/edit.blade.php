@extends('layouts.app')

@section('content')
<h2>{{ __('edit_sec') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" action="{{ route('admin.inside_departments.update', $inside_department->id) }}" method="post">
    @csrf
    @method('put')

    <div>
        <div class="mb-3">
            <label class="label text-muted mb-1">{{ __('section_name') }}</label>
            <input required class="form-control col-md-6" type="text" name="name" value="{{ $inside_department->name }}" />
        </div>

        <div class="mb-3">
            <label class="label text-muted mb-1">{{ __('section_manager') }}</label>
            <select required name="admin_id" class="form-control col-md-6">
                @foreach($doctors as $doctor)
                <option {{ $inside_department->admin_id == $doctor->id ? 'selected' : '' }} value="{{ $doctor->id }}">
                    {{ $doctor->user->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- <div class="form-group">
        <div>
            <label>إسم القسم</label>
        </div>
        <input required class="form-control col-md-6" type="text" placeholder="اسم القسم..." name="name"
            value="{{ $inside_department->name }}">
    </div>
    <div class="form-group">
        <div>
            <label>رئيس القسم</label>
        </div>
        <select required name="admin_id" class="form-control col-md-6">
            @forelse($doctors as $doctor)
                <option {{ $inside_department->admin_id == $doctor->id ? 'selected' : '' }}
                    value="{{ $doctor->id }}"> {{ $doctor->user->name }} </option>
            @empty
            @endforelse
        </select>
    </div> --}}
    

    {{-- <div class="section-2">
    <h3 class="text-center mt-5">
        خطة العمل
    </h3>

    <div class="row">

        <div class="col-md-6 mt-4">
            <div>
                <label>أنشطة ثابتة</label>
            </div>
            <select required name="permanent_activity_id[]" multiple class="form-control m-select col-md-6">
                @foreach($permanent_activities as $permanent_activity)
                <option @foreach ($selected_permanent_activities as $selected_permanent_activity)
                    @if ($permanent_activity->id==$selected_permanent_activity)selected @endif
                    @endforeach
                    value="{{ $permanent_activity->id }}">{{ $permanent_activity->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mt-4">
            <a href="{{ route('admin.activities.create') }}" class="btn btn-success add">
                <span class="plus"> +</span>
                <span class="text">اضف نشاط </span>
            </a>
        </div>

        <div class="col-md-6 mt-4">
            <div>
                <label>أنشطة متغيرة</label>
            </div>
            <select required name="variable_activity_id[]" multiple class="form-control m-select col-md-6">
                @foreach($variable_activities as $variable_activity)
                    <option @foreach ($selected_variable_activities as $selected_variable_activity)
                    @if ($variable_activity->id==$selected_variable_activity)selected @endif
                @endforeach
                value="{{ $variable_activity->id }}">{{ $variable_activity->name }} </option>
                @endforeach
            </select>
            </div>
            <div class="col-md-6 mt-4">
                <a href="{{ route('admin.activities.create') }}" class="btn btn-success add">
                    <span class="plus"> +</span>
                    <span class="text">اضف نشاط </span>
                </a>
            </div>
            </div>
        </div> --}}

    <div class="work-plan mt-4">
        <h3>{{ __('work_plan') }}</h3>

        <div class="row mt-4">
            <div class="col-md-5">
                <label class="label text-muted mb-1">{{ __('fixed_actvts') }}</label>
            </div>
            <div class="col-md-5">
                <label class="label text-muted mb-1">{{ __('adjstbl_actvts') }}</label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <select required name="permanent_activity_id[]" multiple class="form-control m-select">
                    @foreach($permanent_activities as $permanent_activity)
                    <option @foreach ($selected_permanent_activities as $selected_permanent_activity)
                        @if ($permanent_activity->id==$selected_permanent_activity)selected @endif
                        @endforeach
                        value="{{ $permanent_activity->id }}">{{ $permanent_activity->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <select required name="variable_activity_id[]" multiple class="form-control m-select">
                    @foreach($variable_activities as $variable_activity)
                    <option
                        @foreach ($selected_variable_activities as $selected_variable_activity)
                            @if ($variable_activity->id==$selected_variable_activity)selected @endif
                        @endforeach
                        value="{{ $variable_activity->id }}">{{ $variable_activity->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <a href="{{ route('admin.activities.create') }}" class="btn btn-primary text-nowrap w-100">
                    {{ __('add_actvts') }} <i class="uil uil-plus ms-1"></i>
                </a>
            </div>
        </div>
    </div>


    <div class="mt-4">
        <label class="label text-muted mb-1">{{ __('add_ptnts') }}</label>

        <div class="row">
            <div class="col-md-10">
                <select required name="patients[]" multiple class="form-control m-select col-md-6 my-3"
                    data-placeholder="{{ __('chos_ptnts') }}">
                    @foreach($patients as $patient)
                        @if (isset($patient->patient) and $patient->patient->status == 'check')
                        <option @foreach ($selected_patients as $selected_patient)  @if ($patient->id==$selected_patient->patient_id)selected @endif @endforeach value="{{ $patient->id }}">
                            {{ $patient->name }} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.patients.create') }}" class="btn btn-primary w-100">
                    {{ __('add_patient') }} <i class="uil uil-plus ms-1"></i>
                </a>
            </div>
        </div>
    </div>



    {{-- <div class="section-3 my-4">
        <div>
            <label>إضافة المرضى</label>
        </div>
        <div class="border-dashed">
            <select required name="patients[]" multiple class="form-control m-select col-md-6 my-3"
                data-placeholder="اختر المرضى...">
                @foreach($patients as $patient)
                    @if (isset($patient->patient) and $patient->patient->status == 'check')
                    <option @foreach ($selected_patients as $selected_patient)  @if ($patient->id==$selected_patient->patient_id)selected @endif @endforeach value="{{ $patient->id }}">
                        {{ $patient->name }} </option>
                    @endif
                @endforeach
                </select>
                <a href="{{ route('admin.patients.create') }}" class="btn btn-success add py-2 m-0">
                    <span class="plus"> +</span>
                    <span class="text">اضافة مريض </span>
                </a>
            </div>
        </div> --}}


    {{-- <div class="section-4">
        <h3 class="text-center mt-5">
            الفريق العلاجى
        </h3>

        <div class="row">

            <div class="col-md-6 mt-4">
                <div>
                    <label>الطبيب النفسى</label>
                </div>
                <select required name="psychologist_id" class="form-control">
                    @foreach($psychologists as $psychologist)
                        <option {{ $inside_department->psychologist_id == $psychologist->id ? 'selected' : '' }} value="{{ $psychologist->id }}">
                            {{ $psychologist->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mt-4">
                <a href="{{ route('admin.doctors.create') }}" class="btn btn-success add add1">
                    <span class="plus"> +</span>
                    <span class="text">اضف طبيب </span>
                </a>
            </div>

            <div class="col-md-6 mt-4">
                <div>
                    <label>الأخصائى النفسى</label>
                </div>
                <select required name="psychologist_helper_id" class="form-control">
                    @foreach($psychologist_helpers as $psychologist_helper)
                    <option {{ $inside_department->psychologist_helper_id == $psychologist_helper->id ? 'selected' : '' }} value="{{ $psychologist_helper->id }}">
                        {{ $psychologist_helper->user->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mt-4">
                <a href="{{ route('admin.doctors.create') }}" class="btn btn-success add add1">
                    <span class="plus"> +</span>
                    <span class="text">اضف أخصائى </span>
                </a>
            </div>

            <div class="col-md-6 mt-4">
                <div>
                    <label>الأخصائى الاجتماعى</label>
                </div>
                <select required name="sociologist_id" class="form-control">
                    @forelse($sociologists as $sociologist)
                        <option {{ $inside_department->sociologists == $sociologist->id ? 'selected' : '' }}
                            value="{{ $sociologist->id }}"> {{ $sociologist->user->name }} </option>
                    @empty
                    @endforelse
                </select>
            </div>

            <div class="col-md-6 mt-4">
                <a href="{{ route('admin.doctors.create') }}" class="btn btn-success add add1">
                    <span class="plus"> +</span>
                    <span class="text">اضف أخصائى </span>
                </a>
            </div>

            <div class="col-md-6 mt-4">
                <div>
                    <label>منفذ النشاط</label>
                </div>
                <select required name="activity_executor_id" class="form-control">
                    @forelse($executors as $executor)
                        <option {{ $inside_department->activity_executor_id == $executor->id ? 'selected' : '' }}
                            value="{{ $executor->id }}"> {{ $executor->user->name }} </option>
                    @empty
                    @endforelse
                </select>
            </div>

            <div class="col-md-6 mt-4">
                <a href="{{ route('admin.doctors.create') }}" class="btn btn-success add add1">
                    <span class="plus"> +</span>
                    <span class="text">اضف منفذ </span>
                </a>
            </div>
        </div>
    </div> --}}

    <div class="mt-4">
        <h3>{{ __('trtmnt_team') }}</h3>

        <div class="mt-4">
            <span class="label text-muted mb-1">{{ __('psychologist') }}</span>
            <div class="row">
                <div class="col-9">
                    <select required name="psychologist_id" class="form-control">
                        @foreach($psychologists as $psychologist)
                        <option {{ $inside_department->psychologist_id == $psychologist->id ? 'selected' : '' }} value="{{ $psychologist->id }}">
                            {{ $psychologist->user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary w-100">
                        {{ __('add_doc') }} <i class="uil uil-plus ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <span class="label text-muted mb-1">الأخصائى النفسى</span>
            <div class="row">
                <div class="col-9">
                    <select required name="psychologist_helper_id" class="form-control">
                        @foreach($psychologist_helpers as $psychologist_helper)
                        <option {{ $inside_department->psychologist_helper_id == $psychologist_helper->id ? 'selected' : '' }} value="{{ $psychologist_helper->id }}">
                            {{ $psychologist_helper->user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary w-100">
                        {{ __('add_specialist') }} <i class="uil-plus"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-4"></div>
        <span class="label text-muted mb-1">{{ __('sociologist') }}</span>
        <div class="row">
            <div class="col-9">
                <select required name="sociologist_id" class="form-control">
                    @foreach($sociologists as $sociologist)
                    <option {{ $inside_department->sociologists == $sociologist->id ? 'selected' : '' }} value="{{ $sociologist->id }}">
                        {{ $sociologist->user->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-3">
                <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary w-100">
                    {{ __('add_specialist') }} <i class="uil-plus"></i>
                </a>
            </div>
        </div>

        <div class="mt-4"></div>
        <span class="label text-muted mb-1">{{ __('actvty_exec') }}</span>
        <div class="row">
            <div class="col-9">
                <select required name="activity_executor_id" class="form-control">
                    @foreach($executors as $executor)
                    <option {{ $inside_department->activity_executor_id == $executor->id ? 'selected' : '' }} value="{{ $executor->id }}">
                        {{ $executor->user->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-3">
                <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary w-100">
                    {{ __('add_exec') }} <i class="uil-plus"></i>
                </a>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary rounded-pill mt-4">
        {{ __('finish') }} <i class="uil-edit ms-1"></i>
    </button>
</form>
@endsection
