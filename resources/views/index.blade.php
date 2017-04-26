@extends('layouts.app')
@section('content')
<html>
    
<head>
    <meta charset="UTF-8">
    <title>Lista de celulares</title>

</head>
<body>
    
    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1 class="text-center">Tienda de celulares</h1>
            <table class="table table-bordered">
                @foreach ($celulares as $celular)
                                    
                      <div class="col-md-4">
                        <div class="thumbnail">
                         <img class="img-responsive" src="{{ $celular->image }}" alt="..." width="200px">
                         </div>
                          <div class="caption">
                            <h3>{{ $celular->titulo }}</h3>
                            <p>${{ $celular->precio }}</p>
                            <p><a  class="btn btn-primary" href="comprar/{{ $celular->id }}" class="btn btn-primary" role="button">Comprar</a> </p>
                          </div>
                        </div>
                      </div>
                    
                @endforeach
            </table>
      </div>
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">Una implementación de Culqi en Laravel</p>
      </div>
    </footer>

</body>
</html>
@endsection

