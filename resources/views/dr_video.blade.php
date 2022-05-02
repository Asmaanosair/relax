@extends('layouts.app')

@section('content')
    <dr-video-chat :allusers="{{ $users }}" turn_url="turn:192.158.29.39:3478?transport=udp"
                turn_username="JZEOEt2V3Qb0y27GRntt2u2PAYA=" turn_credential="28224511:1379330808"/>



@endsection
