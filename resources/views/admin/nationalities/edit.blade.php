@extends('layouts.app')

@section('content')
<h2>{{ __('edit_nlty') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{ route('admin.nationalities.update', $nationality->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('nationality') }}</label>
        <input required name="nationality" class="form-control" type="text" value="{{ $nationality->nationality }}" />
    </div>

    <div class="mb-4">
        <label class="label text-muted mb-1">{{ __('country_flag') }}</label>
        <div class="text-center mb-3">
            <img src="{{ $nationality->flag }}" class="image-edit" />
        </div>
        <div class="add-file">
            <div class="add-file__title-box">
                <img src="{{ asset('img/adding icon.svg') }}" alt="add icon" class="add-file-icon" />
                <input type="file" name="flag" accept="image/*" onchange="showPreview(event);" />
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary rounded-pill">
        {{ __('edit_nlty') }} <i class="uil uil-check-circle"></i>
    </button>
</form>
@endsection