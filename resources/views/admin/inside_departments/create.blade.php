@extends('layouts.app')

@section('content')
<h2>{{ __('add_nes') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" action="{{ route('admin.inside_departments.store') }}" method="post">
    @csrf
    <div>
        <div class="mb-3">
            <label class="label text-muted mb-1">{{ __('section_name') }}</label>
            <input required class="form-control col-md-6" type="text" name="name">
        </div>

        <div class="mb-3">
            <label class="label text-muted mb-1">{{ __('section_manager') }}</label>
            <select required name="admin_id" class="form-control col-md-6">
                @foreach($doctors as $doctor)
                <option {{ $doctor->is_inside ? 'disabled' : '' }} value="{{ $doctor->id }}">
                    {{ $doctor->user->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

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
                <select required name="permanent_activity_id[]" multiple class="form-control m-select" data-placeholder="{{ __('chos_fixd_actvts') }}">
                    @foreach($permanent_activities as $permanent_activity)
                    <option value="{{ $permanent_activity->id }}">{{ $permanent_activity->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <select required name="variable_activity_id[]" multiple class="form-control m-select"
                    data-placeholder="{{ __('chos_adjstbl_actvts') }}">
                    @forelse($variable_activities as $variable_activity)
                        <option value="{{ $variable_activity->id }}">{{ $variable_activity->name }} </option>
                    @empty
                    @endforelse
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
                        <option {{ $patient->insideDepartmentPatients ? 'disabled' : '' }} value="{{ $patient->id }}">
                            {{ $patient->name }}
                        </option>
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

    <div class="mt-4">
        <h3>{{ __('trtmnt_team') }}</h3>

        <div class="mt-4">
            <span class="label text-muted mb-1">{{ __('psychologist') }}</span>
            <div class="row">
                <div class="col-9">
                    <select required name="psychologist_id" class="form-control">
                        @foreach($psychologists as $psychologist)
                        <option {{ $psychologist->is_inside ? 'disabled' : '' }}
                            value="{{ $psychologist->id }}">
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
                        <option {{ $psychologist_helper->is_inside ? 'disabled' : '' }}
                            value="{{ $psychologist_helper->id }}">
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
                    <option {{ $sociologist->is_inside ? 'disabled' : '' }}
                        value="{{ $sociologist->id }}">
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
                    @forelse($executors as $executor)
                    <option {{ $executor->is_inside ? '' : 'disabled' }}
                        value="{{ $executor->id }}">
                        {{ $executor->user->name }}
                    </option>
                    @empty
                    @endforelse
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
