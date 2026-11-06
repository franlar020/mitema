import fs from 'node:fs';
import path from 'node:path';
import { PDFDocument, rgb, StandardFonts } from 'pdf-lib';

const outputFile = path.join(process.cwd(), 'docs', 'Guia-Subida-Imagenes-Fauna-del-Velazco.pdf');
const C = {
  forest: rgb(0.122, 0.239, 0.169),
  forestSoft: rgb(0.184, 0.353, 0.251),
  cream: rgb(0.969, 0.953, 0.910),
  terracotta: rgb(0.769, 0.439, 0.310),
  terracottaInk: rgb(0.659, 0.337, 0.235),
  charcoal: rgb(0.133, 0.133, 0.133),
  gray: rgb(0.373, 0.400, 0.373)
};

const doc = await PDFDocument.create();
const font = await doc.embedFont(StandardFonts.Helvetica);
const fontBold = await doc.embedFont(StandardFonts.HelveticaBold);
const A4 = [595.28, 841.89];
let page = doc.addPage(A4);
let width = page.getSize().width;
let height = page.getSize().height;
let y = height - 54;
const margin = 54;

function newPage() {
  page = doc.addPage(A4);
  const size = page.getSize();
  width = size.width; height = size.height;
  y = height - 54;
}
function ensure(needed) { if (y < needed) newPage(); }
function wrap(text, f, size, maxWidth) {
  const words = String(text).split(/\s+/).filter(Boolean);
  const lines = [];
  let line = '';
  for (const word of words) {
    const test = line ? `${line} ${word}` : word;
    if (f.widthOfTextAtSize(test, size) <= maxWidth || !line) line = test;
    else { lines.push(line); line = word; }
  }
  if (line) lines.push(line);
  return lines;
}
function drawWrapped(text, x, size, color, f = font, lineHeight = 15, maxWidth = width - margin * 2) {
  for (const line of wrap(text, f, size, maxWidth)) {
    ensure(size + 20);
    page.drawText(line, { x, y, size, color, font: f });
    y -= lineHeight;
  }
}
function center(text, size, color, f = font) {
  const w = f.widthOfTextAtSize(text, size);
  drawWrapped(text, Math.max(margin, (width - w) / 2), size, color, f, size + 5, width - margin * 2);
}
function heading(number, title) {
  ensure(70);
  y -= 20;
  page.drawText(number + '  ', { x: margin, y, size: 14, color: C.terracottaInk, font: fontBold });
  const nx = margin + fontBold.widthOfTextAtSize(number + '  ', 14);
  page.drawText(title, { x: nx, y, size: 14, color: C.forest, font: fontBold });
  y -= 8;
  page.drawRectangle({ x: margin, y, width: width - margin * 2, height: 2, color: C.terracotta });
  y -= 24;
}
function step(number, title, body) {
  ensure(90);
  page.drawText(number + '  ', { x: margin, y, size: 12, color: C.terracottaInk, font: fontBold });
  const nx = margin + fontBold.widthOfTextAtSize(number + '  ', 12);
  page.drawText(title, { x: nx, y, size: 12, color: C.forest, font: fontBold });
  y -= 18;
  drawWrapped(body, margin + 18, 10, C.charcoal, font, 15);
  y -= 10;
}

page.drawRectangle({ x: 0, y: 0, width, height, color: C.cream });
page.drawRectangle({ x: 0, y: height - 52, width, height: 52, color: C.forest });
page.drawText('Fauna del Velazco - Guía de imágenes', { x: margin, y: height - 33, size: 11, color: rgb(1,1,1), font: fontBold });

y = height - 112;
center('FAUNA DEL VELAZCO', 22, C.forest, fontBold);
y -= 38;
center('Guía para subir fotos de mascotas', 24, C.terracottaInk, fontBold);
y -= 28;
center('Instrucciones para buscar y cargar imágenes de perros', 11, C.forestSoft);
y -= 30;
center('Sitio web de la clínica veterinaria · Ciudad Autónoma de Buenos Aires', 9, C.gray);
y -= 18;
center('Fauna del Velazco · Dra. Victoria Boratto · Noviembre 2026', 9, C.gray);
y -= 30;
page.drawRectangle({ x: margin, y, width: width - margin * 2, height: 3, color: C.terracotta });
y -= 38;

