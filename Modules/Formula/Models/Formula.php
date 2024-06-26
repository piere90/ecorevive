<?php

namespace Modules\Formula\Models;

use App\Models\BaseModel;
use Modules\Ingrediente\Models\Ingrediente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formula extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'formula';
    protected $primaryKey = 'numero'; // Specifica la chiave primaria

    protected $fillable = [
        'data', 
        'prodotto', 
        'id_prodotto', 
        'versione', 
        'created_by', 
        'updated_by', 
        'deleted_by'
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Formula\database\factories\FormulaFactory::new();
    }

    public function prodotto()
    {
        return $this->belongsTo('Modules\Prodotto\Models\Prodotto', 'id_prodotto', 'n_prodotto');
    }

    public function ingredienti()
    {
        return $this->belongsToMany(Ingrediente::class, 'formula_ingredienti', 'id_formula', 'id_ingrediente')
                    ->withPivot('quantita', 'created_at', 'updated_at')
                    ->withTimestamps();
    }
}
