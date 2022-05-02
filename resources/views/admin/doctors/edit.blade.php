@extends('layouts.app')

@section('content')
<h2>{{ __('edit_d') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{ route('admin.doctors.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('doc_name') }}</label>
        <input required name="name"  class="form-control" type="text" value="{{ old('name') ?? $doctor->name }}" />
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('email') }}</label>
        <input required name="email" class="form-control" type="email" value="{{ old('email') ?? $doctor->email }}" />
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('validity') }}</label>
        <select name="role_id" class="form-control">
            @foreach($roles as $role)
            <option {{ $doctor->doctor->role_id == $role->id ? 'selected' : '' }}  value="{{ $role->id }}">{{ $role->role }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('naionality') }}</label>
        <select name="nationality_id" class="form-control">
            @foreach($nationalities as $nationality)
            <option {{ $doctor->doctor->nationality_id == $nationality->id ? 'selected' : ''}} value="{{ $nationality->id }}">
                {{ $nationality->nationality }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('type') }}</label>
        <select name="gender" class="form-control">
            <option {{ $doctor->gender === 'male' ? 'selected' : '' }} value="male">{{ __('male') }}</option>
            <option {{ $doctor->gender === 'female' ? 'selected' : '' }} value="female">{{ __('female') }}</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('phone_number') }}</label>
        <input required name="phone" class="form-control" type="text" value="{{ old('phone') ?? $doctor->phone }}">
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('birthday') }}</label>
        <p>{{ $doctor->birthday }}</p>
        <input required name="birthday" class="form-control" type="date" value="{{ old('birthday') ?? $doctor->birthday }}">
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('doc_details') }}</label>
        <textarea name="details" class="form-control" rows="5">{{ old('details') ?? $doctor->doctor->details }}</textarea>
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('price') }}</label>
        <input required name="price" class="form-control"  type="text" value="{{ old('price') ?? $doctor->doctor->price }}" />
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('password') }}</label>
        <input required name="password" class="form-control" type="password" value="{{ old('password') }}" />
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('img_profile') }}</label>
        <div class="add-file">
            <div class="add-file__title-box">
                <img src="{{ asset('img/adding icon.svg') }}" alt="add icon" width="100" height="100" class="add-file-icon" />
                <input type="file" name="image" accept="image/*" onchange="showPreview(event);" />
            </div>
        </div>
    </div>

    <button class="btn btn-primary rounded-pill px-4" type="submit">
        {{ __('add_nd') }} <i class="uil uil-plus"></i>
    </button>
</form>
@endsection
