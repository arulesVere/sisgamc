<!-- Modal -->
<div class="modal fade" id="deleteModal{{$qp->idfolder}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form id="demo-form2" action="/Prestamo/{{$qp->idfolder}}" method="Post" data-parsley-validate class="form-horizontal form-label-left">
  @csrf    
  @method('PUT')
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">ACTUALIZAR PRESTAMO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ESTA SEGURO DE DEVOLVER FOLDER A ALMACEN: 
        </br></br>
        <div  class="text-center">
            <strong>{{"CODIGO: ".$qp->codigofolder."  ASIGNADO A: ".$qp->aquien}}</strong>
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