heading('01', 'Objetivo');
drawWrapped('Esta guía explica cómo buscar, subir y colocar las fotografías de perros que humanizarán el sitio web de la clínica. Las imágenes irán en la portada (hero) y en las secciones intermedias, con un estilo botánico de fondo crema y bordes suaves.', margin, 10, C.charcoal);
y -= 14;

step('01', 'Buscar imágenes', 'Descargá fotos de perros con buena iluminación en bancos de imágenes gratuitos (por ejemplo Unsplash, Pexels o Freepik). Procura que las fotos tengan tonos cálidos para que combinen con la paleta de la web (fondo crema #F7F3E8, verde bosque #1F3D2B, terracota #C4704F). Priorizá imágenes donde el perro se vea tranquilo y bien cuidado.');
step('02', 'Subir imágenes a WordPress', '1. Ingresá al panel de administración con tu usuario (ismaf).\n2. Ve a Medios > Añadir nuevo.\n3. Subí las fotos que elegiste.\n4. Hacé clic en cada foto y presioná el botón "Copiar la URL al portapapeles".');
step('03', 'Insertar URLs en el código', '1. Abrí el proyecto en Visual Studio Code.\n2. Buscá el archivo front-page.php.\n3. Buscá el texto PEGAR_AQUI_URL_DE_ISMAEL.\n4. Reemplazá el texto con las URLs que copiaste de WordPress.\n5. El marcador aparece en las líneas 43, 122 y 352 de front-page.php.');
step('04', 'Verificar', 'Recargá la página de la veterinaria para confirmar que las imágenes se ven correctamente con los estilos de Tailwind (bordes suaves, sombra sutil e integración con el fondo crema).');

ensure(170);
page.drawText('Recomendaciones técnicas', { x: margin, y, size: 13, color: C.forest, font: fontBold });
y -= 24;
drawWrapped('• Tamaño y proporción: las imágenes están preparadas con una relación de aspecto 4:5 (aspect-[4/5]) y ancho completo (w-full). Elegí fotos que se vean bien en vertical.', margin, 9.5, C.charcoal);
y -= 6;
drawWrapped('• Peso del archivo: optimizá cada imagen para web antes de subirla, para que el sitio cargue rápido en móviles.', margin, 9.5, C.charcoal);
y -= 6;
drawWrapped('• Texto alternativo (alt): cada imagen debe tener un alt descriptivo, por ejemplo "Perro golden retriever en consulta veterinaria".', margin, 9.5, C.charcoal);
y -= 6;
drawWrapped('• Nombres de archivo: usá nombres en minúsculas sin espacios, por ejemplo perro-golden-01.jpg.', margin, 9.5, C.charcoal);
y -= 30;

ensure(90);
const boxTop = y;
page.drawRectangle({ x: margin, y: boxTop - 45, width: width - margin * 2, height: 45, color: C.cream, borderColor: C.terracotta, borderWidth: 1 });
page.drawText('IMPORTANTE', { x: margin + 10, y: boxTop - 17, size: 9, color: C.terracottaInk, font: fontBold });
drawWrapped('No borres ni modifiques otros archivos del tema sin consultar primero. Mantén wp_footer() y no toques los scripts de Mercado Pago ni Joinchat.', margin + 10, 9, C.charcoal, font, 13, width - margin * 2 - 20);
y = boxTop - 80;

ensure(100);
center('Gracias.', 18, C.forest, fontBold);
y -= 25;
center('Fauna del Velazco · Dra. Victoria Boratto', 11, C.terracottaInk);
y -= 18;
center('Guía de subida de imágenes · Fauna del Velazco · 2026', 9, C.gray);

const bytes = await doc.save();
fs.mkdirSync(path.dirname(outputFile), { recursive: true });
fs.writeFileSync(outputFile, bytes);
console.log(`PDF document written: ${outputFile}`);
console.log(`Size: ${(bytes.length / 1024).toFixed(1)} KB`);
