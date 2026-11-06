# INIT · Fauna del Velazco

Documento maestro del proyecto del tema WordPress para la clínica veterinaria **Fauna del Velazco**, dirigida por la **Dra. Victoria Boratto**.

- **Tema:** `mitema`
- **Text domain:** `fauna-del-velazco`
- **Versión:** `0.1.0`
- **Entorno local:** `https://localhost/webwordpress/`
- **Estado general:** Fase 0 y Fase 1 completadas. Fase 2 es el siguiente paso.
- **Documento para clienta:** `docs/Fauna-del-Velazco-Proyecto.docx`

---

## 1. Visión del proyecto

Fauna del Velazco necesita una presencia digital cálida, profesional y coherente con la atención personalizada que ofrece. El sitio debe cumplir tres funciones sin perder una identidad editorial propia:

1. **Presentar la clínica y a la profesional** con un tono cercano, claro y confiable.
2. **Vender productos** de la tienda mediante WooCommerce y Mercado Pago.
3. **Gestionar turnos y pacientes** con una experiencia simple: elegir servicio, elegir mascota, elegir fecha, confirmar y pagar la seña.

La dirección visual elegida es una **guía botánica editorial**: fondo crema, verde bosque, terracota, tipografía serif expresiva, líneas botánicas, arcos y composiciones asimétricas. La sensación buscada es la de un cuaderno de campo cuidado, no la de una clínica genérica.

### Principios

- **Una sola profesional, una sola agenda.** La Dra. Victoria Boratto es el centro de la confianza.
- **Claridad antes que decoración.** Cada sección debe explicar qué se ofrece, cómo se reserva y qué pasa después.
- **Cercanía sin infantilismo.** La mascota es protagonista, pero la comunicación es adulta y profesional.
- **Mobile first real.** La mayoría de las reservas y consultas llegarán desde el teléfono.
- **WooCommerce sin fricción.** La tienda y la seña usan el ecosistema WooCommerce; el tema no procesa pagos.
- **Accesibilidad y performance.** Contraste, foco visible, HTML semántico, assets locales y carga diferida.

---

## 2. Alcance funcional

### 2.1 Sitio institucional

- Inicio con hero, propuesta de valor, servicios, proceso de reserva, tienda, sobre la profesional, preguntas frecuentes y contacto.
- Página de servicios con detalle de cada prestación.
- Página “Sobre la clínica” / “Nosotros”.
- Página de contacto con dirección, horarios, teléfono, email, WhatsApp, redes y mapa.
- Blog / notas de salud animal y novedades.
- Páginas legales: privacidad, términos, defensa de las y los consumidores.
- Navegación principal, menú móvil y footer con accesos rápidos.

### 2.2 Tienda

- Catálogo de productos físicos: alimentos, accesorios, higiene, farmacia, etc.
- Categorías, etiquetas y búsqueda.
- Ficha de producto con imagen, precio, stock, variaciones y descripción.
- Carrito y checkout con bloques de WooCommerce.
- Pagos exclusivamente mediante el plugin **WooCommerce Mercado Pago**.
- Envíos, retiro en clínica y costos configurables desde WooCommerce.
- Correos transaccionales de WooCommerce.

### 2.3 Reservas

- Registro/inicio de sesión de clientes.
- Perfiles de mascotas: nombre, especie, raza, sexo, nacimiento, peso, esterilización, microchip, alergias y notas.
- Selección de servicio, mascota, fecha y horario.
- Agenda de una sola profesional.
- Seña online mediante orden WooCommerce + Mercado Pago.
- Historial de turnos y estados.
- Reprogramación y cancelación según política.
- Recordatorios por email y WhatsApp.
- Panel de administración para la clínica.

### 2.4 Canales de contacto

- WhatsApp mediante **Joinchat** (widget flotante).
- Enlaces directos a WhatsApp desde botones y footer cuando el número esté configurado.
- Email, teléfono, Instagram y Facebook configurables desde el Personalizador.
- Aviso de que la atención es con turno previo.

---

## 3. Identidad visual

### 3.1 Paleta

