<div class="card mt-3">
    <div class="card-body">
        @foreach ($errors->all() as $error)
            <p class="text-danger">{{ $error }}</p>
        @endforeach
    </div>
</div>