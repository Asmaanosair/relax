@extends('layouts.app')

@section('content')
<h2>{{ __('sess_info') }}</h2>
{{-- <h2> تعديل موعد {{ $patient_id->user->name }}</h2> --}}
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

@if ($appointment != null)
<div class="row mt-4">
    <div class="col-12 d-flex align-items-center">
        <img src="{{ $appointment->user->image }}" class="rounded-pill" width="75" height="75" />
        <div class="ms-4">
            <button class="button btn btn-primary rounded-pill" disabled>
                {{ __('change_pic') }} <i class="uil-edit"></i>
            </button>
            <a href="{{ route('admin.assessments.edit', $appointment->user_id) }}" class="button btn btn-light rounded-pill ms-2" >
                {{ __('edit_ti') }} <i class="uil-edit"></i>
            </a>
        </div>
    </div>
    <div class="col-12 mt-5">
        <h3 class="text-muted border-bottom pb-3 mb-3">{{ __('info') }}</h3>
        <div class="row">
            <div class="col-lg-7">
                <div class="row mb-3">
                    <h6 class="col-sm-8 mb-0">{{ __('patient_name') }}:</h6>
                    <div class="col-sm-4">{{ $appointment->user->name }}</div>
                </div>
                <div class="row mb-3">
                    <h6 class="col-sm-8 mb-0">{{ __('t_d_r_f_t_i') }}:</h6>
                    <div class="col-sm-4">{{ $appointment->doctor->name }}</div>
                </div>
                <div class="row mb-3">
                    <h6 class="col-sm-8 mb-0">{{ __('intview_date') }}:</h6>
                    <div class="col-sm-4">{{ $appointment->doctor_appointment->date }}</div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="row mb-3">
                    <h6 class="col-sm-5 mb-0">{{ __('day') }}:</h6>
                    <div class="col-sm-7">{{ $appointment->doctor_appointment->day }}</div>
                </div>
                <div class="row mb-3">
                    <h6 class="col-sm-5 mb-0">{{ __('hour') }}:</h6>
                    <div class="col-sm-7">
                        {{ $appointment->hour->hour }}
                        {{ $appointment->hour->type == 'AM' ? __('am') : __('pm') }}
                    </div>
                </div>
            </div>
        </div>

        <a class="btn btn-primary btn-block rounded-pill mt-4" href="{{ route('admin.assessments.edit', $appointment->user_id) }}">
            {{ __('back_to_assess_list') }}
        </a>
    </div>
</div>
@else
<div class="alert alert-danger  text-center d-flex justify-content-center ">
    <p class="">{{ __('no_intv_now') }}</p>
</div>
@endif
@endsection
