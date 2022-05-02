@extends('layouts.app')
@section('content')



<meta name="friendId" content="{{$friend->id}}">
<audio id="chat-sound">
    <source src="{{asset('sounds/chat.mp3')}}">
</audio>

<div class="time">
    <p class="time-counter"></p>
</div>


<div class="messages">
    <div class="messages__left">
    @forelse($patients_id as $patient_id)

        {{!$myfriend = App\User::where('id',$patient_id->user_id)->get()->first()}}

        <div class="chat-rect">

            <a class="img-chat" href="{{route('doctor.chat.clinics.show',$myfriend->id)}}">
                <img src="{{$myfriend->image}}" alt="picture" class="chat-rect-img" style="border-radius:50%">
            </a>

            <img src="{{$myfriend->image}}" alt="picture" class="chat-rect-img" style="border-radius:50%">

            <div class="message-info">

                <h1 class="message-info__person"><a href="{{route('doctor.chat.clinics.show',$myfriend->id)}}">{{$myfriend->name}}</a></h1>
                <p class="message-info__text">

                </p>

            </div>
        </div>

        @empty


        @endforelse

    </div>

    <div class="messages__right" style="padding: 20px 0 ;border: 1px solid #e2e2e2">
        <chat :chats="chats" :userid="{{Auth::user()->id}}" :friendid="{{$friend->id}}"></chat>
    </div>
</div>

@endsection

