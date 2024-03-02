<form action="{{route('withdraw.update', $withdraw->uwithdraw_id)}}" method="post" id="withdrawUpdate" onsubmit="confirmButtonClick(event)">
    @csrf
    @method('put')
    <input type="hidden" name="udeposit_id" value="{{$withdraw->uwithdraw_id}}">
    <button type="submit" class="btn badge p-2 btn-danger">
        Mark as Sent
    </button>
</form> 