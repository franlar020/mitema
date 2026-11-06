import { PDFDocument, rgb, StandardFonts } from 'pdf-lib';
import fs from 'node:fs';
import path from 'node:path';

const themeDir = process.cwd();
const outputFile = path.join(themeDir, 'docs', 'Guia-Subida-Imagenes-Fauna-del-Velazco.pdf');

const C = {
  forest: rgb(0.122, 0.239, 0.169),   // #1F3D2B
  forestSoft: rgb(0.184, 0.353, 0.251), // #2F5A40
  cream: rgb(0.969, 0.953, 0.910),    // #F7F3E8
  terracotta: rgb(0.769, 0.439, 0.310), // #C4704F
  terracottaInk: rgb(0.659, 0.337, 0.235), // #A85638
  sage: rgb(0.561, 0.663, 0.561),     // #8FA98F
  charcoal: rgb(0.133, 0.133, 0.133), // #222222
  gray: rgb(0.373, 0.400, 0.373),     // #5F665F
  line: rgb(0.847, 0.820, 0.765),     // #D8D1C2
};

const doc = await PDFDocument.create();
const page = doc.addPage([595, 842]); // A4
const { width, height } = page.getSize();
const font = await doc.embedFont(StandardFonts.Helvetica);
const fontBold = await doc.embedFont(StandardFonts.HelveticaBold);

let y = height - 60;

// Helper: texto centrado
function centerText(text, y, size, color, f = font) {
  page.drawText(text, { x: width/2 - f.widthOfTextAtSize(text, size)/2, y, size, color, font: f });
}

// Helper: texto normal
function normalText(text, x, y, size, color, f = font) {
  page.drawText(text, { x, y, size, color, font: f });
}

// Fondo crema suave en toda la página
page.drawRectangle({ x: 0, y: 0, width, height, color: C.cream });

// Bandeja superior forest
page.drawRectangle({ x: 0, y: height - 120, width, height: 120, color: C.forest });

centerText('FAUNA DEL VELAZCO', height - 90, 20, rgb(1, 1, 1), fontBold);
centerText('Guía para subir fotos de mascotas', height - 130, 24, rgb(1, 1, 1), fontBold);
centerText('Instrucciones para buscar y cargar imágenes de perros', height - 155, 11, C.gray);

centerText('Sitio web de la clínica veterinaria · Ciudad Autónoma de Buenos Aires', height - 190, 9, C.forestSoft);
centerText('Fauna del Velazco · Dra. Victoria Boratto · Noviembre 2026', height - 205, 9, C.gray);

y = height - 250;

// Línea divisoria terracota
page.drawRectangle({ x: 60, y: y, width: width - 120, height: 3, color: C.terracotta });
y -= 40;

// 1. Objetivo
page.drawText('1.  Objetivo', { x: 60, y, size: 14, color: C.forest, font: fontBold });
y -= 25;
normalText('Esta guía explica cómo buscar, subir y colocar las fotografías de perros que humanizarán el sitio web de la clínica. Las imágenes irán en la portada (hero) y en las secciones intermedias, con un estilo botánico de fondo crema y bordes suaves.', 60, y, 10, C.charcoal);
y -= 50;

// 2. Paso 1
page.drawText('2.  Buscar imágenes', { x: 60, y, size: 14, color: C.forest, font: fontBold });
y -= 25;
normalText('Descargá fotos de perros con buena iluminación en bancos de imágenes gratuitos (por ejemplo Unsplash, Pexels o Freepik). Procura que las fotos tengan tonos cálidos para que combinen con la paleta de la web (fondo crema #F7F3E8, verde bosque #1F3D2B, terracota #C4704F). Priorizá imágenes donde el perro se vea tranquilo y bien cuidado.', 60, y, 10, C.charcoal);
y -= 50;

