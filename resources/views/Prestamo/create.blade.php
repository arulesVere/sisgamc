<!-- Modal -->
<div class="modal fade" id="prestamoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <form class="form-horizontal" action="/Prestamo" method="Post" >
    @csrf  
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">NUEVO PRESTAMO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card">
            <div class="card-body">
            <div class="form-group row">
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >CODIGO:</label
                >
                <div class="col-sm-9">
                    <select
                        class="select2 form-select "
                        style="height: 36px; width: 100%" name="cbxcodigo"
                      >
                          <option>SELECCIONE UNA OPCION</option>
                          @foreach($codigo as $qp)
                          <option value="{{$qp->idfolder}}">{{$qp->codigofolder}}</option>
                          @endforeach
                    </select>
                </div>           
            </div>

            <div class="form-group row">
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >FECHA PRESTAMO:</label
                >
                <div class="col-sm-9">
                <input
                    type="date"
                    class="form-control"
                    id="fname" name="txtfechaprestamo"
                />
                </div>
            </div>
            <div class="form-group row">
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >FECHA DEVOLUCION:</label
                >
                <div class="col-sm-9">
                <input
                    type="date"
                    class="form-control"
                    id="fname" name="txtfechadevolucion"
                />
                </div>
            </div>
            <div class="form-group row">
                <label
                for="cono1"
                class="col-sm-3 text-end control-label col-form-label"
                >ASIGNADO A:</label
                >
                <div class="col-sm-9">
                    <input
                        type="text"
                        class="form-control"
                        id="fname" name="txtasignadoa"
                        placeholder="INGRESE NOMBRE COMPLETO"
                    />
                </div>
            </div>
            <div class="form-group row">
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >MOTIVO:</label
                >
                <div class="col-sm-9">
                      <textarea class="form-control" placeholder="INGRESE MOTIVO" name="txtmotivo"></textarea>
                </div>
            </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
        <button type="submit" class="btn btn-primary">GUARDAR</button>
      </div>
    </div>
  
   </form>
  </div>
</div>
