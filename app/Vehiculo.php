<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public $timestamps = false;

  //relaciones un  vehiculo pertenece a un cliente
  public function cliente()
  {
    return $this->belongsTo(Cliente::class); //pertenece a 
  }
}
