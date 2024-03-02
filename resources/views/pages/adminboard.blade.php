@extends('layouts.app')

@section('content')
        
    <main class="main">
        <div class="container-fluid">
            
            @include('components.adminnings')

            
            @include('components.dashchart')
            

            @include('components.dashlist')

        </div>
    </main>

@endsection
