@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between">
                        <div class="titld">
                            <h4 class="title">404, Not Found!</h4>
                        </div>
                        <div class="dropdown">
                            
                            <a class="btn {{$errors->any() ? 'btn-danger' : 'btn-success' }}">
                                Go Back
                            </a>
                            
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body px-0 pt-2">
                            <div class="search-box justify-content-end pb-2 px-3 border-bottom">
                                <input type="text" class="form-control ms-auto w-25" placeholder="search">
                            </div>
                            <div class="table-responsive ps">
                                <p class="ps-3 pt-4">Sorry we couldn't find any page or results to match your query</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (request()->user()->user_type === 'super_admin')
            @include('forms.profits')
        @endif
        
    </main>
@endsection
