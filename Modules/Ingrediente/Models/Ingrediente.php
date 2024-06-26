<?php

namespace Modules\Ingrediente\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingrediente extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nome', 
        'created_by', 
        'updated_by', 
        'deleted_by'
    ];

    protected $table = 'ingrediente';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Ingrediente\database\factories\IngredienteFactory::new();
    }

    public function formule()
    {
        return $this->belongsToMany(Formula::class, 'formula_ingredienti', 'id_ingrediente', 'id_formula')
                    ->withPivot('quantita', 'herz', 'created_at', 'updated_at')
                    ->withTimestamps();
    }
}
