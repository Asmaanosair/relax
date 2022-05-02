@extends('layouts.app')

@section('content')
<div class="row messages">
    <div class="col-3">
        {{-- <div class="messages__left"> --}}
        <ul class="list-group">
            @forelse($patients_id as $patient_id)
            {{ !($friend = App\User::where('id', $patient_id->patient_id)->get()->first()) }}
            <li class="list-group-item d-flex align-items-center">
                {{-- <div class="chat-rect"> --}}
                    <a class="img-chat" href="{{ route('chat.show', $friend->id) }}">
                        <img src="{{ $friend->image }}" alt="picture" class="chat-rect-img rounded-pill" width="65" height="65" />
                    </a>
        
                    <img src="{{ $friend->image }}" alt="picture" class="chat-rect-img rounded-pill" width="65" height="65" />
        
                    <div class="message-info ms-3">
                        <h4 class="message-info__person mb-0">
                            <a href="{{ route('chat.show', $friend->id) }}">{{ $friend->name }}</a>
                        </h4>
                        <p class="message-info__text mb-0"></p>
                    </div>
                {{-- </div> --}}
            </li>
            @empty
            @endforelse
        </ul>
        {{-- </div> --}}
    </div>

    <div class="col-9">
        <div class="messages__right" style="border: 1px solid #e2e2e2">
            <p style="font-size: 20px;text-align: center;margin: 235px 0;">
                اختر مريض لمحادثته
            </p>
        </div>
    </div>
</div>
@endsection
