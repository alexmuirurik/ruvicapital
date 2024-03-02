@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="container">
            <div class="row gutters-sm">
                <div class="col-md-4 col-lg-3">
                    <div class="card">
                        <div class="card-img d-flex flex-column align-items-center justify-content-center pt-3 px-5 bg-light">
                            <img src="{{$user->profile_img}}" alt="" class="object-fit-cover rounded-circle" width="200" height="200">
                            <h4 class="mt-2">{{$user->names}}</h4>
                            <small class="pb-3">{{$user->email}}</small>
                        </div>
                        <div class="ul-body">
                            <ul class="list-group">
                                <li class="list-group-item"><span class="fw-bold">Firstname:</span> {{$user->firstname}}</li>
                                <li class="list-group-item"><span class="fw-bold">Lastname:</span> {{$user->lastname}}</li>
                                <li class="list-group-item"><span class="fw-bold">Mobile: </span> {{$user->mobile}} </li>
                                <li class="list-group-item"><span class="fw-bold">Role:</span> {{$user->user_type}} </li>
                                <li class="list-group-item"><span class="fw-bold">Status:</span> {{$user->status}} </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="card">
                        <div class="card-img py-5 px-2 bg-light"></div>
                        <div class="card-body">
                            <h5 class="title">User Logs</h5>
                                <table class="table table-hover ">
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ip Address</th>
                                        <th scope="col">Browser</th>
                                        <th scope="col">OS</th>
                                        <th scope="col">Device</th>
                                        <th scope="col">Log Date</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($userlogs as $userlog)
                                            <tr>
                                                <td>{{$loop->index + 1}}</td>
                                                <td>{{$userlog->ip_address}}</td>
                                                <td>{{$userlog->browser}}</td>
                                                <td>{{$userlog->os}}</td>
                                                <td>{{$userlog->device}}</td>
                                                <td>{{$userlog->created_at->diffForHumans()}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 justify-content-between gap-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="title-box d-flex justify-content-center align-items-center w-50">
                                            <span class="fs-2 text-success fw-bolder">{{count($referrals)}}</span>
                                        </div>
                                        <div class="items-box d-flex flex-column">
                                            <h5>Referrals</h5>
                                            <span>
                                                {{now()->format('F')}}: ${{number_format(array_sum(
                                                    array_filter((array)$referrals, function($referral){ 
                                                        isset($referral['deposit_amount']) ?? $referral['deposit_amount']; 
                                                    })
                                                ), 2)}}
                                            </span>
                                            <span>Total: ${{number_format(array_sum((array)$referrals), 2)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="title-box d-flex justify-content-center align-items-center w-50">
                                            <span class="fs-2 text-danger fw-bolder">0</span>
                                        </div>
                                        <div class="items-box d-flex flex-column">
                                            <h5>Earnings</h5>
                                            <span>{{now()->format('F')}}: ${{number_format(array_sum((array)$referrals), 2)}}</span>
                                            <span>Total: ${{number_format(array_sum((array)$referrals), 2)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 justify-content-between gap-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="title-box d-flex justify-content-center align-items-center w-50">
                                            <span class="fs-2 text-warning fw-bolder">0</span>
                                        </div>
                                        <div class="items-box d-flex flex-column">
                                            <h5>Profits</h5>
                                            <span>{{now()->format('F')}}: ${{number_format(array_sum((array)$referrals), 2)}}</span>
                                            <span>Total: ${{number_format(array_sum((array)$referrals), 2)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="title-box d-flex justify-content-center align-items-center w-50">
                                            <span class="fs-2 text-info fw-bolder">0</span>
                                        </div>
                                        <div class="items-box d-flex flex-column">
                                            <h5>Deposits</h5>
                                            <span>{{now()->format('F')}}: ${{number_format(array_sum((array)$referrals), 2)}}</span>
                                            <span>Total: ${{number_format(array_sum((array)$referrals), 2)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
