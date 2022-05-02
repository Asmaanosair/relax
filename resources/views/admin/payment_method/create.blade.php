@extends('layouts.app')

@section('content')
<h2>{{ __('add_npm') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<x-errors />

<form class="mt-4" method="post" action="{{ route('admin.payment_method.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="label text-muted mb-1">{{ __('pymnt_mthd_name') }}</label>
        <input required name="payment_method" class="form-control" type="text" />
    </div>

    <div class="mb-4">
        <label class="label text-muted mb-1">{{ __('pymnt_mthd_img') }}</label>
        <div class="add-file">
            <div class="add-file__title-box">
                <img src="{{ asset('img/adding icon.svg') }}" alt="add icon" class="add-file-icon" />
                <input type="file" name="image" accept="image/*" onchange="showPreview(event);" />
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary rounded-pill">
        {{ __('add_npm') }} <i class="uil-check-circle ms-1"></i>
    </button>
</form>
@endsection
