<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class='row'>
        <div class="col-12 text-center">
            <h1 >Liquidacion de sueldo </h1>
            <h4>Octubre 2022</h4>
        </div>
    </div>
    <div class='row'>
        <h4 class= "col-12">Identificacion del trabajador</h4>
        <div class="col-6">
            <p>Nombre: {{$data['nombre']}}</p>
            <p>Rut: {{$data['rut']}}</p>
            <p>Cargo: {{$data['cargo']}}</p>
            <p>AFP: {{$data['afp']}}</p>
            <p>Previsión de salud: {{$data['salud']}}</p>
            
        </div>
        <div class="col-6">
            <p>Fecha de ingreso: {{$data['fecha_contrato']}}</p>
            <p>Días trabajados: 30</p>
        </div>
    </div>
    <div class='row'>
        <div class="col-6">
            <h4>Haberes imponibles</h4>
            <p>Sueldo: {{$data['sueldobase']}}</p>
            <p>Gratificación legal: {{$data['gratificacionlegal']}} </p>
            <p class="fw-bold">Total imponible: {{$data['baseimponible']}}</p>
        </div>
        <div class="col-6">
            <h4>Haberes no imponibles</h4>             
                
                <p class="fw-bold">Total no imponible: {{$data['asignaciones']}}</p>
                
        </div>
        <p class="col-12 fw-bold" >Total de haberes: {{$data['total_haber']}}</p>
    </div>
    
    <div class="row">
        <div class="col-12">
            <h4>Descuentos legales</h4>
            <p>Cotización de afp: {{$data['descuento_afp']}}</p>
            <p>Cotización de salud: {{$data['descuento_salud']}}</p>
            @if($data['descuento_seguros']!=0)
            <p>Ahorro voluntario: {{$data['descuento_seguros']}}</p>
            @endif
            <p>Anticipos: {{$data['anticipo']}}</p>
            <p class="col-12 fw-bold">Total descuentos: {{$data['total_descuento']}}</p>
        </div>
    </div>
    <div class='row'>
        <p class="col-12 fw-bold">Sueldo liquido a pagar: {{$data['sueldo_liquido']}}</p>
        
    </div>

    <div class='row justify-content-center'>
        <div class="col-3 text-center">
            <p class='border-top border-dark'>{{$data['nombre']}}</p>
        </div>
    </div>
    <div>
        <p>Certifico que he recibido de KFC, a
            mi entera satisfacción el saldo indicado en la presente liquidación y no
            tengo cargo ni cobro posterior que hacer.
        </p>
    </div>
</body>
</html>