<!-- Modal -->
<div class="modal fade" id="tramiteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <form class="form-horizontal" action="/Tramite" method="Post" >
    @csrf  
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">NUEVO TRAMITE</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card">
            <div class="card-body">  
            <div class="form-group row">
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >TRAMITE:</label
                >
                <div class="col-sm-9">
                <input
                    type="text"
                    class="form-control"
                    id="fname" name="txttramite"
                    placeholder="INGRESE NUEVO TRAMITE"
                />
                </div>
            </div>
            <div class="form-group row">
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >PERTENCE A:</label
                >
                <div class="col-sm-9">
                  <select
                          class="select2 form-select shadow-none"
                          style="width: 100%; height: 36px" name="cbxoficina">
                            <option>SELECCIONE OFICINA</option>
                            @foreach($queryoficina as $qo)
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