| Token | Hex | Uso |
|---|---|---|
| `forest` | `#1F3D2B` | Color principal, textos, fondos oscuros |
| `forest-soft` | `#2F5A40` | Variantes y hover |
| `forest-deep` | `#142A1D` | Footer y bloques de máximo contraste |
| `cream` | `#F7F3E8` | Fondo base |
| `cream-dark` | `#EFE8D8` | Superficies y separadores |
| `paper` | `#FFFDF7` | Tarjetas y notas |
| `terracotta` | `#C4704F` | Acento, iconos, detalles |
| `terracotta-ink` | `#A85638` | Texto pequeño sobre crema (contraste AA) |
| `terracotta-soft` | `#E2A487` | Acentos suaves |
| `sage` | `#8FA98F` | Acompañamiento botánico |
| `sage-soft` | `#C5D3C3` | Texto secundario sobre oscuro |
| `charcoal` | `#222222` | Texto de cuerpo |

### 3.2 Tipografía

- **Fraunces Variable** para títulos, citas y números editoriales.
- **Manrope Variable** para cuerpo, navegación, botones y datos.
- Fuentes autoalojadas en `assets/fonts/`; sin Google Fonts ni CDN.
- Escala editorial con `clamp()` para adaptar titulares sin saltos bruscos.
- Eyebrows en mayúsculas, tracking amplio y terracota oscuro.

### 3.3 Recursos gráficos

- Marca circular: huella + hoja + rama.
- Variantes: `logo-horizontal.svg`, `logo-badge.svg`, `logo-mark.svg`, `favicon.svg`.
- Línea botánica `botanical-branch.svg`.
- Patrón de puntos sutil.
- Arcos, bordes finos, tarjetas de papel y botones tipo píldora.
- Animación de entrada respetuosa de `prefers-reduced-motion`.

### 3.4 Tono de voz

- Español Argentina, voseo: “elegí”, “reservá”, “escribinos”, “podés”.
- Cercano, claro, sin tecnicismos innecesarios.
- La salud y el bienestar de la mascota primero.
- Sin promesas médicas absolutas ni lenguaje alarmista.

---

## 4. Stack y entorno

| Componente | Versión / detalle |
|---|---|
| WordPress | 7.1.4 |
| PHP | 8.2.12 |
| WooCommerce | 11.2.2 |
| WooCommerce Mercado Pago | 8.10.0 |
| Joinchat | 6.4.2 |
| Node.js | 24.16.0 |
| npm | 11.13.0 |
| Tailwind CSS | v4 compilado localmente |
| JavaScript | esbuild |
| Base de datos | MySQL en puerto 3307 |
| Zona horaria | `America/Argentina/Buenos_Aires` |
| Moneda | ARS |
| Formato de fecha | `d/m/Y` |
| Inicio de semana | lunes |

### Comandos

```bash
npm install
npm run build      # compila CSS y JS para producción
npm run dev:css    # observa Tailwind
npm run dev:js     # observa esbuild
```

No hay `wp-cli` disponible en el entorno. Para tareas de WordPress se usa un bootstrap con `wp-load.php` desde PHP CLI.

---

## 5. Arquitectura del tema

### 5.1 Archivos principales

| Archivo | Responsabilidad |
|---|---|
| `style.css` | Cabecera obligatoria del tema |
| `functions.php` | Bootstrap y carga de módulos |
| `inc/setup.php` | Supports, menús, imágenes, widgets, body classes |
| `inc/enqueue.php` | CSS/JS compilados y preload de fuentes |
| `inc/logo.php` | Logo de respaldo y favicon |
| `inc/template-tags.php` | Iconos SVG, helpers de contacto y tienda |
| `inc/nav.php` | Fallbacks de menús |
| `inc/customizer.php` | Datos de contacto, redes y URL de reservas |
| `inc/woocommerce.php` | Compatibilidad HPOS/bloques y wrappers |
| `header.php` / `footer.php` | Shell global y `wp_footer()` |
| `front-page.php` | Landing institucional |
| `page.php` / `single.php` | Página y nota |
| `archive.php` / `search.php` / `404.php` | Archivos, búsqueda y error |
| `template-parts/` | Tarjetas, estados vacíos |
| `theme.json` | Tokens del editor y estilos globales |
| `assets/src/css/app.css` | Sistema de diseño Tailwind v4 |
| `assets/src/js/app.js` | Menú móvil y comportamientos |
| `assets/dist/` | CSS/JS compilados y versionados |

