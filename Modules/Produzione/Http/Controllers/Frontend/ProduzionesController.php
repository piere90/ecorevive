<?php

namespace Modules\Produzione\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendBaseController;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Traits\ProgressivoTrait;
use Illuminate\Support\Str;
use Modules\Prodotto\Models\Prodotto; // Assicurati di avere il modello Prodotto
use Modules\Produzione\Models\Produzione;
use App\Models\User;

class ProduzionesController extends FrontendBaseController
{
    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;

    public $module_model;

    use ProgressivoTrait;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Produzione';

        // module name
        $this->module_name = 'produzione';

        // directory path of the module
        $this->module_path = 'produzione::frontend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Produzione\Models\Produzione";
    }

        /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = $module_model::latest()->paginate();

        return view(
            "$module_path.$module_name.index",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_action', 'module_name_singular')
        );
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

        // Calcola il progressivo utilizzando il trait
        $progressivo = $this->calculateProgressivo(Produzione::class);

        logUserAccess($module_title.' '.$module_action);

        return view(
            "{$module_path}.{$module_name}.create",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action', 'products', 'users', 'progressivo')
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
        // Aggiungi il progressivo alla richiesta utilizzando il trait
        $request = $this->addProgressivoToRequest($request, Produzione::class);

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

        return redirect("produzione/create");
    }
}
