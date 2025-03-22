@extends("layouts.layout")

@section('title', 'Prospecto Vista')

@section('content')
    <!-- Portada -->
    <section id="portada" class="">
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
    @endphp
    <!-- All Pages -->
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
                            <p class="mb-0">SEÑOR:</p>
                            <p class="mb-0">……………………………..</p>
                            <p>
                                <span class="prospecto__business">{{ config("prospecto.texto.empresa") }}</span>
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
                                        @foreach (config('prospecto.modulos') as $modulo)
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

    <section id="page-2" class="page-all">
        <div class="container page-a4" style="outline: 1px solid red">
            <div class="row">
                <div class="col-12 px-0">
                    <div class="page-all__header">
                        <figure class="text-center header">
                            <img src={{ asset("/image/header.png")}} class="img-fluid header__img" alt="Header" />
                        </figure>
                    </div>
                    <div class="page-all__content">
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
                                        <!-- Modulo -->
                                        <tr>
                                            <td colspan="3" class="table-subtitle">
                                                Módulo de Almacén
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <ul></ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <ul>
                                                        <li>Traslados entre almacenes</li>
                                                        <li>Emisión de guías de remisión</li>
                                                        <li>Control de stock físico</li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <ul>
                                                        <li>Despachos múltiples de venta</li>
                                                        <li>Recepción múltiple de compras</li>
                                                        <li>
                                                            Control de stock físico, comprometido y en
                                                            tránsito
                                                        </li>
                                                        <li>Entradas y salidas personalizadas</li>
                                                        <li>
                                                            Entradas y salidas por rendir (movimiento
                                                            antes de emisión de comprobante)
                                                        </li>
                                                        <li>
                                                            Control por lotes según fecha de vencimiento,
                                                            para reposición con proveedores
                                                        </li>
                                                        <li>
                                                            Control por series únicas para cada producto
                                                            en inventario
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modulo -->
                                        <tr>
                                            <td colspan="3" class="table-subtitle">
                                                Módulo de Reportes y Configuración
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <ul>
                                                        <li>Dashboard de ventas</li>
                                                        <li>Reportes de ventas</li>
                                                        <li>Reportes de caja</li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <ul>
                                                        <li>Reportes de compra</li>
                                                        <li>Reportes de inventario y Kardex</li>
                                                        <li>Reportes de cuentas por cobrar y pagar</li>
                                                        <li>Reporte de utilidades</li>
                                                        <li>Multi almacén</li>
                                                        <li>Multi agencia</li>
                                                        <li>Control de permisos por perfil</li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <ul>
                                                        <li>Multi empresa</li>
                                                        <li>
                                                            Control de ámbito de acceso y reportería
                                                            configurable por agencia
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modulo -->
                                        <tr>
                                            <td colspan="3" class="table-subtitle">
                                                CPE con Homologación a SUNAT
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div>
                                                    <ul>
                                                        <li>Boleta de venta Electrónica</li>
                                                        <li>Factura Electrónica</li>
                                                        <li>Nota de Crédito Boleta y Factura</li>
                                                        <li>Guía de Remisión</li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <!-- Mensaje -->
                                        <tr>
                                            <td colspan="3" class="table-message">
                                                <div class="text-center">
                                                    WhatsApp y Call center: Lunes a sábado: 8am - 8pm
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Precio 1 -->
                                        <tr>
                                            <td class="table-price-1">
                                                <div>S/ 79</div>
                                            </td>
                                            <td class="table-price-1">
                                                <div>S/ 129</div>
                                            </td>
                                            <td class="table-price-1">
                                                <div>S/ 179</div>
                                            </td>
                                        </tr>
                                        <!-- Precio 2 -->
                                        <tr>
                                            <td class="table-price-2">
                                                <div>S/ 79</div>
                                            </td>
                                            <td class="table-price-2">
                                                <div>S/ 129</div>
                                            </td>
                                            <td class="table-price-2">
                                                <div>S/ 179</div>
                                            </td>
                                        </tr>
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
                                Cada empresa (por RUC) al exceder su límite de cpe mensual
                                pagará por documento adicional según los siguientes rangos:
                            </p>
                            <img src={{ asset("/image/tabla-precios.png")}} alt="Tabla Rangos" />
                            <p class="table-text-final__last text-start">
                            NOTA: Todos los montos y precios de esta proforma son expresados SIN IGV y se pagan por adelantado.
                            </p>
                        </div>
                        <div class="last-sections medios-de-pago">
                            <div class="text-start">
                                <p class="mb-4">
                                    <span class="last-sections__title">MEDIOS DE PAGO:</span>
                                </p>
                                <figure class="mb-0 text-center">
                                    <img src={{ asset("/image/pagos.jpg")}} class="img-fluid medios-de-pago__img"
                                        alt="Medios de Pago" />
                                </figure>
                            </div>
                        </div>
                        <div class="last-sections medios-de-pago mt-5">
                            <div class="text-start">
                                <p class="mb-4">
                                    <span class="last-sections__title">VALIDEZ DE LA PROFORMA:</span>
                                    <span class="last-sections__response d-inline-block ms-3">Febrero 2025</span>
                                </p>
                            </div>
                        </div>
                        <div class="firma">
                            <div class="text-center">
                                <p class="mb-0">Atentamente,</p>
                                <img src={{ asset("/image/firma-arguz.png")}} alt="Firma" class="firma__img mt-4" />
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
