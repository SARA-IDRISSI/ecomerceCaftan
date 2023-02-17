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
                <span>min:</span> <input type="number" value="0" class="text-info" wire:model='min_value'> -
                <span>max:</span>
                <input class="text-info" type="number" value="1000" wire:model="max_value">

            </div>
        </div>
    </div>
    {{-- <div class="price-input d-flex">
                <div class="field">
                    <span>Min</span>
                    <input type="number" class="input-min" value="2500">
                </div>

                <div class="separator">&ensp;</div>

                <div class="field">
                    <span>Max</span>
                    <input type="number" class="input-min" value="7500">
                </div>
            </div>
            <div class="slider">
                <div class="progress"></div>

            </div>
        </div> --}}


    <div class="col-9">

        <div class="container row gx-1 mx-auto gy-5">
            @if ($message)
                <h4 class="text-center">{{ $message }}</h4>
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
                        <p><button>Acheter</button></p>
                    </div>
                </div>

                {{-- <div class="col-lg-3 col-md-6 col-sm-10 mx-auto">
                    <div class="boxx">
                        <div class="image-boxx">
                            <img src="/{{ $product->photo }}" class="image-one" alt="">
                            @if ($product->promo != 0)
                                <span>promo</span>
                            @endif
                            <div class="overlayy">
                                <img src="/{{ $product->photo }}" class="image-two" alt="">
                                <div class="text">
                                    <span class="ico" data-bs-toggle="tooltip" data-bs-offset="0,5"
                                        data-bs-placement="top" title="Quick view"><i
                                            class="fa-regular fa-eye "></i></span>
                                    <span class="ico"><i class="fa-regular fa-heart"></i></span>
                                    <span class="ico"><i class="fa-solid fa-shuffle"></i></span>
                                </div>
                            </div>


                            <div class="titl-box">
                                <h6>{{ $product->title }}</h6>

                                <h5>Colorful Pattern Shirts</h5>
                                <div class="row justify-content-between">
                                    <div class="col-8">
                                        <i class="fa-regular fa-star text-warning"></i><i
                                            class="fa-regular fa-star text-warning"></i><i
                                            class="fa-regular fa-star text-warning"></i><i
                                            class="fa-regular fa-star text-warning"></i><i
                                            class="fa-regular fa-star text-warning"></i> <span>90%</span>

                                        @if ($product->promo == 1)
                                            <p class="price">${{ $product->prix_promotion }}</p>
                                            <p class="price"> <del> ${{ $product->prix_actuel }} </del></p>
                                        @else
                                            <p class="price">${{ $product->prix_actuel }}</p>
                                        @endif
                                    </div>
                                    <div class="pannier me-lg-2 col-2 d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-cart-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            @endforeach
        </div>
    </div>


    {{-- <script>
        let sliderrange = $('#slider-range');
        let amountprice = $('#amount');
        $(function() {

                    sliderrange.slider({
                        range: true,
                        min: 0,
                        max: 1000,
                        values: [0, 1000],
                        slide: function(event, ui) {
                            // amountprice.val("5" + ui.values[0] + " - $" + ui.values[1]);
                            @this.set('min_value', ui.values[0])
                            @this.set('min_value', ui.values[1])

                        }); amountprice.val("5" + sliderrange.slider("values", 0) +
                        -" - S $" + sliderrange.slider("values", 1);
                        )});
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <script src="https://kit.fontawesome.com/552b1297ac.js" crossorigin="anonymous"></script>
</main>
