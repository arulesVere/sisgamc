<!-- Modal -->
<div class="modal fade" id="archivoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <form class="form-horizontal" action="/Archivo" method="Post" enctype="multipart/form-data">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">NUEVO ARCHIVO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card">
            <div class="card-body">
              <div class="form-group row">
                  <label
                  for="fname"
                  class="col-sm-3 text-end control-label col-form-label"
                  >SUBIR ARCHIVO:</label
                  >
                  <div class="col-md-9">
                        <input
                              type="text"
                              class="custom-file-input"
                              id="google_folder_id" name="google_folder_id"
                              value="{{$google_folder_id}}"
                              hidden
                          />
                      <div class="custom-file">
                          <input
                              type="file"
                              class="custom-file-input"
                              id="validatedCustomFile" name="txtfile"
                              required
                          />
                          <label
                              class="custom-file-label"
                              for="validatedCustomFile"
                              >Elegir archivo...</label
                          >
                          <div class="invalid-feedback">
                              Example invalid custom file feedback
                          </div>
                      </div>
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
