@extends('layouts.backend.app')
@section('tittle', 'Dashboard')
@push('css')
@endpush

@section('content')
<!-- BEGIN Content-->
<div class="app-content content">
    <div class="content-wrapper">

        You are logged in! as <strong>{{Auth::user()->name}}</strong>
    </div>
</div>
<!-- END Content-->
@endsection

@push('js')
@endpush
