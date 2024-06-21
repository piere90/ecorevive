<?php

namespace Modules\Produzione\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Modules\Prodotto\Models\Prodotto; // Assicurati di avere il modello Prodotto
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ProduzionesController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Produzione';

        // module name
        $this->module_name = 'produzione';

        // directory path of the module
        $this->module_path = 'produzione::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Produzione\Models\Produzione";
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

        // carica qui le relazioni
        $$module_name = $module_model::with(['prodotto', 'user'])->select(
            'numero_produzione',
            'data_reale',
            'data',
            'codice_prodotto',
            'id_user',
            'progressivo',
            'peso',
            'versione',
            'note',
            'fila',
            'stato',
            'codice_univoco',
            'data_spedizione',
            'cliente',
            'created_at',
            'updated_at'
        );

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('codice_prodotto', function ($data) {
                return $data->prodotto ? $data->prodotto->prodotto : '';
            })
            ->addColumn('id_user', function ($data) {
                return $data->user ? $data->user->first_name : '';
            })
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;
                $data = $data->numero_produzione;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('updated_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->updated_at);

                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                }

                return $data->updated_at->isoFormat('llll');
            })
            ->rawColumns(['codice_prodotto', 'action'])
            ->orderColumns(['numero_produzione'], '-:column $1')
            ->make(true);
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Create';

        //recupero la lista di prodotti
        $products = Prodotto::all();

        //recupero la lista di utenti
        $users = User::all();

        logUserAccess($module_title.' '.$module_action);

        return view(
            "{$module_path}.{$module_name}.create",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action', 'products', 'users')
        );
    }

        /**
     * Store a new resource in the database.
     *
     * @param  Request  $request  The request object containing the data to be stored.
     * @return RedirectResponse The response object that redirects to the index page of the module.
     *
     * @throws Exception If there is an error during the creation of the resource.
     */
    public function store(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Store';

        $$module_name_singular = $module_model::create($request->all());

        flash("New '".Str::singular($module_title)."' Added")->success()->important();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->numero_produzione);

        return redirect("admin/{$module_name}");
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

        $$module_name_singular = $module_model::where('numero_produzione', $id)->firstOrFail();
        $id_produzione = $$module_name_singular->numero_produzione;

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->numero_produzione);

        //recupero la lista di prodotti
        $products = Prodotto::all();

        //recupero la lista di utenti
        $users = User::all();
        
        return view(
            "{$module_path}.{$module_name}.edit",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', "{$module_name_singular}", "id_produzione", "products", "users")
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

        $$module_name_singular = $module_model::with(['prodotto', 'user'])->where('numero_produzione', $id)->firstOrFail();
        $id_produzione = $$module_name_singular->numero_produzione;

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->numero_produzione);

        //recupero la lista di prodotti
        $products = Prodotto::all();

        //recupero la lista di utenti
        $users = User::all();
        
        return view(
            "{$module_path}.{$module_name}.show",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action', "{$module_name_singular}", "id_produzione", "products", "users")
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

        $$module_name_singular = $module_model::where('numero_produzione', $id)->firstOrFail();

        $$module_name_singular->update($request->all());

        flash(Str::singular($module_title)."' Updated Successfully")->success()->important();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->numero_produzione);

        return redirect()->route("backend.{$module_name}.show", $$module_name_singular->numero_produzione);
    }

}
