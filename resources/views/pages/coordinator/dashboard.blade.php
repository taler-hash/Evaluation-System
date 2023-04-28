@extends('layout.master')

@section('navContent')


@section('header', 'Dashboard')


@section('content')

<div class="">
    
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