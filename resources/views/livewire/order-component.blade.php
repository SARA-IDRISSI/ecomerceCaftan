<section class="col-9 mt-4" style="overflow-x: scroll">
    <div class="row container mb-5">
        <h1 class="text-black mb-5  titleDashboard">Toute Les Ordres</h1>
        <div class="col-4">
            <input type="date" placeholder="filtrer par Date de la commande" wire:model='date'
                wire:change='handleChangeDate($event.target.value)'
                value="{{ Carbon\Carbon::parse($date)->format('Y-m-d') }}" class="form-control" />
        </div>

        <div class="col-4">
            <input type="text" placeholder="filtrer par Nom" wire:keydown='handleChange($event.target.value)'
                class="form-control" />
        </div>
        <div class="col-4">
            <input type="text" placeholder="filtrer par numero de telephone"
                wire:keydown='handleChangeTele($event.target.value)' class="form-control" />
        </div>

    </div>
    @if (session('success'))
        <div class="alert alert-succes>{{ session('success') }}"></div>
    @endif
    <table class="table">
        <thead class="table-dark">
            <th scope="col">#IdOrder</th>
            <th scope="col">Total</th>
            <th scope="col">Status</th>
            <th scope="col">DateCommande</th>
            <th scope="col">Nom</th>
            <th scope="col">Numero Telephone</th>
            <th scope="col">Adresse</th>
            <th scope="col" class="action">Actions</th>
        </thead>
        <tbody>
            @foreach ($orders as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->total }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                    <td>{{ $item->user->firstname }} {{ $item->user->lastname }}</td>
                    <td>{{ $item->user->contactNo }}</td>
                    <td>{{ $item->user->adressLine }}</td>
                    <td>
                        <button class="btn btn-primary"><a href="/show/{{ $item->id }}" class="text-light">
                                <i class="bi bi-eye"></i> Details</a></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        {{-- 'pagination::bootstrap-4' --}}
    </table>
    {{ $orders->links('pagination::bootstrap-4') }}
</section>
