<div class="modal fade" id="modalDelete{{ $element->type() . $element->getID() }}" data-bs-backdrop="static"
  data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <p>¿Está seguro que desea eliminar "{{ $element->nombre() }}"?
        <br>
        Esta acción no podrá revertirse.
      </p>
      @if ($element->type() == 'section')
        @if (!$element->subsections->isEmpty())
          <p><span class="warning">ATENCIÓN</span><br>Esta sección tiene subsecciones vinculadas. Si la eliminas quedarán
            en la papelera.</p>
        @endif
      @elseif ($element->type() == 'subsection')
        @if ($element->hasChildren())
          @if (request()->route()->getName() == 'other')
            <p><span class="warning">ATENCIÓN</span><br>Esta subsección tiene artículos o investigadores vinculados. Si
              la eliminas también quedarán en este apartado porque ya no estarán vinculados a una subsección.</p>
          @else
            <p><span class="warning">ATENCIÓN</span><br>Esta subsección tiene artículos o investigadores vinculados. Si
              la eliminas quedarán en la papelera.</p>
          @endif
        @endif
      @endif
      <div class="botones">
        <button class="btn btn-outline-primary" data-bs-dismiss="modal" aria-label="Close">
          Cancelar</button>
        <form action="{{ route('remove-' . $element->type(), ['id_element' => $element->getID()]) }}" method="POST">
          @csrf
          @method('DELETE')
          <button class="btn btn-primary" type="submit">Aceptar</button>
        </form>
      </div>
    </div>
  </div>
</div>
