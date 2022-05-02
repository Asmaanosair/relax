@extends('layouts.app')

@section('content')
<h2>{{ __('add_np') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<form class="mt-4" method="post" action="{{ route('admin.patients.store') }}" enctype="multipart/form-data">
    @csrf

    <x-errors />

    <div class="section-1">
        <div class="mb-3">
            <label class="text-muted mb-1">{{ __('patient_name') }}</label>
            <input required name="name" class="form-control" type="text">
        </div>
        <div class="mb-3">
            <label class="text-muted mb-1">{{ __('email') }}</label>
            <input required name="email" class="form-control" type="email">
        </div>
        <div class="mb-3">
            <label class="text-muted mb-1">{{ __('gender') }}</label>
            <select name="gender" class="form-control">
                <option value="male">{{ __('male') }}</option>
                <option value="female">{{ __('female') }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="text-muted mb-1">{{ __('phone_number') }}</label>
            <input required name="phone" class="form-control" type="text" />
        </div>
        <div class="mb-3">
            <label class="text-muted mb-1">{{ __('birthday') }}</label>
            <input required name="birthday" class="form-control" type="date" />
        </div>
        <div class="mb-3">
            <label class="text-muted mb-1">{{ __('password') }}</label>
            <input required name="password" class="form-control" type="password" />
        </div>
    </div>
    <div class="mb-3">
        <label class="text-muted mb-1">{{ __('img_profile') }}</label>
        <div class="add-file">
            <div class="add-file__title-box">
                <img src="{{ asset('img/adding icon.svg') }}"  alt="add icon" class="add-file-icon" />
                <input type="file" name="image" accept="image/*" onchange="showPreview(event);" />
            </div>
        </div>
    </div>
    <div class="my-4">
        <button type="submit" class="btn btn-primary rounded-pill px-4">
            {{ __('add_patient') }} <i class="uil uil-plus"></i>
        </button>
    </div>
</form>
@endsection
