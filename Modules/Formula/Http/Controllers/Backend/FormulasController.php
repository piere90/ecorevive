<?php

namespace Modules\Formula\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Modules\Prodotto\Models\Prodotto;
use Modules\Ingrediente\Models\Ingrediente;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class FormulasController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Formula';

        // module name
        $this->module_name = 'formula';

        // directory path of the module
        $this->module_path = 'formula::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Formula\Models\Formula";
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

        // Query per ottenere i dati
        $data = $module_model::with('ingredienti', 'prodotto')->get();

        return Datatables::of($data)
            ->addColumn('ingredienti', function ($formula) {
                return $formula->ingredienti->map(function ($ingrediente) {
                    $hertzString = isset($ingrediente->pivot->herz) ? ' (' . $ingrediente->pivot->herz . ' Hz.)' : '';
                    return $ingrediente->nome . ' (Qt. ' . $ingrediente->pivot->quantita . ')'.$hertzString;
                })->implode('<br>');
            })
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;
                $data = $data->numero;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('prodotto', function ($data) {
                return '<strong>' . $data->prodotto . '</strong>';
            })
            ->editColumn('updated_at', function ($data) {
                return Carbon::parse($data->updated_at)->diffForHumans();
            })
            ->rawColumns(['prodotto', 'action', 'ingredienti'])
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

        //recupero la lista degli ingredienti
        $ingredienti = Ingrediente::all();

        logUserAccess($module_title.' '.$module_action);

        return view(
            "{$module_path}.{$module_name}.create",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action', 'products', 'ingredienti')
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

        // Valida la richiesta
        $request->validate([
            'id_prodotto' => 'required|exists:prodotto,n_prodotto',
            'versione' => 'required|integer',
            'ingredienti' => 'required|array',
        ]);

        // Crea la nuova formula
        $$module_name_singular = $module_model::create([
            'data' => now(),
            'prodotto' => Prodotto::find($request->id_prodotto)->prodotto,
            'id_prodotto' => $request->id_prodotto,
            'versione' => $request->versione,
        ]);

        // Aggiungi gli ingredienti
        foreach ($request->ingredienti as $ingrediente) {
            if (!empty($ingrediente['id'])) {
                $data = [
                    'quantita' => $ingrediente['quantita'] ?? null,
                    'herz' => $ingrediente['herz'] ?? null,
                ];
                $$module_name_singular->ingredienti()->attach($ingrediente['id'], $data);
            }
        }

        flash("New '".Str::singular($module_title)."' Added")->success()->important();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->numero);

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

        // Recupera la formula con gli ingredienti associati
        $formula = $module_model::with('ingredienti', 'prodotto')->where('numero', $id)->firstOrFail();

        // Aggiungi log per debug
        Log::info('Data retrieved:', $formula->toArray());

        $formula_ingredienti = $formula->ingredienti;

        //recupero la lista di prodotti
        $products = Prodotto::all();

        //recupero la lista degli ingredienti
        $ingredienti = Ingrediente::all();

        $id_formula = $formula->numero;

        logUserAccess($module_title.' '.$module_action.' | Id: '.$id_formula);

        return view(
            "{$module_path}.{$module_name}.edit",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', "{$module_name_singular}", "id_formula", 'products', 'ingredienti', 'formula_ingredienti')
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

        // Valida la richiesta
        $request->validate([
            'id_prodotto' => 'required|exists:prodotto,n_prodotto',
            'ingredienti' => 'required|array',
        ]);

        // Recupera la formula
        $formula = $module_model::with('ingredienti', 'prodotto')->where('numero', $id)->firstOrFail();

        //verifico se devo aumentare la versione della formula
        $this->updateVersioneFormula($formula, $request);

        // Aggiorna i campi della formula
        $formula->update([
            'id_prodotto' => $request->input('id_prodotto'),
            'prodotto' => Prodotto::find($request->id_prodotto)->prodotto,
            'versione' => $formula->versione,
            'updated_at' => now(),
        ]);

        // Sincronizza gli ingredienti
        $ingredienti = [];
        foreach ($request->ingredienti as $ingrediente) {
            if (!empty($ingrediente['id']) && !empty($ingrediente['quantita'])) {
                $ingredienti[$ingrediente['id']] = [
                    'quantita' => $ingrediente['quantita'],
                    'herz' => $ingrediente['herz']
                ];
            }
        }
        $formula->ingredienti()->sync($ingredienti);

        flash(Str::singular($module_title)."' Updated Successfully")->success()->important();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$id);

        return redirect()->route("backend.{$module_name}.show", $id);
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

        // Recupera la formula con gli ingredienti associati
        $formula = $module_model::with('ingredienti')->where('numero', $id)->firstOrFail();

        $formula_ingredienti = $formula->ingredienti;

        $id_formula = $formula->numero;

        logUserAccess($module_title.' '.$module_action.' | Id: '.$id_formula);
        
        return view(
            "{$module_path}.{$module_name}.show",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action', "{$module_name_singular}", "id_formula", 'formula_ingredienti')
        );
    }

    private function updateVersioneFormula($formula, $request)
    {
        // Controlla se il prodotto è stato modificato
        $productChanged = $formula->id_prodotto != $request->input('id_prodotto');

        // Controlla se gli ingredienti sono stati modificati
        $existingIngredients = $formula->ingredienti->pluck('pivot.quantita', 'pivot.herz', 'pivot.id_ingrediente')->toArray();
        $newIngredients = [];
        foreach ($request->ingredienti as $ingrediente) {
            if (!empty($ingrediente['id']) && !empty($ingrediente['quantita'])) {
                $newIngredients[$ingrediente['id']] = [
                    'quantita' => $ingrediente['quantita'],
                    'herz' => $ingrediente['herz']
                ];
                
            }
        }

        $ingredientsChanged = $existingIngredients != $newIngredients;

        // Se gli ingredienti sono cambiati e il prodotto non è cambiato, incrementa la versione
        if ($ingredientsChanged && !$productChanged) {
            $formula->versione += 1;
        }

        return $formula;
    }

}
