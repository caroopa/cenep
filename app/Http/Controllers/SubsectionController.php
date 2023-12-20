<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Subsection;

class SubsectionController extends Controller
{
	public function loadContent($id_subseccion)
	{
		$subsection = Subsection::find($id_subseccion);

		if ($subsection) {
			return $subsection;
		} else {
			throw new ModelNotFoundException('No se encontró la sección.');
		}
	}

	public function allArticles()
	{
		return Subsection::where('tipo', 'article')->get();
	}

	public function allInvs()
	{
		return Subsection::where('tipo', 'inv')->get();
	}

	public function allNullSubsections()
	{
		return Subsection::whereNull('id_seccion')->get();
	}

	public function allSubsections()
	{
		return Subsection::all();
	}

	// ADMIN
	private $type = ['subsection', 'subseccion'];

	public function addForm($id_section)
	{
		return view(
			'admin/form-subsection',
			[
				'method' => 'POST',
				'type' => $this->type,
				'belong' => app(SectionController::class)->loadContent($id_section),
			]
		);
	}

	public function editForm($id_subsection, $id_section)
	{
		$belong = app(SectionController::class)->loadContent($id_section);
		return view(
			'admin/form-subsection',
			[
				'method' => 'PUT',
				'type' => $this->type,
				'belong' => $belong,
				'element' => $this->loadContent($id_subsection),
				'sections_list' => app(SectionController::class)->sectionsBy($belong->tipo),
			]
		);
	}

	public function insert(Request $request, $id_belong)
	{
		$belong = app(SectionController::class)->loadContent($id_belong);

		if ($belong->tipo == 'normal') {
			$newSubsection = Subsection::create([
				'nombre' => $request->input('nombre'),
				'id_seccion' => $id_belong,
				'contenido' => $request->input('contenido'),
				'descripcion' => null,
				'subtitulo' => null,
				'publicaciones' => null,
				'tipo' => $belong->tipo,
			]);
		} else {
			$newSubsection = Subsection::create([
				'nombre' => $request->input('nombre'),
				'id_seccion' => $id_belong,
				'contenido' => null,
				'descripcion' => $request->input('descripcion'),
				'subtitulo' => $request->input('subtitulo'),
				'publicaciones' => $request->input('publicaciones'),
				'tipo' => $belong->tipo,
			]);
		}

		return redirect()->route('selector-section')->with([
			'tab' => $id_belong,
			'expand' => 0,
			'new' => $newSubsection->getID(),
			'new_type' => 'subsection',
			'msg' => '"' . $request->input('nombre') . '" creado exitosamente.',
		]);
	}

	public function update(Request $request, $id_element)
	{
		$subsection = $this->loadContent($id_element);

		$subsection->nombre = $request->input('nombre');
		$subsection->id_seccion = $request->input('seccion');
		if ($subsection->tipo == "normal") {
			$subsection->contenido = $request->input('contenido');
		} else {
			$subsection->descripcion = $request->input('descripcion');
			$subsection->subtitulo = $request->input('subtitulo');
			$subsection->publicaciones = $request->input('publicaciones');
		}
		// $subsection->tipo = $request->input('tipo');

		$subsection->save();

		return redirect()->route('selector-section')->with([
			'tab' => $request->input('seccion'),
			'expand' => 0,
			'new' => $id_element,
			'new_type' => 'subsection',
			'msg' => '"' . $request->input('nombre') . '" modificado exitosamente.',
		]);
	}

	public function delete(Request $request, $id_element)
	{
		$subsection = $this->loadContent($id_element);

		$name = $subsection->nombre;
		$belong = $subsection->id_seccion;

		if ($subsection->id_seccion == null) {
			$redirect = "other";
			$param = ['msg' => '"' . $name . '" eliminado exitosamente.'];
		} else {
			$redirect = "selector-section";
			$param = ['msg' => '"' . $name . '" eliminado exitosamente.', 'tab' => $belong];
		}

		$subsection->delete();

		return redirect()->route($redirect)->with($param);
	}
}
