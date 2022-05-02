@extends('layouts.app')

@section('content')
<h2>{{ __('edit_ap') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{ route('doctor.doctor_appointments.update', $doctor_appointment->id) }}"
    enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="mb-3">
        <label>{{ __('date') }}</label>
        <input required name="date" class="form-control col-md-6" type="date" value="{{ $doctor_appointment->date }}">
    </div>

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('day') }}</label>
        <select required name="day" class="form-control m-select chosen-select col-md-6"
            data-placeholder="{{ __('chos_hours') }}">
            @foreach ($days as $day)
            <option {{ $day == $doctor_appointment->day ? 'selected' : '' }} value="{{ $day }}">
                {{ $day }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="label text-muted mb-1">{{ __('hours') }}</label>
        <select required id="m-select" name="hours[]" multiple class="form-control m-select chosen-select col-md-6"
            data-placeholder="{{ __('chos_hours') }}">
            @foreach ($hours as $hour)
            <option
                @foreach ($doctor_appointment->hours as $doctor_appointment_hour)
                    @if ($hour->id==$doctor_appointment_hour->id)
                    selected
                    @endif
                @endforeach
                value="{{ $hour->id }}">
                {{ $hour->hour }}
                <span>{{ $hour->type == 'AM' ? 'ص' : 'م' }}</span>
            </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary rounded-pill">
        {{ __('save_changes') }} <i class="uil-edit ms-1"></i>
    </button>
</form>
@endsection
