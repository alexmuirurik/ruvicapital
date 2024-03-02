@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between">
                        <div class="titld">
                            <h4 class="title">Withdraws</h4>
                        </div>
                        <div class="dropdown">
                            <a class="btn {{$errors->any() ? 'btn-danger' : 'btn-success' }}" data-bs-toggle="offcanvas" 
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" href="/withdraw/add-new">New Withdraw</a>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body px-0 pt-2">
                            <div class="d-flex search-box justify-content-between pb-2 px-3 border-bottom">
                                <input type="text" class="form-control ms-auto w-25" placeholder="search">
                            </div>
                            <div class="table-responsive ps">
                                <table class="table table-hover">
                                    <thead class="bg-body-tertiary">
                                        <tr>
                                            <th style="width: 1%;" scope="col">#</th>
                                            <th scope="col">Names</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Ending Date</th>
                                            <th style="width: 1%;" scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($withdraws as $withdraw)
                                            <tr>
                                                <td>{{$loop->index + 1}}</td>
                                                <td>{{$withdraw->names}}</td>
                                                <td>{{$withdraw->email}}</td>
                                                <td>{{$withdraw->contact_number}}</td>
                                                <td>${{$withdraw->amount}}</td>
                                                <td>{{$withdraw->created_at}}</td>
                                                <td>
                                                    @if ($withdraw->status === 'pending_disbursement')
                                                        @if (request()->user()->user_type === 'super_admin')
                                                            @include('forms.disburse')
                                                        @else
                                                            <button class="btn btn-warning">Requested</button>
                                                        @endif
                                                    @else
                                                        <button class="btn btn-success">Funds_Disbursed</button>
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
        
        @include('forms.withdraw')

    </main>
@endsection
