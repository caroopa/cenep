<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Article;
use App\Models\Section;
use App\Models\Subsection;

class ArticleController extends Controller
{
  public function sectionByArticle($id_article)
  {
    $section = Section::whereHas('subsections.articles', function ($query) use ($id_article) {
      $query->where('id_articulo', $id_article);
    })->first();

    if ($section) {
      return $section;
    } else {
      throw new ModelNotFoundException('No se encontró la sección.');
    }
  }

  public function subsectionByArticle($id_article)
  {
    $subsection = Subsection::whereHas('articles', function ($query) use ($id_article) {
      $query->where('id_articulo', $id_article);
    })->first();

    if ($subsection) {
      return $subsection;
    } else {
      throw new ModelNotFoundException('No se encontró la sección.');
    }
  }

  public function loadContent($id_article)
  {
    $article = Article::find($id_article);

    if ($article) {
      return $article;
    } else {
      throw new ModelNotFoundException('No se encontró la sección.');
    }
  }

  public function allNullArticles()
  {
    return Article::whereNull('id_subseccion')->get();
  }

  // ADMIN
  private $type = ['article', 'investigación'];

  public function addForm($id_subsection)
  {
    return view(
      'admin/form-article',
      [
        'method' => 'POST',
        'type' => $this->type,
        'belong' => app(SubsectionController::class)->loadContent($id_subsection),
      ]
    );
  }

  public function editForm($id_article, $id_subsection)
  {
    return view(
      'admin/form-article',
      [
        'method' => 'PUT',
        'type' => $this->type,
        'belong' => app(SubsectionController::class)->loadContent($id_subsection),
        'element' => $this->loadContent($id_article),
        'subsections' => app(SubsectionController::class)->allArticles()
      ]
    );
  }

  public function insert(Request $request, $id_belong)
  {
    $newArticle = Article::create([
      'titulo_corto' => $request->input('titulo_corto'),
      'titulo' => $request->input('titulo'),
      'contenido' => $request->input('contenido'),
      'id_subseccion' => $id_belong,
    ]);

    $subsection = app(SubsectionController::class)->loadContent($id_belong);
    $id_section = $subsection->id_seccion;

    return redirect()->route('selector-section')->with([
      'tab' => $id_section,
      'expand' => $id_belong,
      'new' => $newArticle->getID(),
      'new_type' => 'article',
      'msg' => '"' . $request->input('titulo_corto') . '" creado exitosamente.',
    ]);
  }

  public function update(Request $request, $id_element)
  {
    $article = $this->loadContent($id_element);

    $article->titulo = $request->input('titulo');
    $article->titulo_corto = $request->input('titulo_corto');
    $article->contenido = $request->input('contenido');
    $article->id_subseccion = $request->input('subseccion');

    $article->save();

    $subsection = app(SubsectionController::class)->loadContent($request->input('subseccion'));
    $id_section = $subsection->id_seccion;

    return redirect()->route('selector-section')->with([
      'tab' => $id_section,
      'expand' => $request->input('subseccion'),
      'new' => $id_element,
      'new_type' => 'article',
      'msg' => '"' . $request->input('titulo_corto') . '" modificado exitosamente.',
    ]);
  }

  public function delete(Request $request, $id_element)
  {
    $article = $this->loadContent($id_element);

    $name = $article->titulo_corto;

    if ($article->id_subseccion == null) {
      $redirect = "other";
      $param = ['msg' => '"' . $name . '" eliminado exitosamente.'];
    } else {
      $subsection = app(SubsectionController::class)->loadContent($article->id_subseccion);
      $belong = $subsection->id_seccion;
      $redirect = "selector-section";
      $param = ['msg' => '"' . $name . '" eliminado exitosamente.', 'tab' => $belong];
    }

    $article->delete();

    return redirect()->route($redirect)->with($param);
  }
}