@extends('layouts.layout')

@section("title", "Editar Prospecto")

@section("head")
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
  <style>
    #app {
    background-color: #F0F2F4;
    }
    .editor-quill {
    height: calc(100% + -66px + -20px);
    max-height: 330px;
    overflow: auto;
    }

    @media(min-width: 1400px) {
    .editor-quill {
      height: calc(100% + -42px + -24px);
    }
    }

    .role-button-img{
      display: block;
    }
    .role-button-img img{
      max-height: 120px;
      object-fit: contain;
    }
  </style>
@endsection

@php
  $id_modulos = [];
@endphp
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

    <form action="{{ route('prospecto.update') }}" method="POST" enctype="multipart/form-data" id="form-prospecto-update">
    @csrf
    @method('PUT')

    <div class="card mb-3">
      <div class="card-header">Imágenes de Portada</div>
      <div class="card-body">
      <div class="form-group">
        <div class="row">
        <div class="col-6">
          <label class="d-block">Logo</label>
          <small>Imagen actual: {{ $prospecto['portada']['logo'] }}</small>
          <input type="file" name="logo" class="form-control d-none" accept="image/*" id="portada-logo" />
          <label for="portada-logo" role="button" class="role-button-img">
            <img src={{ asset(config("prospecto.portada.logo")) }} class="img-fluid" alt="Logo main"/>
          </label>
        </div>
        <div class="col-6">
          <label class="d-block">Hero</label>
          <small>Imagen actual: {{ $prospecto['portada']['hero'] }}</small>
          <input type="file" name="hero" class="form-control d-none" accept="image/*" id="portada-hero" />
          <label for="portada-hero" role="button" class="role-button-img">
            <img src={{ asset(config("prospecto.portada.hero")) }} class="img-fluid" alt="Hero Main"/>
          </label>
        </div>
        </div>
      </div>

      <div class="form-group mt-2">
        <div class="row">
        <div class="col-6">
          <label class="d-block">Año</label>
          <small>Imagen actual: {{ $prospecto['portada']['anio'] }}</small>
          <input type="file" name="anio" class="form-control d-none" accept="image/*" id="portada-anio">
          <label for="portada-anio" role="button" class="role-button-img">
            <img src={{ asset(config("prospecto.portada.anio")) }} class="img-fluid" alt="Año"/>
          </label>
        </div>
        <div class="col-6">
          <label class="d-block">Footer</label>
          <small>Imagen actual: {{ $prospecto['portada']['footer'] }}</small>
          <input type="file" name="footer" class="form-control d-none" accept="image/*" id="portada-footer"/>
          <label for="portada-footer" role="button" class="role-button-img">
            <img src={{ asset(config("prospecto.portada.footer")) }} class="img-fluid" alt="Footer"/>
          </label>
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
        <label>Titular</label>
        <input type="text" name="titular" class="form-control" value="{{ $prospecto['texto']['titular'] }}">
      </div>
      <div class="form-group mt-2">
        <label>Ciudad</label>
        <input type="text" name="ciudad" class="form-control" value="{{ $prospecto['texto']['ciudad'] }}">
      </div>
      <div class="form-group mt-2">
        <label>Texto de Presentación</label>
        <div class="editor-quill" data-id="texto_presentacion">{!! $prospecto['texto']['texto_presentacion'] !!}</div>
        <input type="hidden" name="texto_presentacion" id="texto_presentacion">
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
      <!-- HERE FOR -->
      <div class="editor-quill" data-id="modulos_{{ $index }}_{{ $colIndex }}">{!!  $columna !!}</div>
      <input type="hidden" name="modulos[{{ $index }}][columnas][{{ $colIndex }}]"
      id="modulos_{{ $index }}_{{ $colIndex }}" />
      @php
    $id_modulos[] = "modulos_{$index}_{$colIndex}";
  @endphp
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
        <label>Activación</label>
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
        <label>Pago mensual:</label>
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
          <label class="d-block">Medios de Pago</label>
          <small>Imagen actual: {{ $prospecto['portada']['medios_pago'] }}</small>
          <input type="file" name="medios_pago" class="form-control d-none" accept="image/*" id="medios_pago">
          <label for="medios_pago" role="button" class="role-button-img">
            <img src={{ asset(config("prospecto.portada.medios_pago")) }} class="img-fluid" alt="Medios Pago" />
          </label>
        </div>
        <div class="col-6">
          <label class="d-block">Firma</label>
          <small>Imagen actual: {{ $prospecto['portada']['firma'] }}</small>
          <input type="file" name="firma" class="form-control d-none" accept="image/*" id="firma">
          <label for="firma" role="button" class="role-button-img">
            <img src={{ asset(config("prospecto.portada.firma")) }} class="img-fluid" alt="Firma" />
          </label>
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
  <!-- <script src="https://cdn.tiny.cloud/1/gel7fdioeucyfu96ck6bumm74t880jwgbtleertkqb6gl0ih/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
    selector: 'textarea#texto_presentacion, textarea[id^="modulos_"]',
    plugins: 'lists link image table code help wordcount', // Plugins que deseas habilitar
    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code', // Barra de herramientas
    menubar: false, // Oculta la barra de menú
    height: 300, // Altura del editor
    branding: false, // Oculta la marca de TinyMCE
    });
    </script> -->

  <!-- Include the Quill library -->
  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
  <!-- Initialize Quill editor -->
  <script>
    let editors = ['texto_presentacion'];
    let modulos = @json($id_modulos); // Se convierte correctamente en array de JS
    editors = editors.concat(modulos); // Une los arrays correctamente

    // Instanciando los Editores de texto
    let quill;
    for (let i = 0; i < editors.length; i++) {
    quill = new Quill(`[data-id=${editors[i]}]`, {
      theme: 'snow'
    });
    }

    document.addEventListener("DOMContentLoaded", () => {
    const initChangeInputHiddenFormEdit = () => {
      const changeInputs = () => {
      console.log("Submit...!!!");
      // editors
      for (let i = 0; i < editors.length; i++) {
        const editorContent = document
        .querySelector(`.editor-quill:has(+#${editors[i]}) .ql-editor`)
        .innerHTML.trim();
        document.querySelector(`#${editors[i]}`).value = editorContent;
      }
      };
      document.querySelector('#form-prospecto-update').addEventListener('submit', changeInputs);
      changeInputs();
    };
    initChangeInputHiddenFormEdit();
    });
  </script>

  <!--  -->
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

  <!--  -->
  <!-- <script>
    document.addEventListener("DOMContentLoaded", () => {
    const inputFiles = document.querySelectorAll(`input[type="file"][accept="image/*"]`);
    Array.from(inputFiles).forEach(inputFile => {
      inputFile.addEventListener("change", (event) => {
      const file = event.target.files[0];
      if (file) {
      inputFile.nextElementSibling.querySelector("img").src = file.name;
      }
      })
    });
    });
    </script> -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("input[type='file']").forEach(input => {
      input.addEventListener("change", function () {
      let file = this.files[0]; //
      let tipo = this.name; // El nombre del input es el tipo de imagen

      if (file) {
        let formData = new FormData();
        formData.append("imagen", file);
        formData.append("tipo", tipo);
        formData.append("_token", "{{ csrf_token() }}");

        fetch("{{ route('prospecto.upload-image') }}", {
          method: "POST",
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
          // Actualizar la imagen mostrada sin recargar la página
          let imgElement = input.nextElementSibling.querySelector(`img`);
          if (imgElement) {
            imgElement.src = data.url;
          }
          }
        })
        .catch(error => console.error("Error al subir la imagen:", error));
      }
      });
    });
    });
  </script>
@endsection