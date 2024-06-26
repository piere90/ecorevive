@props(["data"=>"", "module_name", "id_prodotto"=>"", "formula_ingredienti"=>""])
<p>
    @lang("All values of :module_name (Id: :id)", ['module_name'=>ucwords(Str::singular($module_name)), 'id'=>$data->numero])
</p>
<table class="table table-responsive-sm table-hover table-bordered">
    <?php
    //dd($data);
    $all_columns = $data->getTableColumns();
    ?>
    <thead>
        <tr>
            <th scope="col">
                <strong>
                    @lang('Name')
                </strong>
            </th>
            <th scope="col">
                <strong>
                    @lang('Value')
                </strong>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_columns as $column)
        <tr>
            <td>
                <strong>
                    {{ __(label_case($column->name)) }}
                </strong>
            </td>
            <td>
                @if ($column->name === 'elenco_formule')
                    @if (!empty($formula_ingredienti))
                        <ul>
                            @foreach ($formula_ingredienti as $ingrediente)
                                <li>
                                    {!! $ingrediente['nome'] !!} 
                                    @if (!empty($ingrediente->pivot['quantita']))
                                        (Qt. {!! $ingrediente->pivot['quantita'] !!})
                                    @endif
                                    @if (!empty($ingrediente->pivot['herz']))
                                        ({!! $ingrediente->pivot['herz'] !!} Hz)
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No ingredients available.</p>
                    @endif
                @else
                    {!! show_column_value($data, $column) !!}
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Lightbox2 Library --}}
<x-library.lightbox />
