<!-- Modal -->
<div class="modal fade" id="rolModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <form class="form-horizontal" action="/Rol" method="Post" >
    @csrf  
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">NUEVA GESTION</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label
                    for="fname"
                    class="col-sm-3 text-end control-label col-form-label"
                    >ROL:</label
                    >
                    <div class="col-sm-9">
                    <input
                        type="text"
                        class="form-control"
                        id="fname" name="txtrol"
                        placeholder="INGRESE ROL"
                    />
                    </div>
                </div>
                <div class="form-group row">
                    <label
                    for="fname"
                    class="col-sm-3 text-end control-label col-form-label"
                    >DETALLE:</label
                    >
                    <div class="col-sm-9">
                    <textarea class="form-control" name="txtdetalle" placeholder="INGRESE DETALLE"></textarea>
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