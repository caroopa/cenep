<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $table = 'articulo';
	protected $primaryKey = 'id_articulo';
	public $timestamps = false;

	protected $fillable = [
		'titulo_corto',
		'titulo',
		'contenido',
		'id_subseccion',
	];

	public function subsection()
	{
		return $this->belongsTo(Subsection::class, 'id_subseccion', 'id_subseccion');
	}

	public function invs()
	{
		return $this->belongsToMany(Inv::class, 'articulo_investigador', 'id_investigador', 'id_articulo');
	}

	public function getID()
	{
		return $this->id_articulo;
	}

	public function nombre()
	{
		return $this->titulo_corto;
	}

	public function type()
	{
		return "article";
	}

	public function withoutLink()
  {
    return $this->contenido == null;
  }
}
