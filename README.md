# Fauna del Velazco

Tema WordPress a medida para la clínica veterinaria **Fauna del Velazco**, dirigida por la Dra. Victoria Boratto.

## Stack

- WordPress 7.1.4
- PHP 8.2
- WooCommerce 11.2.2
- WooCommerce Mercado Pago (a instalar en producción)
- Joinchat (previsto para la puesta en marcha)
- Tailwind CSS v4 compilado con npm
- esbuild para el JavaScript del tema
- Fuentes variables Fraunces + Manrope autoalojadas

## Requisitos

- PHP 8.1 o superior
- Node.js 20 o superior
- WooCommerce activo para la tienda
- Mercado Pago para WooCommerce activo para los pagos
- Joinchat activo para el widget de WhatsApp

## Instalación

```bash
npm install
npm run build
```

Para desarrollo:

```bash
npm run dev:css
npm run dev:js
```

Cada comando queda observando cambios. En producción alcanza con `npm run build`.

El documento de proyecto se regenera con:

```bash
npm run docs
```

La guía de carga de productos se genera con:

```bash
npm run docs:productos
```

El resultado queda en `docs/Fauna-del-Velazco-Proyecto.docx` y `docs/Guia-Subida-Productos-Fauna-del-Velazco.docx`. No requiere Word instalado: usa la librería `docx` y los assets PNG de `docs/assets/`. `npm run docs:all` regenera además la guía de imágenes existente.

## Estructura

```text
mitema/
├── style.css                  # Cabecera obligatoria del tema
├── functions.php              # Bootstrap del tema
├── header.php                 # Shell, navegación y menú móvil
├── footer.php                 # Footer, contacto y wp_footer()
├── front-page.php             # Home editorial
├── archive-product.php        # Archivo de la tienda
├── single-product.php         # Ficha de producto
├── page.php                   # Página (incluye carrito, checkout y cuenta)
├── single.php                 # Nota / entrada
├── archive.php                # Archivos
├── search.php                 # Búsqueda
├── 404.php                    # Error 404
├── searchform.php             # Buscador
├── comments.php               # Comentarios
├── theme.json                 # Tokens del editor y estilos de bloque
├── inc/
│   ├── setup.php              # Supports, menús, tamaños, widgets
│   ├── enqueue.php            # CSS/JS compilados y fuentes
│   ├── logo.php               # Logo y favicon de respaldo
│   ├── template-tags.php      # Iconos SVG y helpers de contacto
│   ├── nav.php                # Fallbacks de menús
│   ├── customizer.php         # Contacto, redes y URL de reservas
│   ├── catalogo-productos.php # Catálogo y URLs de imágenes por SKU
│   └── woocommerce.php        # Integración WooCommerce/HPOS/bloques
├── tools/
│   └── sembrar-productos.php  # Alta idempotente de los 15 productos
├── template-parts/            # Tarjetas y estados vacíos
├── assets/
│   ├── src/
│   │   ├── css/app.css        # Entrada de Tailwind v4
│   │   └── js/app.js          # Entrada de JavaScript
│   ├── dist/                  # Assets compilados (se commitean)
│   ├── fonts/                 # Fraunces y Manrope variables
│   └── img/                   # Logo, favicon, línea botánica y placeholder
├── docs/
│   ├── Fauna-del-Velazco-Proyecto.docx
│   ├── Guia-Subida-Productos-Fauna-del-Velazco.docx
│   └── assets/                # PNG de logo para el documento
├── languages/                 # Traducciones
├── INIT.md                    # Plan completo, fases y flujo de reserva
└── AGENTS.md                  # Reglas para agentes y desarrolladores
```

## Identidad visual

- **Paleta:** forest `#1F3D2B`, cream `#F7F3E8`, terracotta `#C4704F`, terracotta ink `#A85638`, sage `#8FA98F`, charcoal `#222222`.
- **Tipografía:** Fraunces para display y Manrope para UI/cuerpo, autoalojadas en `assets/fonts/`.
- **Estética:** guía botánica editorial, arcos, bordes finos, tarjetas de papel, patrón de puntos y composiciones asimétricas.
- **Contraste:** para texto pequeño sobre crema se usa `terracotta-ink`, no el terracotta plano.
- **Movimiento:** las animaciones respetan `prefers-reduced-motion` y los focus states quedan visibles.

