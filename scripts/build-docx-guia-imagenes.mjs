import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import {
  Header,
  AlignmentType,
  BorderStyle,
  Document,
  Footer,
  HeadingLevel,
  PageNumber,
  Paragraph,
  TextRun,
  Packer,
} from 'docx';

const themeDir = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '..');
const outputFile = path.join(themeDir, 'docs', 'Guia-Subida-Imagenes-Fauna-del-Velazco.docx');

const C = {
  forest: '1F3D2B',
  forestSoft: '2F5A40',
  cream: 'F7F3E8',
  terracotta: 'C4704F',
  terracottaInk: 'A85638',
  charcoal: '222222',
  gray: '5F665F',
  line: 'D8D1C2',
};

const FONT_BODY = 'Arial';
const FONT_HEAD = 'Georgia';
const PAGE_WIDTH = 11906;
const PAGE_HEIGHT = 16838;
const PAGE_MARGIN = 1134;

const noneBorder = { style: BorderStyle.NONE, size: 0, color: C.cream };

const textRun = (text, options = {}) =>
  new TextRun({
    text,
    font: options.font ?? FONT_BODY,
    size: options.size ?? 21,
    color: options.color ?? C.charcoal,
    bold: options.bold ?? false,
    italics: options.italics ?? false,
    allCaps: options.allCaps ?? false,
  });

const paragraph = (content, options = {}) => {
  const children = Array.isArray(content) ? content : [textRun(content, options)];
  return new Paragraph({
    children,
    alignment: options.alignment,
    spacing: { before: options.before ?? 0, after: options.after ?? 140, line: options.line ?? 276 },
    indent: options.indent,
    keepNext: options.keepNext,
  });
};

const spacer = (after = 180) =>
  new Paragraph({ spacing: { before: 0, after, line: 20 }, children: [] });

const sectionHeading = (number, title) => [
  new Paragraph({
    heading: HeadingLevel.HEADING_1,
    keepNext: true,
    spacing: { before: 300, after: 80 },
    children: [
      textRun(`${number}.  `, { font: FONT_HEAD, size: 40, bold: true, color: C.terracottaInk }),
      textRun(title, { font: FONT_HEAD, size: 40, bold: true, color: C.forest }),
    ],
  }),
];

const heading2 = (text) =>
  new Paragraph({
    heading: HeadingLevel.HEADING_2,
    keepNext: true,
    spacing: { before: 260, after: 90 },
    children: [textRun(text, { font: FONT_HEAD, size: 28, bold: true, color: C.forest })],
  });

const numberedStep = (number, title, description) => [
  new Paragraph({
    spacing: { before: 120, after: 20 },
    children: [
      textRun(`${number}  `, { font: FONT_HEAD, size: 27, bold: true, color: C.terracottaInk }),
      textRun(title, { size: 22, bold: true, color: C.forest }),
    ],
  }),
  new Paragraph({
    spacing: { after: 100, line: 268 },
    indent: { left: 440 },
    children: [textRun(description, { size: 20, color: C.charcoal })],
  }),
];

const callout = (title, text) => {
  const border = {
    top: noneBorder,
    bottom: noneBorder,
    right: noneBorder,
    left: { style: BorderStyle.SINGLE, size: 28, color: C.terracotta },
  };
  return new Paragraph({
    border,
    spacing: { before: 20, after: 0 },
    indent: { left: 360, right: 360 },
    children: [
      new Paragraph({
        spacing: { after: 60 },
        children: [textRun(title.toUpperCase(), { size: 15, bold: true, color: C.terracottaInk, characterSpacing: 22 })],
      }),
      new Paragraph({
        spacing: { after: 0, line: 260 },
        children: [textRun(text, { size: 20, color: C.forest })],
      }),
    ],
  });
};

const content = [];

content.push(
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 400 },
    children: [textRun('FAUNA DEL VELAZCO', { font: FONT_HEAD, size: 40, bold: true, color: C.forest })],
  }),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 260 },
    children: [textRun('Guía para subir fotos de mascotas', { font: FONT_HEAD, size: 44, bold: true, color: C.terracottaInk })],
  }),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 100 },
    children: [textRun('Instrucciones para buscar y cargar imágenes de perros', { size: 22, color: C.terracottaSoft })],
  }),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 400 },
    children: [textRun('Sitio web de la clínica veterinaria · Ciudad Autónoma de Buenos Aires', { size: 16, color: C.gray })],
  }),
  spacer(260),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 0 },
    children: [textRun('Fauna del Velazco · Dra. Victoria Boratto · Noviembre 2026', { size: 15, color: C.gray })],
  }),
);

content.push(
  ...sectionHeading('01', 'Objetivo'),
  paragraph(
    'Esta guía explica cómo buscar, subir y colocar las fotografías de perros que humanizarán el sitio web de la clínica. Las imágenes irán en la portada (hero) y en las secciones intermedias, con un estilo botánico de fondo crema y bordes suaves.',
    { after: 160 }
  ),
);

