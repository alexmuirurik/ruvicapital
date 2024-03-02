<form action="{{route('deposits.update', $deposit->udeposit_id)}}" method="post" onsubmit="confirmButtonClick(event)">
    @csrf
    @method('put')
    <input type="hidden" name="udeposit_id" value="{{$deposit->udeposit_id}}">
    <button type="submit" class="btn badge p-2 btn-danger" >
        Approve Deposit
    </button>
</form> 