// 3. Paso 2
page.drawText('3.  Subir imágenes a WordPress', { x: 60, y, size: 14, color: C.forest, font: fontBold });
y -= 25;
normalText('1. Ingresá al panel de administración con tu usuario (ismaf).', 60, y, 10, C.charcoal); y -= 15;
normalText('2. Ve a Medios > Añadir nuevo.', 60, y, 10, C.charcoal); y -= 15;
normalText('3. Subí las fotos que elegiste.', 60, y, 10, C.charcoal); y -= 15;
normalText('4. Hacé clic en cada foto y presioná el botón "Copiar la URL al portapapeles".', 60, y, 10, C.charcoal);
y -= 50;

// 4. Paso 3
page.drawText('4.  Insertar URLs en el código', { x: 60, y, size: 14, color: C.forest, font: fontBold });
y -= 25;
normalText('1. Abrí el proyecto en Visual Studio Code.', 60, y, 10, C.charcoal); y -= 15;
normalText('2. Buscá el archivo front-page.php.', 60, y, 10, C.charcoal); y -= 15;
normalText('3. Buscá el texto PEGAR_AQUI_URL_DE_ISMAEL.', 60, y, 10, C.charcoal); y -= 15;
normalText('4. Reemplazá el texto con las URLs que copiaste de WordPress.', 60, y, 10, C.charcoal); y -= 15;
normalText('5. El marcador aparece en las líneas 43, 122 y 352 de front-page.php.', 60, y, 10, C.charcoal);
y -= 50;

// 5. Paso 4
page.drawText('5.  Verificar', { x: 60, y, size: 14, color: C.forest, font: fontBold });
y -= 25;
normalText('Recargá la página de la veterinaria para confirmar que las imágenes se ven correctamente con los estilos de Tailwind (bordes suaves, sombra sutil e integración con el fondo crema).', 60, y, 10, C.charcoal);
y -= 50;

// 6. Recomendaciones técnicas
page.drawText('Recomendaciones técnicas', { x: 60, y, size: 12, color: C.forest, font: fontBold });
y -= 20;
normalText('• Tamaño y proporción: las imágenes están preparadas con una relación de aspecto 4:5 (aspect-[4/5]) y ancho completo (w-full). Elegí fotos que se vean bien en vertical.', 60, y, 9, C.charcoal); y -= 15;
normalText('• Peso del archivo: optimizá cada imagen para web antes de subirla, para que el sitio cargue rápido en móviles.', 60, y, 9, C.charcoal); y -= 15;
normalText('• Texto alternativo (alt): cada imagen debe tener un alt descriptivo, por ejemplo "Perro golden retriever en consulta veterinaria".', 60, y, 9, C.charcoal); y -= 15;
normalText('• Nombres de archivo: usá nombres en minúsculas sin espacios, por ejemplo perro-golden-01.jpg.', 60, y, 9, C.charcoal);
y -= 50;

// 7. Advertencia (caja con borde terracota)
page.drawRectangle({ x: 60, y: y - 40, width: width - 120, height: 50, color: rgb(0.98, 0.96, 0.90), borderColor: C.terracotta, borderWidth: 1 });
normalText('IMPORTANTE', 70, y - 15, 10, C.terracottaInk, fontBold);
normalText('No borres ni modifiques otros archivos del tema sin consultar primero. Mantén wp_footer() y no toques los scripts de Mercado Pago ni Joinchat.', 70, y - 30, 9, C.charcoal);
y -= 70;

// Firma
centerText('Gracias.', height - 40, 20, C.forest, fontBold);
centerText('Fauna del Velazco · Dra. Victoria Boratto', height - 60, 11, C.terracottaInk);
centerText('Guía de subida de imágenes · Fauna del Velazco · 2026', height - 75, 9, C.gray);

const pdfBytes = await doc.save();
fs.writeFileSync(outputFile, pdfBytes);
console.log(`PDF document written: ${outputFile}`);
console.log(`Size: ${(pdfBytes.length / 1024).toFixed(1)} KB`);
