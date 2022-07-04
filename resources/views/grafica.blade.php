<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Diseño</title>
</head>
<body>
    <div class="row g-0" style="background-color: #FFCCCC; min-height: 657px ;">
        <div class="col-sm-8 col-md-8" style="background-color: #CCFFE6;">
            Graficas
        </div>
        <div class="col-sm-6 col-md-4 row g-0" style="background-color: #F3F3F3;">
            <div class="container row g-0 " style="height: 30%;">
                <div class="col-sm-4 align-items-center row">
                   <img src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png"  width="80" height="100">
                </div>
                <div class="col-sm-8 row container">
                    <div class="col-sm-8">
                        <span>Nombre: </span>
                        <p> {{ $datos->nombre }} </p>
                    </div>
                    <!-- <div class="w-100"></div> --> 

                    <div class="row">
                        <div class="col-sm-6">
                            <span>Edad: </span>
                            <p> {{ $datos->edad }} </p>
                        </div>

                        <div class="col-sm-6">
                            <span>Sangre: </span>
                            <p> {{ $datos->tipo_de_sangre }} </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <span>Peso: </span>
                            <p> {{ $datos->peso }}kg</p>
                        </div>

                        <div class="col-sm-6">
                            <span>Altura: </span>
                            <p> {{ $datos->altura }}m</p>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="container align-items-center p-2 " style="height: 20%;">
                <div class="text-center" data-bs-spy="scroll">
                    <button type="button" class="btn btn-outline-success" style="padding: 40px 20px;">25</button>
                    <button type="button" class="btn btn-outline-success" style="padding: 40px 20px;">26</button>
                    <button type="button" class="btn btn-outline-success" style="padding: 40px 20px;">27</button>
                    <button type="button" class="btn btn-outline-success" style="padding: 40px 20px;">28</button>
                    <button type="button" class="btn btn-outline-success" style="padding: 40px 20px;">29</button>
                    <button type="button" class="btn btn-outline-success" style="padding: 40px 20px;">30</button>
                </div>
            </div>
            <div class="row container align-items-center" style="height: 50%;">
                <div class = "col-sm-12 text-center">
                    <span>Temperatura: </span>
                    <p>
                        @foreach($registro_pulsera as $registro)
                            {{ $registro -> temperatura }} 
                        @endforeach
                    </p>
				</div>

                <div class = "col-sm-12 text-center">
                    <span>Pulso Cardiaco: </span>
                    <p>
                        @foreach($registro_pulsera as $registro)
                            {{ $registro -> pulso_cardiaco }}
                        @endforeach
                    </p>
				</div>

                <div class = "col-sm-12 text-center ">
                    <span>Oxigenacion en la sangre: </span>
                    <p>
                        @foreach($registro_pulsera as $registro)
                            {{ $registro -> oxi_sangre }}
                        @endforeach
                    </p>
				</div>

            </div>
        </div>
    </div>
</body>
</html>