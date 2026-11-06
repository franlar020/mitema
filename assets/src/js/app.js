/**
 * Fauna del Velazco frontend behavior.
 *
 * Keep progressive enhancements in this entry point. WooCommerce,
 * Mercado Pago and Joinchat scripts are intentionally left untouched.
 */
(() => {
  'use strict';

  document.documentElement.classList.add('fv-js');

  const toggle = document.querySelector('[data-fv-menu-toggle]');
  const menu = document.getElementById('fv-mobile-menu');
  const label = toggle?.querySelector('[data-fv-menu-label]');
  const iconOpen = toggle?.querySelector('[data-fv-icon-open]');
  const iconClose = toggle?.querySelector('[data-fv-icon-close]');

  if (!toggle || !menu) {
    return;
  }

  const setOpen = (open) => {
    toggle.setAttribute('aria-expanded', String(open));
    menu.hidden = !open;
    document.body.classList.toggle('fv-menu-open', open);

    if (label) {
      label.textContent = open ? 'Cerrar menú' : 'Abrir menú';
    }

    iconOpen?.classList.toggle('hidden', open);
    iconClose?.classList.toggle('hidden', !open);
  };

  toggle.addEventListener('click', () => {
    setOpen(toggle.getAttribute('aria-expanded') !== 'true');
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
      setOpen(false);
      toggle.focus();
    }
  });

  menu.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => setOpen(false));
  });

  window.addEventListener('resize', () => {
    if (window.matchMedia('(min-width: 1024px)').matches) {
      setOpen(false);
    }
  });
})();
