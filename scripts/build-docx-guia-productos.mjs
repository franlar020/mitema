import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import {
  AlignmentType,
  BorderStyle,
  Document,
  Footer,
  Header,
  HeadingLevel,
  PageNumber,
  Paragraph,
  Table,
  TableCell,
  TableLayoutType,
  TableRow,
  TextRun,
  VerticalAlign,
  WidthType,
  Packer,
} from 'docx';

const themeDir = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '..');
const outputFile = path.join(themeDir, 'docs', 'Guia-Subida-Productos-Fauna-del-Velazco.docx');

const C = {
  forest: '1F3D2B',
  forestSoft: '2F5A40',
  cream: 'F7F3E8',
  creamDark: 'EFE8D8',
  paper: 'FFFDF7',
  terracotta: 'C4704F',
  terracottaInk: 'A85638',
  sage: '8FA98F',
  sageSoft: 'C5D3C3',
  charcoal: '222222',
  gray: '5F665F',
  line: 'D8D1C2',
};

const FONT_BODY = 'Arial';
const FONT_HEAD = 'Georgia';
const PAGE_WIDTH = 11906;
const PAGE_HEIGHT = 16838;
const PAGE_MARGIN = 1134;
const CONTENT_WIDTH = PAGE_WIDTH - PAGE_MARGIN * 2;

const noneBorder = { style: BorderStyle.NONE, size: 0, color: C.cream };
const tableBorders = {
  top: { style: BorderStyle.SINGLE, size: 4, color: C.line },
  bottom: { style: BorderStyle.SINGLE, size: 4, color: C.line },
  left: { style: BorderStyle.SINGLE, size: 4, color: C.line },
  right: { style: BorderStyle.SINGLE, size: 4, color: C.line },
  insideHorizontal: { style: BorderStyle.SINGLE, size: 4, color: C.line },
  insideVertical: { style: BorderStyle.SINGLE, size: 4, color: C.line },
};

const textRun = (text, options = {}) =>
  new TextRun({
    text,
    font: options.font ?? FONT_BODY,
    size: options.size ?? 21,
    color: options.color ?? C.charcoal,
    bold: options.bold ?? false,
    italics: options.italics ?? false,
    allCaps: options.allCaps ?? false,
    characterSpacing: options.characterSpacing ?? 0,
  });

const paragraph = (content, options = {}) => {
  const children = Array.isArray(content) ? content : [textRun(content, options)];
  return new Paragraph({
    children,
    alignment: options.alignment,
    spacing: {
      before: options.before ?? 0,
      after: options.after ?? 140,
      line: options.line ?? 276,
    },
    indent: options.indent,
    keepNext: options.keepNext,
  });
};

const bullet = (content, options = {}) =>
  new Paragraph({
    children: Array.isArray(content) ? content : [textRun(content, options)],
    bullet: { level: 0 },
    spacing: { after: options.after ?? 70, line: options.line ?? 264 },
    indent: { left: 420, hanging: 240 },
  });

const spacer = (after = 180) =>
  new Paragraph({ spacing: { before: 0, after, line: 20 }, children: [] });

const rule = (color = C.line, size = 6, after = 180) =>
  new Paragraph({
    border: { bottom: { style: BorderStyle.SINGLE, size, color } },
    spacing: { after },
    children: [],
  });

const sectionHeading = (number, title) => [
  new Paragraph({
    heading: HeadingLevel.HEADING_1,
    keepNext: true,
    spacing: { before: 300, after: 80 },
    children: [
      textRun(`${number}. `, { font: FONT_HEAD, size: 40, bold: true, color: C.terracottaInk }),
      textRun(title, { font: FONT_HEAD, size: 40, bold: true, color: C.forest }),
    ],
  }),
  rule(C.terracotta, 8, 200),
];

