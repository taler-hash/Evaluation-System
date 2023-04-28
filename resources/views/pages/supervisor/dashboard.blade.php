@extends('layout.master')


@section('content')

<div class="">
    SuperVisor
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