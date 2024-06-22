@props(["data"=>"", "module_name", "module_path", "module_title"=>"", "module_icon"=>"", "module_action"=>"", "products"=>"", "users"=>"", "progressivo"=>""])
<div id="card-produzione" class="card">
    <div class="card-body">
        <div class="row mt-4">
            <div class="col">
                {{ html()->form('POST', route("frontend.$module_name.store"))->class('form')->acceptsFiles()->open() }}

                @include ("$module_path.$module_name.form")

                <div class="row">
                    <div class="col-6">
                        <x-backend.buttons.create>Create</x-backend.buttons.create>
                    </div>
                    <div class="col-6">
                        <div class="float-end">
                            <x-backend.buttons.cancel />
                        </div>
                    </div>
                </div>

                {{ html()->form()->close() }}
            </div>
        </div>
    </div>

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