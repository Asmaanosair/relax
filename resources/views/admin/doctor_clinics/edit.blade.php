@extends('layouts.app')

@section('content')
<h2>{{ __('edit_d') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{ route('admin.doctor_clinics.update', $doctor->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('doc_name') }}</label>
        <input name="name" class="form-control" type="text" value="{{ $doctor->name }}">
    </div>

    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label class="label text-muted mb-1">{{ __('email') }}</label>
                <input name="email" class="form-control" type="email" value="{{ $doctor->email }}">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label class="label text-muted mb-1">{{ __('gender') }}</label>
                <select name="gender" class="form-control">
                    <option {{ $doctor->gender == 'male' ? 'selected' : '' }} value="male">{{ __('male') }}</option>
                    <option {{ $doctor->gender == 'female' ? 'selected' : '' }} value="female">{{ __('female') }}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('job_title') }}</label>
        <input required name="job_title" class="form-control" type="text" value="{{ $doctor->doctorClinic->job_title }}">
    </div>

    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label class="label text-muted mb-1">{{ __('clinics') }}</label>
                <select name="clinic_id" class="form-control">
                    @foreach($clinics as $clinic)
                    <option {{ $doctor->doctorClinic->clinic_id == $clinic->id ? 'selected' : '' }} value="{{ $clinic->id }}">
                        {{ $clinic->clinic }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label class="label text-muted mb-1">{{ __('nationality') }}</label>
                <select name="nationality_id" class="form-control">
                    @foreach($nationalities as $nationality)
                    <option {{ $doctor->doctorClinic->nationality_id == $nationality->id ? 'selected' : '' }} value="{{ $nationality->id }}">
                        {{ $nationality->nationality }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('phone_number') }}</label>
        <input name="phone" class="form-control" type="text" value="{{ $doctor->phone }}">
    </div>

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('birthday') }}</label>
        <p>{{ $doctor->birthday }}</p>
        <input value={{ $doctor->birthday }} name="birthday" class="form-control" type="date" />
    </div>

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('doc_details') }}</label>
        <textarea name="details" class="form-control" rows="5">{{ $doctor->doctorClinic->details }}</textarea>
    </div>

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('price') }}</label>
        <input required name="price" class="form-control" type="text" value="{{ $doctor->doctorClinic->price }}" />
    </div>

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('password') }}</label>
        <input name="password" class="form-control" type="password" />
    </div>

    <div class="mb-4">
        <label class="label text-muted mb-1">{{ __('img_profile') }}</label>
        <div class="mb-3">
            <img src="{{ $doctor->image }}" alt="doctor" class="image-edit">
        </div>
        <div class="add-file">
            <div class="add-file__title-box">
                <img src="{{ asset('img/adding icon.svg') }}" alt="add icon" class="add-file-icon" />
                <input type="file" name="image" accept="image/*" onchange="showPreview(event);" />
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary rounded-pill">
        {{ __('save_changes') }} <i class="uil-edit"></i>
    </button>
</form>
@endsection
