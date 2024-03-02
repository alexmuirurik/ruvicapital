@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="titld">
                            <h4 class="title">Deposits</h4>
                        </div>
                        <div class="dropdown">
                            <a class="btn {{$errors->any() ? 'btn-danger' : 'btn-success' }}" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" 
                                aria-controls="offcanvasRight" href="/deposits">
                                Make a Deposit
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card mt-3">
                        <div class="card-body px-0 pt-2">
                            <div class="search-box justify-content-end pb-2 px-3 border-bottom">
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-3 position-relative">
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <input type="text" class="form-control ms-auto w-25" placeholder="Search Data">
                            </div>
                            <div class="table-responsive ps">
                                <table class="table table-hover">
                                    <thead class="bg-body-tertiary">
                                        <tr>
                                            <th style="width: 1%;" scope="col" class="border-right">#</th>
                                            <th scope="col">Names</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Increment</th>
                                            <th scope="col">Date</th>
                                            <th class="" style="width: 1%;" scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach ($deposits as $deposit)
                                            <tr>
                                                <td style="width: 1%;" scope="row" class="border-right">{{$loop->index + 1}}</td>
                                                <td>{{$deposit->names}}</td>
                                                <td>{{$deposit->mobile}}</td>
                                                <td>${{number_format((float)$deposit->amount, 2, '.', '')}}</td>
                                                <td>${{number_format((float)array_sum(json_decode($deposit->increment)), 2, '.', '')}}</td>
                                                <td>{{$deposit->created_at}}</td>
                                                <td style="width: 1%;">
                                                    @if ($deposit->status !== 'funds_received')
                                                        @if (request()->user()->user_type === 'super_admin')
                                                            @include('forms.earning') 
                                                        @else
                                                            <button class="btn badge p-2 btn-warning">
                                                                Pending Receipt
                                                            </button>
                                                        @endif                                                  
                                                    @else
                                                        <button class="btn badge p-2 btn-success">
                                                            Funds Approved
                                                        </button> 
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @include('forms.deposit')

    </main>
@endsection
