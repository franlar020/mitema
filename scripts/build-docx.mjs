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
  HeightRule,
  ImageRun,
  PageNumber,
  Paragraph,
  ShadingType,
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
const outputFile = path.join(themeDir, 'docs', 'Fauna-del-Velazco-Proyecto.docx');

const logoHorizontal = fs.readFileSync(path.join(themeDir, 'docs', 'assets', 'logo-horizontal.png'));
const logoMark = fs.readFileSync(path.join(themeDir, 'docs', 'assets', 'logo-mark.png'));
const homeScreenshot = fs.readFileSync(path.join(themeDir, 'screenshot.png'));

const C = {
  forest: '1F3D2B',
  forestSoft: '2F5A40',
  forestDeep: '142A1D',
  cream: 'F7F3E8',
  creamDark: 'EFE8D8',
  paper: 'FFFDF7',
  terracotta: 'C4704F',
  terracottaInk: 'A85638',
  terracottaSoft: 'E2A487',
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
const noBorders = {
  top: noneBorder,
  bottom: noneBorder,
  left: noneBorder,
  right: noneBorder,
  insideHorizontal: noneBorder,
  insideVertical: noneBorder,
};
const lineBorder = (color = C.line, size = 4) => ({ style: BorderStyle.SINGLE, size, color });
const tableBorders = {
  top: lineBorder(),
  bottom: lineBorder(),
  left: lineBorder(),
  right: lineBorder(),
  insideHorizontal: lineBorder(),
  insideVertical: lineBorder(),
};

const cellMargins = { top: 80, bottom: 80, left: 120, right: 120 };
const compactMargins = { top: 55, bottom: 55, left: 100, right: 100 };

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
    pageBreakBefore: options.pageBreakBefore,
    border: options.border,
    shading: options.shading,
  });
};

const bullet = (content, options = {}) =>
  new Paragraph({
    children: Array.isArray(content) ? content : [textRun(content, options)],
    bullet: { level: 0 },
    spacing: { after: options.after ?? 60, line: options.line ?? 264 },
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

const sectionHeading = (number, title, options = {}) => [
  new Paragraph({
    heading: HeadingLevel.HEADING_1,
    pageBreakBefore: options.pageBreakBefore ?? false,
    keepNext: true,
    spacing: { before: options.before ?? 300, after: 80 },
    children: [
      textRun(`${number}. `, {
        font: FONT_HEAD,
        size: 40,
        bold: true,
        color: C.terracottaInk,
      }),
      textRun(title, {
        font: FONT_HEAD,
        size: 40,
        bold: true,
        color: C.forest,
      }),
    ],
  }),
  rule(C.terracotta, 8, 200),
];

const heading2 = (text, options = {}) =>
  new Paragraph({
    heading: HeadingLevel.HEADING_2,
    keepNext: true,
    pageBreakBefore: options.pageBreakBefore ?? false,
    spacing: { before: options.before ?? 260, after: 90 },
    children: [textRun(text, { font: FONT_HEAD, size: 28, bold: true, color: C.forest })],
  });

const heading3 = (text) =>
  new Paragraph({
    heading: HeadingLevel.HEADING_3,
    keepNext: true,
    spacing: { before: 180, after: 50 },
    children: [textRun(text, { font: FONT_BODY, size: 22, bold: true, color: C.terracottaInk })],
  });

const eyebrow = (text, options = {}) =>
  new Paragraph({
    alignment: options.alignment,
    spacing: { before: options.before ?? 0, after: options.after ?? 100 },
    children: [
      textRun(text.toUpperCase(), {
        size: options.size ?? 16,
        bold: true,
        color: options.color ?? C.terracottaInk,
        characterSpacing: 34,
      }),
    ],
  });

const caption = (text) =>
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { before: 60, after: 180 },
    children: [textRun(text, { size: 17, italics: true, color: C.gray })],
  });

const imageBlock = (data, width, height, alt, captionText) => [
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { before: 100, after: 60 },
    children: [
      new ImageRun({
        type: 'png',
        data,
        transformation: { width, height },
        altText: { title: alt, description: alt, name: alt },
      }),
    ],
  }),
  caption(captionText),
];

const cellParagraphs = (value, options = {}) => {
  const values = Array.isArray(value) ? value : [value];
  return values.map((item) => {
    if (item instanceof Paragraph) return item;
    return new Paragraph({
      spacing: { before: 0, after: options.after ?? 0, line: options.line ?? 240 },
      children: [
        textRun(String(item), {
          size: options.size ?? 18,
          bold: options.bold ?? false,
          color: options.color ?? C.charcoal,
          font: options.font ?? FONT_BODY,
        }),
      ],
    });
  });
};

const makeTable = (headers, rows, widths, options = {}) => {
  const border = options.borders ?? tableBorders;
  const margin = options.compact ? compactMargins : cellMargins;
  const headerFill = options.headerFill ?? C.forest;
  const rowFills = options.rowFills ?? null;
  const noRowShading = options.noRowShading ?? false;
  const keepTogether = options.keepTogether ?? false;

  const headerRow =
    headers && headers.length
      ? new TableRow({
          tableHeader: true,
          cantSplit: true,
          keepNext: keepTogether,
          children: headers.map(
            (header, index) =>
              new TableCell({
                width: { size: widths[index], type: WidthType.PERCENTAGE },
                shading: { fill: headerFill },
                margins: margin,
                verticalAlign: VerticalAlign.CENTER,
                children: cellParagraphs(header, {
                  size: options.headerSize ?? 18,
                  bold: true,
                  color: C.cream,
                }),
              })
          ),
        })
      : null;

  const bodyRows = rows.map((row, rowIndex) => {
    const fill = noRowShading
      ? null
      : rowFills?.[rowIndex] ?? (rowIndex % 2 === 0 ? C.paper : C.creamDark);

    return new TableRow({
      cantSplit: true,
      keepNext: keepTogether && rowIndex < rows.length - 1,
      children: row.map(
        (cell, columnIndex) =>
          new TableCell({
            width: { size: widths[columnIndex], type: WidthType.PERCENTAGE },
            shading: fill ? { fill } : undefined,
            margins: margin,
            verticalAlign: VerticalAlign.TOP,
            children: cellParagraphs(cell, {
              size: options.bodySize ?? 18,
              color: options.bodyColor ?? C.charcoal,
            }),
          })
      ),
    });
  });

  return new Table({
    rows: headerRow ? [headerRow, ...bodyRows] : bodyRows,
    width: { size: 100, type: WidthType.PERCENTAGE },
    columnWidths: widths.map((width) => Math.round((CONTENT_WIDTH * width) / 100)),
    layout: TableLayoutType.FIXED,
    borders: border,
  });
};

const infoTable = (rows) =>
  new Table({
    width: { size: 100, type: WidthType.PERCENTAGE },
    columnWidths: [Math.round(CONTENT_WIDTH * 0.28), Math.round(CONTENT_WIDTH * 0.72)],
    layout: TableLayoutType.FIXED,
    borders: tableBorders,
    rows: rows.map(
      ([label, value]) =>
        new TableRow({
          cantSplit: true,
          children: [
            new TableCell({
              width: { size: 28, type: WidthType.PERCENTAGE },
              shading: { fill: C.cream },
              margins: cellMargins,
              verticalAlign: VerticalAlign.CENTER,
              children: [
                new Paragraph({
                  spacing: { after: 0 },
                  children: [
                    textRun(label.toUpperCase(), {
                      size: 15,
                      bold: true,
                      color: C.terracottaInk,
                      characterSpacing: 18,
                    }),
                  ],
                }),
              ],
            }),
            new TableCell({
              width: { size: 72, type: WidthType.PERCENTAGE },
              shading: { fill: C.paper },
              margins: cellMargins,
              verticalAlign: VerticalAlign.CENTER,
              children: [
                new Paragraph({
                  spacing: { after: 0 },
                  children: [textRun(value, { size: 18, color: C.forest })],
                }),
              ],
            }),
          ],
        })
    ),
  });

