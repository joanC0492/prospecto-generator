@extends("layouts.layout")

@section('title', 'Prospecto Vista')

@section('content')
    <!-- Portada -->
    <section id="portada">
        <div class="container page-a4" style="outline: 1px solid red">
            <div class="row">
                <div class="col-12 px-0">
                    <figure class="text-center home__figure-logo">
                        <img src={{ asset(config("prospecto.portada.logo")) }} class="home__logo" alt="Logo main" />
                    </figure>
                    <figure class="text-center mb-0 home__figure-hero">
                        <img src={{ asset(config("prospecto.portada.hero"))}} class="img-fluid" alt="Hero" />
                    </figure>

                    <figure class="text-center home__figure-anio">
                        <img src={{ asset(config("prospecto.portada.anio"))}} class="img-fluid home__anio" alt="2025" />
                    </figure>
                </div>
                <div class="col-12 px-0 align-self-end">
                    <figure class="text-center mb-0 home__figure-footer">
                        <img src={{ asset(config("prospecto.portada.footer"))}} class="img-fluid home__footer"
                            alt="Footer" />
                    </figure>
                </div>
            </div>
        </div>
    </section>

@php
  // Agrupar módulos por página
  $modulosPorPagina = [];
  foreach (config('prospecto.modulos') as $modulo) {
    $pagina = $modulo['pagina'];
    if (!isset($modulosPorPagina[$pagina])) {
      $modulosPorPagina[$pagina] = [];
    }
    $modulosPorPagina[$pagina][] = $modulo;
  }
  $modulosPagina1 = isset($modulosPorPagina[1]) ? $modulosPorPagina[1] : [];
  // Eliminamos la pagina 1 de los modulos
  unset($modulosPorPagina[1]);
@endphp
    <section id="page-1" class="page-all">
        <div class="container page-a4" style="outline: 1px solid red">
            <div class="row">
                <div class="col-12 px-0">
                    <div class="page-all__header">
                        <figure class="text-center header">
                            <img src={{ asset("/image/header.png")}} class="img-fluid header__img" alt="Header" />
                        </figure>
                    </div>
                    <div class="page-all__content">
                        <div class="prospecto__anio-name text-center">
                            <p>{{config("prospecto.texto.anio_texto") }}</p>
                        </div>
                        <div class="prospecto__title text-center">
                            <p>{{ config("prospecto.texto.proforma_numero") }}</p>
                        </div>
                        <div class="text-end">
                            <p class="mb-0">{{ config("prospecto.texto.lugar_fecha") }}</p>
                        </div>
                        <div>
                            <!-- Titular -->
                            <p class="mb-0">SEÑOR(ES):</p>
                            <!-- <p class="mb-0">……………………………..</p> -->
                            <p class="mb-0 prospecto__owner" style="text-decoration:underline;text-decoration-style:dotted;font-size:11pt;font-weight: bold;">{{ config("prospecto.texto.titular") }}&nbsp;&nbsp;&nbsp;</p>
                            <p>
                                <!-- ciudad -->
                                <span class="prospecto__business">{{ config("prospecto.texto.ciudad") }}</span>
                                <span>–</span>
                            </p>
                        </div>
                        <div class="prospecto__text sangria">
                            {!! config('prospecto.texto.texto_presentacion') !!}
                        </div>

                        <div class="tables__title text-center">
                            <div class="alert-subrayado shadow">
                                <p class="m-0">{{ config("prospecto.texto.tabla_titulo") }}</p>
                            </div>
                        </div>

                        <div class="tables">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="bg-ar-primary">
                                        <tr class="text-center">
                                            <th scope="col" class="bg-ar-primary text-white">
                                                Plan<br />✫
                                            </th>
                                            <th scope="col" class="bg-ar-primary text-white">
                                                Plan<br />✫✫
                                            </th>
                                            <th scope="col" class="bg-ar-primary text-white">
                                                Plan<br />✫✫✫
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($modulosPagina1 as $modulo)
                                            <!-- Nombre del módulo -->
                                            <tr class="table_row_modulo">
                                                <td colspan="3" class="table-subtitle">{{ $modulo['nombre'] }}</td>
                                            </tr>
                                            <!-- Contenido del módulo -->
                                            <tr class="table_row_columnas">
                                                @foreach ($modulo['columnas'] as $columna)
                                                    <td>
                                                        <div>{!! $columna !!}</div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 px-0 align-self-end">
                    <div class="page-all__footer">
                        <figure class="text-center mb-0 footer">
                            <img src={{ asset("/image/footer.png")}} class="img-fluid footer-img" alt="Footer" />
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

