@extends('layouts.app')

@section('content')
@if (Auth::user()->isAdmin())
<h3>{{ __('dashboard') }}</h3>
<p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>

<div class="row mt-4">
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="d-flex">
            <i class="uil uil-user-md display-2 me-3"></i>
            <div>
                <h4 class="mb-1">Total doctors</h4>
                <p class="mb-0">The total registered doctors</p>
                <span class="fs-3">14</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
        <div class="d-flex">
            <i class="uil uil-user-nurse display-2 me-3"></i>
            <div>
                <h4 class="mb-1">Total patients</h4>
                <p class="mb-0">The total registered patients</p>
                <span class="fs-3">58</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
        <div class="d-flex">
            <i class="uil uil-comment-verify display-2 me-3"></i>
            <div>
                <h4 class="mb-1">Total assessments</h4>
                <p class="mb-0">The total assessments</p>
                <span class="fs-3">5</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
        <div class="d-flex">
            <i class="uil uil-clinic-medical display-2 me-3"></i>
            <div>
                <h4 class="mb-1">Total clinics</h4>
                <p class="mb-0">The total registered clinics</p>
                <span class="fs-3">17</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
        <div class="d-flex">
            <i class="uil uil-hospital display-2 me-3"></i>
            <div>
                <h4 class="mb-1">Total sections</h4>
                <p class="mb-0">The total registered sections</p>
                <span class="fs-3">20</span>
            </div>
        </div>
    </div>
</div>

@elseif (Auth::user()->isPatient())
@php
    $patient = Auth::user();
@endphp

<h3>{{ __('hi') }}, {{ $patient->name }}</h3>
<p>{{ __('hi') }}, {{ $patient->name }} what’s your day been like so far?</p>

@elseif (Auth::user()->isClinicDoctor())

<h3>{{ __('hi') }}, doctor {{ Auth::user()->name }}</h3>

@elseif (Auth::user()->isInsideDoctor())

<h3>{{ __('hi') }}, doctor {{ Auth::user()->name }}</h3>

@endif

@endsection