const callout = (title, text, options = {}) => {
  const border = {
    top: noneBorder,
    bottom: noneBorder,
    right: noneBorder,
    left: { style: BorderStyle.SINGLE, size: 28, color: options.accent ?? C.terracotta },
  };

  return new Table({
    width: { size: 100, type: WidthType.PERCENTAGE },
    columnWidths: [CONTENT_WIDTH],
    layout: TableLayoutType.FIXED,
    borders: border,
    rows: [
      new TableRow({
        cantSplit: true,
        children: [
          new TableCell({
            shading: { fill: options.fill ?? C.paper },
            margins: { top: 160, bottom: 160, left: 220, right: 220 },
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
                children: [
                  textRun(text, {
                    size: options.size ?? 20,
                    color: options.textColor ?? C.forest,
                  }),
                ],
              }),
            ],
          }),
        ],
      }),
    ],
  });
};

const paletteTable = (options = {}) => {
  const swatches = [
    {
      name: 'Forest',
      hex: '#1F3D2B',
      fill: C.forest,
      text: C.cream,
      sub: C.sageSoft,
      use: 'Principal',
    },
    {
      name: 'Cream',
      hex: '#F7F3E8',
      fill: C.cream,
      text: C.forest,
      sub: C.gray,
      use: 'Fondo',
    },
    {
      name: 'Terracotta',
      hex: '#C4704F',
      fill: C.terracotta,
      text: C.cream,
      sub: C.paper,
      use: 'Acento',
    },
    {
      name: 'Sage',
      hex: '#8FA98F',
      fill: C.sage,
      text: C.forest,
      sub: C.forest,
      use: 'Botánica',
    },
    {
      name: 'Charcoal',
      hex: '#222222',
      fill: C.charcoal,
      text: C.cream,
      sub: C.sageSoft,
      use: 'Texto',
    },
  ];

  return new Table({
    width: { size: 100, type: WidthType.PERCENTAGE },
    columnWidths: [1928, 1928, 1928, 1928, 1926],
    layout: TableLayoutType.FIXED,
    borders: tableBorders,
    rows: [
      new TableRow({
        height: { value: options.height ?? 760, rule: HeightRule.ATLEAST },
        cantSplit: true,
        children: swatches.map(
          (swatch) =>
            new TableCell({
              width: { size: 20, type: WidthType.PERCENTAGE },
              shading: { fill: swatch.fill },
              margins: { top: 120, bottom: 120, left: 110, right: 110 },
              verticalAlign: VerticalAlign.CENTER,
              children: [
                new Paragraph({
                  spacing: { after: 20 },
                  children: [
                    textRun(swatch.name, {
                      size: 18,
                      bold: true,
                      color: swatch.text,
                    }),
                  ],
                }),
                new Paragraph({
                  spacing: { after: 30 },
                  children: [textRun(swatch.hex, { size: 15, color: swatch.sub })],
                }),
                new Paragraph({
                  spacing: { after: 0 },
                  children: [
                    textRun(swatch.use, {
                      size: 14,
                      color: swatch.sub,
                      allCaps: true,
                      characterSpacing: 12,
                    }),
                  ],
                }),
              ],
            })
        ),
      }),
    ],
  });
};

const numberedStep = (number, title, description) => [
  new Paragraph({
    spacing: { before: 120, after: 20 },
    children: [
      textRun(`${number}  `, {
        font: FONT_HEAD,
        size: 27,
        bold: true,
        color: C.terracottaInk,
      }),
      textRun(title, { size: 22, bold: true, color: C.forest }),
    ],
  }),
  new Paragraph({
    spacing: { after: 100, line: 268 },
    indent: { left: 440 },
    children: [textRun(description, { size: 20, color: C.charcoal })],
  }),
];

const content = [];

// ---------------------------------------------------------------------------
// Cover
// ---------------------------------------------------------------------------

const brandBand = new Table({
  width: { size: 100, type: WidthType.PERCENTAGE },
  columnWidths: [Math.round(CONTENT_WIDTH * 0.58), Math.round(CONTENT_WIDTH * 0.42)],
  layout: TableLayoutType.FIXED,
  borders: noBorders,
  rows: [
    new TableRow({
      children: [
        new TableCell({
          width: { size: 58, type: WidthType.PERCENTAGE },
          shading: { fill: C.forest },
          margins: { top: 120, bottom: 120, left: 200, right: 120 },
          children: [
            new Paragraph({
              spacing: { after: 0 },
              children: [
                textRun('FAUNA DEL VELAZCO', {
                  size: 15,
                  bold: true,
                  color: C.cream,
                  characterSpacing: 38,
                }),
              ],
            }),
          ],
        }),
        new TableCell({
          width: { size: 42, type: WidthType.PERCENTAGE },
          shading: { fill: C.forest },
          margins: { top: 120, bottom: 120, left: 120, right: 200 },
          children: [
            new Paragraph({
              alignment: AlignmentType.RIGHT,
              spacing: { after: 0 },
              children: [
                textRun('DOCUMENTO DE PROYECTO · 2026', {
                  size: 13,
                  bold: true,
                  color: C.sageSoft,
                  characterSpacing: 18,
                }),
              ],
            }),
          ],
        }),
      ],
    }),
  ],
});

const cover = [
  brandBand,
  spacer(520),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 360 },
    children: [
      new ImageRun({
        type: 'png',
        data: logoHorizontal,
        transformation: { width: 360, height: 103 },
        altText: {
          title: 'Fauna del Velazco',
          description: 'Logo horizontal de Fauna del Velazco',
          name: 'Logo Fauna del Velazco',
        },
      }),
    ],
  }),
  eyebrow('Clínica veterinaria · Ciudad Autónoma de Buenos Aires', {
    alignment: AlignmentType.CENTER,
    after: 140,
  }),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { before: 0, after: 120, line: 300 },
    children: [
      textRun('Proyecto digital', {
        font: FONT_HEAD,
        size: 52,
        bold: true,
        color: C.forest,
      }),
    ],
  }),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 200, line: 280 },
    children: [
      textRun('Sitio web, tienda WooCommerce y reservas con seña online', {
        size: 22,
        color: C.forestSoft,
      }),
    ],
  }),
  new Paragraph({
    border: { bottom: { style: BorderStyle.SINGLE, size: 10, color: C.terracotta } },
    indent: { left: 2500, right: 2500 },
    spacing: { after: 260 },
    children: [],
  }),
  paragraph(
    'Un documento para revisar el proyecto completo: identidad, arquitectura, flujo de reserva, plan por fases y estado actual.',
    {
      alignment: AlignmentType.CENTER,
      size: 20,
      color: C.charcoal,
      line: 286,
      after: 260,
      indent: { left: 900, right: 900 },
    }
  ),
  paletteTable({ height: 700 }),
  spacer(300),
  infoTable([
    ['Preparado para', 'Dra. Victoria Boratto · Fauna del Velazco'],
    ['Documento', 'Proyecto digital, plan de fases y flujo de reserva'],
    ['Fecha', 'Noviembre 2026'],
    ['Estado', 'Fases 0 y 1 completadas · Fase 2 en preparación'],
  ]),
  spacer(260),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 0 },
    children: [
      textRun('Fauna del Velazco · Clínica veterinaria · Ciudad Autónoma de Buenos Aires', {
        size: 15,
        color: C.gray,
      }),
    ],
  }),
];

