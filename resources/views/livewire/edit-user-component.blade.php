<div class="container col-8 mx-auto">
    @if ($validationMessage)
        <div class="alert alert-success">{{ $validationMessage }}</div>
    @endif
    @if ($validationMessageError)
        <div class="alert alert-danger">{{ $validationMessageError }}</div>
    @endif
    <form action="" method="post" class="row g-3" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="inputEmail4" wire:model='username'>
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="inputEmail4" wire:model='email'>
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="inputPassword4" wire:model='password'>
        </div>
        <div class="col-12">
            <label for="formFile" class="form-label">Image</label>
            <input class="form-control" type="file" name="image" id="formFile" wire:model='image'>
            <img wire src="/{{ $showImage }}" alt="">
        </div>


        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck" name="newsletter">
                <label class="form-check-label" for="gridCheck" wire:model='newsletter'>
                    Envoyez-moi les nouvelles et les
                    offres par e-mail
                </label>
            </div>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary" wire:click.prevent='post'>Edit</button>
        </div>

    </form>
</div>
