<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Section;
use App\Models\Subsection;

class SectionController extends Controller
{
	public function loadContent($id_section)
	{
		return Section::find($id_section);
	}

	public function loadHeaderData()
	{
		$id_page = 1;
		return Section::with('subsections')->where('id_pagina', $id_page)->get();
	}

	public function subsectionByID($id_subsection)
	{
		return Subsection::find($id_subsection);
	}

	public function sectionBySubsection($id_subsection)
	{
		$subsection = $this->subsectionByID($id_subsection);

		if ($subsection) {
				return $subsection->section;
		} else {
				throw new ModelNotFoundException('No se encontró la sección.');
		}
	}

	public function sectionsBy($type)
	{
		return Section::where('tipo', $type)->get();
	}

	public function allSections()
	{
		return Section::all();
	}

	// ADMIN
	private $type = ['section', 'seccion'];

	public function addForm()
	{
		return view(
			'admin/form-section',
			[
				'method' => 'POST',
				'type' => $this->type,
			]
		);
	}

	public function editForm($id_section)
	{
		return view(
			'admin/form-section',
			[
				'method' => 'PUT',
				'type' => $this->type,
				'element' => $this->loadContent($id_section),
			]
		);
	}

	public function insert(Request $request)
	{
		$newSection = Section::create([
			'nombre' => $request->input('nombre'),
			'tipo' => $request->input('tipo'),
			'orden' => 0
		]);
		$newSection->update(['orden' => $newSection->getID()]);

		return redirect()->route('selector-section')->with([
			'tab' => $newSection->getID(),
			'msg' => '"' . $request->input('nombre') . '" creado exitosamente.',
		]);
	}

	public function update(Request $request, $id_element)
	{
		$section = $this->loadContent($id_element);

		$section->nombre = $request->input('nombre');
		// $section->tipo = $request->input('tipo');
		$section->orden = $section->getID();

		$section->save();

		return redirect()->route('selector-section')->with([
			'tab' => $section->getID(),
			'msg' => '"' . $request->input('nombre') . '" modificado exitosamente.',
		]);
	}

	public function delete(Request $request, $id_element)
	{
		$section = $this->loadContent($id_element);
		$name = $section->nombre;
		$section->delete();
		return redirect()->route('selector-section')->with(['msg' => '"' . $name . '" eliminado exitosamente.']);
	}
}