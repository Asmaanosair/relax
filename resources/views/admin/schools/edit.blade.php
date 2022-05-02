@extends('layouts.app')

@section('content')
<h2>{{ __('edit_s') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<form class="mt-4" method="post" action="{{ route('admin.schools.update', $school->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('schol_name') }}</label>
        <input required name="school" class="form-control" type="text" value="{{ $school->school }}" />
    </div>

    <div class="mb-4">
        <label class="label text-muted mb-1">{{ __('add_schol_img') }}</label>
        <div class="mb-3 col-md-5">
            <img src="{{ $school->image }}" alt="patient" class="image-edit img-fluid" />
        </div>
        <div class="add-file ">
            <div class="add-file__title-box">
                <img src="{{ asset('img/adding icon.svg') }}" alt="add icon" class="add-file-icon" />
                <input type="file" name="image" accept="image/*" onchange="showPreview(event);" />
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary rounded-pill">
        {{ __('save_changes') }} <i class="uil-edit ms-1"></i>
    </button>
</form>
@endsection