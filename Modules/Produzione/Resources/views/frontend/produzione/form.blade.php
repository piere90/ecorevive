<div class="row">
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
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'data_reale';
            $field_lable = label_case('data e ora');
            $field_placeholder = $field_lable;
            $required = "required";
            $current_datetime = now()->format('Y-m-d\TH:i:s');
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! field_required($required) !!}
            <input type="datetime-local" name="{{ $field_name }}" class="form-control" value="{{ $current_datetime }}" {{ $required }}>
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'codice_prodotto';
            $field_lable = label_case('codice prodotto');
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
    <!-- Campo Progressivo Sacco -->
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'progressivo';
            $field_lable = label_case('progressivo');
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! field_required($required) !!}
            <input type="number" name="{{ $field_name }}" class="form-control" value="{{ $progressivo }}" readonly {{ $required }}>
        </div>
    </div>
    <!-- Campo Peso -->
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'peso';
            $field_lable = label_case('peso sacco');
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! field_required($required) !!}
            <input type="number" name="{{ $field_name }}" class="form-control" placeholder="{{ $field_placeholder }}" value="{{ old($field_name, optional($data)->peso) }}" {{ $required }}>
        </div>
    </div>
    <!-- Campo Note -->
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'note';
            $field_label = label_case('Note');
            $field_placeholder = $field_label;
            $required = "";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            <textarea name="{{ $field_name }}" class="form-control" placeholder="{{ $field_placeholder }}" {{ $required }}>{{ old($field_name, optional($data)->note) }}</textarea>
        </div>
    </div>
</div>

<x-library.select2 />
