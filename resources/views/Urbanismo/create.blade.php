<?php
$sessionusuario=session('sessionusuario');
$nombreoficina=session('sessionoficina');
$sessionidusuario=session('sessionidusuario');
?>
<!-- Modal -->
<div class="modal fade" id="saneamientoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl">
   <form class="form-horizontal" action="/Saneamiento" method="Post" >
    @csrf  
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">NUEVO REGISTRO / SANEAMIENTO BASICO</h1>
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
                >FECHA RECEPCION:</label
                >
                <div class="col-sm-3">
                    <input
                    type="date"
                    class="form-control"
                    id="fname" name="txtfecharecepcion"
                    placeholder="INGRESE FECHA RECEPCION"
                    />
                </div>

                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >TIPO SOLICITUD:</label
                >
                <div class="col-sm-3">
                  <select
                          class="select2 form-select shadow-none"
                          style="width: 100%; height: 36px" name="cbxtramite">
                            <option>SELECCIONE SOLICITUD</option>
                            @foreach($querytramite as $qt)
                            <option value="{{$qt->idtramite}}">{{$qt->nombre}}</option>
                            @endforeach
                  </select>
                </div>
            </div>
            <div class="form-group row">
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >OTB:</label
                >
                <div class="col-sm-3">
                    <input
                    type="text"
                    class="form-control"
                    id="fname" name="txtotb"
                    placeholder="INGRESE O.T.B."
                    />
                </div>
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >SUPERVISOR:</label
                >
                <div class="col-sm-3">
                    <input
                        type="text"
                        class="form-control"
                        id="fname" name="txtresponsable"
                        placeholder="INGRESE NOMBRE DEL SUPERVISOR"
                    />
                </div> 
            </div>
            <div class="form-group row">
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >PROCEDENCIA:</label
                >
                <div class="col-sm-3">
                  <select class="select2 form-select "
                          style="height: 36px; width: 100%" name="cbxsecretaria">
                            <option>SELECCIONE UNA OPCION</option>
                            <option value="DESPACHO">DESPACHO</option>
                            <option value="SECRETARIA MUNICIPAL TECNICA">SECRETARIA MUNICIPAL TECNICA</option>
                            <option value="SECRETARIA MUNICIPAL ADMINISTRATIVA FINANCIERA">SECRETARIA MUNICIPAL ADMINISTRATIVA FINANCIERA</option>
                            <option value="SECRETARIA MUNICIPAL GENERAL">SECRETARIA MUNICIPAL GENERAL</option>
                            <option value="SECRETARIA MUNICIPAL DE PLANIFICACION">SECRETARIA MUNICIPAL DE PLANIFICACION</option>
                  </select>
                </div> 
                <label
                for="fname"
                class="col-sm-3 text-end control-label col-form-label"
                >UBICADO EN:</label
                >
                <div class="col-sm-3">
                  <select
                        class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px" name="cbxestante">
                          <option>SELECCIONE ESTANTE</option>
                          @foreach($querybyestante as $qe)
                          <option value="{{$qe->idestante}}">{{$qe->estante}}</option>
                          @endforeach
                  </select>
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