@foreach ($modulosPorPagina as $pagina => $modulos)
  <section id="page-{{ $pagina }}" class="page-all foreach">
    <div class="container page-a4" style="outline: 1px solid red">
      <div class="row">
        <div class="col-12 px-0">
          <div class="page-all__header">
            <figure class="text-center header">
              <img src="{{ asset('/image/header.png') }}" class="img-fluid header__img" alt="Header" />
            </figure>
          </div>
          <div class="page-all__content">
            <div class="tables">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead class="bg-ar-primary">
                    <tr class="text-center">
                      <th scope="col" class="bg-ar-primary text-white">Plan<br />✫</th>
                      <th scope="col" class="bg-ar-primary text-white">Plan<br />✫✫</th>
                      <th scope="col" class="bg-ar-primary text-white">Plan<br />✫✫✫</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($modulos as $modulo)
                      <!-- Nombre del módulo -->
                      <tr>
                        <td colspan="3" class="table-subtitle">
                          {{ $modulo['nombre'] }}
                        </td>
                      </tr>
                      <!-- Contenido del módulo -->
                      <tr>
                        @foreach ($modulo['columnas'] as $columna)
                          <td><div>{!! $columna !!}</div></td>
                        @endforeach
                      </tr>
                      @if ($loop->last)
                        <!-- Mensaje -->
                        <tr>
                          <td colspan="3" class="table-message">
                            <div class="text-center">
                              {{ config("prospecto.texto.tabla_horario") }}
                            </div>
                          </td>
                        </tr>
                        <!-- Precio 1 -->
                        <tr>
                            <td class="table-price-1">
                                <p class="mb-0" style="font-size: 11pt;">Activación:</p>
                                <div>S/ {{ config("prospecto.texto.tabla_subprecio_1") }}</div>
                            </td>
                            <td class="table-price-1">
                              <p class="mb-0" style="font-size: 11pt;">Activación:</p>
                              <div>S/ {{ config("prospecto.texto.tabla_subprecio_2") }}</div>
                            </td>
                            <td class="table-price-1">
                              <p class="mb-0" style="font-size: 11pt;">Activación:</p>
                              <div>S/ {{ config("prospecto.texto.tabla_subprecio_3") }}</div>
                            </td>
                        </tr>
                        <!-- Precio 2 -->
                        <tr>
                            <td class="table-price-2">
                              <p class="mb-0" style="font-size: 11pt;">Pago mensual:</p>
                              <div>S/ {{ config("prospecto.texto.tabla_precio_1") }}</div>
                            </td>
                            <td class="table-price-2">
                              <p class="mb-0" style="font-size: 11pt;">Pago mensual:</p>
                              <div>S/ {{ config("prospecto.texto.tabla_precio_2") }}</div>
                            </td>
                            <td class="table-price-2">
                              <p class="mb-0" style="font-size: 11pt;">Pago mensual:</p>
                              <div>S/ {{ config("prospecto.texto.tabla_precio_3") }}</div>
                            </td>
                        </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endforeach

    <section id="page-3" class="page-all">
        <div class="container page-a4" style="outline: 1px solid red">
            <div class="row">
                <div class="col-12 px-0">
                    <div class="page-all__header">
                        <figure class="text-center header">
                            <img src={{ asset("/image/header.png")}} class="img-fluid header__img" alt="Header" />
                        </figure>
                    </div>
                    <div class="page-all__content">
                        <div class="table-text-final">
                            <p class="table-text-final__first">
                              {{ config("prospecto.texto.tabla_final_texto") }}
                            </p>
                            <img src={{ asset(config("prospecto.portada.tabla_final_image"))}} alt="Tabla Rangos" />
                            <p class="table-text-final__last text-start">
                                {{ config("prospecto.texto.tabla_nota") }}
                            </p>
                        </div>
                        <div class="last-sections medios-de-pago">
                            <div class="text-start">
                                <p class="mb-4">
                                    <span class="last-sections__title">MEDIOS DE PAGO:</span>
                                </p>
                                <figure class="mb-0 text-center">
                                    <img src={{ asset(config("prospecto.portada.medios_pago"))}} class="img-fluid medios-de-pago__img"
                                        alt="Medios de Pago" />
                                </figure>
                            </div>
                        </div>
                        <div class="last-sections medios-de-pago mt-5">
                            <div class="text-start">
                                <p class="mb-4">
                                  <span class="last-sections__title">VALIDEZ DE LA PROFORMA:</span>
                                  <span class="last-sections__response d-inline-block ms-3">{{ config("prospecto.texto.validez_proforma") }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="firma">
                            <div class="text-center">
                                <p class="mb-0">Atentamente,</p>
                                <img src={{ asset(config("prospecto.portada.firma"))}} alt="Firma" class="firma__img mt-4" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 px-0 align-self-end">
                    <div class="page-all__footer">
                        <figure class="text-center mb-0 footer">
                            <img src={{ asset("/image/footer.png")}} class="img-fluid footer-img" alt="Footer" />
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    @vite("resources/js/app.js")
@endsection