// ---------------------------------------------------------------------------
// Contents
// ---------------------------------------------------------------------------

const contentsLeft = [
  '01 · Resumen ejecutivo',
  '02 · Ficha del proyecto',
  '03 · Objetivos',
  '04 · Identidad visual',
  '05 · Arquitectura técnica',
  '06 · Experiencia del sitio',
  '07 · Flujo de reserva',
];
const contentsRight = [
  '08 · Modelo de datos',
  '09 · Catálogo de servicios',
  '10 · Plan por fases',
  '11 · Estado actual',
  '12 · Decisiones y riesgos',
  '13 · Próximos pasos',
  'Anexo · Glosario',
];
const contentsRows = contentsLeft.map((item, index) => [item, contentsRight[index]]);

content.push(
  new Paragraph({
    heading: HeadingLevel.HEADING_1,
    pageBreakBefore: true,
    keepNext: true,
    spacing: { before: 0, after: 80 },
    children: [
      textRun('Contenido', {
        font: FONT_HEAD,
        size: 40,
        bold: true,
        color: C.forest,
      }),
    ],
  }),
  rule(C.terracotta, 8, 220),
  paragraph(
    'Este documento reúne el plan completo del proyecto, el estado actual y el flujo de reserva. Está pensado para revisar las decisiones antes de avanzar a la tienda y a la agenda.',
    { size: 21, after: 200 }
  ),
  makeTable(null, contentsRows, [50, 50], {
    compact: true,
    noRowShading: true,
    borders: noBorders,
    bodySize: 19,
  }),
  spacer(80),
  callout(
    'Cómo leerlo',
    'Las secciones 1 a 6 explican el proyecto y la identidad. La sección 7 desarrolla el flujo de reserva. La 10 ordena el plan por fases y la 11 resume el estado actual.',
    { fill: C.paper, accent: C.sage }
  ),
  new Paragraph({
    spacing: { before: 120, after: 0 },
    children: [
      textRun('Documento vivo · actualizar al cerrar cada fase.', {
        size: 16,
        italics: true,
        color: C.gray,
      }),
    ],
  })
);

// ---------------------------------------------------------------------------
// 1. Resumen ejecutivo
// ---------------------------------------------------------------------------

content.push(
  ...sectionHeading('01', 'Resumen ejecutivo', { pageBreakBefore: true }),
  paragraph(
    'Fauna del Velazco es una clínica veterinaria de atención personalizada liderada por la Dra. Victoria Boratto. Este proyecto construye un sitio propio que reúne la presentación de la clínica, una tienda online y un sistema de turnos con seña.',
    { after: 140 }
  ),
  paragraph(
    'La primera etapa resolvió la identidad visual y las vistas institucionales. La segunda integra la tienda de WooCommerce. Después se implementa la agenda, la reserva online y el cobro de la seña con Mercado Pago.',
    { after: 180 }
  ),
  makeTable(
    ['Capa', 'Qué resuelve'],
    [
      ['Sitio institucional', 'Presenta la clínica, los servicios, la profesional y los canales de contacto.'],
      ['Tienda WooCommerce', 'Vende productos físicos y usa Mercado Pago como única pasarela de pago.'],
      ['Turnos', 'Permite elegir servicio, mascota, fecha y horario, y confirmar con una seña.'],
    ],
    [24, 76]
  ),
  spacer(160),
  callout(
    'Estado actual',
    'Fases 0 y 1 completadas. El tema está activo, la home y las vistas principales funcionan en desktop y móvil, y la tienda ya usa el shell visual del sitio. La próxima etapa es la Fase 2: tienda WooCommerce.',
    { fill: C.cream, accent: C.sage }
  ),
  heading2('La decisión central'),
  paragraph(
    'Una sola profesional, una sola agenda y una seña online. El turno se confirma recién cuando Mercado Pago aprueba el pago. Si la seña no llega, el horario se libera para otra persona.',
    { after: 140 }
  ),
  paragraph(
    'El tema no procesa pagos ni guarda datos de tarjeta: crea una orden de WooCommerce y deja que el plugin de Mercado Pago haga el checkout. Esa separación mantiene el sitio seguro y compatible con el ecosistema.',
    { after: 160 }
  )
);

// ---------------------------------------------------------------------------
// 2. Ficha del proyecto
// ---------------------------------------------------------------------------

content.push(
  ...sectionHeading('02', 'Ficha del proyecto'),
  infoTable([
    ['Clínica', 'Fauna del Velazco'],
    ['Profesional', 'Dra. Victoria Boratto'],
    ['Ubicación', 'Plaza José María Velazco Ibarra, barrio de Balvanera (Comuna 3), Ciudad Autónoma de Buenos Aires. Entre Av. Jujuy, calle México, calle Saavedra y Av. Independencia. Espacio público tradicional con áreas de juegos infantiles y sectores deportivos renovados.'],
    ['Sitio local', 'https://localhost/webwordpress/'],
    ['Tema', 'mitema · tema WordPress a medida'],
    ['Stack', 'WordPress 7.1.4 · PHP 8.2 · WooCommerce 11.2.2 · Mercado Pago 8.10.0 · Joinchat 6.4.2'],
    ['Frontend', 'Tailwind CSS v4 compilado con npm · esbuild · fuentes autoalojadas'],
    ['Idioma y moneda', 'Español Argentina · ARS'],
    ['Zona horaria', 'America/Argentina/Buenos_Aires'],
    ['Estado', 'Fases 0 y 1 completadas · Fase 2 en preparación'],
  ]),
  spacer(220),
  new Paragraph({
    border: { left: { style: BorderStyle.SINGLE, size: 24, color: C.terracotta } },
    indent: { left: 360, right: 360 },
    spacing: { before: 60, after: 200, line: 300 },
    children: [
      textRun(
        '“Un sitio que acompañe a la mascota y a su familia desde la primera consulta hasta el seguimiento.”',
        { font: FONT_HEAD, size: 26, italics: true, color: C.forest }
      ),
    ],
  }),
  paragraph(
    'El proyecto se apoya en una idea simple: la atención de la Dra. Victoria es cercana y personal, y el sitio debe transmitir eso sin perder claridad operativa. La reserva, la tienda y el contacto tienen que poder resolverse en pocos pasos.',
    { after: 160 }
  )
);

// ---------------------------------------------------------------------------
// 3. Objetivos
// ---------------------------------------------------------------------------

content.push(
  ...sectionHeading('03', 'Objetivos'),
  paragraph(
    'El sitio debe ser una herramienta de confianza y de gestión, no solo una vidriera. Estos son los objetivos que ordenan el diseño y las decisiones técnicas:',
    { after: 120 }
  ),
  ...[
    'Dar a conocer la clínica y la mirada profesional de la Dra. Victoria.',
    'Permitir reservar un turno en pocos pasos, desde el teléfono.',
    'Cobrar una seña segura con Mercado Pago y liberar horarios impagos.',
    'Vender productos de la tienda sin salir del sitio.',
    'Centralizar el historial de mascotas y turnos de cada cliente.',
    'Reducir ausencias con recordatorios por email y WhatsApp.',
    'Sostener una experiencia mobile first, accesible y rápida.',
    'Preparar una base escalable para nuevas especialidades y servicios.',
  ].map((item) => bullet(item)),
  heading2('Principios de experiencia'),
  makeTable(
    ['Claro', 'Cálido', 'Confiable'],
    [
      [
        'Menos pasos, etiquetas directas y confirmaciones visibles.',
        'Tono cercano, voseo y una estética de cuaderno de campo.',
        'Datos de contacto, políticas y estados siempre a la vista.',
      ],
    ],
    [33, 33, 34]
  ),
  heading2('Qué vamos a medir'),
  ...[
    'Turnos reservados y turnos confirmados con seña.',
    'Tasa de ausencias y reprogramaciones.',
    'Ventas de la tienda y productos más consultados.',
    'Consultas que llegan por WhatsApp o desde la página de contacto.',
  ].map((item) => bullet(item))
);

