@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between">
                        <div class="titld">
                            <h4 class="title">Referrals</h4>
                        </div>
                        <div class="dropdown">
                            <a class="btn {{$errors->any() ? 'btn-danger' : 'btn-success' }}" data-bs-toggle="offcanvas" 
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" href="/withdraw/add-new">Copy Referral Link</a>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body px-0 pt-2">
                            <div class="d-flex search-box justify-content-between pb-2 px-3 border-bottom">
                                <input type="text" class="form-control ms-auto w-25" placeholder="search">
                            </div>
                            <div class="table-responsive ps">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-end">#</th>
                                            <th>Name</th>						
                                            <th>Deposit Status</th>
                                            <th>Deposited Amount</th>
                                            <th>Total Commission</th>
                                            <th>Date Created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="border-end" style="width: 1%">{{$loop->index + 1}}</td>
                                                <td>
                                                    <a href="{{route('user.show', $user->username)}}">
                                                        <img src="{{$user->profile_img}}" class="rounded-circle me-2" alt="Avatar" height="30" width="30"> 
                                                        {{$user->names}}
                                                    </a>
                                                </td>                      
                                                <td>{{$user->user_type}}</td>
                                                <td>
                                                    <span class="status text-{{$user->status === 'approved' ? 'success' : 'danger'}}">•</span>
                                                    {{$user->status}}
                                                </td>
                                                <td>{{$user->created_at}}</td>  
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

        @include('forms.user')

    </main>
@endsection
