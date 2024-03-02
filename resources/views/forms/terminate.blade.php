<form action="{{route('contract.update', $contract->udeposit_id)}}" method="post" id="depositUpdate" onsubmit="confirmButtonClick(event)">
    @csrf
    @method('put')
    <input type="hidden" name="udeposit_id" value="{{$contract->udeposit_id}}">
    <button type="submit" class="btn badge p-2 btn-danger">
        Terminate Contract
    </button>
</form> 