<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subsection extends Model
{
	protected $table = 'subseccion';
	protected $primaryKey = 'id_subseccion';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'id_seccion',
		'contenido',
		'descripcion',
		'subtitulo',
		'publicaciones',
		'tipo',
	];

	public function section()
	{
		return $this->belongsTo(Section::class, 'id_seccion', 'id_seccion');
	}

	public function articles()
	{
		return $this->hasMany(Article::class, 'id_subseccion', 'id_subseccion')->orderBy('created_at', 'desc')
			->orderBy('id_articulo', 'asc');
	}

	public function invs()
	{
		return $this->hasMany(Inv::class, 'id_subseccion', 'id_subseccion')->orderBy('nombre', 'asc');
	}

	public function getID()
	{
		return $this->id_subseccion;
	}

	public function nombre()
	{
		return $this->nombre;
	}

	public function type()
	{
		return "subsection";
	}

	public function hasChildren()
	{
		return !$this->articles->isEmpty() || !$this->invs->isEmpty();
	}

	public function children()
	{
		if ($this->tipo == "article") {
			return $this->articles();
		} else {
			return $this->invs();
		}
	}
}