const heading2 = (text) =>
  new Paragraph({
    heading: HeadingLevel.HEADING_2,
    keepNext: true,
    spacing: { before: 240, after: 90 },
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

const callout = (title, text, options = {}) =>
  new Table({
    width: { size: 100, type: WidthType.PERCENTAGE },
    columnWidths: [CONTENT_WIDTH],
    layout: TableLayoutType.FIXED,
    borders: {
      top: noneBorder,
      bottom: noneBorder,
      right: noneBorder,
      left: { style: BorderStyle.SINGLE, size: 28, color: options.accent ?? C.terracotta },
    },
    rows: [
      new TableRow({
        cantSplit: true,
        children: [
          new TableCell({
            shading: { fill: options.fill ?? C.paper },
            margins: { top: 150, bottom: 150, left: 220, right: 220 },
            children: [
              new Paragraph({
                spacing: { after: 60 },
                children: [
                  textRun(title.toUpperCase(), {
                    size: 15,
                    bold: true,
                    color: options.titleColor ?? C.terracottaInk,
                    characterSpacing: 22,
                  }),
                ],
              }),
              new Paragraph({
                spacing: { after: 0, line: 260 },
                children: [textRun(text, { size: 20, color: C.forest })],
              }),
            ],
          }),
        ],
      }),
    ],
  });

const makeTable = (headers, rows, widths) =>
  new Table({
    width: { size: 100, type: WidthType.PERCENTAGE },
    columnWidths: widths.map((width) => Math.round((CONTENT_WIDTH * width) / 100)),
    layout: TableLayoutType.FIXED,
    borders: tableBorders,
    rows: [
      new TableRow({
        tableHeader: true,
        cantSplit: true,
        children: headers.map(
          (header, index) =>
            new TableCell({
              width: { size: widths[index], type: WidthType.PERCENTAGE },
              shading: { fill: C.forest },
              margins: { top: 80, bottom: 80, left: 120, right: 120 },
              verticalAlign: VerticalAlign.CENTER,
              children: [
                new Paragraph({
                  spacing: { after: 0 },
                  children: [textRun(header, { size: 18, bold: true, color: C.cream })],
                }),
              ],
            })
        ),
      }),
      ...rows.map(
        (row, rowIndex) =>
          new TableRow({
            cantSplit: true,
            children: row.map(
              (cell, columnIndex) =>
                new TableCell({
                  width: { size: widths[columnIndex], type: WidthType.PERCENTAGE },
                  shading: { fill: rowIndex % 2 === 0 ? C.paper : C.creamDark },
                  margins: { top: 80, bottom: 80, left: 120, right: 120 },
                  verticalAlign: VerticalAlign.TOP,
                  children: [
                    new Paragraph({
                      spacing: { after: 0, line: 240 },
                      children: [textRun(String(cell), { size: 18 })],
                    }),
                  ],
                })
            ),
          })
      ),
    ],
  });

const content = [];

// Cover
content.push(
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 100 },
    children: [
      textRun('FAUNA DEL VELAZCO', {
        size: 15,
        bold: true,
        color: C.terracottaInk,
        characterSpacing: 38,
      }),
    ],
  }),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 120 },
    children: [textRun('Guía para cargar productos', { font: FONT_HEAD, size: 46, bold: true, color: C.forest })],
  }),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 80 },
    children: [textRun('Fotos, catálogo y tienda WooCommerce', { size: 22, color: C.forestSoft })],
  }),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 320 },
    children: [
      textRun('Instrucciones para el equipo de la clínica · Noviembre 2026', {
        size: 16,
        color: C.gray,
      }),
    ],
  }),
  rule(C.terracotta, 10, 260),
  paragraph(
    'Esta guía explica cómo subir las fotos de los productos a la biblioteca de medios de WordPress y cómo vincularlas con cada producto de la tienda. También resume cómo se administran precios, stock y descripciones una vez creado el catálogo.',
    { size: 20, after: 220, line: 290 }
  ),
  callout(
    'Antes de empezar',
    'La tienda ya tiene 15 productos de demostración publicados. Solo falta reemplazar los recuadros de imagen por las fotos definitivas. No hace falta crear los productos otra vez.',
    { fill: C.cream, accent: C.sage }
  ),
  spacer(260),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 0 },
    children: [
      textRun('Fauna del Velazco · Dra. Victoria Boratto', { size: 16, color: C.terracottaInk }),
    ],
  })
);

