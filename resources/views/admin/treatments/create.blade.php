@extends('layouts.app')

@section('content')
<h2>{{ __('add_nt') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{ route('admin.treatments.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        {{-- <label>اسم الجلسه </label> --}}
        <label class="label text-muted mb-1">{{ __('trtmnt') }}</label>
        <input required name="treatment" class="form-control" type="text" />
    </div>

    <div class="mb-4">
        <label class="label text-muted mb-1">{{ __('school') }}</label>
        <select name="school_id" class="form-control">
            @foreach ($schools as $row)
            <option value="{{ $row->id }}"> {{ $row->school }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary rounded-pill">
        {{ __('add_nt') }} <i class="uil-check-circle ms-1"></i>
    </button>
</form>
@endsection
