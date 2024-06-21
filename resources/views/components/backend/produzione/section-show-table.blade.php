@props(["data"=>"", "module_name"])
<p>
    @lang("All values of :module_name (Id: :id)", ['module_name'=>ucwords(Str::singular($module_name)), 'id'=>$data->id])
</p>
<table class="table table-responsive-sm table-hover table-bordered">
    <?php
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
                @if ($column->name == 'codice_prodotto')
                    {{ $data->prodotto->prodotto }}
                @elseif ($column->name == 'id_user')
                    {{ $data->user->first_name }}
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