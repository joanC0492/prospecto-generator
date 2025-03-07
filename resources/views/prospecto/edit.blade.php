@extends('layouts.layout')

@section("title", "Editar Prospecto")

@section("head")
  <style>
    #app {
    background-color: #F0F2F4;
    }
  </style>
@endsection

@section('content')
  <div class="container pb-5">
    <h1 class="text-center">Editar Prospecto</h1>

    @if(session('success'))
    <div class="alert alert-success">
    {{ session('success') }}
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
      const capa = document.querySelector("#capa");
      capa.classList.add("active");
      setTimeout(function () {
      window.location.href = "{{ route('prospecto.edit') }}";
      }, 2000);
    });
    </script>
  @endif

    <form action="{{ route('prospecto.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card mb-3">
      <div class="card-header">Imágenes de Portada</div>
      <div class="card-body">
      <div class="form-group">
        <div class="row">
        <div class="col-6">
          <label>Logo</label>
          <input type="file" name="logo" class="form-control" accept="image/*">
          <small>Imagen actual: {{ $prospecto['portada']['logo'] }}</small>
        </div>
        <div class="col-6">
          <label>Hero</label>
          <input type="file" name="hero" class="form-control" accept="image/*">
          <small>Imagen actual: {{ $prospecto['portada']['hero'] }}</small>
        </div>
        </div>
      </div>

      <div class="form-group mt-2">
        <div class="row">
        <div class="col-6">
          <label>Año</label>
          <input type="file" name="anio" class="form-control" accept="image/*">
          <small>Imagen actual: {{ $prospecto['portada']['anio'] }}</small>
        </div>
        <div class="col-6">
          <label>Footer</label>
          <input type="file" name="footer" class="form-control" accept="image/*">
          <small>Imagen actual: {{ $prospecto['portada']['footer'] }}</small>
        </div>
        </div>

      </div>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-header">Datos de Texto</div>
      <div class="card-body">
      <div class="form-group">
        <label>Texto del Año</label>
        <input type="text" name="anio_texto" class="form-control" value="{{ $prospecto['texto']['anio_texto'] }}">
      </div>
      <div class="form-group mt-2">
        <label>Número de Proforma</label>
        <input type="text" name="proforma_numero" class="form-control"
        value="{{ $prospecto['texto']['proforma_numero'] }}">
      </div>
      <div class="form-group mt-2">
        <label>Lugar y Fecha</label>
        <input type="text" name="lugar_fecha" class="form-control" value="{{ $prospecto['texto']['lugar_fecha'] }}">
      </div>
      <div class="form-group mt-2">
        <label>Empresa</label>
        <input type="text" name="empresa" class="form-control" value="{{ $prospecto['texto']['empresa'] }}">
      </div>
      <div class="form-group mt-2">
        <label>Texto de Presentación</label>
        <textarea id="texto_presentacion" name="texto_presentacion"
        class="form-control">{{ $prospecto['texto']['texto_presentacion'] }}</textarea>
      </div>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-header">Tabla Modulos</div>
      <div class="card-body">
      <!-- Modulos -->
      @foreach ($prospecto['modulos'] as $index => $modulo)
      <div class="form-group mt-3">
      <label class="h6 fw-bold">{{$modulo['nombre']}}</label>
      <select id="modulo_pagina_{{ $index }}" name="modulos[{{ $index }}][pagina]" class="form-control">
      <option value="1" {{ $modulo['pagina'] == 1 ? 'selected' : '' }}>Tabla 1</option>
      <option value="2" {{ $modulo['pagina'] == 2 ? 'selected' : '' }}>Tabla 2</option>
      <option value="3" {{ $modulo['pagina'] == 3 ? 'selected' : '' }}>Tabla 3</option>
      </select>
      <div class="row">
      @foreach ($modulo['columnas'] as $colIndex => $columna)
      <div class="col-4">
      <p class="mb-0 mt-1">Plan @for($i = 0; $i <= $colIndex; $i++)✫@endfor</p>
      <textarea id="modulos_{{ $index }}_{{ $colIndex }}"
      name="modulos[{{ $index }}][columnas][{{ $colIndex }}]" class="form-control">{{ $columna }}</textarea>
      </div>
    @endforeach
      </div>
      </div>
    @endforeach
      <div class="form-group mt-3">
        <label>Tabla Horario</label>
        <input type="text" name="tabla_horario" class="form-control"
        value="{{ $prospecto['texto']['tabla_horario'] }}">
      </div>
      <div class="form-group mt-3">
        <label>SubPrecios</label>
        <div class="row">
        <div class="col-4">
          <input type="number" name="tabla_subprecio_1" class="form-control"
          value="{{ $prospecto['texto']['tabla_subprecio_1'] }}">
        </div>
        <div class="col-4">
          <input type="number" name="tabla_subprecio_2" class="form-control"
          value="{{ $prospecto['texto']['tabla_subprecio_2'] }}">
        </div>
        <div class="col-4">
          <input type="number" name="tabla_subprecio_3" class="form-control"
          value="{{ $prospecto['texto']['tabla_subprecio_3'] }}">
        </div>
        </div>
      </div>
      <div class="form-group mt-3">
        <label>Precios</label>
        <div class="row">
        <div class="col-4">
          <input type="number" name="tabla_precio_1" class="form-control"
          value="{{ $prospecto['texto']['tabla_precio_1'] }}">
        </div>
        <div class="col-4">
          <input type="number" name="tabla_precio_2" class="form-control"
          value="{{ $prospecto['texto']['tabla_precio_2'] }}">
        </div>
        <div class="col-4">
          <input type="number" name="tabla_precio_3" class="form-control"
          value="{{ $prospecto['texto']['tabla_precio_3'] }}">
        </div>
        </div>
      </div>


      </div>
    </div>

    <div class="card mb-3">
      <div class="card-header">Pago y Firma</div>
      <div class="card-body">
      <!-- Modulos -->
      <div class="form-group">
        <div class="row">
        <div class="col-6">
          <label>Medios de Pago</label>
          <input type="file" name="medios_pago" class="form-control" accept="image/*">
          <small>Imagen actual: {{ $prospecto['portada']['medios_pago'] }}</small>
        </div>
        <div class="col-6">
          <label>Firma</label>
          <input type="file" name="firma" class="form-control" accept="image/*">
          <small>Imagen actual: {{ $prospecto['portada']['firma'] }}</small>
        </div>
        </div>
      </div>
      <div class="form-group mt-3">
        <label>Validez de la proforma</label>
        <input type="text" name="validez_proforma" class="form-control"
        value="{{ $prospecto['texto']['validez_proforma'] }}">
      </div>
      </div>
    </div>

    <div class="form-group mt-3">
      <div class="botones-edit">
      <button id="btn-guardar" type="submit" class="btn btn-primary">Guardar</button>
      <a target="_blank" href="{{ route('prospecto.show') }}" class="btn btn-info mr-2 text-white">Ver</a>
      </div>
    </div>

    </form>

    <form action="{{ route('prospecto.restore') }}" method="POST" class="mt-3">
    @csrf
    <div class="botones-edit mt-8">
      <button id="btn-restaurar" type="submit" class="btn btn-warning text-white"
      onclick="return confirm('¿Estás seguro que deseas restaurar los valores originales?')">
      <i class="fas fa-undo"></i> Restaurar
      </button>
    </div>
    </form>
  </div>
  <div id="capa" class="">
    <span class="loader"></span>
  </div>
@endsection

@section("script")
  <script src="https://cdn.tiny.cloud/1/xe8aawpzrkkcmj1liuqshqogzi37wa0uh4jxzzradacq8nxk/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script>
    tinymce.init({
    selector: 'textarea#texto_presentacion, textarea[id^="modulos_"]',
    plugins: 'lists link image table code help wordcount', // Plugins que deseas habilitar
    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code', // Barra de herramientas
    menubar: false, // Oculta la barra de menú
    height: 300, // Altura del editor
    branding: false, // Oculta la marca de TinyMCE
    });
  </script>
  <script>

    document.addEventListener("DOMContentLoaded", () => {
    const botones = document.querySelectorAll(`#btn-guardar,#btn-restaurar`);
    Array.from(botones).forEach((item) => {
      item.addEventListener("click", () => {
      const capa = document.querySelector("#capa");
      capa.classList.add("active");
      })
    });
    })

  </script>
@endsection
