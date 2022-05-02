@extends('layouts.app')

@section('content')
<h2>{{ __('add_ap') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{ route('doctor.doctor_appointments.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('date') }}</label>
        <input required name="date" class="form-control col-md-6" type="date" />
    </div>

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('day') }}</label>
        <select required name="day" class="form-control m-select chosen-select col-md-6"
            data-placeholder="{{ __('chos_hours') }}">
            @foreach ($days as $day)
            <option value="{{ $day }}">{{ $day }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="label text-muted mb-1">{{ __('hours') }}</label>
        <select required id="m-select" name="hours[]" multiple class="form-control m-select chosen-select col-md-6"
            data-placeholder="{{ __('chos_hours') }}">
            @foreach ($hours as $hour)
                <option value="{{ $hour->id }}">
                    {{ $hour->hour }}
                    <span>
                        {{ $hour->type == 'AM' ? __('am') : __('pm') }}
                    </span>
                </option>

            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary rounded-pill">
        {{ __('add_ap') }} <i class="uil-edit ms-1"></i>
    </button>
</form>
@endsection
