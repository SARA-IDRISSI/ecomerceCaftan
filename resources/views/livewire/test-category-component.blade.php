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
            <input type="range" class="range-min" min="0" max="4000" step="100" wire:model='min_value'
                wire:change="handleRange($event.target.value, 'input-max')">
            <input type="range" class="range-max" min="0" max="4000" step="100" wire:model='max_value'
                wire:change="handleRange($event.target.value, 'input-max')">
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
                    border: @if (in_array(" $color:$stock", $colorsBtn)) 3px solid; @endif"
                            class="btn"></label>
                        <input id="{{ $color }}" wire:model="colorsBtn" type="checkbox" class="invisible"
                            value="{{ "$color:$stock" }}" />
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
</div>
