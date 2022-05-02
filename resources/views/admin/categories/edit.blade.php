@extends('layouts.app')

@section('content')
<h2>{{ __('edit_categ') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="mb-4">
        <label class="label text-muted mb-1">{{ __('category') }}</label>
        <input required name="category" class="form-control" type="text" value="{{ $category->category }}">
    </div>

    <button type="submit" class="btn btn-primary rounded-pill">
        {{ __('save_changes') }} <i class="uil uil-check-circle"></i>
    </button>
</form>
@endsection
