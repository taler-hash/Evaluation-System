@extends('layout.master')

@section('navContent')


@section('header', 'Students')


@section('content')

<div class="">
    Students
</div>

@endsection

@push('scripts')

<script>
    document.addEventListener('alpine:init',()=>{
        Alpine.data('data',()=>({

        }))
    })
</script>
@endpush