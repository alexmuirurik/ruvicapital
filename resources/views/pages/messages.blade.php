@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between">
                        <div class="titld">
                            <h4 class="title">Withdrawal Requests</h4>
                        </div>
                        <div class="dropdown"><a class="btn btn-success" href="/messages/add-new">Contact Admin</a></div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body px-0 pt-2">
                            <div class="search-box justify-content-end pb-2 px-3 border-bottom"><input type="text"
                                    class="form-control ms-auto w-25" placeholder="search"></div>
                            <div class="chat-section">
                                <div class="d-flex">
                                    <div class="col-lg-2 border-right">
                                        <ul class="nav flex-column mt-3">
                                            <li class="nav-item"><a class="nav-link border-bottom" href="/messages"><i
                                                        class="fa fa-gear px-2"></i><span class="title">Noticed</span></a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link border-bottom" href="/messages"><i
                                                        class="fa fa-gear px-2"></i><span class="title">Noticed</span></a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link border-bottom" href="/messages"><i
                                                        class="fa fa-gear px-2"></i><span class="title">Noticed</span></a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link border-bottom" href="/messages"><i
                                                        class="fa fa-gear px-2"></i><span class="title">Noticed</span></a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link border-bottom" href="/messages"><i
                                                        class="fa fa-gear px-2"></i><span class="title">Noticed</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="card">
                                            <div class="card-body messages-body"></div>
                                            <div class="card-footer">
                                                <form action="#" method="post"><input class="form-control"
                                                        name="iroeir" id="rioe"></form>
                                            </div>
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
