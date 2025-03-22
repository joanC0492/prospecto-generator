<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class ProspectoController extends Controller
{

  public function show()
  {
    // Renderiza la vista principal del prospecto
    return view('prospecto');
  }
  public function edit()
  {
    // Cargar configuración actual
    $prospecto = Config::get('prospecto');
    return view('prospecto.edit', compact('prospecto'));
  }

  public function update(Request $request)
  {
    $request->validate([
      'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      'hero' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      'anio' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      'footer' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      'tabla_final_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      'medios_pago' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      'firma' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      // Texto
      'texto_presentacion' => 'nullable|string', // Acepta HTML del editor
      'texto_tabla_horario' => 'nullable|string',
      'modulos' => 'nullable|array', // Validar que los módulos sean un array
    ]);

    // Definir configuración actualizada
    $configPath = config_path('prospecto.php');
    $currentConfig = require $configPath;

    // Procesar subida de imágenes
    $imagenes = ['logo', 'hero', 'anio', 'footer','tabla_final_image','medios_pago','firma'];
    foreach ($imagenes as $imagen) {
      if ($request->hasFile($imagen)) {
        // Guardar nueva imagen
        $file = $request->file($imagen);
        $fileName = time() . '_' . $imagen . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('image'), $fileName);

        // Actualizar ruta en configuración
        $currentConfig['portada'][$imagen] = '/image/' . $fileName;
      }
    }

    // Actualizar campos de texto
    $textFields = [
      'anio_texto',
      'proforma_numero',
      'lugar_fecha',
      // 'empresa',
      'titular',
      'ciudad',
      'texto_presentacion',
      'tabla_titulo',
      'tabla_horario',
      'tabla_subprecio_1',
      'tabla_subprecio_2',
      'tabla_subprecio_3',
      'tabla_precio_1',
      'tabla_precio_2',
      'tabla_precio_3',
      'tabla_final_texto',
      'tabla_nota',
      'validez_proforma'
    ];

    foreach ($textFields as $field) {
      if ($request->has($field)) {
        $currentConfig['texto'][$field] = $request->input($field);
      }
    }

    // Actualizar módulos dinámicos
    // if ($request->has('modulos')) {
    //   foreach ($request->input('modulos') as $index => $columnas) {
    //     foreach ($columnas as $colIndex => $valor) {
    //       $currentConfig['modulos'][$index]['columnas'][$colIndex] = $valor;
    //     }
    //   }
    // }
    if ($request->has('modulos')) {
      foreach ($request->input('modulos') as $index => $moduloData) {
        // Actualizar la página del módulo
        $currentConfig['modulos'][$index]['pagina'] = $moduloData['pagina'];

        // Actualizar las columnas del módulo
        foreach ($moduloData['columnas'] as $colIndex => $valor) {
          $currentConfig['modulos'][$index]['columnas'][$colIndex] = $valor;
        }
      }
    }

    // Guardar configuración actualizada
    $configContent = "<?php\n\nreturn " . var_export($currentConfig, true) . ";\n";
    File::put($configPath, $configContent);

    // Redirigir con mensaje de éxito
    return redirect()->route('prospecto.edit')
      ->with('success', 'Prospecto actualizado exitosamente');
  }

  public function restore()
  {
    // Definir los valores originales por defecto
    $defaultConfig = [
      'portada' => [
        'logo' => '/image/logo.png',
        'hero' => '/image/home-hero.png',
        'anio' => '/image/home-anio.png',
        'footer' => '/image/home-footer.png',
        'tabla_final_image' => '/image/tabla-precios.png',
        'medios_pago' => '/image/pagos.jpg',
        'firma' => '/image/firma-arguz.png',
      ],
      'texto' => [
        'anio_texto' => 'Año de la recuperación y consolidación de la economía peruana',
        'proforma_numero' => 'PROFORMA N° 0242 – 2025 – AA/GC',
        'lugar_fecha' => 'Tarapoto, 04 de febrero de 2024',
        // 'empresa' => 'Segunda Jerusalén',
        'titular'=> 'Nombre de la persona o personas',
        'ciudad' => 'Segunda Jerusalén',
        'texto_presentacion' => '<p>Estimados señores, es grata la oportunidad de dirigirnos a ustedes y saludarlos cordialmente deseándoles buena salud y prosperidad, a la vez presentarle la proforma de nuestro software:</p>',
        'tabla_titulo' => 'Sistema Administrativo Comercial – Aster',
        'tabla_horario' => 'WhatsApp y Call center: Lunes a sábado: 8am - 8pm',
        'tabla_subprecio_1' => '79',
        'tabla_subprecio_2' => '129',
        'tabla_subprecio_3' => '179',
        'tabla_precio_1' => '79',
        'tabla_precio_2' => '129',
        'tabla_precio_3' => '179',
        'tabla_final_texto' => 'Cada empresa (por RUC) al exceder su límite de cpe mensual pagará por documento adicional según los siguientes rangos:',
        'tabla_nota'=> 'Nota: Precios no incluyen IGV y se pagan por adelantado',
        'validez_proforma' => 'Febrero 2025'
      ],
      'modulos' => [
        [
          'nombre' => 'Módulo de Compras',
          'pagina' => 1,
          'columnas' => [
            "<ul><li>Lista y categorización de productos</li></ul>",
            "<ul><li>Gestión de proveedores</li><li>Registro de compras al contado y crédito</li><li>Registro de gastos con cargo a costo</li><li>Registro de Notas de crédito proveedor</li></ul>",
            "<ul><li>Importación mediante registro de DAM</li><li>Desglose de costo: importación, flete, impuesto, otros.</li></ul>",
          ],
        ],
        [
          'nombre' => 'Módulo de Ventas',
          'pagina' => 1,
          'columnas' => [
            "<ul><li>Cartera de clientes</li><li>Ventas al contado y crédito</li><li>Emisión de Notas de crédito cliente</li></ul>",
            "<ul><li>Emisión de cotizaciones</li><li>Línea de crédito y control por cliente y vendedor</li></ul>",
            "<ul><li>Créditos mediante solicitud y evaluación</li><li>Control de intereses y moras</li></ul>",
          ],
        ],
        [
          'nombre' => 'Módulo de Caja',
          'pagina' => 1,
          'columnas' => [
            "<ul><li>Cobro de ventas</li><li>Transferencias entre cajas/bancos</li></ul>",
            "<ul><li>Pago de compras</li><li>Pago de cuentas por pagar</li><li>Cobro de cuentas por cobrar</li><li>Semaforización de cuentas por cobrar</li></ul>",
            "<ul><li>Préstamos de dinero directo</li><li>Manejo de dólares</li><li>Control de ingresos y egresos por rendir(anticipos y rendiciones de viáticos)</li><li>Envío de estados de cuenta por correo</li></ul>",
          ],
        ],
        [
          'nombre' => 'Módulo de Almacén',
          'pagina' => 2,
          'columnas' => [
            "<ul></ul>",
            "<ul><li>Traslados entre almacenes</li><li>Emisión de guías de remisión</li><li>Control de stock físico</li></ul>",
            "<ul><li>Despachos múltiples de venta</li><li>Recepción múltiple de compras</li><li>Control de stock físico, comprometido y en tránsito</li><li>Entradas y salidas personalizadas</li><li>Entradas y salidas por rendir (movimiento antes de emisión de comprobante)</li><li>Control por lotes según fecha de vencimiento, para reposición con proveedores</li><li>Control por series únicas para cada producto en inventario</li></ul>",
          ],
        ],
        [
          'nombre' => 'Módulo de Reportes y Configuración',
          'pagina' => 2,
          'columnas' => [
            "<ul><li>Dashboard de ventas</li><li>Reportes de ventas</li><li>Reportes de caja</li></ul>",
            "<ul><li>Reportes de compra</li><li>Reportes de inventario y Kardex</li><li>Reportes de cuentas por cobrar y pagar</li><li>Reporte de utilidades</li><li>Multi almacén</li><li>Multi agencia</li><li>Control de permisos por perfil</li></ul>",
            "<ul><li>Multi empresa</li><li>Control de ámbito de acceso y reportería configurable por agencia</li></ul>",
          ],
        ],
        [
          'nombre' => 'CPE con Homologación a SUNAT',
          'pagina' => 2,
          'columnas' => [
            "<ul><li>Hasta 1000 cpe / mes</li><li>1 agencia</li><li>3 usuarios</li></ul>",
            "<ul><li>Hasta 2000 cpe / mes</li><li>3 agencias</li><li>10 usuarios</li><li>Boleta de venta Electrónica</li><li>Factura Electrónica</li><li>Nota de Crédito Boleta y Factura</li><li>Guía de Remisión</li></ul>",
            "<ul><li>Hasta 3000 cpe / mes</li><li>5 agencias</li><li>15 usuarios</li></ul>",
          ],
        ],
      ],
    ];

    // Ruta del archivo de configuración
    $configPath = config_path('prospecto.php');

    // Eliminar imágenes actuales que no sean las originales
    $currentConfig = require $configPath;
    $imagenes = ['logo', 'hero', 'anio', 'footer','tabla_final_image','medios_pago','firma'];

    foreach ($imagenes as $imagen) {
      $currentPath = public_path(ltrim($currentConfig['portada'][$imagen], '/'));
      $defaultPath = public_path(ltrim($defaultConfig['portada'][$imagen], '/'));

      // Si la imagen actual es diferente de la original, eliminarla
      if ($currentPath !== $defaultPath && File::exists($currentPath)) {
        File::delete($currentPath);
      }
    }

    // Guardar configuración por defecto
    $configContent = "<?php\n\nreturn " . var_export($defaultConfig, true) . ";\n";
    File::put($configPath, $configContent);

    // Redirigir con mensaje de éxito
    return redirect()->route('prospecto.edit')
      ->with('success', 'Prospecto restaurado a valores por defecto');
  }


  public function destroy(string $id)
  {
  }

  public function index()
  {
  }


  public function create()
  {
  }

  public function store(Request $request)
  {
  }
}