content.push(
  ...numberedStep(
    '01',
    'Buscar imágenes',
    'Descargá fotos de perros con buena iluminación en bancos de imágenes gratuitos (por ejemplo Unsplash, Pexels o Freepik). Procura que las fotos tengan tonos cálidos para que combinen con la paleta de la web (fondo crema #F7F3E8, verde bosque #1F3D2B, terracota #C4704F). Priorizá imágenes donde el perro se vea tranquilo y bien cuidado.',
  ),
);

content.push(
  ...numberedStep(
    '02',
    'Subir imágenes a WordPress',
    '1. Ingresá al panel de administración con tu usuario (ismaf).\n2. Ve a Medios > Añadir nuevo.\n3. Subí las fotos que elegiste.\n4. Hacé clic en cada foto y presioná el botón "Copiar la URL al portapapeles".',
  ),
);

content.push(
  ...numberedStep(
    '03',
    'Insertar URLs en el código',
    '1. Abrí el proyecto en Visual Studio Code.\n2. Buscá el archivo front-page.php.\n3. Buscá el texto PEGAR_AQUI_URL_DE_ISMAEL.\n4. Reemplazá el texto con las URLs que copiaste de WordPress.\n5. El marcador aparece en las líneas 43, 122 y 352 de front-page.php.',
  ),
);

content.push(
  ...numberedStep(
    '04',
    'Verificar',
    'Recargá la página de la veterinaria para confirmar que las imágenes se ven correctamente con los estilos de Tailwind (bordes suaves, sombra sutil e integración con el fondo crema).',
  ),
);

content.push(
  heading2('Recomendaciones técnicas'),
  paragraph('Tamaño y proporción: las imágenes están preparadas con una relación de aspecto 4:5 (aspect-[4/5]) y ancho completo (w-full). Elegí fotos que se vean bien en vertical.', { after: 100 }),
  paragraph('Peso del archivo: optimizá cada imagen para web antes de subirla, para que el sitio cargue rápido en móviles.', { after: 100 }),
  paragraph('Texto alternativo (alt): cada imagen debe tener un alt descriptivo, por ejemplo "Perro golden retriever en consulta veterinaria".', { after: 100 }),
  paragraph('Nombres de archivo: usá nombres en minúsculas sin espacios, por ejemplo perro-golden-01.jpg.', { after: 160 }),
);

content.push(
  callout(
    'Importante',
    'No borres ni modifiques otros archivos del tema sin consultar primero. Mantén wp_footer() y no toques los scripts de Mercado Pago ni Joinchat.',
  ),
);

content.push(
  spacer(300),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 0 },
    children: [textRun('Gracias.', { font: FONT_HEAD, size: 30, bold: true, color: C.forest })],
  }),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 120 },
    children: [textRun('Fauna del Velazco · Dra. Victoria Boratto', { size: 18, color: C.terracottaInk })],
  }),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 0 },
    children: [textRun('Guía de subida de imágenes · Fauna del Velazco · 2026', { size: 15, color: C.gray })],
  }),
);

const header = new Header({
  children: [
    new Paragraph({
      alignment: AlignmentType.RIGHT,
      spacing: { after: 0 },
      children: [textRun('Fauna del Velazco · Guía de imágenes', { size: 12, color: C.gray })],
    }),
  ],
});

const footer = new Footer({
  children: [
    new Paragraph({
      alignment: AlignmentType.RIGHT,
      spacing: { after: 0 },
      children: [
        textRun('Página ', { size: 12, color: C.gray }),
        new TextRun({ children: [PageNumber.CURRENT], font: FONT_BODY, size: 12, color: C.terracottaInk, bold: true }),
        textRun(' de ', { size: 12, color: C.gray }),
        new TextRun({ children: [PageNumber.TOTAL_PAGES], font: FONT_BODY, size: 12, color: C.gray }),
      ],
    }),
  ],
});

const doc = new Document({
  title: 'Fauna del Velazco · Guía de subida de imágenes',
  subject: 'Instrucciones para buscar y subir fotos de perros al sitio web',
  creator: 'Fauna del Velazco',
  description: 'Guía para buscar imágenes de perros, subirlas a WordPress e insertarlas en front-page.php.',
  keywords: 'WordPress, imágenes, mascotas, veterinaria, Fauna del Velazco',
  lastModifiedBy: 'Fauna del Velazco',
  revision: 1,

  features: { updateFields: true },
  styles: {
    default: {
      document: { run: { font: FONT_BODY, size: 21, color: C.charcoal }, paragraph: { spacing: { line: 276, after: 140 } } },
    },
  },
  sections: [
    {
      properties: {
        page: { size: { width: PAGE_WIDTH, height: PAGE_HEIGHT }, margin: { top: PAGE_MARGIN, right: PAGE_MARGIN, bottom: PAGE_MARGIN, left: PAGE_MARGIN } },
      },
      headers: { default: header },
      footers: { default: footer },
      children: content,
    },
  ],
});

const buffer = await Packer.toBuffer(doc);
fs.mkdirSync(path.dirname(outputFile), { recursive: true });
fs.writeFileSync(outputFile, buffer);
console.log(`Word document written: ${outputFile}`);
console.log(`Size: ${(buffer.length / 1024).toFixed(1)} KB`);