// 1. Objetivo
content.push(
  ...sectionHeading('01', 'Objetivo'),
  paragraph(
    'Dejar la tienda lista para publicar: cada producto debe tener una foto clara, un nombre correcto, un precio actualizado y stock disponible. Las fotos se suben a Medios y se vinculan al producto mediante una URL en el archivo del catálogo.',
    { after: 160 }
  ),
  paragraph(
    'El catálogo tiene tres categorías: Alimentos, Accesorios y Cuidado. Cada producto tiene un código interno (SKU) que no debe cambiarse, porque es el vínculo entre la foto y el producto.',
    { after: 160 }
  )
);

// 2. Antes de empezar
content.push(
  ...sectionHeading('02', 'Antes de empezar'),
  makeTable(
    ['Qué necesitás', 'Detalle'],
    [
      ['Usuario de WordPress', 'Con permiso para administrar Medios y WooCommerce.'],
      ['Acceso al archivo del tema', 'Para reemplazar la línea de imagen en inc/catalogo-productos.php.'],
      ['Fotos de los productos', 'Una por producto, idealmente con fondo claro y el producto centrado.'],
      ['Datos comerciales', 'Precio final, stock y descripción breve.'],
    ],
    [30, 70]
  ),
  spacer(120),
  callout(
    'Importante',
    'Si no tenés acceso al archivo del tema, pedile a la persona responsable del desarrollo que haga el cambio. No edites otros archivos ni cambies los SKU.',
    { fill: C.paper, accent: C.terracotta }
  )
);

// 3. Preparar las fotos
content.push(
  ...sectionHeading('03', 'Preparar las fotos'),
  paragraph(
    'Una buena foto vende mejor y mantiene la tienda rápida. Antes de subir cada archivo, verificá estas recomendaciones:',
    { after: 120 }
  ),
  makeTable(
    ['Recomendación', 'Valor sugerido'],
    [
      ['Formato', 'JPG, PNG o WebP.'],
      ['Tamaño', '1200 × 1200 px como mínimo.'],
      ['Proporción', 'Cuadrada (1:1), para que coincida con las tarjetas de la tienda.'],
      ['Peso', 'Menos de 300 KB por imagen.'],
      ['Fondo', 'Claro, limpio y sin objetos que distraigan.'],
      ['Nombre del archivo', 'Minúsculas, sin espacios ni acentos. Ejemplo: alimento-cachorros-3kg.jpg.'],
      ['Texto alternativo', 'Descriptivo. Ejemplo: “Bolsa de alimento para cachorros de 3 kg”.'],
    ],
    [32, 68]
  ),
  spacer(100),
  paragraph(
    'Si la foto original es muy pesada, comprimila antes de subirla. No hace falta que sea perfecta: lo importante es que el producto se vea completo, nítido y con luz natural.',
    { after: 160 }
  )
);

// 4. Subir a Medios
content.push(
  ...sectionHeading('04', 'Subir las fotos a Medios'),
  ...numberedStep(
    '01',
    'Ingresar al panel',
    'Entrá a https://localhost/webwordpress/wp-admin/ con tu usuario y contraseña. En producción, usá la dirección real del sitio.'
  ),
  ...numberedStep(
    '02',
    'Abrir Medios',
    'En el menú lateral, elegí Medios → Añadir nuevo.'
  ),
  ...numberedStep(
    '03',
    'Subir el archivo',
    'Arrastrá la foto o usá el botón “Seleccionar archivos”. Esperá a que termine la subida.'
  ),
  ...numberedStep(
    '04',
    'Completar los datos',
    'En “Texto alternativo”, escribí una descripción breve de la foto. Por ejemplo: “Collar ajustable de nylon”.'
  ),
  ...numberedStep(
    '05',
    'Copiar la URL del archivo',
    'Hacé clic en la foto subida y usá “Copiar URL al portapapeles”. Si no aparece, copiá la dirección que termina en .jpg, .png o .webp. No copies la dirección de la página del adjunto.'
  ),
  spacer(80),
  callout(
    'URL correcta',
    'La URL debe empezar con https://localhost/webwordpress/wp-content/uploads/ y terminar en el nombre del archivo. Si termina en -300x300.jpg o similar, estás copiando una versión redimensionada: volvé a copiar la URL original.',
    { fill: C.cream, accent: C.sage }
  )
);

