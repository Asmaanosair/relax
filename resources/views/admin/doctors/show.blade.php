@extends('layouts.app')

@section('content')
<h2>{{ __('doc_details') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<div class="row mt-4">
    <div class="col-12 d-flex align-items-center">
        <img src="{{ $doctor->user->image }}" class="rounded-pill" width="75" height="75" />
        <div class="ms-4">
            <button class="button btn btn-primary rounded-pill">
                {{ __('change_pic') }} <i class="uil-edit"></i>
            </button>
            <a href="{{ route('admin.doctors.edit', $doctor->user->id) }}" class="button btn btn-light rounded-pill ms-2">
                {{ __('edit_ti') }} <i class="uil-edit"></i>
            </a>
        </div>
    </div>
    <div class="col-12 mt-5">
        <h5 class="text-muted mb-1">{{ __('pers_details') }}</h5>
        <p class="pb-3 border-bottom">{{ __('pers_details_desc') }}</p>
        <div class="row">
            <div class="col-lg-6">
                <div class="row mb-3">
                    <h5 class="col-sm-5 mb-0">{{ __('name') }}:</h5>
                    <div class="col-sm-7">
                        {{ $doctor->user->name }}
                    </div>
                </div>
                <div class="row mb-3">
                    <h5 class="col-sm-5 mb-0">{{ __('email') }}:</h5>
                    <div class="col-sm-7">
                        {{ $doctor->user->email }}
                    </div>
                </div>
                <div class="row mb-3">
                    <h5 class="col-sm-5 mb-0">{{ __('birthday') }}:</h5>
                    <div class="col-sm-7">
                        {{ $doctor->user->birthday }}
                    </div>
                </div>
                <div class="row mb-3">
                    <h5 class="col-sm-5 mb-0">{{ __('salary') }}:</h5>
                    <div class="col-sm-7">
                        {{ $doctor->price }}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row mb-3">
                    <h5 class="col-sm-5 mb-0">{{ __('gender') }}:</h5>
                    <div class="col-sm-7">
                        {{ $doctor->user->gender }}
                    </div>
                </div>
                <div class="row mb-3">
                    <h5 class="col-sm-5 mb-0">{{ __('phone_number') }}:</h5>
                    <div class="col-sm-7">
                        {{ $doctor->user->phone }}
                    </div>
                </div>
                <div class="row mb-3">
                    <h5 class="col-sm-5 mb-0">{{ __('role') }}:</h5>
                    <div class="col-sm-7">
                        {{ $doctor->role->role }}
                    </div>
                </div>
            </div>
        </div>

        <h5 class="text-muted mb-1 border-top pt-3">{{ __('doc_details') }}:</h5>

        <div class="">
            {{ $doctor->details }}
        </div>
    </div>
</div>
@endsection
