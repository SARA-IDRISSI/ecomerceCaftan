<main class="row container mx-auto">
    <div class="col-3 mt-5 ">

        <div class="mb-5 mt-3 me-5">

            <h4>Filter by price</h4>
            <div class="price-input">
                <div class="field">
                    <span>Min</span>
                    <input type="number" class="input-min" min="0" wire:model="min_value">
                </div>
                <div class="separator">-
                </div>
                <div class="field">
                    <span>Max</span>
                    <input type="number" class="input-max" min="0" wire:model="max_value">
                </div>
            </div>
            <div class="slider">
                <div class="progress"></div>
            </div>
            <div class="range-input">
                <input type="range" class="range-min" min="0" max="4000" step="100"
                    wire:model='min_value' wire:change="handleRange($event.target.value, 'input-max')">
                <input type="range" class="range-max" min="0" max="4000" step="100"
                    wire:model='max_value' wire:change="handleRange($event.target.value, 'input-max')">
            </div>
        </div>




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
    </div>

    {{-- <div class="col-1"></div> --}}


    <div class="col-8 ">
        <p class="text-black  mt-5  titleDashboard fs-1">{{ strtoupper($category->libeleCateg) }}</p>
        <div class="d-flex justify-content-end mb-5">
            <div class="dropdown ">
                <button class="btn colo dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $orderBy }}
                </button>
                <ul class="dropdown-menu">
                    <li class="dropdown-item linke "> <a wire:click.prevent="changeOrderBy('Default Sorting')"
                            href="#">Default
                            Sorting</a>
                    </li>
                    <li class="dropdown-item linke"> <a wire:click.prevent="changeOrderBy('Price: Low to High')"
                            href="#">Price:
                            Low to
                            High</a>
                    </li>
                    <li class="dropdown-item linke"> <a wire:click.prevent="changeOrderBy('Price: High to Low')"
                            href="#">Price:
                            High to
                            Low</a>
                    </li>
                    <li class="dropdown-item linke"> <a wire:click.prevent="changeOrderBy('Sort By Newness')"
                            href="#">Sort
                            By Newness</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container row  mx-auto gy-5">
            @if ($message)
                <h4 class="">{{ $message }}</h4>
            @endif
            @foreach ($products as $product)
                <div class="col-5 ">
                    <div class=" position-relative overflow-hidden">
                        <a href="/detailProduct/{{ $product->id }}">
                            <img src="/{{ $product->photo }}" width="100%" class="imgCatgegory">
                            @if ($product->promo != 0)
                                <span
                                    class="position-absolute text-light top-10 end-0 iconBg rounded-circle p-2">promo</span>
                            @endif
                        </a>

                        <div class="icon_img">
                            <a href="/detailProduct/{{ $product->id }}" class="me-2  iconBg rounded-circle p-2"><i
                                    class="bi bi-eye"></i></a>


                            @php
                                $items = Cart::instance('wishlist')->search(function ($cartItem) use ($product) {
                                    return $cartItem->id == $product->id;
                                });
                            @endphp
                            @if (count($items) > 0)
                                <a href="/add-to-wishlist/{{ $product->id }}"
                                    class="iconList bg-danger iconBg rounded-circle p-2">
                                    <i class="bi bi-heart-fill"></i>
                                </a>
                            @else
                                <a href="/add-to-wishlist/{{ $product->id }}"
                                    class="iconList iconBg rounded-circle p-2">
                                    <i class="bi bi-heart"></i>
                                </a>
                            @endif
                        </div>


                    </div>
                    <div class="text-center">
                        <h3 class="mt-2">{{ $product->title }}</h3>
                        <div class="d-flex justify-content-around">
                            @if ($product->promo == 1)
                                <p class="price color"> {{ $product->prix_promotion }} dh</p>
                                <p class="price"><del> {{ $product->prix_actuel }} dh</del></p>
                            @else
                                <p class="price color"> {{ $product->prix_actuel }} dh</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</main>
<script>
    const rangeInput = document.querySelectorAll(".range-input input"),
        priceInput = document.querySelectorAll(".price-input input"),
        range = document.querySelector(".slider .progress");
    let priceGap = 200;

    priceInput.forEach((input) => {
        input.addEventListener("input", (e) => {
            let minPrice = parseInt(priceInput[0].value),
                maxPrice = parseInt(priceInput[1].value);
            console.log("test")

            if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                if (e.target.className === "input-min") {
                    rangeInput[0].value = minPrice;
                    range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                    console.log((minPrice / rangeInput[0].max) * 100)
                } else {
                    rangeInput[1].value = maxPrice;
                    range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    console.log(100 - (maxPrice / rangeInput[1].max) * 100)
                }
            }
        });
    });
</script>
