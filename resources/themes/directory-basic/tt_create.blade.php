@extends('layouts.theme')

@section('css')
    {!! Theme::css('css/bootstrap.min.css') !!}
    <style>
        .tab-content {
            display: block;
        }
    </style>
@endsection

@section('editable_content')
    <div class="py-5">
        @include('TroubleTicket::troubleTickets.public.create', ['troubleTicket'=>$troubleTicket])
    </div>
@endsection
