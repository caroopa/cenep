<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Inv;
use App\Models\Section;
use App\Models\Subsection;

class InvController extends Controller
{
  public function sectionByInv($id_inv)
  {
    $section = Section::whereHas('subsections.invs', function ($query) use ($id_inv) {
      $query->where('id_investigador', $id_inv);
    })->first();

    if ($section) {
      return $section;
    } else {
      throw new ModelNotFoundException('No se encontró la sección.');
    }
  }

  public function subsectionByInv($id_inv)
  {
    $subsection = Subsection::whereHas('invs', function ($query) use ($id_inv) {
      $query->where('id_investigador', $id_inv);
    })->first();

    if ($subsection) {
      return $subsection;
    } else {
      throw new ModelNotFoundException('No se encontró la sección.');
    }
  }

  public function loadContent($id_inv)
  {
    $inv = Inv::find($id_inv);

    if ($inv) {
      return $inv;
    } else {
      throw new ModelNotFoundException('No se encontró la sección.');
    }
  }

  public function allNullInvs()
  {
    return Inv::whereNull('id_subseccion')->get();
  }

  // ADMIN

  private $type = ['inv', 'investigador'];

  public function addForm($id_subsection)
  {
    return view(
      'admin/form-inv',
      [
        'method' => 'POST',
        'type' => $this->type,
        'belong' => app(SubsectionController::class)->loadContent($id_subsection),
        'section' => app(SectionController::class)->loadContent(3)
      ]
    );
  }

  public function editForm($id_inv, $id_subsection)
  {
    return view(
      'admin/form-inv',
      [
        'method' => 'PUT',
        'type' => $this->type,
        'belong' => app(SubsectionController::class)->loadContent($id_subsection),
        'element' => $this->loadContent($id_inv),
        'subsections' => app(SubsectionController::class)->allInvs(),
        'section' => app(SectionController::class)->loadContent(3)
      ]
    );

  }

  public function insert(Request $request, $id_belong)
  {
    if ($request->hasFile('cv')) {
      $cvFile = $request->file('cv');
      $cvFileName = $cvFile->getClientOriginalName();
      $cvFile->move(base_path('../public_html/docs'), $cvFileName);

      $newInv = Inv::create([
        'nombre' => $request->input('nombre'),
        'mail' => $request->input('mail'),
        'cv' => $cvFileName,
        'descripcion' => $request->input('descripcion'),
        'publicaciones' => $request->input('publicaciones'),
        'investigaciones' => $request->input('investigaciones'),
        'id_subseccion' => $id_belong,
      ]);
    } else {
      $newInv = Inv::create([
        'nombre' => $request->input('nombre'),
        'mail' => $request->input('mail'),
        'cv' => "",
        'descripcion' => $request->input('descripcion'),
        'publicaciones' => $request->input('publicaciones'),
        'investigaciones' => $request->input('investigaciones'),
        'id_subseccion' => $id_belong,
      ]);
    }

    $articlesSelected = $request->input('articulos', []);

    $newInv->articles()->attach($articlesSelected);

    $subsection = app(SubsectionController::class)->loadContent($id_belong);
    $id_section = $subsection->id_seccion;

    return redirect()->route('selector-section')->with([
      'tab' => $id_section,
      'expand' => $id_belong,
      'new' => $newInv->getID(),
      'new_type' => 'inv',
      'msg' => '"' . $request->input('nombre') . '" creado exitosamente.',
    ]);
  }

  public function update(Request $request, $id_element)
  {
    $inv = $this->loadContent($id_element);

    $inv->nombre = $request->input('nombre');
    $inv->mail = $request->input('mail');
    $inv->descripcion = $request->input('descripcion');
    $inv->publicaciones = $request->input('publicaciones');
    $inv->investigaciones = $request->input('investigaciones');
    $inv->id_subseccion = $request->input('subseccion');

    if ($request->hasFile('cv')) {
      $cvFile = $request->file('cv');
      $cvFileName = $cvFile->getClientOriginalName();
      $cvFile->move(base_path('../public_html/docs'), $cvFileName);
      $inv->cv = $cvFileName;
    }

    $inv->save();

    $articlesSelected = $request->input('articulos', []);

    $inv->articles()->sync($articlesSelected);

    $subsection = app(SubsectionController::class)->loadContent($request->input('subseccion'));
    $id_section = $subsection->id_seccion;

    return redirect()->route('selector-section')->with([
      'tab' => $id_section,
      'expand' => $request->input('subseccion'),
      'new' => $id_element,
      'new_type' => 'inv',
      'msg' => '"' . $request->input('nombre') . '" modificado exitosamente.',
    ]);
  }

  public function delete(Request $request, $id_element)
  {
    $inv = $this->loadContent($id_element);

    $name = $inv->nombre;

    if ($inv->id_subseccion == null) {
      $redirect = "other";
      $param = ['msg' => '"' . $name . '" eliminado exitosamente.'];
    } else {
      $subsection = app(SubsectionController::class)->loadContent($inv->id_subseccion);
      $belong = $subsection->id_seccion;
      $redirect = "selector-section";
      $param = ['msg' => '"' . $name . '" eliminado exitosamente.', 'tab' => $belong];
    }

    $inv->delete();

    return redirect()->route($redirect)->with($param);
  }
}