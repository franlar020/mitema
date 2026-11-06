# Fauna del Velazco

Tema WordPress a medida para la clínica veterinaria **Fauna del Velazco**, dirigida por la Dra. Victoria Boratto.

## Stack

- WordPress 7.1.4
- PHP 8.2
- WooCommerce 11.2.2
- WooCommerce Mercado Pago 8.10.0
- Joinchat 6.4.2
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

El resultado queda en `docs/Fauna-del-Velazco-Proyecto.docx`. No requiere Word instalado: usa la librería `docx` y los assets PNG de `docs/assets/`.

## Estructura

```text
mitema/
├── style.css                  # Cabecera obligatoria del tema
├── functions.php              # Bootstrap del tema
├── header.php                 # Shell, navegación y menú móvil
├── footer.php                 # Footer, contacto y wp_footer()
├── front-page.php             # Home editorial
├── page.php                   # Página
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
│   └── woocommerce.php        # Compatibilidad WooCommerce/HPOS/bloques
├── template-parts/            # Tarjetas y estados vacíos
├── assets/
│   ├── src/
│   │   ├── css/app.css        # Entrada de Tailwind v4
│   │   └── js/app.js          # Entrada de JavaScript
│   ├── dist/                  # Assets compilados (se commitean)
│   ├── fonts/                 # Fraunces y Manrope variables
│   └── img/                   # Logo, favicon y línea botánica
├── docs/
│   ├── Fauna-del-Velazco-Proyecto.docx
│   └── assets/                # PNG de logo para el documento
├── scripts/
│   └── build-docx.mjs         # Generador del documento Word
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

## Fase actual

**Fases 0 y 1 completadas.** El tema está activo, la home y las vistas institucionales funcionan en desktop y móvil, y la tienda ya usa el shell visual del sitio.

La próxima etapa es la **Fase 2: tienda WooCommerce**:

1. Archivo de productos, tarjetas y ficha de producto.
2. Carrito, checkout y Mi cuenta integrados al diseño.
3. Pruebas de compra con Mercado Pago.
4. Fase 3: CPTs, agenda, disponibilidad y wizard de reserva.
5. Fase 4: seña con WooCommerce + Mercado Pago.
6. Fase 5: emails, recordatorios y Joinchat.
7. Fase 6: QA, accesibilidad, performance y lanzamiento.

El plan completo, el modelo de datos y el flujo de reserva están en [`INIT.md`](INIT.md).

## Documentación

- [`INIT.md`](INIT.md) — plan completo, arquitectura, fases, modelo de datos, flujo de reserva y riesgos.
- [`AGENTS.md`](AGENTS.md) — reglas de desarrollo, comandos y restricciones críticas.
- [`docs/Fauna-del-Velazco-Proyecto.docx`](docs/Fauna-del-Velazco-Proyecto.docx) — documento temático para la clienta, con portada, paleta, capturas, fases y flujo de reserva.
- `npm run docs` — regenera el Word después de cambiar el plan.

## Notas

- El `screenshot.png` del tema está generado a 1200 × 900 desde la home de Fase 1.
- El sitio local está en `https://localhost/webwordpress/` con SSL autofirmado; para pruebas con `curl` usar `-k`.
- El modo “Coming soon” de WooCommerce está desactivado en local para revisar la tienda.
- La tienda, el carrito, el checkout y Mi cuenta usan el markup base de WooCommerce hasta la Fase 2.
- Los CTA de reserva apuntan a `#reservar`; la pantalla real de reserva llega en la Fase 3.
- El logo se puede reemplazar desde **Apariencia → Personalizar → Identidad del sitio → Logo**.
- WordPress no permite subir SVG por defecto. El tema incluye sus SVG y los usa como fallback; para subir un logo propio desde el admin, usar PNG o WebP, o instalar un plugin de sanitización SVG.