### 5.2 Módulos futuros de reservas

```text
inc/booking/
├── post-types.php      # CPTs y taxonomías
├── roles.php           # Capacidades de cliente/recepción
├── repository.php      # Acceso a datos y transacciones
├── availability.php    # Reglas, excepciones y cálculo de slots
├── booking.php         # Creación, confirmación y cancelación
├── payments.php        # Puente con WooCommerce/Mercado Pago
├── emails.php          # Correos transaccionales
├── reminders.php       # Recordatorios y trabajos programados
├── admin.php           # Agenda y columnas del admin
└── rest.php            # Endpoints de disponibilidad y reserva
```

La capa repositorio permite empezar con CPTs y migrar a tablas propias si la agenda o el volumen de turnos lo justifican.

### 5.3 Compatibilidad WooCommerce

- Declaración de compatibilidad con **HPOS** (`custom_order_tables`).
- Declaración de compatibilidad con **cart/checkout blocks**.
- No se copian ni sobreescriben las plantillas de checkout/carrito.
- No se desencolan scripts de Mercado Pago ni de Joinchat.
- El tema puede personalizar la tienda y la ficha de producto, pero el pago queda en manos del plugin.
- Las plantillas WooCommerce se implementarán en Fase 2, respetando versiones y hooks.

### 5.4 Nota sobre CSS y WordPress

Tailwind v4 usa capas (`@layer`). Los estilos globales de `theme.json` y los CSS de WooCommerce se imprimen sin capas y pueden ganar sobre utilidades de Tailwind. Por eso:

- No se define `styles.elements.heading.color` ni `styles.elements.link.color` a nivel global.
- El color de títulos de bloques se define en `styles.blocks.core/heading`.
- Los ajustes imprescindibles para WooCommerce viven al final de `app.css`, fuera de capas.
- Los títulos sobre fondos oscuros usan clases explícitas (`text-cream`, `fv-display--light`).

---

## 6. Modelo de datos de reservas

### 6.1 CPT `fv_paciente`

Representa a la mascota. El dueño es un usuario de WordPress.

| Campo | Tipo | Notas |
|---|---|---|
| `owner_id` | usuario | Autor del CPT |
| `name` | texto | Nombre de la mascota |
| `species` | taxonomía/texto | Perro, gato, otro |
| `breed` | texto | Raza o mestizo |
| `sex` | selección | Macho/hembra |
| `birthdate` | fecha | Para edad y dosis |
| `weight` | número | kg |
| `sterilized` | booleano | Sí/no |
| `microchip` | texto | Opcional |
| `allergies` | texto largo | Alergias y reacciones |
| `notes` | texto largo | Cuidados especiales |
| `photo` | imagen | Opcional |

### 6.2 CPT `fv_servicio`

| Campo | Tipo | Notas |
|---|---|---|
| `name` | texto | Nombre visible |
| `description` | editor | Detalle |
| `duration` | número | Minutos |
| `buffer_before` | número | Minutos de preparación |
| `buffer_after` | número | Minutos de limpieza/registro |
| `price` | número | Precio de referencia |
| `deposit` | número | Seña |
| `capacity` | número | 1 por defecto |
| `active` | booleano | Visible/no visible |
| `order` | número | Orden en el wizard |
| `modality` | selección | Presencial/domicilio/online |

### 6.3 CPT `fv_turno`