// ---------------------------------------------------------------------------
// 4. Identidad visual
// ---------------------------------------------------------------------------

content.push(
  ...sectionHeading('04', 'Identidad visual'),
  paragraph(
    'La dirección elegida es una guía botánica editorial: fondo crema, verde bosque, terracota y una tipografía serif expresiva. La sensación buscada es la de un cuaderno de campo cuidado, no la de una clínica genérica.',
    { after: 160 }
  ),
  paletteTable(),
  spacer(120),
  callout(
    'Contraste y accesibilidad',
    'El terracota #C4704F no se usa para texto pequeño sobre crema; en esos casos se reemplaza por terracota ink #A85638. Los estados de foco y la navegación por teclado se mantienen visibles.',
    { fill: C.paper, accent: C.sage }
  ),
  spacer(120),
  makeTable(
    ['Tipografía', 'Uso', 'Detalle'],
    [
      ['Fraunces', 'Títulos, citas y números editoriales', 'Serif variable, cálida, con personalidad.'],
      ['Manrope', 'Cuerpo, navegación, botones y datos', 'Sans serif variable, clara en pantalla.'],
    ],
    [20, 36, 44],
    { keepTogether: true }
  ),
  heading2('Una marca con textura'),
  ...[
    'Marca circular con huella, hoja y rama botánica.',
    'Arcos, bordes finos, tarjetas de papel y patrón de puntos.',
    'Iconos de línea y botones tipo píldora.',
    'Animaciones suaves y respeto por prefers-reduced-motion.',
    'Contraste cuidado: el terracota de texto pequeño se oscurece a #A85638.',
  ].map((item) => bullet(item)),
  spacer(80),
  new Paragraph({
    border: { left: { style: BorderStyle.SINGLE, size: 22, color: C.sage } },
    indent: { left: 360, right: 360 },
    spacing: { before: 40, after: 180, line: 300 },
    children: [
      textRun('“La medicina veterinaria también es escuchar.”', {
        font: FONT_HEAD,
        size: 25,
        italics: true,
        color: C.forest,
      }),
    ],
  }),
  paragraph(
    'La identidad se traslada al editor de WordPress mediante theme.json, pero los títulos y enlaces del frontend conservan el control desde el sistema de diseño. Así se evita que los estilos globales pisen los botones y las secciones oscuras.',
    { after: 160 }
  )
);

// ---------------------------------------------------------------------------
// 5. Arquitectura técnica
// ---------------------------------------------------------------------------

content.push(
  ...sectionHeading('05', 'Arquitectura técnica'),
  paragraph(
    'El sitio usa un tema propio, sin page builder, con Tailwind CSS v4 compilado localmente y esbuild para el JavaScript. Las fuentes Fraunces y Manrope se autoalojan: no hay CDN ni dependencias externas en el frontend.',
    { after: 160 }
  ),
  makeTable(
    ['Componente', 'Uso'],
    [
      ['WordPress', 'Base de contenido, usuarios, medios y administración.'],
      ['WooCommerce', 'Catálogo, carrito, checkout, órdenes y cuenta de cliente.'],
      ['Mercado Pago', 'Pasarela de pago para productos y señas de turnos.'],
      ['Joinchat', 'Widget flotante de WhatsApp y enlaces de contacto.'],
      ['Tailwind CSS v4', 'Sistema de diseño compilado, sin CDN.'],
      ['esbuild', 'Bundle de JavaScript del tema.'],
    ],
    [26, 74]
  ),
  heading2('Módulos del tema'),
  makeTable(
    ['Módulo', 'Responsabilidad'],
    [
      ['Header / footer', 'Shell global, navegación, contacto y wp_footer().'],
      ['front-page.php', 'Home editorial con servicios, proceso, tienda y FAQ.'],
      ['Plantillas', 'Página, nota, archivo, búsqueda, 404 y comentarios.'],
      ['Design system', 'Tokens, componentes, tipografía, iconos y responsive.'],
      ['Customizer', 'Teléfono, WhatsApp, email, dirección, horarios, redes y URL de reservas.'],
      ['WooCommerce', 'Compatibilidad HPOS, checkout blocks y wrappers del tema.'],
      ['Reservas (futuro)', 'CPT, repositorio, disponibilidad, wizard, pagos y recordatorios.'],
    ],
    [26, 74]
  ),
  heading2('Compatibilidad'),
  ...[
    'HPOS de WooCommerce declarado y preservado.',
    'Checkout y carrito por bloques: no se copian plantillas críticas.',
    'Mercado Pago y Joinchat no se desencolan ni se bloquean.',
    'El tema no procesa pagos ni almacena datos de tarjeta.',
    'WordPress no permite SVG por defecto; el tema usa SVG propios y recomienda PNG/WebP para uploads.',
  ].map((item) => bullet(item)),
  spacer(80),
  callout(
    'Límite de responsabilidad',
    'El tema crea la orden y el turno. El cobro, la preferencia de pago, los webhooks y los reembolsos quedan en manos del plugin de Mercado Pago y de WooCommerce.',
    { fill: C.cream, accent: C.terracotta }
  )
);

// ---------------------------------------------------------------------------
// 6. Experiencia del sitio
// ---------------------------------------------------------------------------

content.push(
  ...sectionHeading('06', 'Experiencia del sitio'),
  paragraph(
    'La home funciona como una visita guiada: presenta la promesa, muestra los servicios, explica cómo se reserva, abre la tienda, cuenta quién está detrás y cierra con preguntas frecuentes y contacto.',
    { after: 100 }
  ),
  ...imageBlock(
    homeScreenshot,
    620,
    465,
    'Home de Fauna del Velazco en desktop',
    'Home de Fase 1 · vista desktop a 1200 × 900 px'
  ),
  heading2('Recorrido de la home'),
  ...[
    'Hero con la promesa, la profesional, el horario y el acceso a turnos.',
    'Franja de confianza: una profesional, horarios y compra/reserva online.',
    'Servicios con duración, descripción y acceso a la tienda.',
    'Proceso de reserva en tres pasos, con la seña como cierre.',
    'Tienda con categorías y acceso al catálogo completo.',
    'Sobre la clínica, retrato simbólico, formación y valores.',
    'Preguntas frecuentes y contacto con dirección, horarios y WhatsApp.',
  ].map((item) => bullet(item)),
  heading2('Vistas incluidas'),
  makeTable(
    ['Vista', 'Qué incluye'],
    [
      ['Inicio', 'Home editorial completa y responsive.'],
      ['Páginas', 'Plantilla de página con hero y contenido.'],
      ['Notas', 'Single de blog, fecha, contenido y comentarios.'],
      ['Archivos y búsqueda', 'Listados, tarjetas, estados vacíos y buscador.'],
      ['404', 'Página de error con mensaje propio y accesos útiles.'],
      ['Tienda', 'Shell visual, título y avisos; el catálogo se completa en Fase 2.'],
    ],
    [26, 74]
  ),
  paragraph(
    'La experiencia se verificó en 1440 px y 390 px. El menú móvil funciona con teclado y atributos ARIA; el body solo bloquea el scroll mientras el menú está abierto, para no interferir con Joinchat.',
    { after: 160 }
  )
);

