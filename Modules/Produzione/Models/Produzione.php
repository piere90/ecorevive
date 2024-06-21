<?php

namespace Modules\Produzione\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produzione extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'produzione';

    protected $fillable = [
        'created_by',
        'updated_by', 
        'deleted_by',
        'codice_prodotto', 
        'id_user',// other fillable fields
    ];

    // Specifica la chiave primaria
    protected $primaryKey = 'numero_produzione';


    public function prodotto()
    {
        return $this->belongsTo('Modules\Prodotto\Models\Prodotto', 'codice_prodotto', 'n_prodotto');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user', 'id');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Produzione\database\factories\ProduzioneFactory::new();
    }
}
