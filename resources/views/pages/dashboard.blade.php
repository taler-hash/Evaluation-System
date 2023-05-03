@extends('layout.master')

@section('navContent')


@section('header', 'Dashboard')


@section('content')
    @if(session('role') === 4)
        @include('/pages/student/dashboard')
    @endif  
@endsection

@push('scripts')

<script>
    document.addEventListener('alpine:init',()=>{
        Alpine.data('data',()=>({

        }))
    })
</script>
@endpush