// ---------------------------------------------------------------------------
// 7. Flujo de reserva
// ---------------------------------------------------------------------------

content.push(
  ...sectionHeading('07', 'Flujo de reserva'),
  paragraph(
    'La reserva se piensa como un recorrido corto, con confirmaciones visibles y una sola decisión por pantalla. El cliente siempre sabe qué servicio eligió, para qué mascota, qué día y cuánto va a pagar como seña.',
    { after: 100 }
  ),
  heading2('Recorrido del cliente'),
  ...numberedStep(
    '01',
    'Entrada',
    'Desde “Reservar turno” en el hero, el header, el footer, la sección de turnos o un enlace de WhatsApp.'
  ),
  ...numberedStep(
    '02',
    'Cuenta',
    'El cliente inicia sesión o se registra. La cuenta permite guardar mascotas, turnos e historial.'
  ),
  ...numberedStep(
    '03',
    'Servicio',
    'Elige el tipo de atención. Se muestran duración, precio de referencia y monto de la seña.'
  ),
  ...numberedStep(
    '04',
    'Mascota',
    'Selecciona un perfil existente o crea uno nuevo con especie, raza, edad, peso y cuidados especiales.'
  ),
  ...numberedStep(
    '05',
    'Fecha y horario',
    'El calendario muestra disponibilidad real para los próximos 60 días, en horario de Buenos Aires.'
  ),
  ...numberedStep(
    '06',
    'Hold del horario',
    'Al elegir un turno, el slot se bloquea entre 10 y 15 minutos mientras el cliente completa la reserva.'
  ),
  ...numberedStep(
    '07',
    'Confirmación de datos',
    'Revisa servicio, mascota, fecha, hora, dirección y política de cancelación antes de pagar.'
  ),
  ...numberedStep(
    '08',
    'Seña',
    'Se crea una orden de WooCommerce y se redirige al checkout de Mercado Pago.'
  ),
  ...numberedStep(
    '09',
    'Resultado del pago',
    'Pago aprobado: turno confirmado. Pago pendiente: se mantiene el hold. Pago rechazado o vencido: el horario se libera.'
  ),
  ...numberedStep(
    '10',
    'Seguimiento',
    'El cliente recibe confirmación, recordatorios y puede reprogramar o cancelar según la política.'
  ),
  spacer(80),
  callout(
    'Regla de oro',
    'El turno se confirma recién cuando Mercado Pago aprueba la seña. Si el pago no llega, el horario se libera automáticamente para otra persona.',
    { fill: C.cream, accent: C.terracotta }
  ),
  heading2('Estados del turno'),
  makeTable(
    ['Estado', 'Significado'],
    [
      ['pending_payment', 'Horario reservado temporalmente, esperando la seña.'],
      ['confirmed', 'Pago aprobado o seña dispensada por la clínica.'],
      ['rescheduled', 'Turno movido; se conserva el historial.'],
      ['checked_in', 'El paciente está presente en la clínica.'],
      ['completed', 'Atención realizada.'],
      ['cancelled_by_client', 'Cancelado por el cliente.'],
      ['cancelled_by_clinic', 'Cancelado por la clínica.'],
      ['no_show', 'El cliente no asistió.'],
      ['expired', 'El hold venció sin pago.'],
    ],
    [32, 68]
  ),
  heading2('Cómo se calcula la disponibilidad'),
  ...[
    'Agenda semanal de la Dra. Victoria y duración de cada servicio.',
    'Buffers de preparación y registro antes y después del turno.',
    'Turnos existentes en estado pendiente, confirmado o en atención.',
    'Bloqueos manuales, vacaciones, congresos y feriados.',
    'Anticipación mínima y horizonte máximo de reserva.',
    'Hora actual en America/Argentina/Buenos_Aires.',
  ].map((item) => bullet(item)),
  heading2('Seña con Mercado Pago'),
  paragraph(
    'El pago se apoya en WooCommerce para no reinventar el checkout ni la seguridad de la pasarela. La orden guarda el vínculo con el turno y el turno guarda el ID de la orden.',
    { after: 100 }
  ),
  makeTable(
    ['1. Cliente', '2. WooCommerce', '3. Mercado Pago', '4. Turno'],
    [
      [
        'Elige horario y confirma la reserva.',
        'Crea la orden con la seña y redirige al checkout.',
        'Cobra con el plugin y actualiza la orden por webhook.',
        'Se confirma o se libera el horario según el pago.',
      ],
    ],
    [25, 25, 25, 25]
  ),
  heading2('Reglas de negocio propuestas'),
  ...[
    'Seña obligatoria para confirmar el turno; se descuenta del total del servicio.',
    'Cancelación con más de 24 h: devolución o crédito según política.',
    'Cancelación con menos de 24 h: la seña no se devuelve, salvo indicación de la clínica.',
    'Una reprogramación sin costo con 24 h de anticipación.',
    'Si la clínica cancela, se devuelve la seña o se reprograma sin cargo.',
    'Las urgencias no se reservan online: se derivan telefónicamente.',
  ].map((item) => bullet(item))
);

// ---------------------------------------------------------------------------
// 8. Modelo de datos
// ---------------------------------------------------------------------------

content.push(
  ...sectionHeading('08', 'Modelo de datos'),
  paragraph(
    'La primera versión usa Custom Post Types de WordPress y una capa repositorio. Esa capa permite empezar rápido y migrar a tablas propias si la agenda o el volumen de turnos lo justifican.',
    { after: 120 }
  ),
  makeTable(
    ['CPT', 'Rol', 'Campos clave'],
    [
      [
        'fv_paciente',
        'Mascota asociada a un usuario',
        'Nombre, especie, raza, sexo, nacimiento, peso, esterilización, microchip, alergias y notas.',
      ],
      [
        'fv_servicio',
        'Prestación reservable',
        'Duración, buffers, precio, seña, capacidad, modalidad y estado.',
      ],
      [
        'fv_turno',
        'Reserva concreta',
        'Paciente, servicio, profesional, inicio/fin UTC, estado, orden de seña, hold y recordatorios.',
      ],
    ],
    [20, 24, 56]
  ),
  heading2('Por qué CPT + repositorio'),
  ...[
    'Los CPT permiten administrar pacientes, servicios y turnos desde WordPress sin desarrollo extra.',
    'El repositorio aísla las consultas y las reglas de negocio.',
    'Si la agenda crece, se puede migrar a tablas propias sin reescribir la interfaz.',
    'Los estados y las transiciones quedan en un solo lugar.',
  ].map((item) => bullet(item)),
  spacer(80),
  callout(
    'Privacidad',
    'Los datos de mascotas pueden incluir información sensible de salud. El acceso debe limitarse al dueño y a la clínica, con roles, permisos y una política de retención clara.',
    { fill: C.paper, accent: C.sage }
  )
);

// ---------------------------------------------------------------------------
// 9. Catálogo de servicios
// ---------------------------------------------------------------------------

