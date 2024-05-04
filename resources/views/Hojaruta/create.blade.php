<?php
$sessionusuario=session('sessionusuario');
$nombreoficina=session('sessionoficina');
$sessionidusuario=session('sessionidusuario');
?>
<!-- Modal -->
<div class="modal fade" id="hojarutaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl">
   <form class="form-horizontal" action="/Hojaruta" method="Post" >
    @csrf  
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">NUEVO REGISTRO / HOJA DE RUTA</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >FECHA SOLICITUD:</label
                >
                <div class="col-sm-3">
                  <input
                      type="date"
                      class="form-control"
                      id="FechaActual" name="txtinicio"
                      placeholder="INGRESE FECHA INICIO"
                  />
                </div>
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >N° DE H.R.:</label
                >
                <div class="col-sm-3">
                  <input
                      type="text"
                      class="form-control"
                      id="fname" name="txtnrohr"
                      placeholder="NRO. HOJA DE RUTA"
                  />
                </div>
            </div>
            
            <div class="form-group row">
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >UD. CORRESPONDIENTE:</label>
                <div class="col-sm-3">
                <input
                    type="text"
                    class="form-control"
                    id="fname" name="txtunidad"
                    placeholder="INGRESE UNIDAD" />
                </div>
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >FECHA H.R.:</label
                >
                <div class="col-sm-3">
                  <input
                      type="date"
                      class="form-control"
                      id="fname" name="txtfechahr"/>
                </div>
              </div>
              <div class="form-group row">
                    <label
                    for="fname"
                    class="col-sm-3 text-end control-label col-form-label"
                    >RESPONS. DE RUAT:</label
                    >
                    <div class="col-sm-3">
                        <input
                            type="text"
                            class="form-control"
                            id="fname" name="txtresponsable"
                            placeholder="INGRESE RESPONS."
                        />
                    </div> 
                    <label
                    for="fname"
                    class="col-sm-3 text-end control-label col-form-label"
                    >FECHA DE ENVIO:</label
                    >
                    <div class="col-sm-3">
                      <input
                          type="date"
                          class="form-control"
                          id="fname" name="txtenviohr"
                          placeholder="INGRESE FECHA DE ENVIO"
                      />
                    </div>
                </div> 
                <div class="form-group row">
                    <label
                    for="fname"
                    class="col-sm-3 text-end control-label col-form-label"
                    >INGRESE RAZÓN:</label
                    >
                    <div class="col-sm-3">
                      <textarea class="form-control" placeholder="INGRESE MOTIVO" name="txtmotivo"></textarea>
                    </div>
                    
                </div> 
          </div>
              <!--FIN HOJA RUTA -->
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


<script type="text/javascript">

  var fecha = new Date();
  document.getElementById("FechaActual").value = fecha.toJSON().slice(0,10);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>