// 5. Vincular la foto
content.push(
  ...sectionHeading('05', 'Vincular la foto con el producto'),
  paragraph(
    'El vínculo se hace en el archivo inc/catalogo-productos.php. Cada producto tiene un SKU y una línea “imagen”. Solo hay que reemplazar el texto vacío por la URL copiada. La lista completa de SKU está en el anexo, al final de esta guía.',
    { after: 120 }
  ),
  heading2('Ejemplo'),
  paragraph(
    'Buscá el SKU del producto. Por ejemplo, FV-ALI-001 corresponde a “Alimento para cachorros 3 kg”. La línea se ve así:',
    { after: 80 }
  ),
  new Paragraph({
    shading: { fill: C.creamDark },
    spacing: { before: 60, after: 120, line: 260 },
    indent: { left: 240, right: 240 },
    children: [
      textRun("'imagen'            => '',", {
        font: 'Consolas',
        size: 18,
        color: C.terracottaInk,
      }),
    ],
  }),
  paragraph('Después de pegar la URL, queda así:', { after: 80 }),
  new Paragraph({
    shading: { fill: C.creamDark },
    spacing: { before: 60, after: 120, line: 260 },
    indent: { left: 240, right: 240 },
    children: [
      textRun(
        "'imagen'            => 'https://localhost/webwordpress/wp-content/uploads/2026/11/alimento-cachorros-3kg.jpg',",
        { font: 'Consolas', size: 18, color: C.forest }
      ),
    ],
  }),
  paragraph(
    'Guardá el archivo. No hace falta ejecutar npm ni volver a crear el producto: el cambio se toma en la próxima carga de la tienda.',
    { after: 140 }
  ),
  callout(
    'Una foto por producto',
    'Repetí el proceso para cada SKU. Si un producto se queda sin URL, la tienda muestra un recuadro de “Imagen próximamente”; no se rompe nada.',
    { fill: C.paper, accent: C.terracotta }
  )
);

// 6. Verificar
content.push(
  ...sectionHeading('06', 'Verificar en la tienda'),
  ...numberedStep(
    '01',
    'Abrir la tienda',
    'Entrá a https://localhost/webwordpress/tienda/ y recargá la página.'
  ),
  ...numberedStep(
    '02',
    'Revisar la tarjeta',
    'La foto debe aparecer cuadrada, completa y sin deformarse. El nombre, la categoría y el precio deben coincidir.'
  ),
  ...numberedStep(
    '03',
    'Abrir el producto',
    'Hacé clic en la tarjeta y verificá la ficha: imagen principal, descripción, precio y botón “Añadir al carrito”.'
  ),
  ...numberedStep(
    '04',
    'Probar el carrito',
    'Agregá un producto y abrí el carrito. La miniatura y el contador del header deben actualizarse.'
  )
);

// 7. Administrar precios y stock
content.push(
  ...sectionHeading('07', 'Administrar precios, stock y descripciones'),
  paragraph(
    'Una vez creados los productos, los datos comerciales se editan desde WooCommerce. El archivo del catálogo se usa para crear los productos y vincular las imágenes, no para cambiar precios todos los días.',
    { after: 120 }
  ),
  makeTable(
    ['Qué querés cambiar', 'Dónde hacerlo'],
    [
      ['Precio', 'Productos → Todos los productos → editar el producto → Precio normal.'],
      ['Stock', 'Productos → Inventario → cantidad disponible.'],
      ['Descripción', 'Productos → editar el producto → Descripción del producto.'],
      ['Categoría', 'Productos → editar el producto → Categorías.'],
      ['Foto', 'inc/catalogo-productos.php, en la línea “imagen” del SKU.'],
      ['Publicar u ocultar', 'Productos → editar el producto → Estado del producto.'],
    ],
    [34, 66]
  ),
  spacer(100),
  callout(
    'No cambiar el SKU',
    'El SKU es la clave que vincula el producto con su foto. Si se cambia, la imagen deja de encontrarse. Si necesitás cambiar un SKU, consultá primero con desarrollo.',
    { fill: C.cream, accent: C.terracotta }
  )
);

