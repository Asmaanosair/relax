@extends('layouts.app')

@section('content')
<h2>{{ __('edit_pricing') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{ route('admin.pricings.update', $pricing->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('features_title') }}</label>
        <input required name="title" class="form-control" type="text" value="{{ $pricing->title }}" />
    </div>

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('price') }}</label>
        <input required name="price" class="form-control" type="text" value="{{ $pricing->price }}" />
    </div>

    <div class="mb-4">
        <label class="label text-muted mb-1">{{ __('features') }}</label>
        <textarea name="describtion" class="form-control" rows="3" placeholder="{{ __('feat_example') }}">{{ $pricing->describtion }}</textarea>
        <div class="form-text">{{ __('sprate_fets_wd') }}</div>
    </div>

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('type') }}</label>
        <select name="type" class="form-control">
            <option {{ $pricing->type == 0 ? 'selected' : '' }} value="0">{{ __('monthly') }}</option>
            <option {{ $pricing->type == 1 ? 'selected' : '' }} value="1">{{ __('yearly') }}</option>
        </select>
    </div>

    <div class="mb-4 d-flex align-items-center">
        <label class="label text-muted me-3">{{ __('price_color') }}</label>
        <input type="color" name="color" value="{{ $pricing->color }}">
    </div>

    <button type="submit" class="btn btn-primary rounded-pill">
        {{ __('save_changes') }} <i class="uil-edit ms-1"></i>
    </button>
</form>
@endsection