<?php
$sessionusuario=session('sessionusuario');
$nombreoficina=session('sessionoficina');
$sessionidusuario=session('sessionidusuario');
?>
<!-- Modal -->
<div class="modal fade" id="bajadefinitivaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl">
   <form class="form-horizontal" action="/Bajadefinitiva" method="Post" >
    @csrf  
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">NUEVO REGISTRO / BAJA DEFINITIVA</h1>
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
                        id="fname" name="txtplacabaja"
                        placeholder="INGRESE NRO PLACA"
                    />
                </div>
            </div>
            <div class="form-group row">
               
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >HOJA RUTA:</label
                >
                <div class="col-sm-3">
                    <input
                        type="text"
                        class="form-control"
                        id="fname" name="txthojaruta"
                        placeholder="INGRESE NRO HOJA RUTA"
                    />
                </div>
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >BAJA POR:</label
                >
                <div class="col-sm-3">
                    <select
                        class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px" name="cbxrazonbaja"
                        >
                        <option>SELECCIONE UNA OPCION</option>
                        <option value="POR EXPORTACION">EXPORTACION</option>
                        <option value="ROBO DE MOTO">ROBO DE MOTO</option>
                        <option value="ROBO DE VEHICULO">ROBO DE VEHICULO</option>
                    </select>
                </div>
            </div>
                    <!-- BAJA DEFINITIVA -->
            <div class="form-group row">
                 
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >TRAMITADOR:</label
                >
                <div class="col-sm-3">
                    <input
                    type="radio"
                    class="tramitador" value="PROPIETARIO"
                    id="customControlValidation3" checked="checked"
                    name="rdbtramitador"
                    />
                    <label
                    class="form-check-label mb-0"
                    for="customControlValidation3"
                    >PROPIETARIO</label
                    >
                    <input
                    type="radio"
                    class="tramitador" value="ABOGADO"
                    id="customControlValidation3"
                    name="rdbtramitador"
                    />
                    <label
                    class="form-check-label mb-0"
                    for="customControlValidation3"
                    >ABOGADO(A)</label
                    >
                </div> 
                
                <div id="divabogado" style="display:none;">
                    <div class="form-group row">
                        <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >ABOGADO(A):</label
                        >
                        <div class="col-sm-3">
                            <input
                            type="text"
                            class="form-control"
                            id="fname" name="txtabogado"
                            placeholder="INGRESE NOMBRE ABOGADA"
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
                            id="fname" name="txtcarnetabogado"
                            placeholder="INGRESE CARNET"
                        />
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


<script type="text/javascript">
  var fecha = new Date();
  document.getElementById("FechaActual").value = fecha.toJSON().slice(0,10);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>


