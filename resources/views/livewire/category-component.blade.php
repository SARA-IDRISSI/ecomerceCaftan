<main class="row container mx-auto">
    <div class="col-3 mt-5">
        <h4>Sizes</h4>
        <div class="form-check">
            <input class="form-check-input" wire:model="sizeInputs" type="checkbox" value="xs" id="xs">
            <label class="form-check-label" for="xs">
                XS
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" wire:model="sizeInputs" type="checkbox" value="s" id="s">
            <label class="form-check-label" for="s">
                S
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" wire:model="sizeInputs" type="checkbox" value="m" id="m">
            <label class="form-check-label" for="m">
                M
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" wire:model="sizeInputs" type="checkbox" value="l" id="l">
            <label class="form-check-label" for="l">
                L
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" wire:model="sizeInputs" type="checkbox" value="xl" id="xl">
            <label class="form-check-label" for="xl">
                XL
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" wire:model="sizeInputs" type="checkbox" value="xxl" id="xxl">
            <label class="form-check-label" for="xxl">
                XXL
            </label>
        </div>

        <div class="mt-5">

            <h4>Colors</h4>
            @php
                $colors = [];
            @endphp
            @foreach ($productSizes as $size)
                @foreach ($size->colors as $color => $stock)
                    @if (!in_array($color, $colors))
                        @php
                            array_push($colors, $color);
                        @endphp
                        <div>
                            {{-- <input type="checkbox" name="" id="" class="form-control"> <input type="color"
                        value="{{ $color }}" disabled /> --}}
                            <label for="{{ $color }}"
                                style="background-color: {{ $color }};
                    border: @if (in_array("$color:$stock", $colorsBtn)) 3px solid; @endif"
                                class="btn"></label>
                            <input id="{{ $color }}" wire:model="colorsBtn" type="checkbox" class="invisible"
                                value="{{ "$color:$stock" }}" />
                        </div>
                    @endif
                @endforeach
            @endforeach



        </div>

        <div class="mt-5">

            <h4>filter by price</h4>
            <div id="slider-range"> </div>
            <div class="label-input">
                <span>min:</span> <input type="number" class="text-info" wire:model='min_value'> -
                <span>max:</span>
                <input class="text-info" type="number" wire:model="max_value">

            </div>
        </div>
    </div>


    <div class="col-9">
        <p class="text-center fs-1">{{ strtoupper($category->libeleCateg) }}</p>
        <div class="d-flex justify-content-end">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    {{ $orderBy }}
                </button>
                <ul class="dropdown-menu">
                    <li class="dropdown-item"> <a wire:click.prevent="changeOrderBy('Default Sorting')"
                            href="#">Default
                            Sorting</a>
                    </li>
                    <li class="dropdown-item"> <a wire:click.prevent="changeOrderBy('Price: Low to High')"
                            href="#">Price:
                            Low to
                            High</a>
                    </li>
                    <li class="dropdown-item"> <a wire:click.prevent="changeOrderBy('Price: High to Low')"
                            href="#">Price:
                            High to
                            Low</a>
                    </li>
                    <li class="dropdown-item"> <a wire:click.prevent="changeOrderBy('Sort By Newness')"
                            href="#">Sort
                            By Newness</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container row gx-1 mx-auto gy-5">
            @if ($message)
                <h4>{{ $message }}</h4>
            @endif
            @foreach ($products as $product)
                <div class="col-3">
                    <div class="card">
                        <a href="/detailProduct/{{ $product->id }}">
                            <img src="/{{ $product->photo }}" class="img-boot-catg img-fluid">
                            @if ($product->promo != 0)
                                <span>promo</span>
                            @endif
                        </a>

                        <h1>{{ $product->title }}</h1>
                        @if ($product->promo == 1)
                            <p class="price">${{ $product->prix_promotion }}</p>
                            <p class="price">${{ $product->prix_actuel }}</p>
                        @else
                            <p class="price">${{ $product->prix_actuel }}</p>
                        @endif
                        @php
                            $items = Cart::instance('wishlist')->search(function ($cartItem) use ($product) {
                                return $cartItem->id == $product->id;
                            });
                        @endphp
                        @if (count($items) > 0)
                            <a href="/add-to-wishlist/{{ $product->id }}" class="iconList bg-danger">
                                <i class="bi bi-heart"></i>
                            </a>
                        @else
                            <a href="/add-to-wishlist/{{ $product->id }}" class="iconList">
                                <i class="bi bi-heart"></i>
                            </a>
                        @endif
                        <p><button>Acheter</button></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
