<?php

namespace Modules\Prodotto\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProdottosController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Prodotto';

        // module name
        $this->module_name = 'prodotto';

        // directory path of the module
        $this->module_path = 'prodotto::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Prodotto\Models\Prodotto";
    }

    /**
     * Retrieves the data for the index page of the module.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index_data()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $page_heading = label_case($module_title);
        $title = $page_heading.' '.label_case($module_action);

        $$module_name = $module_model::select('n_prodotto', 'prodotto', 'updated_at');

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;
                $data = $data->n_prodotto;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('prodotto', '<strong>{{$prodotto}}</strong>')
            ->editColumn('updated_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->updated_at);

                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                }

                return $data->updated_at->isoFormat('llll');
            })
            ->rawColumns(['prodotto', 'action'])
            ->orderColumns(['n_prodotto'], '-:column $1')
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Edit';

        $$module_name_singular = $module_model::where('n_prodotto', $id)->firstOrFail();
        $id_prodotto = $$module_name_singular->n_prodotto;

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->n_prodotto);

        return view(
            "{$module_path}.{$module_name}.edit",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', "{$module_name_singular}", "id_prodotto")
        );
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Show';

        $$module_name_singular = $module_model::where('n_prodotto', $id)->firstOrFail();
        $id_prodotto = $$module_name_singular->n_prodotto;

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->n_prodotto);

        return view(
            "{$module_path}.{$module_name}.show",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action', "{$module_name_singular}", "id_prodotto")
        );
    }

    /**
     * Updates a resource.
     *
     * @param  int  $id
     * @param  Request  $request  The request object.
     * @param  mixed  $id  The ID of the resource to update.
     * @return Response
     * @return RedirectResponse The redirect response.
     *
     * @throws ModelNotFoundException If the resource is not found.
     */
    public function update(Request $request, $id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        $$module_name_singular = $module_model::where('n_prodotto', $id)->firstOrFail();

        $$module_name_singular->update($request->all());

        flash(Str::singular($module_title)."' Updated Successfully")->success()->important();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->n_prodotto);

        return redirect()->route("backend.{$module_name}.show", $$module_name_singular->n_prodotto);
    }
}
