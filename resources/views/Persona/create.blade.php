<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
   <form class="form-horizontal" method="post" action="/Persona">
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
                      id="fname"
                      placeholder="INGRESE NOMBRE" name="txtnombre"
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label
                    for="lname"
                    class="col-sm-3 text-end control-label col-form-label"
                    >PRIMER APELLIDO</label
                  >
                  <div class="col-sm-9">
                    <input
                      type="text"
                      class="form-control"
                      id="lname"
                      placeholder="INGRESE PRIMER APELLIDO" name="txtpapellido"
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label
                    for="lname"
                    class="col-sm-3 text-end control-label col-form-label"
                    >SEGUNDO APELLIDO</label
                  >
                  <div class="col-sm-9">
                    <input
                      type="text"
                      class="form-control"
                      id="lname"
                      placeholder="INGRESE SEGUNDO APELLIDO" name="txtsapellido"
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label
                    for="lname"
                    class="col-sm-3 text-end control-label col-form-label"
                    >CARNET</label
                  >
                  <div class="col-sm-9">
                    <input
                      type="text"
                      class="form-control"
                      id="lname"
                      placeholder="INGRESE CARNET" name="txtcarnet"
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label
                    for="lname"
                    class="col-sm-3 text-end control-label col-form-label"
                    >CORREO</label
                  >
                  <div class="col-sm-9">
                    <input
                      type="text"
                      class="form-control"
                      id="lname"
                      placeholder="INGRESE CORREO" name="txtcorreo"
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label
                    for="lname"
                    class="col-sm-3 text-end control-label col-form-label"
                    >CARGO</label
                  >
                    <div class="col-md-9">
                      <select
                        class="select2 form-select "
                        style="height: 36px; width: 100%" name="cbxcargo"
                      >
                          <option>SELECCIONE UNA OPCION</option>
                          @foreach($cargo as $car)
                          <option value="{{$car->idcargo}}">{{$car->nombre}}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label
                    for="lname"
                    class="col-sm-3 text-end control-label col-form-label"
                    >OFICINA</label
                  >
                    <div class="col-md-9">
                      <select
                        class="select2 form-select "
                        style="height: 36px; width: 100%" name="cbxoficina"
                      >
                          <option>SELECCIONE UNA OPCION</option>
                          @foreach($oficina as $ofi)
                          <option value="{{$ofi->idoficina}}">{{$ofi->nombre}}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label
                    for="lname"
                    class="col-sm-3 text-end control-label col-form-label"
                    >PERMISOS</label
                  >
                    <div class="col-md-9">
                      @foreach($rol as $rol)
                      <div class="form-check mr-sm-2">
                        <input
                          type="checkbox"
                          class="form-check-input"
                          id="customControlAutosizing1" value="{{$rol->idrol}}" name="chxrol[]"
                        />
                        <label
                          class="form-check-label mb-0"
                          for="customControlAutosizing1"
                          >{{$rol->nombre}}</label
                        >
                      </div>
                      @endforeach
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