<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	protected $table = 'pagina';
	protected $primaryKey = 'id_pagina';
	public $timestamps = false;

	protected $fillable = [
		'titulo',
		'presentacion',
		'imagen',
		'contacto',
	];

	public function sections()
	{
		return $this->hasMany(Section::class, 'id_pagina');
	}

	public function getID()
	{
		return $this->id_pagina;
	}

	public function nombre()
	{
		return $this->titulo;
	}

	public function type()
	{
		return "index";
	}
}
