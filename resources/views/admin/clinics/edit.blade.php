@extends('layouts.app')

@section('content')
<h2>{{ __('edit_c') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{ route('admin.clinics.update', $clinic->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('clinic_name') }}</label>
        <input required name="clinic" class="form-control" type="text" value="{{ $clinic->clinic }}" />
    </div>

    <div class="mb-4">
        <label class="label text-muted mb-1">{{ __('clinic_image') }}</label>
        <div class="mb-3">
            <img src="{{ asset($clinic->image) }}" alt="clinic" class="image-edit" />
        </div>
        <div class="add-file">
            <div class="add-file__title-box">
                <i class="uil uil-plus fs-2" style="color: #c7ccd6"></i>
                <input type="file" name="image" accept="image/*" onchange="showPreview(event);" />
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary rounded-pill">
        {{ __('save_changes') }} <i class="uil-edit ms-1"></i>
    </button>
</form>
@endsection
