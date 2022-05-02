@extends('layouts.app')

@section('content')
<h2>{{ __('edit_patient') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<form class="mt-4" method="post" action="{{ route('admin.patients.update', $patient->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')

    <x-errors />

    <div class="section-1">
        <div class="mb-3">
            <label class="text-muted mb-1">{{ __('patient_name') }}</label>
            <input required name="name" class="form-control" type="text" value="{{ $patient->name }}" />
        </div>
        <div class="mb-3">
            <label class="text-muted mb-1">{{ __('email') }}</label>
            <input required name="email" class="form-control" type="email" value="{{ $patient->email }}" />
        </div>
        <div class="mb-3">
            <label class="text-muted mb-1">{{ __('gender') }}</label>
            <select name="gender" class="form-control">
                <option {{ $patient->gender === 'male' ? 'selected' : '' }} value="male">{{ __('male') }}</option>
                <option {{ $patient->gender === 'female' ? 'selected' : '' }} value="female">{{ __('female') }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="text-muted mb-1">{{ __('phone_number') }}</label>
            <input required name="phone" class="form-control" type="text" value="{{ $patient->phone }}" />
        </div>
        <div class="mb-3">
            <label class="text-muted mb-1">{{ __('birthday') }}</label>
            <input required name="birthday" class="form-control" type="date" value={{$patient->birthday}} />
        </div>
        <div class="mb-3">
            <label class="text-muted mb-1">{{ __('password') }}</label>
            <input name="password" class="form-control" type="password" />
        </div>
    </div>
    <div class="mb-3">
        <label class="text-muted mb-1">{{ __('img_profile') }}</label>
        <div class="mb-4">
            <img src="{{ $patient->image }}" alt="patient" class="rounded-pill" width="200" />
        </div>
        <div class="add-file">
            <div class="add-file__title-box">
                <img src="{{ asset('img/adding icon.svg') }}"  alt="add icon" class="add-file-icon" />
                <input type="file" name="image" accept="image/*" onchange="showPreview(event);" />
            </div>
        </div>
    </div>
    <div class="my-4">
        <button type="submit" class="btn btn-primary rounded-pill px-4">
            {{ __('edit_patient') }} <i class="uil uil-edit"></i>
        </button>
    </div>
</form>
@endsection
