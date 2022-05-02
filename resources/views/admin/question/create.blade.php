@extends('layouts.app')

@section('content')
<h2>{{ __('add_nq') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{ route('admin.question.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('question') }}</label>
        <input name="question" class="form-control col-md-6" type="text" />
    </div>

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('answer') }}</label>
        <input name="answer" class="form-control col-md-6" type="text" />
    </div>

    <div class="mb-4">
        <label class="label text-muted mb-1">{{ __('clinic') }}</label>
        <select name="clinic_id" class="form-control col-md-6">
            <option disabled selected>{{ __('chos_clinic') }}</option>
            @foreach ($clinics as $row)
            <option value="{{ $row->id }}"> {{ $row->clinic }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary rounded-pill">
        {{ __('save_changes') }} <i class="uil uil-check-circle"></i>
    </button>
</form>
@endsection