| Campo | Tipo | Notas |
|---|---|---|
| `patient_id` | ID | `fv_paciente` |
| `service_id` | ID | `fv_servicio` |
| `professional_id` | ID | Dra. Victoria Boratto |
| `start_at` | UTC | Se guarda en UTC |
| `end_at` | UTC | Calculado con duración + buffers |
| `status` | selección | Ver estados |
| `deposit_order_id` | ID | Orden WooCommerce |
| `payment_status` | selección | Estado de la seña |
| `notes` | texto | Notas del cliente |
| `internal_notes` | texto | Notas de la clínica |
| `hold_expires_at` | UTC | Bloqueo temporal |
| `source` | selección | Web, admin, WhatsApp |
| `reminders_sent` | JSON | Control de recordatorios |
| `cancellation_reason` | texto | Si corresponde |

### 6.4 Estados del turno

| Estado | Significado |
|---|---|
| `pending_payment` | Slot reservado temporariamente, esperando seña |
| `confirmed` | Pago aprobado o seña dispensada por la clínica |
| `rescheduled` | Turno movido; se conserva historial |
| `checked_in` | Paciente presente en la clínica |
| `completed` | Atención realizada |
| `cancelled_by_client` | Cancelado por el cliente |
| `cancelled_by_clinic` | Cancelado por la clínica |
| `no_show` | No asistió |
| `expired` | El hold venció sin pago |

### 6.5 Relación con WooCommerce

- La seña se representa como una **orden WooCommerce**.
- Puede ser un producto virtual “Seña de turno” o un ítem de línea con el servicio.
- La orden guarda metadata: `_fv_appointment_id`, `_fv_patient_id`, `_fv_service_id`.
- El turno guarda `_fv_order_id`.
- El plugin de Mercado Pago genera la preferencia y procesa el pago.
- El tema nunca recibe ni almacena datos de tarjeta.
- Los webhooks del plugin actualizan la orden; un hook de WooCommerce sincroniza el turno.
- Un proceso programado reconcilia órdenes pendientes y libera holds vencidos.

---

## 7. Flujo de reserva

### 7.1 Recorrido del cliente

1. **Entrada:** desde “Reservar turno” en el hero, header, footer, sección de turnos o WhatsApp.
2. **Cuenta:** el cliente inicia sesión o se registra. Si no tiene cuenta, puede crear una en el momento.
3. **Servicio:** elige el tipo de atención. Se muestra duración, precio de referencia y seña.
4. **Mascota:** elige un perfil existente o crea uno nuevo con los datos básicos.
5. **Fecha:** el calendario muestra los próximos 60 días con disponibilidad real.
6. **Horario:** el sistema calcula slots según agenda, duración, buffers, feriados y excepciones.
7. **Hold:** al elegir un horario, el slot se bloquea temporalmente (10–15 minutos).
8. **Confirmación:** revisa servicio, mascota, fecha, hora, dirección y política de cancelación.
9. **Seña:** se crea una orden WooCommerce y se redirige a Mercado Pago.
10. **Resultado:**
    - Pago aprobado → turno `confirmed`, email/WhatsApp de confirmación, slot asegurado.
    - Pago pendiente → el hold se mantiene hasta su vencimiento.
    - Pago rechazado/cancelado → turno `expired` y slot liberado.
11. **Gestión:** desde “Mi cuenta” puede ver el historial, reprogramar o cancelar según la política.
12. **Recordatorios:** 48 h y 24 h antes, con enlace para confirmar, reprogramar o cancelar.
13. **Post-visita:** resumen, indicaciones y opción de próximo turno.

### 7.2 Cálculo de disponibilidad

El motor debe considerar:

- Agenda semanal de la profesional.
- Duración del servicio + `buffer_before` + `buffer_after`.
- Turnos existentes en estado `pending_payment`, `confirmed` o `checked_in`.
- Bloqueos manuales de la clínica (vacaciones, congresos, feriados).
- Feriados nacionales y provinciales.
- Anticipación mínima (por ejemplo, 2 horas).
- Horizonte máximo de reserva (por ejemplo, 60 días).
- Límite diario de turnos.
- Hora actual en `America/Argentina/Buenos_Aires`.
- Cambios de horario estacionales.
- Duración distinta por servicio.
- Una sola profesional: no hay agenda paralela en el MVP.