content.push(
  ...sectionHeading('09', 'Catálogo de servicios'),
  paragraph(
    'El catálogo inicial se define con la clínica. Las duraciones, precios y señas son propuestas a validar antes de cargar la agenda real.',
    { after: 120 }
  ),
  makeTable(
    ['Servicio', 'Duración sugerida', 'Seña sugerida', 'Notas'],
    [
      ['Consulta clínica', '30 min', 'A definir', 'Evaluación general y plan de seguimiento.'],
      ['Vacunación y control', '20 min', 'A definir', 'Calendario, carnet y refuerzos.'],
      ['Peluquería y baño', '60–90 min', 'A definir', 'Según tamaño, pelaje y comportamiento.'],
      ['Nutrición', '30 min', 'A definir', 'Plan alimentario y control de peso.'],
      ['Evaluación prequirúrgica', '30 min', 'A definir', 'Estudios y derivación si corresponde.'],
    ],
    [25, 18, 17, 40]
  ),
  heading2('A futuro'),
  ...[
    'Diagnóstico por imágenes y laboratorio.',
    'Odontología, oftalmología y dermatología.',
    'Fisioterapia y rehabilitación.',
    'Guardería, day care y adiestramiento.',
    'Certificados de viaje y telemedicina.',
    'Farmacia, alimentos y accesorios con retiro o envío.',
  ].map((item) => bullet(item)),
  paragraph(
    'La tienda puede convivir con los servicios: un alimento o un accesorio se compra online, mientras que una consulta se reserva con seña y agenda.',
    { after: 160 }
  ),
  heading2('Datos que definen un servicio'),
  makeTable(
    ['Dato', 'Uso'],
    [
      ['Duración y buffers', 'Minutos de atención y preparación; definen el espacio real en la agenda.'],
      ['Precio y seña', 'Precio de referencia y monto de la seña que se cobra online.'],
      ['Modalidad', 'Presencial, domicilio o telemedicina; define la logística.'],
      ['Capacidad', 'Uno por defecto; permite bloques grupales a futuro.'],
      ['Visibilidad', 'Activo/inactivo y orden en el wizard de reserva.'],
    ],
    [30, 70],
    { keepTogether: true }
  ),
  spacer(80),
  callout(
    'La seña no es el precio total',
    'La seña reserva el horario y se descuenta del total del servicio. El saldo se abona en la clínica o según la política que definamos.',
    { fill: C.cream, accent: C.sage }
  )
);

// ---------------------------------------------------------------------------
// 10. Plan por fases
// ---------------------------------------------------------------------------

content.push(
  ...sectionHeading('10', 'Plan por fases'),
  paragraph(
    'El proyecto avanza por fases cerradas. Cada una tiene un objetivo, entregables y un criterio de aceptación. No se pasa a la siguiente sin una demo y una revisión conjunta.',
    { after: 120 }
  ),
  makeTable(
    ['Fase', 'Objetivo y entregables', 'Estado'],
    [
      [
        '0 · Base técnica',
        [
          'Tema activo, build de Tailwind y esbuild, theme.json base.',
          'Compatibilidad declarada con WooCommerce HPOS y checkout blocks.',
          'Assets de marca, screenshot y documentación inicial.',
        ],
        'Completada',
      ],
      [
        '1 · Identidad y frontend',
        [
          'Header, footer, menú móvil, home editorial y plantillas base.',
          'Sistema de diseño, fuentes autoalojadas, logo y línea botánica.',
          'Personalizador de contacto y verificación responsive.',
        ],
        'Completada',
      ],
      [
        '2 · Tienda WooCommerce',
        [
          'Archivo de productos, tarjetas, ficha de producto y categorías.',
          'Carrito, checkout y Mi cuenta integrados al diseño.',
          'Avisos, botones, campos y estados vacíos. Pruebas con Mercado Pago.',
        ],
        'Siguiente',
      ],
      [
        '3 · Reservas',
        [
          'CPT de pacientes, servicios y turnos; roles y repositorio.',
          'Motor de disponibilidad y wizard de reserva.',
          'Mis mascotas, Mis turnos y agenda de administración.',
        ],
        'Planificada',
      ],
      [
        '4 · Seña',
        [
          'Orden WooCommerce, preferencia de Mercado Pago y metadata cruzada.',
          'Webhooks, holds, expiración y conciliación programada.',
          'Reembolsos y pruebas en sandbox y producción.',
        ],
        'Planificada',
      ],
      [
        '5 · Comunicaciones',
        [
          'Emails de confirmación, recordatorio, cancelación y reprogramación.',
          'Recordatorios 48 h / 24 h, enlaces de autogestión y lista de espera.',
          'Integración con Joinchat y enlaces de WhatsApp.',
        ],
        'Planificada',
      ],
      [
        '6 · QA y lanzamiento',
        [
          'Accesibilidad, performance, SEO técnico y analítica.',
          'Páginas legales, backups, staging y plan de despliegue.',
          'Manual de uso y monitoreo de errores/webhooks.',
        ],
        'Planificada',
      ],
    ],
    [17, 63, 20],
    { keepTogether: true }
  ),
  spacer(80),
  callout(
    'Criterio de cierre de cada fase',
    'Demo funcional, revisión de la clínica, QA de los flujos críticos, documentación actualizada y aprobación para avanzar. Las fases 3 y 4 son el camino crítico para que la reserva con seña funcione de punta a punta.',
    { fill: C.cream, accent: C.terracotta }
  ),
  heading2('Qué necesitamos de la clínica'),
  makeTable(
    ['Dato', 'Para qué'],
    [
      ['Dirección, teléfono, WhatsApp y email reales', 'Contacto, footer, Joinchat y notificaciones.'],
      ['Servicios, duraciones, precios y señas', 'Catálogo y motor de disponibilidad.'],
      ['Fotos de la clínica y de la Dra. Victoria', 'Home, sobre la clínica y redes.'],
      ['Política de cancelación y reprogramación', 'Reglas del turno y textos legales.'],
      ['Feriados, vacaciones y días de cierre', 'Cálculo de horarios disponibles.'],
      ['Textos legales y datos fiscales', 'Privacidad, términos y defensa del consumidor.'],
    ],
    [46, 54]
  ),
  paragraph(
    'El camino crítico es Fase 2 → Fase 3 → Fase 4. La Fase 5 puede empezar en paralelo cuando los estados del turno y los emails estén definidos.',
    { after: 160 }
  ),
  heading2('Cómo trabajamos cada fase'),
  makeTable(
    ['Etapa', 'Qué hacemos'],
    [
      ['1. Kickoff', 'Revisamos alcance, datos y criterios de aceptación.'],
      ['2. Demo', 'Construimos en staging y mostramos el flujo completo.'],
      ['3. Revisión', 'La clínica prueba, marca ajustes y prioriza.'],
      ['4. Cierre', 'QA, documentación y aprobación para la siguiente fase.'],
    ],
    [28, 72],
    { keepTogether: true }
  )
);

// ---------------------------------------------------------------------------
// 11. Estado actual
// ---------------------------------------------------------------------------

