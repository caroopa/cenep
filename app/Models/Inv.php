<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inv extends Model
{
  protected $table = 'investigador';
  protected $primaryKey = 'id_investigador';
  public $timestamps = false;

  protected $fillable = [
    'nombre',
    'mail',
    'cv',
    'descripcion',
    'publicaciones',
    'investigaciones',
    'id_subseccion',
  ];

  public function subsection()
  {
    return $this->belongsTo(Subsection::class, 'id_subseccion', 'id_subseccion');
  }

  public function articles()
  {
    return $this->belongsToMany(Article::class, 'articulo_investigador', 'id_investigador', 'id_articulo');
  }

  public function getID()
  {
    return $this->id_investigador;
  }

  public function nombre()
  {
    return $this->nombre;
  }

  public function type()
  {
    return "inv";
  }

  public function hasArticle($id_article)
  {
    return $this->articles->contains($id_article);
  }

  public function withoutLink()
  {
    return $this->mail == null && $this->cv == null && $this->descripcion == null && $this->publicaciones == null && $this->investigaciones == null;
  }
}
