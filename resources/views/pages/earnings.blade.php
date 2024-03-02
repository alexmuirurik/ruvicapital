@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between">
                        <div class="titld">
                            <h4 class="title">Earnings</h4>
                        </div>
                        <div class="dropdown">
                            
                            @if (request()->user()->user_type == 'super_admin')
                                <a class="btn {{$errors->any() ? 'btn-danger' : 'btn-success' }}" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" 
                                    aria-controls="offcanvasRight">
                                    Award Profits
                                </a>
                            @else
                                <a class="btn {{$errors->any() ? 'btn-danger' : 'btn-success' }}" href="{{route('withdraw.index')}}">
                                    Make Withdraw
                                </a>
                            @endif
                            
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body px-0 pt-2">
                            <div class="search-box justify-content-end pb-2 px-3 border-bottom">
                                <input type="text" class="form-control ms-auto w-25" placeholder="search">
                            </div>
                            <div class="table-responsive ps">
                                <table class="table table-hover">
                                    <thead class="bg-body-tertiary">
                                        <tr>
                                            <th style="width: 1%;" scope="col">#</th>
                                            <th scope="col">UserName</th>
                                            <th scope="col">Total Deposit</th>
                                            <th scope="col">Capital Incr</th>
                                            <th scope="col">Interest</th>
                                            <th scope="col">Interest Incr</th>
                                            <th scope="col">Date</th>
                                            <th style="width: 1%;" scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($earnings as $earning)
                                            <tr>
                                                <td style="width: 1%;" scope="row" class="border-right">{{$loop->index + 1}}</td>
                                                <td>{{$earning->names}}</td>
                                                <td>${{$earning->working_capital}}</td>
                                                <td>${{array_sum(json_decode($earning->wc_increments ?? '[]'))}}</td>
                                                <td>${{$earning->interest_earnings ?? 0}}</td>
                                                <td>${{array_sum((array) json_decode($earning->ie_increments ?? '[]'))}}</td>
                                                <td>${{$earning->month}}</td>
                                                <td>
                                                    <button class="btn badge btn-sm btn-success">{{$earning->status}}</button>
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

        @if (request()->user()->user_type === 'super_admin')
            @include('forms.profits')
        @endif
        
    </main>
@endsection
