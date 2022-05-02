@extends('layouts.app')

@section('content')
<h2>{{ __('view_pp') }}</h2>
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

@php
    $type = $pricing->type == 0 ? 'Monthly' : 'Annual';
@endphp

<div class="mt-5">
    <div class="row justify-content-center">
        <div class="col-5">
            <div class="border shadow-sm rounded m-auto p-4" style="max-width: 300px;">
                <div class="rounded-pill d-flex align-items-center justify-content-center m-auto" style="width: 175px;height:175px;border: 8px solid #eee">
                    <div class="text-center">
                        <h2 class="display-5">{{ $pricing->price }}$</h2>
                        <p class="mb-0">Per {{ $type }}</p>
                    </div>
                </div>
                <h2 class="text-center display-6 my-3 py-3 border-top border-bottom">{{ $type }}</h2>
                <ul class="list-unstyled">
                    @foreach (explode('-', $pricing->describtion) as $feature)
                    <li class="d-flex my-2">
                        <i class="uil-check text-success fs-4 me-2 lh-1"></i>
                        <span>{{ $feature }}</span>
                    </li>
                    @endforeach
                </ul>
                <div class="text-center mt-4">
                    <button class="btn btn-outline-primary btn-lg rounded-pill uppercase px-4">
                        Select <i class="uil uil-check-circle ms-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
