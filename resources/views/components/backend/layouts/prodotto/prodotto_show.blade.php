@props(["data"=>"", "module_name", "module_path", "module_title"=>"", "module_icon"=>"", "module_action"=>"", "id_prodotto"=>""])
<div class="card">
    @if ($slot != "")
    <div class="card-body">
        {{ $slot }}
    </div>
    @else
    <div class="card-body">

        <x-backend.prodotto.section-header :data="$data" :module_name="$module_name" :module_title="$module_title" :module_icon="$module_icon" :module_action="$module_action" />

        <div class="row mt-4">
            <div class="col-12">

                <x-backend.prodotto.section-show-table :data="$data" :module_name="$module_name" />

            </div>
        </div>
    </div>
    @endif

    <div class="card-footer">
        <div class="row">
            <div class="col">
                @if ($data != "")
                <small class="float-end text-muted text-end">
                    @lang('Updated at'): {{$data->updated_at->diffForHumans()}},
                    <br class="d-block d-sm-none">
                    @lang('Created at'): {{$data->created_at->isoFormat('LLLL')}}
                </small>
                @endif
            </div>
        </div>
    </div>
</div>