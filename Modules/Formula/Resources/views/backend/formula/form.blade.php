<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'id_prodotto';
            $field_lable = label_case('prodotto');
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! field_required($required) !!}
            <select name="{{ $field_name }}" class="form-control select2" {{ $required }}>
                <option value="">{{ $field_placeholder }}</option>
                @foreach($products as $product)
                    <option value="{{ $product->n_prodotto }}" {{ $product->n_prodotto == optional($data)->id_prodotto ? 'selected' : '' }}>{{ $product->prodotto }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <?php
            //dd($data);
            $field_name = 'versione';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "required";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            <input type="number" name="{{ $field_name }}" value="{{ isset($data->versione) ? $data->versione : '1' }}" class="form-control" readonly {{ $required }}>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-3">
        <div class="form-group">
            {{ html()->label('Ingredienti')->class('form-label') }}
            @for($i = 0; $i < 10; $i++)
                <div class="row mb-3">
                    <div class="col-4">
                        <select name="ingredienti[{{ $i }}][id]" class="form-control select2">
                            <option value="">{{ __('Seleziona Ingrediente') }}</option>
                            @foreach($ingredienti as $ingrediente)
                                <option value="{{ $ingrediente->id }}" {{ isset($formula_ingredienti[$i]) && $formula_ingredienti[$i]['id'] == $ingrediente->id ? 'selected' : '' }}>
                                    {{ $ingrediente->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2">
                        <input type="number" name="ingredienti[{{ $i }}][quantita]" class="form-control" placeholder="Quantità" step="0.01" value="{{ isset($formula_ingredienti[$i]) ? $formula_ingredienti[$i]->pivot['quantita'] : '' }}">
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>


<x-library.select2 />
