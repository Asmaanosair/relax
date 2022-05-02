@extends('layouts.app')

@section('content')
<h2>{{ __('edit_q') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{ route('admin.question.update', $question->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('question') }}</label>
        <input name="question" class="form-control col-md-6" type="text" value="{{ $question->question }}" />
    </div>

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('answer') }}</label>
        <input name="answer" class="form-control col-md-6" type="text" value="{{ $question->answer }}" />
    </div>

    <div class="mb-4">
        <label class="label text-muted mb-1">{{ __('clinic') }}</label>
        <select name="clinic_id" class="form-control col-md-6">
            <option disabled selected>{{ __('chos_clinic') }}</option>
            @foreach($clinics as $row)
                @if($row->id == $question->clinic_id)
                <option value="{{ $row->id }}" selected>{{ $row->clinic }}</option>
                @else
                    <option value="{{ $row->id }}"> {{ $row->clinic }}</option>
                @endif
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary rounded-pill">
        {{ __('save_changes') }} <i class="uil uil-check-circle"></i>
    </button>
</form>
@endsection
