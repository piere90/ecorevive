<?php

namespace Modules\Prodotto\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prodotto extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'prodotto';

    // Specifica la chiave primaria
    protected $primaryKey = 'n_prodotto';

    // Definisci i campi riempibili
    protected $fillable = [
        'prodotto', 
        'created_by', 
        'updated_by', 
        'deleted_by'
    ];

    public function produzioni()
    {
        return $this->hasMany('Modules\Produzione\Models\Produzione', 'codice_prodotto', 'n_prodotto');
    }

    public function formule()
    {
        return $this->hasMany('Modules\Formula\Models\Formula', 'id_prodotto', 'n_prodotto');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Prodotto\database\factories\ProdottoFactory::new();
    }
}
