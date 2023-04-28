@extends('layout.master')


@section('content')

<div class="">
    student
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