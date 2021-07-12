@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                {{ session('status') }}
            @endif
        </div>
    </div>
</div>
@endsection
