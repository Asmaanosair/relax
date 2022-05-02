@extends('layouts.app')
@section('content')

<div class="messages">
    <div class="messages__left">
        @forelse($patients_id as $patient_id)

        {{!$friend = App\User::where('id',$patient_id->user_id)->get()->first()}}

        <div class="chat-rect">
            <a class="img-chat" href="{{route('doctor.chat.clinics.show',$friend->id)}}">
                <img src="{{$friend->image}}" alt="picture" class="chat-rect-img" style="border-radius:50%">
            </a>
            <img src="{{$friend->image}}" alt="picture" class="chat-rect-img" style="border-radius:50%">

            <div class="message-info">


                <h1 class="message-info__person"><a href="{{route('doctor.chat.clinics.show',$friend->id)}}">{{$friend->name}}</a></h1>
                <p class="message-info__text">

                </p>


            </div>
        </div>
        @empty
        @endforelse

    </div>
    <div class="messages__right" style="border: 1px solid #e2e2e2">
        <p style="font-size: 20px;text-align: center;margin: 235px 0;">
            اختر مريض لمحادثته
        </p>
    </div>
</div>
@endsection
