@extends('layouts.app')

@section('content')
<h2>{{ __('patients') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<div class="row mt-4">
    <div class="col-md-8 mb-4">
        <div class="d-flex">
            <i class="uil uil-user-md display-2 me-3"></i>
            <div>
                <h4 class="mb-1">{{ __('total_patnts') }}</h4>
                <p class="mb-0">The total patients for section</p>
                <span class="fs-3">{{ $patients_id->count() }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-4 d-flex justify-content-end pt-3">
        <ul class="list-group w-100">
            <li class="list-group-item active_dept">
                <a>{{ $inside_department->name }}</a>
            </li>
        </ul>
    </div>
</div>

<div class="section-search">
    <div class="has-search">
        <span class="fa fa-search form-control-feedback"></span>
        <input type="text" class="form-control search rounded-pill w-100" placeholder="{{ __('search_patnt') }}">
    </div>
</div>

<div class="table-responsive mt-4">
    <table class="table">
        <tbody>
            @forelse ($patients_id as $patient_id)
            @php
                $patient = App\User::where('id', $patient_id->patient_id)->first();
            @endphp
            <tr class="result border-bottom">
                <td class="d-flex align-items-center">
                    <img class="rounded-pill" src="{{ $patient->image }}" width="45" />
                    <div class="ms-3">
                        <h6 class="mb-1">{{ __('name') }}</h6>
                        <a class="name" href="{{ route('doctor.doctor_patients.show', $patient->id) }}">{{ $patient->name }}</a>
                    </div>
                </td>
                <td>
                    <h6 class="mb-1">{{ __('trtmnt_plan') }}</h6>
                    <span class="number">
                        {{ App\Session::where('user_id', $patient_id->patient_id)->get()->count() }}
                    </span>
                </td>
                <td>
                    <h6 class="mb-1">{{ __('actions') }}</h6>
                    <a href="{{ route('doctor.treatment_goals.show', $patient->id) }}" class="btn btn-primary btn-sm rounded-pill px-3">
                        {{ __('v_plan') }} <i class="uil-eye"></i>
                    </a>
                </td>
            </tr>
            @empty
            <p>{{ __('no_patnts_now') }}</p>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
