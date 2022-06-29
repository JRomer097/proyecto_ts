<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<title>Grafica</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
	<div class="row" style="min-height: 695px; margin: auto;">
		<!--Apartado para las gráficas-->
		<div class="col-md-8" style="background-color: #F3F3F3;"> Prueba </div>
		<!--Apartado para la información del paciente -->
		<div class="col-md-4" style="background-color: #F3F3F3;">
			<!--Información del Paciente-->
			<div class="row" style="min-height: 200px; background-color: #F3F3F3;">

				<div class="container" style="background-color: #F3F3F3; min-width: 75%;">
					<div class="row">
						<div class="col-6 col-sm-4">
							Nombre <!--  {{ $datos->apellidoP_p }} {{ $datos->apellidoM_p }} -->
							<p> {{ $datos->nombre_p }} </p>
						</div >
						<div class="w-100"></div>
						<div class="col-6 col-sm">Edad
							<p>{{ $datos->edad }}</p>
						</div>
						<div class="col-6 col-sm">Sangre
							<p>{{ $datos->tipo_de_sangre }}</p>
						</div>
						<div class="w-100"></div>
						<div class="col-6 col-sm">Peso
							<p>{{ $datos->peso }}</p>
						</div>
						<div class="col-6 col-sm">Altura
							<p>{{ $datos->altura }}</p>
						</div>
					</div>
			</div>
			</div>
			
			<div style="min-height: 495px; background-color: #F3F3F3; min-width: 100%;">	
				<div>
					Estado del paciente
					<div>
					<br>
					@foreach ($registro_pulsera as $registro)
						{{ $registro->id }}
						{{ $registro->id_pacientePersonalizada }}
						{{ $registro->id_pulsera }}
						{{ $registro->fecha }}
						{{ $registro->hora }}
						{{ $registro->temperatura }}
						{{ $registro->pulso_cardiaco }}
						{{ $registro->oxi_sangre }}
						<br>
					@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>