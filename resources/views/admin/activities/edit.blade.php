@extends('layouts.app')

@section('content')
<h2>{{ __('edit_d') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{ route('admin.activities.update', $activity->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('actvty_name') }}</label>
        <input required name="name" class="form-control col-md-6" type="text" value="{{ $activity->name }}">
    </div>

    <div class="mb-4">
        <label class="label text-muted mb-1">{{ __('actvty_type') }}</label>
        <select name="type" class="form-control col-md-6">
            <option {{ $activity->type === 0 ? 'selected' : '' }} value="0">{{ __('fixed') }}</option>
            <option {{ $activity->type === 1 ? 'selected' : '' }} value="1">{{ __('adjustable') }}</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary rounded-pill">
        {{ __('save_changes') }} <i class="uil uil-check-circle"></i>
    </button>
</form>
@endsection
