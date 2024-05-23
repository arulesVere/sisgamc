<!-- Modal -->
<div class="modal fade" id="deleteModal{{$allv->idempastado}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form id="demo-form2" action="/Vehiculo/{{$allv->idempastado}}" method="Post" data-parsley-validate class="form-horizontal form-label-left">
  @csrf
  @method('DELETE')
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">DAR BAJA EMPASTADO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ESTA SEGURO DE ELIMINAR EL REGISTRO: 
        </br></br>
        <div  class="text-center">
            <strong>{{"CODIGO: ".$allv->codigo." NUMERO: ".$allv->numero}}</strong>
        </div>
        </br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
        <button type="submit" class="btn btn-primary">GUARDAR</button>
      </div>
    </div>
    </form>
  </div>
</div>