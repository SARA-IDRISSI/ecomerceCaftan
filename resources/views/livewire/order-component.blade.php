<section class="col-9 mt-4" style="overflow-x: scroll">
    <div class="row container mb-3">
        <h1 class="text-black mb-5  titleDashboard">All Orders</h1>
        <div class="col-4">
            <input type="date" placeholder="filtrer par Date de la commande"
                wire:change='handleChangeDate($event.target.value)' class="form-control" />
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
    <table class="table tab_le">
        <thead class="table-dark">
            <th scope="col">#IdOrder</th>
            <th scope="col">total</th>
            <th scope="col">status</th>
            <th scope="col">dateCommande</th>
            <th scope="col">name</th>
            <th scope="col">Numero Telephone</th>
            <th scope="col">adressLine</th>
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
                                <i class="fa-regular fa-eye"></i> Details</a></button>
                    </td>
                </tr>
            @endforeach
        </tbody>


    </table>
</section>
