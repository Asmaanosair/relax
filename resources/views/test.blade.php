@extends('layouts.test')

@section('content')
    <video-chat :allusers="{{ $users }}" turn_url="turn:192.158.29.39:3478?transport=udp"
                turn_username="JZEOEt2V3Qb0y27GRntt2u2PAYA=" turn_credential="28224511:1379330808"/>



{{--    <video-chat :allusers="{{ $users }}" turn_url="turn:192.158.29.39:3478?transport=udp"--}}
{{--                turn_username="JZEOEt2V3Qb0y27GRntt2u2PAYA=" turn_credential="28224511:1379330808"/>--}}
{{--@section('content')--}}
{{--    <video-chat :allusers="{{ $users }}" :authUserId="{{ auth()->id() }}" turn_url="{{ env('TURN_SERVER_URL') }}"--}}
{{--                turn_username="{{ env('TURN_SERVER_USERNAME') }}" turn_credential="{{ env('TURN_SERVER_CREDENTIAL') }}" />--}}
{{--@endsection--}}

@endsection
