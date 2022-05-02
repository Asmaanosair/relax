@extends('layouts.app')

@section('content')
<h2>{{ __('add_nprice') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{ route('admin.pricings.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('features_title') }}</label>
        <input required name="title" class="form-control" type="text" />
    </div>

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('price') }}</label>
        <input required name="price" class="form-control" type="text" />
    </div>

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('type') }}</label>
        <select name="type" class="form-control">
            <option value="0">{{ __('monthly') }}</option>
            <option value="1">{{ __('yearly') }}</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="label text-muted mb-1">{{ __('features') }}</label>
        <textarea name="describtion" class="form-control" rows="3" placeholder="{{ __('feat_example') }}"></textarea>
        <div class="form-text">{{ __('sprate_fets_wd') }}</div>
    </div>

    <div class="mb-4 d-flex align-items-center">
        <label class="label text-muted me-3">{{ __('price_color') }}</label>
        <input type="color" name="color">
    </div>

    <button type="submit" class="btn btn-primary rounded-pill">
        {{ __('add_nprice') }} <i class="uil-edit ms-1"></i>
    </button>
</form>
@endsection