<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Calendario de eventos</h3>
	</div>
	<div class="box-header with-border">
		<h1 class="box-title">
			<div class="col-xs-12">
				<div class="col-xs-4">
					<button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-success">Agregar Evento</button>
				</div>
				<div class="col-xs-4">
					<button type="button" name="age" id="age" data-toggle="modal" data-target="#edit_data_Modal" class="btn btn-info">Modificar evento</button>
				</div>
				<div class="col-xs-4">
					<button type="button" name="age" id="age" data-toggle="modal" data-target="#edit_data_Modal" class="btn btn-danger">Desactivar evento</button>
				</div>
			</div>
		</h1>
	</div>
	<div class="modal fade" id="add_data_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form class="form-horizontal" method="POST" action="addEvent.php">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Agregar evento</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Titulo</label>
							<div class="col-sm-10">
								<input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
							</div>
						</div>
						<div class="form-group">
							<label for="color" class="col-sm-2 control-label">Color</label>
							<div class="col-sm-10">
								<select name="color" class="form-control" id="color">
									<option value="">Seleccione color</option>
									<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
									<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
									<option style="color:#008000;" value="#008000">&#9724; Green</option>
									<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
									<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
									<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
									<option style="color:#000;" value="#000">&#9724; Black</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="start" class="col-sm-2 control-label">Fecha de inicio</label>
							<div class="col-sm-10">
								<input type="datetime-local" name="start" class="form-control" id="start">
							</div>
						</div>
						<div class="form-group">
							<label for="end" class="col-sm-2 control-label">Fecha Final</label>
							<div class="col-sm-10">
								<input type="datetime-local" name="end" class="form-control" id="end">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary">Guardar cambios</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="edit_data_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form class="form-horizontal" method="POST" action="editEventTitle.php">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Editar Evento</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Titulo</label>
							<div class="col-sm-10">
								<input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
							</div>
						</div>
						<div class="form-group">
							<label for="color" class="col-sm-2 control-label">Color</label>
							<div class="col-sm-10">
								<select name="color" class="form-control" id="color">
									<option value="">Seleccione color</option>
									<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
									<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
									<option style="color:#008000;" value="#008000">&#9724; Green</option>
									<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
									<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
									<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
									<option style="color:#000;" value="#000">&#9724; Black</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox">
									<label class="text-danger"><input type="checkbox" name="delete">Eliminar Evento</label>
								</div>
							</div>
						</div>
						<input type="hidden" name="id" class="form-control" id="id">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary">Guardar Cambios</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- modal que hace todo.... -->
	<div class="modal fade" id="modalgeneral" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form class="form-horizontal" method="POST" action="editEventTitle.php">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Editar Evento</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Titulo</label>
							<div class="col-sm-10">
								<input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
							</div>
						</div>
						<div class="form-group">
							<label for="color" class="col-sm-2 control-label">Color</label>
							<div class="col-sm-10">
								<select name="color" class="form-control" id="color">
									<option value="">Seleccione color</option>
									<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
									<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
									<option style="color:#008000;" value="#008000">&#9724; Green</option>
									<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
									<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
									<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
									<option style="color:#000;" value="#000">&#9724; Black</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox">
									<label class="text-danger"><input type="checkbox" name="delete">Eliminar Evento</label>
								</div>
							</div>
						</div>
						<input type="hidden" name="id" class="form-control" id="id">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success">Agregar</button>
						<button type="button" class="btn btn-primary">Modificar</button>
						<button type="submit" class="btn btn-danger">Borrar</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- fin modal que hace todo.... -->
	<div class="box-body">
		<div id="calendar" class="col-centered">
			<!-- Aca se coloca el calendario-->
		</div>
	</div>
</div>