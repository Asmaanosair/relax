@extends('layouts.app')

@section('content')
<h2>{{ __('add_nd') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{ route('admin.doctors.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('doc_name') }}</label>
        <input required name="name"  class="form-control" type="text" value="{{ old('name') }}" />
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('email') }}</label>
        <input required name="email" class="form-control" type="email" value="{{ old('email') }}" />
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('validity') }}</label>
        <select name="role_id" class="form-control">
            @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->role }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('naionality') }}</label>
        <select name="nationality_id" class="form-control">
            @forelse($nationalities as $nationality)
            <option value="{{ $nationality->id }}">{{ $nationality->nationality }}</option>
            @empty
            @endforelse
        </select>
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('type') }}</label>
        <select name="gender" class="form-control">
            <option value="male">{{ __('male') }}</option>
            <option value="female">{{ __('female') }}</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('phone_number') }}</label>
        <input required name="phone" class="form-control" type="text" value="{{ old('phone') }}">
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('birthday') }}</label>
        <input required name="birthday" class="form-control" type="date" value="{{ old('birthday') }}">
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('doc_details') }}</label>
        <textarea name="details" class="form-control" rows="5">{{ old('details') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('price') }}</label>
        <input required name="price" class="form-control"  type="text" value="{{ old('price') }}" />
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('password') }}</label>
        <input required name="password" class="form-control" type="password" value="{{ old('password') }}" />
    </div>

    <div class="mb-3">
        <label class="text-gray mb-1">{{ __('img_profile') }}</label>
        <div class="add-file">
            <div class="add-file__title-box">
                <img src="{{ asset('img/adding icon.svg') }}" alt="add icon" class="add-file-icon" />
                <input type="file" name="image" accept="image/*" onchange="showPreview(event);" />
            </div>
        </div>
    </div>
    <button class="btn btn-primary rounded-pill px-4" type="submit">
        {{ __('add_nd') }} <i class="uil uil-plus"></i>
    </button>
</form>
@endsection
