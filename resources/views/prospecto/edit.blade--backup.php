@extends('layouts.layout')

@section("title", "Editar Prospecto")

@section('content')
  <div class="container my-4">
    <h1>Editar Prospecto</h1>

  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

    <form action="{{ route('prospecto.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card mb-3">
      <div class="card-header">Imágenes de Portada</div>
      <div class="card-body">
      <div class="form-group">
        <label>Logo</label>
        <input type="file" name="logo" class="form-control" accept="image/*">
        <small>Imagen actual: {{ $prospecto['logo'] }}</small>
      </div>
      <div class="form-group mt-2">
        <label>Hero</label>
        <input type="file" name="hero" class="form-control" accept="image/*">
        <small>Imagen actual: {{ $prospecto['hero'] }}</small>
      </div>
      <div class="form-group mt-2">
        <label>Año</label>
        <input type="file" name="anio" class="form-control" accept="image/*">
        <small>Imagen actual: {{ $prospecto['anio'] }}</small>
      </div>
      <div class="form-group mt-2">
        <label>Footer</label>
        <input type="file" name="footer" class="form-control" accept="image/*">
        <small>Imagen actual: {{ $prospecto['footer'] }}</small>
      </div>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-header">Datos de Texto</div>
      <div class="card-body">
      <div class="form-group">
        <label>Texto del Año</label>
        <input type="text" name="anio_texto" class="form-control" value="{{ $prospecto['anio_texto'] }}">
      </div>
      <div class="form-group mt-2">
        <label>Número de Proforma</label>
        <input type="text" name="proforma_numero" class="form-control" value="{{ $prospecto['proforma_numero'] }}">
      </div>
      <div class="form-group mt-2">
        <label>Lugar y Fecha</label>
        <input type="text" name="lugar_fecha" class="form-control" value="{{ $prospecto['lugar_fecha'] }}">
      </div>
      <div class="form-group mt-2">
        <label>Empresa</label>
        <input type="text" name="empresa" class="form-control" value="{{ $prospecto['empresa'] }}">
      </div>
      <div class="form-group mt-2">
        <label>Texto de Presentación</label>
        <textarea name="texto_presentacion" class="form-control">{{ $prospecto['texto_presentacion'] }}</textarea>
      </div>
      <div class="form-group mt-2">
        <label>Título de Tabla</label>
        <input type="text" name="tabla_titulo" class="form-control" value="{{ $prospecto['tabla_titulo'] }}">
      </div>
      </div>
    </div>

    <!-- Puedes agregar secciones similares para módulos, precios, etc. -->

    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
  </div>
@endsection