// 8. Agregar un producto nuevo
content.push(
  ...sectionHeading('08', 'Agregar un producto nuevo'),
  paragraph(
    'Si más adelante suman un producto que no está en los 15 iniciales, hay dos caminos:',
    { after: 100 }
  ),
  heading2('Opción A · Producto nuevo con foto propia'),
  ...numberedStep(
    '01',
    'Crear el producto en WooCommerce',
    'Productos → Añadir nuevo. Completá nombre, precio, stock, categoría y descripción.'
  ),
  ...numberedStep(
    '02',
    'Anotar el SKU',
    'Usá un código único, por ejemplo FV-ALI-006. Ese código se usa para vincular la foto.'
  ),
  ...numberedStep(
    '03',
    'Pedir el alta en el catálogo',
    'Solicitá que agreguen el SKU y la URL de la foto en inc/catalogo-productos.php. Si el producto ya existe en WooCommerce, no hace falta volver a sembrarlo.'
  ),
  heading2('Opción B · Producto dentro del catálogo'),
  paragraph(
    'Si el producto forma parte del catálogo inicial, se agrega una entrada nueva en inc/catalogo-productos.php con su SKU, nombre, categoría, precio, descripciones, stock e imagen. Después se ejecuta el script de siembra para crear los productos que falten.',
    { after: 120 }
  ),
  callout(
    'Para el equipo de la clínica',
    'La opción B requiere acceso al código. Si no manejás el archivo, usá la opción A y pedí ayuda a desarrollo para el vínculo de la foto.',
    { fill: C.paper, accent: C.sage }
  )
);

// 9. Checklist
content.push(
  ...sectionHeading('09', 'Checklist final'),
  ...[
    'La foto está subida a Medios y tiene texto alternativo.',
    'Copié la URL original del archivo, no la de la página del adjunto.',
    'Reemplacé la línea “imagen” del SKU correcto.',
    'El producto se ve en la tienda con la foto cuadrada.',
    'El precio y el stock coinciden con los datos comerciales.',
    'El botón “Añadir al carrito” funciona.',
    'El contador del carrito se actualiza.',
    'No cambié SKU, precios ni descripciones de otros productos.',
  ].map((item) => bullet(item, { size: 20 }))
);

// 10. Problemas frecuentes
content.push(
  ...sectionHeading('10', 'Problemas frecuentes'),
  makeTable(
    ['Problema', 'Qué revisar'],
    [
      ['La foto no aparece', 'La URL debe ser la original y el SKU debe coincidir. Guardá el archivo y recargá la tienda.'],
      ['Aparece una foto borrosa', 'Subí una imagen de al menos 1200 × 1200 px y evitá las versiones -300x300.'],
      ['La foto se ve estirada', 'La imagen debe ser cuadrada (1:1). Recortala antes de subirla.'],
      ['El producto no está en la tienda', 'Revisá que esté publicado y con stock.'],
      ['El carrito no actualiza el contador', 'Recargá la página. Si persiste, consultá a desarrollo.'],
      ['Cambié el SKU y se perdió la foto', 'Volvé al SKU anterior o actualizá la clave en el catálogo.'],
    ],
    [36, 64]
  ),
  spacer(100),
  callout(
    'Si algo no coincide',
    'No borres productos ni archivos para “probar”. Anotá el SKU, la URL y lo que ves en pantalla, y enviá esa información a desarrollo para revisarlo.',
    { fill: C.cream, accent: C.terracotta }
  )
);

