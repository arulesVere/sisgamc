<!-- Modal -->
<div class="modal fade" id="oficinaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <form class="form-horizontal" action="/Oficina" method="Post" >
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
                >OFICINA:</label
                >
                <div class="col-sm-9">
                <input
                    type="text"
                    class="form-control"
                    id="fname" name="txtoficina"
                    placeholder="INGRESE OFICINA"
                />
                </div>
            </div>
            
            <div class="form-group row">
                <label
                for="cono1"
                class="col-sm-3 text-end control-label col-form-label"
                >SECRETARIA</label
                >
                <div class="col-sm-9">
                    <select class="select2 form-select "
                        style="height: 36px; width: 100%" name="cbxsecretaria">
                          <option>SELECCIONE UNA OPCION</option>
                          <option value="ADMINISTRACION">ADMINISTRACION</option>
                          <option value="DESPACHO">DESPACHO</option>
                          <option value="SMTS">SECRETARIA MUNICIPAL TECNICA Y DE SERVICIOS</option>
                          <option value="SMAF">SECRETARIA MUNICIPAL ADMINISTRATIVA FINANCIERA</option>
                          <option value="SMGG">SECRETARIA MUNICIPAL GENERAL Y DE GOBERNABILIDAD</option>
                          <option value="SMP">SECRETARIA MUNICIPAL DE PLANIFICACION</option>
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