content.push(
  ...sectionHeading('11', 'Estado actual', { pageBreakBefore: true }),
  heading2('Completado'),
  ...[
    'Tema mitema activo y sin errores PHP.',
    'Home, página, nota, archivo, búsqueda, 404 y comentarios.',
    'Header/footer globales y menú móvil accesible.',
    'Sistema de diseño, theme.json y fuentes autoalojadas.',
    'Logo horizontal, badge, mark, favicon y línea botánica.',
    'Personalizador con contacto, redes y URL de reservas.',
    'Compatibilidad base con WooCommerce/HPOS y checkout blocks.',
    'Corrección del logo en páginas WooCommerce y limpieza de la barra lateral cruda.',
    'Formato de fecha d/m/Y, hora H:i e inicio de semana lunes.',
    'Título del sitio “Fauna del Velazco” y modo “Coming soon” desactivado para revisión.',
    'Screenshot del tema actualizado con la home de Fase 1.',
  ].map((item) => bullet(item)),
  heading2('Pendiente de datos'),
  makeTable(
    ['Dato', 'Impacto'],
    [
      ['Dirección exacta y mapa', 'Contacto, footer y SEO local.'],
      ['Teléfono, WhatsApp y email', 'Botones, Joinchat y notificaciones.'],
      ['Instagram y Facebook', 'Footer y prueba social.'],
      ['Servicios, duraciones y precios', 'Wizard, agenda y seña.'],
      ['Monto de la seña y política de cancelación', 'Checkout y reglas del turno.'],
      ['Fotos reales y textos legales', 'Home, páginas legales y lanzamiento.'],
    ],
    [46, 54]
  ),
  heading2('Deuda técnica conocida'),
  ...[
    'La tienda, el carrito, el checkout y Mi cuenta usan el markup base de WooCommerce hasta la Fase 2.',
    'El logo horizontal conserva texto SVG con Georgia; para producción conviene convertirlo a curvas con Fraunces/Manrope.',
    'Los CTA de reserva apuntan al bloque de proceso (#reservar); la pantalla real de reserva llega en Fase 3.',
    'No hay productos de prueba cargados ni páginas legales creadas.',
    'El entorno local usa SSL autofirmado; para pruebas con curl usar -k y en Chrome --ignore-certificate-errors.',
  ].map((item) => bullet(item)),
  spacer(80),
  callout(
    'Sitio local',
    'El tema está disponible en https://localhost/webwordpress/ para revisión. La tienda todavía no tiene productos: el objetivo de la Fase 2 es cargar el catálogo real y validar una compra con Mercado Pago en sandbox.',
    { fill: C.paper, accent: C.sage }
  )
);

// ---------------------------------------------------------------------------
// 12. Decisiones y riesgos
// ---------------------------------------------------------------------------

content.push(
  ...sectionHeading('12', 'Decisiones y riesgos', { pageBreakBefore: true }),
  heading2('Decisiones tomadas'),
  ...[
    'Una sola agenda para la Dra. Victoria Boratto.',
    'Seña online con WooCommerce + Mercado Pago; el tema no procesa pagos.',
    'CPT + repositorio para poder migrar a tablas propias más adelante.',
    'Una sola pasarela de pago para la tienda y la seña.',
    'Tailwind v4 local, sin CDN, con fuentes autoalojadas.',
    'No copiar plantillas críticas de checkout/carrito.',
    'Guardar turnos en UTC y mostrarlos en America/Argentina/Buenos_Aires.',
  ].map((item) => bullet(item)),
  heading2('Riesgos y mitigación'),
  makeTable(
    ['Riesgo', 'Mitigación'],
    [
      ['Doble reserva por concurrencia', 'Bloqueo transaccional, validación final y unique index por profesional/horario.'],
      ['Webhook de Mercado Pago perdido o duplicado', 'Idempotencia, notas de orden y conciliación programada.'],
      ['Conflicto con checkout blocks', 'No copiar plantillas críticas, declarar compatibilidad y probar con el plugin.'],
      ['CSS de WooCommerce pisa Tailwind', 'Reglas puntuales fuera de capas y QA visual en cada fase.'],
      ['Pérdida de datos de mascotas', 'Backups, roles, auditoría y política de retención.'],
      ['Cambios de horario / DST', 'Guardar UTC y renderizar en la zona horaria de Buenos Aires.'],
      ['Reservas falsas o spam', 'Cuenta obligatoria, rate limiting, verificación y seña.'],
    ],
    [38, 62]
  ),
  heading2('Lo que no haremos'),
  ...[
    'No procesar pagos ni almacenar datos de tarjeta en el tema.',
    'No usar un page builder ni un CDN para el diseño.',
    'No desencolar Mercado Pago o Joinchat.',
    'No aplicar overflow: hidden global al body.',
    'No sobreescribir el checkout si eso compromete la compatibilidad.',
  ].map((item) => bullet(item))
);

// ---------------------------------------------------------------------------
// 13. Próximos pasos
// ---------------------------------------------------------------------------

content.push(
  ...sectionHeading('13', 'Próximos pasos'),
  ...[
    'Completar los datos reales de contacto, servicios, precios y políticas.',
    'Ejecutar la Fase 2: tienda, ficha de producto, carrito, checkout y Mi cuenta.',
    'Cargar productos de prueba y validar una compra con Mercado Pago sandbox.',
    'Implementar los CPT, el repositorio y el motor de disponibilidad (Fase 3).',
    'Diseñar el wizard de reserva, Mis mascotas y Mis turnos.',
    'Integrar la seña con WooCommerce/Mercado Pago (Fase 4).',
    'Configurar emails, recordatorios y Joinchat (Fase 5).',
    'Cerrar con QA, accesibilidad, performance y lanzamiento (Fase 6).',
  ].map((item, index) =>
    new Paragraph({
      spacing: { after: 90, line: 268 },
      children: [
        textRun(`${String(index + 1).padStart(2, '0')}  `, {
          font: FONT_HEAD,
          size: 24,
          bold: true,
          color: C.terracottaInk,
        }),
        textRun(item, { size: 21, color: C.charcoal }),
      ],
    })
  ),
  spacer(120),
  callout(
    'Siguiente hito',
    'Fase 2 · Tienda WooCommerce. Validar catálogo, precios, envíos, retiro en clínica y una compra completa con Mercado Pago en sandbox.',
    { fill: C.cream, accent: C.terracotta }
  ),
  spacer(120),
  paragraph(
    'El proyecto ya tiene una base visual y técnica sólida. El siguiente paso es convertir esa base en una tienda operativa y, después, en una agenda real que ordene el día de la clínica y cuide la experiencia de cada familia.',
    { after: 120 }
  )
);

// ---------------------------------------------------------------------------
// Annex · Glossary
// ---------------------------------------------------------------------------

content.push(
  new Paragraph({
    heading: HeadingLevel.HEADING_1,
    keepNext: true,
    spacing: { before: 300, after: 80 },
    children: [
      textRun('Anexo · Glosario', {
        font: FONT_HEAD,
        size: 40,
        bold: true,
        color: C.forest,
      }),
    ],
  }),
  rule(C.terracotta, 8, 200),
  paragraph(
    'Términos que aparecen en el documento y que conviene compartir con la clínica.',
    { after: 140 }
  ),
  makeTable(
    ['Término', 'Qué significa'],
    [
      ['WordPress', 'Sistema de gestión de contenidos del sitio.'],
      ['WooCommerce', 'Tienda y sistema de órdenes de WordPress.'],
      ['Mercado Pago', 'Pasarela que procesa los pagos de la tienda y la seña.'],
      ['CPT', 'Tipo de contenido personalizado de WordPress.'],
      ['Seña', 'Pago parcial que confirma el turno y se descuenta del total.'],
      ['Hold', 'Bloqueo temporal de un horario mientras se completa el pago.'],
      ['Joinchat', 'Widget flotante de WhatsApp del sitio.'],
      ['HPOS', 'Sistema de tablas de órdenes de WooCommerce de alto rendimiento.'],
      ['Webhook', 'Aviso automático que Mercado Pago envía al sitio cuando cambia un pago.'],
      ['Checkout blocks', 'Checkout moderno de WooCommerce basado en bloques.'],
    ],
    [24, 76]
  ),
  spacer(120),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { before: 120, after: 60 },
    children: [
      textRun('Gracias.', {
        font: FONT_HEAD,
        size: 30,
        bold: true,
        color: C.forest,
      }),
    ],
  }),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 120 },
    children: [
      textRun('Fauna del Velazco · Dra. Victoria Boratto', {
        size: 18,
        color: C.terracottaInk,
      }),
    ],
  }),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 100 },
    children: [
      new ImageRun({
        type: 'png',
        data: logoMark,
        transformation: { width: 82, height: 82 },
        altText: {
          title: 'Fauna del Velazco',
          description: 'Marca circular de Fauna del Velazco',
          name: 'Marca Fauna del Velazco',
        },
      }),
    ],
  }),
  new Paragraph({
    alignment: AlignmentType.CENTER,
    spacing: { after: 0 },
    children: [
      textRun('Documento de proyecto · Fauna del Velazco · 2026', {
        size: 15,
        color: C.gray,
      }),
    ],
  })
);