// Anexo · Productos y SKU
content.push(
  ...sectionHeading('Anexo', 'Productos y SKU'),
  paragraph(
    'Usá esta tabla para ubicar el SKU de cada producto antes de reemplazar la línea “imagen” en inc/catalogo-productos.php.',
    { after: 120 }
  ),
  makeTable(
    ['SKU', 'Producto', 'Categoría'],
    [
      ['FV-ALI-001', 'Alimento para cachorros 3 kg', 'Alimentos'],
      ['FV-ALI-002', 'Alimento para adultos 10 kg', 'Alimentos'],
      ['FV-ALI-003', 'Alimento para seniors 7,5 kg', 'Alimentos'],
      ['FV-ALI-004', 'Alimento húmedo para gatos 340 g', 'Alimentos'],
      ['FV-ALI-005', 'Snacks dentales 180 g', 'Alimentos'],
      ['FV-ACC-001', 'Collar ajustable', 'Accesorios'],
      ['FV-ACC-002', 'Correa reforzada 2 m', 'Accesorios'],
      ['FV-ACC-003', 'Cama ortopédica mediana', 'Accesorios'],
      ['FV-ACC-004', 'Transportadora rígida talle M', 'Accesorios'],
      ['FV-ACC-005', 'Comedero doble de acero', 'Accesorios'],
      ['FV-CUI-001', 'Shampoo hipoalergénico 500 ml', 'Cuidado'],
      ['FV-CUI-002', 'Cepillo deslanador', 'Cuidado'],
      ['FV-CUI-003', 'Pipeta antiparasitaria', 'Cuidado'],
      ['FV-CUI-004', 'Toallitas húmedas x 80', 'Cuidado'],
      ['FV-CUI-005', 'Arenilla sanitaria 10 kg', 'Cuidado'],
    ],
    [22, 50, 28]
  )
);

content.push(
  spacer(260),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 0 },
    children: [textRun('Gracias.', { font: FONT_HEAD, size: 30, bold: true, color: C.forest })],
  }),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 120 },
    children: [
      textRun('Fauna del Velazco · Dra. Victoria Boratto', { size: 18, color: C.terracottaInk }),
    ],
  }),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 0 },
    children: [
      textRun('Guía de carga de productos · Fauna del Velazco · 2026', {
        size: 15,
        color: C.gray,
      }),
    ],
  })
);

const header = new Header({
  children: [
    new Paragraph({
      alignment: AlignmentType.RIGHT,
      spacing: { after: 0 },
      children: [
        textRun('Fauna del Velazco · Guía de productos', { size: 12, color: C.gray }),
      ],
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
        new TextRun({
          children: [PageNumber.CURRENT],
          font: FONT_BODY,
          size: 12,
          color: C.terracottaInk,
          bold: true,
        }),
        textRun(' de ', { size: 12, color: C.gray }),
        new TextRun({ children: [PageNumber.TOTAL_PAGES], font: FONT_BODY, size: 12, color: C.gray }),
      ],
    }),
  ],
});

const doc = new Document({
  title: 'Fauna del Velazco · Guía para cargar productos',
  subject: 'Instrucciones para subir fotos y administrar productos de la tienda',
  creator: 'Fauna del Velazco',
  description: 'Guía para cargar imágenes de productos en WordPress y vincularlas con WooCommerce.',
  keywords: 'WordPress, WooCommerce, productos, imágenes, veterinaria, Fauna del Velazco',
  lastModifiedBy: 'Fauna del Velazco',
  revision: 1,
  features: { updateFields: true },
  styles: {
    default: {
      document: {
        run: { font: FONT_BODY, size: 21, color: C.charcoal },
        paragraph: { spacing: { line: 276, after: 140 } },
      },
      heading1: {
        run: { font: FONT_HEAD, size: 40, bold: true, color: C.forest },
        paragraph: { spacing: { before: 300, after: 80 }, keepNext: true },
      },
      heading2: {
        run: { font: FONT_HEAD, size: 28, bold: true, color: C.forest },
        paragraph: { spacing: { before: 240, after: 90 }, keepNext: true },
      },
    },
  },
  sections: [
    {
      properties: {
        page: {
          size: { width: PAGE_WIDTH, height: PAGE_HEIGHT },
          margin: { top: PAGE_MARGIN, right: PAGE_MARGIN, bottom: PAGE_MARGIN, left: PAGE_MARGIN },
        },
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
