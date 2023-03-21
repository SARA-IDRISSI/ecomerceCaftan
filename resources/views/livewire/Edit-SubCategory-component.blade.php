<main class="col-9">
    {{-- add categorie --}}
    @if ($message)
        <div class="alert alert-success">{{ $message }}</div>
    @endif
    @if ($errorMessage)
        <div class="alert alert-danger">{{ $errorMessage }}</div>
    @endif
    <form class="col-10" action="" method="POST" wire:submit.prevent="updateSubCategory">
        @csrf
        <h1 class="text-black mb-5 mt-3 titleDashboard">Modifier UN SUB-CATEGORIE</h1>


        <div class="col-6">
            <label for="" class="form-label">le nom de Subcatégorie</label>
            <input type="text" name="title" id="" wire:model='name' class="form-control">
            <label for="" class="form-label">dans lequel</label>
            <select name="category_id" class="form-select" aria-label="Default select example" wire:model='category_id'>
                @for ($i = 0; $i < count($categories); $i++)
                    @if ($category_id != $categories[$i]->id)
                        <option value="{{ $categories[$i]->id }}">{{ $categories[$i]->libeleCateg }}</option>
                    @else
                        <option selected value="{{ $categories[$i]->id }}">{{ $categories[$i]->libeleCateg }}</option>
                    @endif
                @endfor
            </select>
        </div>
        <button type="submit" class="btn colo mt-3">Modifier</button>
    </form>
</main>