### 7.3 Reglas de negocio propuestas

- Seña obligatoria para confirmar turnos.
- La seña se descuenta del total del servicio.
- Cancelación con más de 24 h: devolución o crédito según política.
- Cancelación con menos de 24 h: la seña no se devuelve, salvo indicación de la clínica.
- Un turno se puede reprogramar una vez sin costo con 24 h de anticipación.
- Si la clínica cancela, se devuelve la seña o se reprograma sin cargo.
- Los turnos `no_show` se registran para seguimiento.
- Las urgencias no se reservan online: se derivan telefónicamente.

### 7.4 Pago de la seña con Mercado Pago

```text
Cliente confirma turno
        ↓
Se crea fv_turno (pending_payment) + hold
        ↓
Se crea orden WooCommerce (pending)
        ↓
Plugin Mercado Pago genera checkout
        ↓
Cliente paga en Mercado Pago
        ↓
Webhook / IPN actualiza la orden
        ↓
Hook de orden aprobada → turno confirmed
        ↓
Email + WhatsApp + pantalla de confirmación
```

Puntos críticos:

- **Idempotencia:** el webhook puede llegar más de una vez; la confirmación debe ser segura.
- **Reconciliación:** proceso programado para órdenes pendientes y holds vencidos.
- **Trazabilidad:** notas de orden y de turno con IDs cruzados.
- **Seguridad:** validar firma/origen según el plugin y no confiar solo en el redirect del navegador.
- **Reembolsos:** se gestionan desde WooCommerce/Mercado Pago; el turno se actualiza manualmente o por hook.
- **Checkout blocks:** no copiar plantillas; mantener compatibilidad con el plugin.

---

## 8. Catálogo de servicios

### 8.1 MVP

| Servicio | Duración sugerida | Seña sugerida | Notas |
|---|---|---|---|
| Consulta clínica | 30 min | A definir | Evaluación general |
| Vacunación y control | 20 min | A definir | Calendario y carnet |
| Peluquería y baño | 60–90 min | A definir | Según tamaño y pelaje |
| Nutrición | 30 min | A definir | Plan y seguimiento |
| Evaluación prequirúrgica | 30 min | A definir | Derivación si corresponde |

### 8.2 Futuro

- Diagnóstico por imágenes y laboratorio.
- Odontología.
- Oftalmología y dermatología (derivación).
- Fisioterapia y rehabilitación.
- Guardería / day care.
- Adiestramiento.
- Certificados de viaje.
- Telemedicina.
- Farmacia y alimentos con retiro o envío.

---

## 9. Plan por fases

### Fase 0 · Base técnica — completada

**Objetivo:** dejar un tema reconocible, compilable y compatible con el stack.

Entregables:

- Estructura del tema y cabecera `style.css`.
- `functions.php` con módulos.
- Tailwind v4 + esbuild configurados.
- `theme.json` inicial.
- Compatibilidad declarada con WooCommerce HPOS y bloques.
- Assets de marca y screenshot inicial.
- Tema activado en WordPress.

Criterio de aceptación: el tema se activa sin errores, compila y WordPress lo reconoce.

### Fase 1 · Sistema de diseño y frontend institucional — completada

**Objetivo:** construir la experiencia visual y las vistas base del sitio.

Entregables:

- Header, footer, menú móvil y navegación.
- Home editorial con hero, servicios, proceso, tienda, sobre la clínica, FAQ y contacto.
- `page.php`, `single.php`, `archive.php`, `search.php`, `404.php`.
- `searchform.php`, `comments.php` y template parts.
- `theme.json` completo.
- Sistema de diseño en `app.css`.
- Fuentes Fraunces y Manrope autoalojadas.
- Logo, favicon y línea botánica.
- Personalizador de contacto, redes y URL de reservas.
- Ajustes de compatibilidad con WooCommerce en la tienda.
- Verificación desktop/móvil y correcciones de contraste.

Criterio de aceptación: el sitio se ve cohesionado, responde en móvil, no tiene errores PHP y las vistas principales funcionan.

