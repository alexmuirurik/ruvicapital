<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="title">Monthly Deposit</h5>
                <h3 class="title-main">${{$earning['working_capital']}}</h3>
                <p class="index">${{$earning['wc_increments']}} increase</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="title">Today's Earnings</h5>
                <h3 class="title-main">${{$earning['interest_earnings'] ?? 0}}</h3>
                <p class="index">${{$earning['ie_increments']}} Yesterday's earning</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="title">Withdrawable Earnings</h5>
                <h3 class="title-main">${{$earning['withdrawable_earnings']}}</h3>
                <p class="index">${{$earning['we_increments']}} increase</p>
            </div>
        </div>
    </div>
</div>