// ---------------------------------------------------------------------------
// Header / footer
// ---------------------------------------------------------------------------

const header = new Header({
  children: [
    new Table({
      width: { size: 100, type: WidthType.PERCENTAGE },
      columnWidths: [Math.round(CONTENT_WIDTH * 0.1), Math.round(CONTENT_WIDTH * 0.6), Math.round(CONTENT_WIDTH * 0.3)],
      layout: TableLayoutType.FIXED,
      borders: {
        top: noneBorder,
        left: noneBorder,
        right: noneBorder,
        insideHorizontal: noneBorder,
        insideVertical: noneBorder,
        bottom: lineBorder(C.line, 4),
      },
      rows: [
        new TableRow({
          children: [
            new TableCell({
              width: { size: 10, type: WidthType.PERCENTAGE },
              margins: { top: 0, bottom: 80, left: 0, right: 80 },
              verticalAlign: VerticalAlign.CENTER,
              children: [
                new Paragraph({
                  spacing: { after: 0 },
                  children: [
                    new ImageRun({
                      type: 'png',
                      data: logoMark,
                      transformation: { width: 26, height: 26 },
                      altText: {
                        title: 'Fauna del Velazco',
                        description: 'Marca circular de Fauna del Velazco',
                        name: 'Marca Fauna del Velazco',
                      },
                    }),
                  ],
                }),
              ],
            }),
            new TableCell({
              width: { size: 60, type: WidthType.PERCENTAGE },
              margins: { top: 0, bottom: 80, left: 0, right: 80 },
              verticalAlign: VerticalAlign.CENTER,
              children: [
                new Paragraph({
                  spacing: { after: 0 },
                  children: [
                    textRun('Fauna del Velazco', {
                      size: 16,
                      bold: true,
                      color: C.forest,
                    }),
                    textRun('  ·  Documento de proyecto', {
                      size: 14,
                      color: C.gray,
                    }),
                  ],
                }),
              ],
            }),
            new TableCell({
              width: { size: 30, type: WidthType.PERCENTAGE },
              margins: { top: 0, bottom: 80, left: 80, right: 0 },
              verticalAlign: VerticalAlign.CENTER,
              children: [
                new Paragraph({
                  alignment: AlignmentType.RIGHT,
                  spacing: { after: 0 },
                  children: [
                    textRun('FASE 1 · 2026', {
                      size: 13,
                      bold: true,
                      color: C.terracottaInk,
                      characterSpacing: 18,
                    }),
                  ],
                }),
              ],
            }),
          ],
        }),
      ],
    }),
  ],
});

const footer = new Footer({
  children: [
    new Table({
      width: { size: 100, type: WidthType.PERCENTAGE },
      columnWidths: [Math.round(CONTENT_WIDTH * 0.7), Math.round(CONTENT_WIDTH * 0.3)],
      layout: TableLayoutType.FIXED,
      borders: {
        top: lineBorder(C.line, 4),
        left: noneBorder,
        right: noneBorder,
        bottom: noneBorder,
        insideHorizontal: noneBorder,
        insideVertical: noneBorder,
      },
      rows: [
        new TableRow({
          children: [
            new TableCell({
              width: { size: 70, type: WidthType.PERCENTAGE },
              margins: { top: 90, bottom: 0, left: 0, right: 80 },
              children: [
                new Paragraph({
                  spacing: { after: 0 },
                  children: [
                    textRun('Dra. Victoria Boratto · Clínica veterinaria', {
                      size: 14,
                      color: C.gray,
                    }),
                  ],
                }),
              ],
            }),
            new TableCell({
              width: { size: 30, type: WidthType.PERCENTAGE },
              margins: { top: 90, bottom: 0, left: 80, right: 0 },
              children: [
                new Paragraph({
                  alignment: AlignmentType.RIGHT,
                  spacing: { after: 0 },
                  children: [
                    textRun('Página ', { size: 14, color: C.gray }),
                    new TextRun({
                      children: [PageNumber.CURRENT],
                      font: FONT_BODY,
                      size: 14,
                      color: C.terracottaInk,
                      bold: true,
                    }),
                    textRun(' de ', { size: 14, color: C.gray }),
                    new TextRun({
                      children: [PageNumber.TOTAL_PAGES],
                      font: FONT_BODY,
                      size: 14,
                      color: C.gray,
                    }),
                  ],
                }),
              ],
            }),
          ],
        }),
      ],
    }),
  ],
});

const emptyHeader = new Header({
  children: [new Paragraph({ children: [] })],
});

const emptyFooter = new Footer({
  children: [new Paragraph({ children: [] })],
});

// ---------------------------------------------------------------------------
// Document
// ---------------------------------------------------------------------------

const doc = new Document({
  title: 'Fauna del Velazco · Proyecto digital',
  subject: 'Sitio web, tienda WooCommerce y reservas con seña online',
  creator: 'Fauna del Velazco',
  description: 'Documento de proyecto: identidad, arquitectura, flujo de reserva, plan por fases y estado actual.',
  keywords: 'WordPress, WooCommerce, Mercado Pago, reservas, veterinaria, Fauna del Velazco',
  lastModifiedBy: 'Fauna del Velazco',
  revision: 1,
  background: { color: C.cream },
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
        paragraph: { spacing: { before: 260, after: 90 }, keepNext: true },
      },
      heading3: {
        run: { font: FONT_BODY, size: 22, bold: true, color: C.terracottaInk },
        paragraph: { spacing: { before: 180, after: 50 }, keepNext: true },
      },
      caption: {
        run: { font: FONT_BODY, size: 17, italics: true, color: C.gray },
      },
      listParagraph: {
        run: { font: FONT_BODY, size: 21, color: C.charcoal },
        paragraph: { spacing: { after: 60 } },
      },
    },
  },
  sections: [
    {
      properties: {
        titlePage: true,
        page: {
          size: { width: PAGE_WIDTH, height: PAGE_HEIGHT },
          margin: {
            top: PAGE_MARGIN,
            right: PAGE_MARGIN,
            bottom: PAGE_MARGIN,
            left: PAGE_MARGIN,
            header: 567,
            footer: 567,
          },
        },
      },
      headers: { default: header, first: emptyHeader },
      footers: { default: footer, first: emptyFooter },
      children: [...cover, ...content],
    },
  ],
});

const buffer = await Packer.toBuffer(doc);
fs.mkdirSync(path.dirname(outputFile), { recursive: true });
fs.writeFileSync(outputFile, buffer);
console.log(`Word document written: ${outputFile}`);
console.log(`Size: ${(buffer.length / 1024).toFixed(1)} KB`);
