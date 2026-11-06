# AGENTS.md

## Project

WordPress theme `mitema` for the veterinary clinic **Fauna del Velazco** (Dra. Victoria Boratto).

- Theme root: `C:\xampp\htdocs\webwordpress\wp-content\themes\mitema`
- Site: `https://localhost/webwordpress/` (local SSL is self-signed)
- Active theme: `mitema`
- Text domain: `fauna-del-velazco`
- Version: `0.1.0`
- Language: Spanish Argentina (voseo)
- Currency: ARS
- Timezone: `America/Argentina/Buenos_Aires`
- DB: MySQL on port `3307`
- No `wp-cli`. Use a `wp-load.php` bootstrap with `/c/xampp/php/php.exe` for WordPress queries.
- Full plan: `INIT.md`. Setup: `README.md`.

## Commands

```bash
npm install
npm run build       # required after changing CSS classes, app.js or before delivery
npm run dev:css     # Tailwind watcher
npm run dev:js      # esbuild watcher
```

PHP lint:

```bash
for f in $(find . -path ./node_modules -prune -o -name '*.php' -print); do
  /c/xampp/php/php.exe -l "$f"
done
```

WordPress bootstrap example:

```bash
/c/xampp/php/php.exe -r "define('WP_USE_THEMES', false); \$_SERVER['HTTP_HOST']='localhost'; \$_SERVER['REQUEST_URI']='/webwordpress/'; require 'C:/xampp/htdocs/webwordpress/wp-load.php'; echo get_option('blogname');"
```

## Architecture

- `functions.php` loads `inc/setup.php`, `enqueue.php`, `logo.php`, `template-tags.php`, `nav.php`, `customizer.php`, `woocommerce.php`.
- Templates: `header.php`, `footer.php`, `front-page.php`, `page.php`, `single.php`, `archive.php`, `search.php`, `404.php`, `searchform.php`, `comments.php`, `template-parts/`.
- Design source: `assets/src/css/app.css` (Tailwind v4) and `assets/src/js/app.js` (esbuild).
- Compiled assets: `assets/dist/app.css` and `assets/dist/app.js`. They are committed and enqueued; never load a CDN.
- Fonts: self-hosted variable Fraunces + Manrope in `assets/fonts/`.
- `theme.json` mirrors editor tokens and block styles.
- Customizer fields: phone, WhatsApp, email, address, hours, booking URL, Instagram, Facebook (`inc/customizer.php`).
- WooCommerce integration is in `inc/woocommerce.php`; store templates are intentionally deferred to Phase 2.

## Design rules

- Palette: forest `#1F3D2B`, cream `#F7F3E8`, terracotta `#C4704F`, terracotta ink `#A85638`, sage `#8FA98F`, charcoal `#222222`.
- Use `terracotta-ink` for small text on cream; plain terracotta does not meet AA contrast for normal text.
- Typography: Fraunces for display, Manrope for UI/body.
- Aesthetic: botanical field guide, editorial, asymmetric, arches, fine borders, paper cards, dot grid.
- Keep existing component classes and naming (`fv-*`) unless a change is required.
- Respect `prefers-reduced-motion`; keep focus states visible.

## Critical constraints

1. **Do not break WooCommerce payments.** The theme must not process payments. It creates orders and relies on the WooCommerce Mercado Pago plugin.
2. **Do not copy or override critical checkout/cart templates** unless strictly necessary and tested with blocks.
3. **Do not dequeue Mercado Pago or Joinchat scripts.**
4. Keep `wp_footer()`. Do not apply global `overflow: hidden`; the mobile menu locks body overflow only while open.
5. Declare and preserve HPOS (`custom_order_tables`) and `cart_checkout_blocks` compatibility.
6. Tailwind v4 uses cascade layers. WordPress global styles and WooCommerce CSS are unlayered and can override utilities.
   - Do not set global `styles.elements.heading.color` or `styles.elements.link.color` in `theme.json`.
   - Use `styles.blocks.core/heading` for editor heading color.
   - Keep WooCommerce-specific fixes at the bottom of `app.css`, outside layers.
7. WordPress rejects SVG uploads by default. Use the bundled SVGs or PNG/WebP for uploads.
8. Do not remove user files or unknown changes without inspecting them first.

## Booking domain (planned)

- CPTs: `fv_paciente`, `fv_servicio`, `fv_turno`.
- Repository layer to allow migration to custom tables later.
- Single professional agenda: Dra. Victoria Boratto.
- Appointment states: `pending_payment`, `confirmed`, `rescheduled`, `checked_in`, `completed`, `cancelled_by_client`, `cancelled_by_clinic`, `no_show`, `expired`.
- Deposit: WooCommerce order + Mercado Pago. Store UTC, render Buenos Aires time.
- Hold slots 10–15 minutes; release expired holds with a scheduled job.
- Booking UI requires a registered user and a pet profile.
- See `INIT.md` for the full flow, data model and phases.

## Current status

- Phase 0 and Phase 1 are complete.
- Frontend verified at desktop and mobile widths.
- WooCommerce “Coming soon” is disabled locally for review.
- Shop/account/cart/checkout still use base WooCommerce markup until Phase 2.
- Theme screenshot `screenshot.png` is generated from the Phase 1 home.
- Next: Phase 2 (WooCommerce templates), then Phase 3 (booking domain).

## Documentation

- `INIT.md` — full project plan, phases, booking flow, risks.
- `docs/Fauna-del-Velazco-Proyecto.docx` — branded client-facing document.
- Regenerate the Word document with `npm run docs` after changing the project plan.
