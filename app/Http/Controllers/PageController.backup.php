<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;

class PageController extends Controller
{
	public function loadIndex()
	{
		return Page::find(1);
	}

	public function footerContent()
	{
		return Page::find(1)->contacto;
	}

	// ADMIN

	private $type = ['index', 'home'];

	public function editForm()
	{
		$msg = session()->pull('msg');
		return view(
			'admin/form-index',
			[
				'method' => 'PUT',
				'type' => $this->type,
				'element' => $this->loadIndex(),
				'msg' => $msg
			]
		);
	}

	public function update(Request $request)
	{
		$index = $this->loadIndex();

		$index->titulo = $request->input('titulo');
		$index->presentacion = $request->input('presentacion');
		$index->contacto = $request->input('contacto');

    if ($request->hasFile('imagen')) {
      $img = $request->file('imagen');
      $imgName = $img->getClientOriginalName();
      $img->move(base_path('../public_html/img/index'), $imgName);
      $index->imagen = $imgName;
    }

		$index->save();
		return redirect()->route('edit-index')->with('msg', 'Home editado exitosamente.');;
	}
}