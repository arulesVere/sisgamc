<?php
$sessionusuario=session('sessionusuario');
$nombreoficina=session('sessionoficina');
$sessionidusuario=session('sessionidusuario');
?>
<!-- Modal -->
<div class="modal fade" id="duplicadoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl">
   <form class="form-horizontal" action="/Duplicado" method="Post" >
    @csrf  
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">NUEVO REGISTRO / DUPLICADO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <label
                for="cono1"
                class="col-sm-3 text-end control-label col-form-label"
                >Nº CARPETA</label
                >
                <div class="col-sm-3">
                  <input
                      type="number"
                      class="form-control"
                      id="fname" name="txtnumero"
                      placeholder="INGRESE NUMERO CARPETA"
                  />
                </div>
                <label
                for="cono1"
                class="col-sm-3 text-end control-label col-form-label"
                >Nº HOJAS EN CARPETA</label
                >
                <div class="col-sm-3">
                <input
                    type="number"
                    class="form-control"
                    id="fname" name="txthoja"
                    placeholder="INGRESE NUMERO DE HOJAS"
                />
                </div>
            </div>

            <div class="form-group row">
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >FECHA INICIO:</label
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
                >FECHA FIN:</label
                >
                <div class="col-sm-3">
                  <input
                      type="date"
                      class="form-control"
                      id="fname" name="txtfin"
                      placeholder="INGRESE FECHA FIN"
                  />
                </div>
            </div>
            <div class="form-group row">
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >SOLICITANTE:</label
                >
                <div class="col-sm-3">
                  <input
                      type="text"
                      class="form-control"
                      id="fname" name="txtsolicitante"
                      placeholder="INGRESE NOMBRE SOLICITANTE"
                  />
                </div>
          
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >CARNET:</label
                >
                <div class="col-sm-3">
                  <input
                      type="text"
                      class="form-control"
                      id="fname" name="txtcarnet"
                      placeholder="INGRESE CARNET"
                  />
                </div>
            </div>
            <div class="form-group row">
              
                <label
                  for="fname"
                  class="col-sm-3 text-end control-label col-form-label"
                  >NRO PLACA:</label
                  >
                  <div class="col-sm-3">
                      <input
                        type="text"
                        class="form-control"
                        id="fname" name="txtplacaduplicado"
                        placeholder="INGRESE NRO PLACA"
                      />
                  </div>
            </div>
            <div class="form-group row">
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >VEHICULO:</label
                >
                <div class="col-sm-3">
                  <select
                        class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px" name="cbxvehiculo"
                      >
                        <option>SELECCIONE UNA OPCION</option>
                        <option value="VEHICULO">VEHICULO</option>
                        <option value="MOTO">MOTO</option>
                  </select>
                </div>
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >TIPO PLAQUETA:</label
                >
                <div class="col-sm-3">
                  <select
                        class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px" name="cbxplaqueta"
                      >
                        <option>SELECCIONE PLAQUETA</option>
                        <option style="background-color: red;" value="PUBLICA">PUBLICA</option>
                        <option style="background-color: yellow;" value="INSTITUCIONAL">INSTITUCIONAL</option>
                        <option style="background-color: white;" value="PARTICULAR">PARTICULAR</option>
                  </select>
                </div>
            </div>

            <div class="form-group row">
              <label
              for="fname"
              class="col-sm-3 text-end control-label col-form-label"
              >PLAQUETA:</label
              >
              <div class="col-sm-3">
                  <input
                    type="text"
                    class="form-control"
                    id="fname" name="txtplaqueta"
                    placeholder="INGRESE NUMERO DE PLAQUETA"
                />
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


<script type="text/javascript">

  var fecha = new Date();
  document.getElementById("FechaActual").value = fecha.toJSON().slice(0,10);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>


