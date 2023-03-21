<main class="col-8">
    @if ($message)
        <div class="alert alert-success">{{ $message }}</div>
    @endif
    @if ($errorMessage)
        <div class="alert alert-danger">{{ $errorMessage }}</div>
    @endif
    <form class="col-10" action="" method="POST" wire:submit.prevent="updateCategory">
        @csrf
        <h1 class="titleDashboard w-100 mt-3 mb-5 ">MODIFIER  CATEGORIES </h1>

        <div class="col-6">
            <label for="" class="form-label mb-3
            ">le nom de catégorie</label>
            <input type="text" name="name" id="" wire:model='name' class="form-control">

        </div>
        <div class="col-6">
            <label for="" class="form-label mt-3
            ">Image</label>
            <input type="file" name="name" id="" wire:model='name' class="form-control">
        </div>
        <button type="submit" class="btn colo mt-3">
            Modifier</button>
    </form>
</main>
