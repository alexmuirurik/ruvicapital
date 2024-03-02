@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between">
                        <div class="titld">
                            <h4 class="title">Contracts</h4>
                        </div>
                        <div class="dropdown">
                            <a class="btn {{$errors->any() ? 'btn-danger' : 'btn-success' }}" data-bs-toggle="offcanvas" 
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"href="/withdraw/add-new">
                                Sign a Contract
                            </a>
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
                                            <th scope="col">Names</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Date</th>
                                            <th style="width: 1%;" scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contracts as $contract)
                                            <tr>
                                                <td>{{$loop->index + 1}}</td>
                                                <td>{{$contract->names}}</td>
                                                <td>{{$contract->email}}</td>
                                                <td>{{$contract->mobile}}</td>
                                                <td>${{$contract->amount}}</td>
                                                <td>{{$contract->termination_date}}</td>
                                                <td>
                                                    @if ($contract->status === 'active_contract')
                                                        @if (request()->user()->user_type === 'super_admin')
                                                            @include('forms.terminate')
                                                        @else
                                                            <button class="btn btn-success">Active_Contract</button>
                                                        @endif
                                                    @else
                                                        <button class="btn btn-warning">{{$contract->status}}</button>
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
        
        @include('forms.contract')

    </main>
@endsection