### Fase 2 · Tienda WooCommerce — siguiente

**Objetivo:** integrar la tienda al lenguaje visual sin romper pagos ni bloques.

Entregables:

- `archive-product.php` o wrapper de archivo de productos.
- Tarjetas de producto.
- `single-product.php` y ficha de producto.
- Carrito y checkout coherentes con el diseño, sin copiar plantillas críticas.
- Página “Mi cuenta” estilizada.
- Avisos, botones, campos y mensajes de WooCommerce.
- Mini-carrito y contador si corresponde.
- Categorías, filtros y ordenamiento.
- Estados vacíos y mensajes de stock.
- Pruebas con HPOS, checkout blocks y Mercado Pago.
- Pruebas de creación de orden, pago aprobado, rechazado y reembolso.

Criterio de aceptación: se puede comprar un producto de punta a punta con Mercado Pago y la tienda se ve parte del mismo sitio.

### Fase 3 · Dominio de reservas

**Objetivo:** construir la agenda y el wizard de turnos.

Entregables:

- CPTs `fv_paciente`, `fv_servicio`, `fv_turno`.
- Roles/capacidades y permisos.
- Repositorio de turnos.
- Motor de disponibilidad.
- Wizard: servicio → mascota → fecha → horario → confirmación.
- “Mis mascotas” y “Mis turnos”.
- Agenda de administración.
- Creación manual de turnos.
- Emails transaccionales básicos.
- Validaciones, nonces y control de concurrencia.

Criterio de aceptación: un usuario registrado puede reservar un turno sin pagar todavía y la clínica lo ve en su agenda; no se producen dobles reservas.

### Fase 4 · Seña con Mercado Pago

**Objetivo:** convertir la reserva en un turno confirmado solo después del pago.

Entregables:

- Producto o línea de seña.
- Creación automática de orden WooCommerce.
- Metadata cruzada turno/orden.
- Redirección y retorno desde Mercado Pago.
- Sincronización por webhook y por estado de orden.
- Holds y expiración.
- Reconciliación programada.
- Reembolsos y cancelaciones.
- Pruebas en sandbox y producción.

Criterio de aceptación: la seña se cobra, el turno se confirma y el slot se libera si el pago falla o expira.

### Fase 5 · Comunicaciones y WhatsApp

**Objetivo:** reducir ausencias y mejorar el seguimiento.

Entregables:

- Emails de confirmación, recordatorio, cancelación y reprogramación.
- Plantillas de email con identidad visual.
- Integración con Joinchat y enlaces `wa.me`.
- Recordatorios 48 h / 24 h.
- Enlaces de autogestión.
- Lista de espera.
- Mensajes post-visita.
- Preferencias de contacto del cliente.

Criterio de aceptación: el cliente recibe confirmación y recordatorios; la clínica puede contactarlo por WhatsApp sin salir del flujo.

### Fase 6 · QA, performance y lanzamiento

**Objetivo:** dejar el sitio listo para producción.

Entregables:

- QA funcional en desktop, tablet y móvil.
- Accesibilidad: teclado, foco, contraste, formularios, lectores de pantalla.
- Performance: fuentes, imágenes, caché, lazy loading, Core Web Vitals.
- SEO técnico: títulos, metadescripciones, Open Graph, schema, sitemap, robots.
- Analítica y eventos de conversión.
- Páginas legales y política de privacidad.
- Backup, staging y plan de despliegue.
- Manual breve para la clínica.
- Monitoreo de errores y webhooks.

Criterio de aceptación: compra y reserva funcionan en producción, el sitio es accesible y la clínica puede operar sin asistencia técnica permanente.

---

## 10. Estado actual

### Completado