## Decisiones del proyecto

- **Reservas:** CPT `fv_paciente`, `fv_servicio` y `fv_turno`, con una capa repositorio para poder migrar a tablas propias si la agenda crece.
- **Turnos:** seña online con Mercado Pago. El tema no procesa pagos: crea una orden WooCommerce y deja que el plugin de Mercado Pago haga el checkout.
- **Profesional:** una sola agenda, Dra. Victoria Boratto.
- **Idioma/moneda:** español Argentina, ARS, zona `America/Argentina/Buenos_Aires`.
- **Tailwind:** v4 compilado, sin CDN.
- **Logo:** badge circular con huella/hoja, más variantes horizontal, mark y favicon.

## Compatibilidad

- **WooCommerce:** se declara compatibilidad con HPOS (`custom_order_tables`) y checkout por bloques. No se copian plantillas de checkout/carrito para no romper los hooks de pago.
- **Mercado Pago:** el tema no encola ni desencola scripts del plugin. El checkout y los webhooks quedan a cargo del plugin.
- **Joinchat:** el tema llama `wp_footer()` y no aplica `overflow: hidden` global, por lo que el widget flotante no se bloquea.
- **CSS:** los estilos globales de WordPress y WooCommerce no usan capas; los ajustes críticos viven al final de `app.css`, fuera de `@layer`.

## Productos y fotografías

El catálogo de demostración vive en `inc/catalogo-productos.php`, indexado por SKU. Cada entrada define nombre, categoría, precio, descripciones, stock, destacado y la URL de la imagen.

Para crear los productos que falten:

```bash
/c/xampp/php/php.exe tools/sembrar-productos.php
```

El script es idempotente: no duplica ni sobreescribe productos existentes. Para cambiar una foto, subirla a **Medios → Añadir nuevo**, copiar la URL del archivo y reemplazarla en la línea `imagen` del SKU correspondiente. La guía completa para el equipo de la clínica está en `docs/Guia-Subida-Productos-Fauna-del-Velazco.docx`.

## Fase actual

**Fases 0, 1 y 2 completadas.** El tema está activo, la home y las vistas institucionales funcionan en desktop y móvil, y la tienda tiene catálogo, ficha de producto, carrito, checkout y Mi cuenta integrados al diseño.

La Fase 2 incluyó:

1. Archivo de productos, tarjetas, filtros por categoría y ficha de producto.
2. 15 productos de demostración publicados con SKU, stock, precios y descripciones.
3. Imágenes por URL de Medios, con recuadros de respaldo y placeholder del tema.
4. Carrito, checkout y Mi cuenta integrados sin copiar plantillas críticas.
5. Contador de carrito en el header con actualización por AJAX.
6. Guía de carga de productos y documento de proyecto actualizados.

La próxima etapa es la **Fase 3: reservas**:

1. CPTs `fv_paciente`, `fv_servicio` y `fv_turno`.
2. Repositorio y motor de disponibilidad.
3. Wizard de reserva y perfil de mascota.
4. Fase 4: seña con WooCommerce + Mercado Pago.
5. Fase 5: emails, recordatorios y Joinchat.
6. Fase 6: QA, accesibilidad, performance y lanzamiento.

## Notas

- El `screenshot.png` del tema está generado a 1200 × 900 desde la home de Fase 1.
- El sitio local está en `https://localhost/webwordpress/` con SSL autofirmado; para pruebas con `curl` usar `-k`.
- El modo “Coming soon” de WooCommerce está desactivado en local para revisar la tienda.
- La tienda tiene 15 productos de demostración; las fotos definitivas se cargan desde Medios y se vinculan en `inc/catalogo-productos.php`.
- El pago con Mercado Pago todavía no se probó porque el plugin no está instalado en el entorno local.
- Los CTA de reserva apuntan a `#reservar`; la pantalla real de reserva llega en la Fase 3.
- El logo se puede reemplazar desde **Apariencia → Personalizar → Identidad del sitio → Logo**.
- WordPress no permite subir SVG por defecto. El tema incluye sus SVG y los usa como fallback; para subir un logo propio desde el admin, usar PNG o WebP, o instalar un plugin de sanitización SVG.
