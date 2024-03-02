<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body p-0">
                <h5 class="title ps-3 pt-2">Latest Transactions</h5>
                <div class="p-1 border justify-content-center"><input type="text"
                        class="form-control ms-auto w-25 m-2" placeholder="Search"></div>
                <div class="table-responsive p">
                    <table class="table table-hover">
                        <thead class="bg-body-tertiary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Names</th>
                                <th scope="col">Amount</th>
                                <th scope="col">email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Month</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deposits as $deposit)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$deposit->names}}</td>
                                    <td>{{$deposit->amount}}</td>
                                    <td>{{$deposit->email}}</td>
                                    <td>
                                        @if ($deposit->earning_id)
                                            <span class="badge bg-danger">Withdrew</span>
                                        @else
                                            <span class="badge bg-success">Deposited</span>
                                        @endif
                                    </td>
                                    <td>January-2024</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>