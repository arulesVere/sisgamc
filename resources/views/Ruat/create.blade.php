<?php
$sessionusuario=session('sessionusuario');
$nombreoficina=session('sessionoficina');
$sessionidusuario=session('sessionidusuario');
?>
<!-- Modal -->
<div class="modal fade" id="ruatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl">
   <form class="form-horizontal" action="/Ruat" method="Post" >
    @csrf  
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">NUEVO REGISTRO / TRAMITE</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <label
                for="cono1"
                class="col-sm-3 text-end control-label col-form-label"
                >Nº FOLDER</label
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
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >NRO. DE CERT.</label
                >
                <div class="col-sm-3">
                    <input
                    type="text"
                    class="form-control"
                    id="fname" name="txtnrocert"
                    placeholder="INGRESE NRO CERT."
                    />
                </div>
            </div>
            <div class="form-group row">
                <label
                    for="fname"
                    class="col-sm-3 text-end control-label col-form-label"
                    >NRO PLACA:</label>
                <div class="col-sm-3">
                    <input
                    type="text"
                    class="form-control"
                    id="fname" name="txtplaca"
                    placeholder="INGRESE NRO PLACA"/>
                </div>

                <label
                    for="lname"
                    class="col-sm-3 text-end control-label col-form-label"
                    >TRAMITE</label
                  >
                    <div class="col-md-3">
                      <select
                        class="select2 form-select "
                        style="height: 36px; width: 100%" name="cbxtramite"
                      >
                          <option>SELECCIONE UNA OPCION</option>
                          @foreach($querytramite as $tra)
                          <option value="{{$tra->idtramite}}">{{$tra->nombre}}</option>
                          @endforeach
                      </select>
                </div>
            </div>
            <div class="form-group row">
                <label
                    for="cono1"
                    class="col-sm-3 text-end control-label col-form-label"
                    >Nº HOJAS</label
                    >
                    <div class="col-sm-3">
                    <input
                        type="number"
                        class="form-control"
                        id="fname" name="txthoja"
                        placeholder="INGRESE NUMERO DE HOJAS"
                    />
                    </div>

                <label
                    for="lname"
                    class="col-sm-3 text-end control-label col-form-label"
                    >ESTANTE</label
                  >
                <div class="col-md-3">
                      <select
                        class="select2 form-select "
                        style="height: 36px; width: 100%" name="cbxestante"
                      >
                          <option>SELECCIONE ESTANTE</option>
                          @foreach($querybyestante as $est)
                          <option value="{{$est->idestante}}">{{$est->estante}}</option>
                          @endforeach
                      </select>
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
            <!--RUAT-->
            <div class="form-group row">
            <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >TIPO SOLICITANTE:</label
                >
                <div class="col-sm-3">
                  <select
                        class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px" name="cbxtiposolicitante"
                      >
                        <option>SELECCIONE TIPO</option>
                        <option value="ABOGADO">ABOGADO</option>
                        <option value="APODERADO">APODERADO</option>
                        <option value="PROPIETARIO">PROPIETARIO</option>
                        <option value="TRAMITADOR">TRAMITADOR</option>
                  </select>
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
                      placeholder="INGRESE SOLICITANTE"
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
            <!--RUAT-->
            
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


