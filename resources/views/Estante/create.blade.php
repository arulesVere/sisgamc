<!-- Modal -->
<div class="modal fade" id="oficinaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <form class="form-horizontal" action="/Estante" method="Post" >
    @csrf  
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">NUEVO REGISTRO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card">
            <div class="card-body">
            <div class="form-group row">
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >NOMBRE:</label
                >
                <div class="col-sm-9">
                <input
                    type="text"
                    class="form-control"
                    id="fname" name="txtestante"
                    placeholder="INGRESE NOMBRE ESTANTE"
                />
                </div>
            </div>
            <div class="form-group row">
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >FILA:</label
                >
                <div class="col-sm-9">
                <input
                    type="text"
                    class="form-control"
                    id="fname" name="txtfila"
                    placeholder="INGRESE FILA"
                />
                </div>
            </div>
            <div class="form-group row">
                <label
                for="cono1"
                class="col-sm-3 text-end control-label col-form-label"
                >PERTENECE A:</label
                >
                <div class="col-sm-9">
                    <select class="select2 form-select "
                        style="height: 36px; width: 100%" name="cbxoficina">
                          <option>SELECCIONE UNA OPCION</option>
                          @foreach($qoficina as $qo)
                          <option value="{{$qo->idoficina}}">{{$qo->nombre}}</option>
                          @endforeach
                    </select>
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