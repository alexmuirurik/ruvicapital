<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="title">Monthly Deposit</h5>
                <h3 class="title-main">${{$earning?->working_capital ?? '0.00'}}</h3>
                <p class="index">${{array_sum(json_decode($earning->wc_increments ?? '[0.00]'))}} increase</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="title">Today's Earnings</h5>
                <h3 class="title-main">${{$earning?->interest_earnings ?? '0.00'}}</h3>
                <p class="index">${{array_sum((array) json_decode($earning->ie_increments  ?? '[0.00]'))}} Yesterday's earning</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="title">Withdrawable Earnings</h5>
                <h3 class="title-main">${{array_sum(json_decode($earning?->wc_increments  ?? '[0.00]') ) + $earning?->interest_earnings}}</h3>
                <p class="index">${{$earning?->interest_earnings ?? '0.00'}} increase</p>
            </div>
        </div>
    </div>
</div>