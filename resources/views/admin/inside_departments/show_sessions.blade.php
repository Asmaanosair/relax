@extends('layouts.app')

@section('content')
<header class="d-flex align-items-center justify-content-between">
    <div>
        <h2>{{ __('ptnt_trtmnt_plan') }}</h2>
        <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
    </div>
    <a href="{{ '#' }}" class="btn btn-light rounded-pill">
        {{ __('patient') . ' ID: ' . $patient->id }}
    </a>
</header>

<div class="table-responsive mt-4">
    @if($sessions->isNotEmpty())
    <table class="table">
        <tbody>
            <tr class="border-bottom">
                <td>{{ __('d_of_t_w') }}</td>
                @foreach ($sessions as $session)
                <td>
                    {{ __('from') }}
                    <span>{{ $session->from }}</span>
                    <span>{{ __('to') }}</span>
                    <span>{{ $session->to }}</span>
                </td>
                @endforeach
            </tr>
            @foreach ($days as $day)
            <tr class="border-bottom">
                <td>
                    <h6>{{ __('Day') }}</h6>
                    {{ __($day) }}
                </td>
                @foreach ($sessions as $session)
                <td colspan="1">
                    <h6>{{ __('What to do') }}</h6>
                    @if ($session->day == $day)
                    <div class="d-flex align-items-center">
                        <span class="badge bg-primary rounded-pill fs-6 px-2 py-1">{{ $session->name }}</span>
                        <p class="badge bg-white shadow-sm border rounded-pill fs-6 px-2 py-1 text-dark mb-0 ms-2">{{ $session->treatment }}</p>
                    </div>
                    @endif
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="text-center">
        <h5>No plans</h5>
        <p>We didn't find any sessions until now.</p>
        {{-- <p class=""> لا يوجد جلسات محددة حتى الان</p> --}}
    </div>
    @endif
</div>
@endsection
