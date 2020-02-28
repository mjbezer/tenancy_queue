<?php

namespace AtitudeAgenda\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use AtitudeAgenda\Http\Controllers\ParametroController;
use AtitudeAgenda\User;
use Illuminate\Support\Facades\Auth;

  class Categoria extends Model
{
    use SoftDeletes;

    protected $connection = 'tenant';
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $fillable =  ['descricao', 'flag_pagar', 'flag_receber'];

    public function subCategoria()
    {
      return $this->hasMany(SubCategoria::class, 'categoria_id', 'id' );
    }

    public function licenciado()
    {
      return $this->hasOne(User::class, 'licenciado_id', 'licenciado_id');
    }
    
}