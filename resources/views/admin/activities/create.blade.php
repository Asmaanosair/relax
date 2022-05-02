@extends('layouts.app')

@section('content')
<h2>{{ __('add_na') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{route('admin.activities.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('actvty_name') }}</label>
        <input required name="name" class="form-control" type="text" />
    </div>

    <div class="mb-4">
        <label class="label text-muted mb-1">{{ __('type') }}</label>
        <select name="type" class="form-control">
            <option value="0">{{ __('fixed') }}</option>
            <option value="1">{{ __('adjustable') }}</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary rounded-pill">
        {{ __('add_na') }} <i class="uil uil-check-circle"></i>
    </button>
</form>
@endsection
