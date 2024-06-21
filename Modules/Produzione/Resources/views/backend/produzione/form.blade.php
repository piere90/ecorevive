<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'codice_prodotto';
            $field_lable = label_case('prodotto');
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! field_required($required) !!}
            <select name="{{ $field_name }}" class="form-control select2" {{ $required }}>
                <option value="">{{ $field_placeholder }}</option>
                @foreach($products as $product)
                    <option value="{{ $product->n_prodotto }}" {{ $product->n_prodotto == optional($data)->codice_prodotto ? 'selected' : '' }}>{{ $product->prodotto }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'id_user';
            $field_lable = label_case('dipendente');
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! field_required($required) !!}
            <select name="{{ $field_name }}" class="form-control select2" {{ $required }}>
                <option value="">{{ $field_placeholder }}</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == optional($data)->id_user ? 'selected' : '' }}>{{ $user->first_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<x-library.select2 />
