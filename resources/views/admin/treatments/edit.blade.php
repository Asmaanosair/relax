@extends('layouts.app')

@section('content')
<h2>{{ __('edit_trtmnt') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{ route('admin.treatments.update', $treatment->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('trtmnt') }}</label>
        <input required name="treatment" class="form-control col-md-6" type="text" value="{{ $treatment->treatment }}">
    </div>

    <div class="mb-4">
        <label class="label text-muted mb-1">{{ __('school') }}</label>
        <select name="school_id" class="form-control col-md-6">
            @foreach ($schools as $row)
                @if ($row->id == $treatment->school_id)
                <option value="{{ $row->id }}" selected> {{ $row->school }}</option>
                @else
                <option value="{{ $row->id }}"> {{ $row->school }}</option>
                @endif
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary rounded-pill">
        {{ __('save_changes') }} <i class="uil-edit ms-1"></i>
    </button>
</form>
@endsection
