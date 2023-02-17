<div class="col-12">
    <div class="form-check form-switch">
        <input wire:model="checked" class="form-check-input" type="checkbox" name="promo" id="flexSwitchCheckDefault"
            value="1">
        <label class="form-check-label" for="flexSwitchCheckDefault">Promo</label>
    </div>
    <div class="row">
        <div class="col-6">
            <label for="" class="form-label">Prix Actuel</label>
            @if ($prix_actuel)
                <input value="{{ $prix_actuel }}" type="text" name="prixactuel" id="" class="form-control">
            @else
                <input value="" type="text" name="prixactuel" id="" class="form-control">
            @endif
        </div>
        @if ($checked)
            <div class="col-6">
                <label for="" class="form-label">Prix Promo</label>

                @if ($prix_promotion)
                    <input value="{{ $prix_promotion }}" type="text" name="prixpromotion" id=""
                        class="form-control">
                @else
                    <input value="" type="text" name="prixpromotion" id="" class="form-control">
                @endif
            </div>
        @endif
    </div>
</div>