- Tema `mitema` activo.
- Fase 0 y Fase 1 implementadas.
- Home, página, nota, archivo, búsqueda, 404 y comentarios.
- Header/footer globales y menú móvil funcional.
- Sistema de diseño y `theme.json`.
- Fuentes autoalojadas.
- Logo horizontal, badge, mark, favicon y línea botánica.
- Personalizador con datos de contacto y redes.
- Compatibilidad base con WooCommerce/HPOS/bloques.
- Corrección del logo en páginas WooCommerce.
- Eliminación de la barra lateral cruda de WooCommerce hasta Fase 2.
- Ajuste de fecha `d/m/Y`, hora `H:i` e inicio de semana lunes.
- Título del sitio: “Fauna del Velazco” y descripción “Clínica veterinaria en Velazco”.
- Modo “Coming soon” de WooCommerce desactivado para revisión local.
- `screenshot.png` actualizado con la home de Fase 1.
- `README.md` y `AGENTS.md` actualizados.
- Documento Word de proyecto generado con `npm run docs` y validado en Word/PDF.

### Pendiente de datos de la clienta

- Dirección exacta y mapa.
- Teléfono, WhatsApp y email reales.
- Instagram y Facebook.
- Servicios definitivos, duraciones y precios.
- Monto de la seña por servicio.
- Política de cancelación y reprogramación.
- Feriados y días de cierre.
- Fotos reales de la clínica y de la Dra. Victoria Boratto.
- Textos legales.
- Preferencia de logo: SVG actual o versión con texto en curvas.

### Deuda técnica conocida

- Las plantillas de tienda, carrito, checkout y cuenta usan el markup base de WooCommerce hasta Fase 2.
- El logo horizontal conserva texto SVG con Georgia; para producción conviene convertirlo a curvas con Fraunces/Manrope.
- El CTA de reservas apunta al bloque de proceso (`#reservar`); la pantalla real de reserva llega en Fase 3.
- No hay productos de prueba cargados en la tienda.
- No hay páginas legales creadas todavía.
- El sitio local usa certificado SSL autofirmado; para pruebas con `curl` usar `-k` y en Chrome `--ignore-certificate-errors`.

---

## 11. Riesgos y decisiones

| Riesgo | Mitigación |
|---|---|
| Doble reserva por concurrencia | Bloqueo transaccional, unique index por profesional/horario y validación final |
| Webhook de Mercado Pago perdido o duplicado | Idempotencia, notas de orden, reconciliación programada |
| Conflicto con checkout blocks | No copiar plantillas críticas; declarar compatibilidad; probar con el plugin |
| CSS de WooCommerce pisa Tailwind | Reglas puntuales fuera de capas y pruebas visuales |
| Pérdida de datos de mascotas | Backups, roles, auditoría y política de retención |
| Cambios de horario / DST | Guardar UTC y renderizar en `America/Argentina/Buenos_Aires` |
| Plugin actualizado rompe plantilla | Versionar overrides y revisar changelogs |
| Mala conversión en móvil | Wizard corto, botones grandes, validación inline |
| Spam o reservas falsas | Cuenta obligatoria, rate limiting, seña y verificación de email |
| Datos sensibles de salud | Acceso restringido, cifrado en tránsito, minimización de datos |

---

## 12. Próximos pasos

1. Completar datos reales de contacto y servicios en el Personalizador.
2. Ejecutar Fase 2: tienda y cuenta WooCommerce.
3. Crear productos de prueba y validar compra con Mercado Pago sandbox.
4. Implementar CPTs, repositorio y motor de disponibilidad (Fase 3).
5. Diseñar el wizard de reserva y “Mis turnos”.
6. Integrar la seña con WooCommerce/Mercado Pago (Fase 4).
7. Configurar emails, recordatorios y Joinchat (Fase 5).
8. QA, accesibilidad, performance y lanzamiento (Fase 6).

---

## 13. Archivos de referencia

- `README.md` — instalación, estructura y compatibilidad.
- `AGENTS.md` — reglas para agentes y desarrolladores.
- `docs/Fauna-del-Velazco-Proyecto.docx` — documento temático para la clienta.
- `theme.json` — tokens del editor.
- `assets/src/css/app.css` — sistema de diseño.
- `front-page.php` — home institucional.
- `inc/customizer.php` — datos configurables.
- `inc/woocommerce.php` — integración WooCommerce.

---

*Documento vivo. Actualizar al cerrar cada fase.*
