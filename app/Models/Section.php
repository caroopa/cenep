<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
	protected $table = 'seccion';
	protected $primaryKey = 'id_seccion';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'orden',
		'tipo',
	];

	public function page()
	{
		return $this->belongsTo(Page::class, 'id_pagina', 'id_pagina');
	}

	public function subsections()
	{
		return $this->hasMany(Subsection::class, 'id_seccion', 'id_seccion');
	}

	public function getID()
  {
    return $this->id_seccion;
  }

	public function nombre()
  {
    return $this->nombre;
  }

	public function type()
	{
		return "section";
	}
}
