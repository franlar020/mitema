<?php
/**
 * Catálogo de productos de la tienda.
 *
 * Este archivo es la fuente de verdad para crear los productos de demostración
 * y para resolver las imágenes desde la biblioteca de medios.
 *
 * Para cambiar una foto:
 * 1. Subir la imagen a Medios > Añadir nuevo.
 * 2. Copiar la URL del archivo (no la URL del adjunto).
 * 3. Reemplazar el valor de `imagen` en el producto correspondiente.
 *
 * Las claves son los SKU y no deben cambiarse una vez creados los productos.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return the store catalog.
 *
 * @return array<string, array<string, mixed>>
 */
function fv_catalogo_productos(): array {
	return array(
		'FV-ALI-001' => array(
			'nombre'            => 'Alimento para cachorros 3 kg',
			'categoria'         => 'Alimentos',
			'precio'            => 24900,
			'descripcion_corta' => 'Fórmula completa para el crecimiento de cachorros de hasta 12 meses.',
			'descripcion'       => 'Alimento balanceado para cachorros con proteínas de alta calidad, calcio y fósforo para acompañar el desarrollo de huesos y articulaciones.

Incluye prebióticos y ácidos grasos esenciales para favorecer la digestión y mantener una piel sana. Ración orientativa según peso y edad; consultar con la clínica antes de cambiar la dieta.',
			'imagen'            => '',
			'stock'             => 14,
			'destacado'         => true,
		),
		'FV-ALI-002' => array(
			'nombre'            => 'Alimento para adultos 10 kg',
			'categoria'         => 'Alimentos',
			'precio'            => 52900,
			'descripcion_corta' => 'Nutrición equilibrada para perros adultos con actividad normal.',
			'descripcion'       => 'Fórmula completa para perros adultos de entre 1 y 7 años. Aporta proteína animal, fibra y antioxidantes para el mantenimiento diario.

Su tamaño de 10 kg es práctico para hogares con uno o más perros y permite conservar el alimento en un lugar fresco y seco. Consultar la tabla de raciones del envase.',
			'imagen'            => '',
			'stock'             => 9,
			'destacado'         => true,
		),
		'FV-ALI-003' => array(
			'nombre'            => 'Alimento para seniors 7,5 kg',
			'categoria'         => 'Alimentos',
			'precio'            => 46500,
			'descripcion_corta' => 'Fórmula pensada para perros mayores de 7 años.',
			'descripcion'       => 'Alimento balanceado para perros seniors con menor contenido calórico, proteínas de buena calidad y condroprotectores para acompañar la movilidad.

La fibra y los prebióticos ayudan al tránsito intestinal. Se recomienda una transición gradual de siete días y un control veterinario periódico.',
			'imagen'            => '',
			'stock'             => 7,
			'destacado'         => false,
		),
		'FV-ALI-004' => array(
			'nombre'            => 'Alimento húmedo para gatos 340 g',
			'categoria'         => 'Alimentos',
			'precio'            => 3900,
			'descripcion_corta' => 'Paté húmedo de pollo para gatos adultos.',
			'descripcion'       => 'Alimento húmedo completo para gatos adultos, elaborado con pollo y sin colorantes artificiales. Su textura suave y su alto contenido de humedad colaboran con la hidratación diaria.

Se puede ofrecer solo o mezclado con alimento seco. Una vez abierto, conservar en la heladera y consumir dentro de las 48 horas.',
			'imagen'            => '',
			'stock'             => 20,
			'destacado'         => false,
		),
		'FV-ALI-005' => array(
			'nombre'            => 'Snacks dentales 180 g',
			'categoria'         => 'Alimentos',
			'precio'            => 7200,
			'descripcion_corta' => 'Premios masticables para el cuidado dental cotidiano.',
			'descripcion'       => 'Snacks con textura que ayuda a reducir la placa y el sarro mientras el perro mastica. Aportan pocas calorías y son útiles como premio durante el entrenamiento.

Ofrecer como complemento de una dieta completa, no como reemplazo del alimento principal. Supervisar la masticación de perros pequeños o muy glotones.',
			'imagen'            => '',
			'stock'             => 18,
			'destacado'         => false,
		),
		'FV-ACC-001' => array(
			'nombre'            => 'Collar ajustable',
			'categoria'         => 'Accesorios',
			'precio'            => 12400,
			'descripcion_corta' => 'Collar resistente con cierre de seguridad y anillo de paseo.',
			'descripcion'       => 'Collar de nylon reforzado con hebilla de acero inoxidable y anillo para sujetar la correa. El sistema de ajuste permite acompañar el crecimiento del perro sin quedar demasiado ajustado.

Disponible en talles M y L. Para el paseo diario, dejar dos dedos de holgura entre el collar y el cuello.',
			'imagen'            => '',
			'stock'             => 16,
			'destacado'         => false,
		),
		'FV-ACC-002' => array(
			'nombre'            => 'Correa reforzada 2 m',
			'categoria'         => 'Accesorios',
			'precio'            => 15900,
			'descripcion_corta' => 'Correa de 2 metros con mosquetón metálico y mango acolchado.',
			'descripcion'       => 'Correa de paseo confeccionada con cinta de nylon de alta resistencia y costuras reforzadas. El mosquetón metálico gira 360° para evitar que la cinta se retuerza.

El mango acolchado mejora el agarre en paseos largos. Revisar periódicamente las costuras y el mosquetón.',
			'imagen'            => '',
			'stock'             => 12,
			'destacado'         => false,
		),
		'FV-ACC-003' => array(
			'nombre'            => 'Cama ortopédica mediana',
			'categoria'         => 'Accesorios',
			'precio'            => 58000,
			'descripcion_corta' => 'Cama con espuma de alta densidad y funda desmontable.',
			'descripcion'       => 'Cama ortopédica de espuma firme que distribuye el peso y ayuda a cuidar las articulaciones de perros adultos y seniors. La funda es desmontable y lavable.

Medidas aproximadas: 80 × 60 × 12 cm. Útil para perros que pasan muchas horas acostados o que se recuperan de una cirugía.',
			'imagen'            => '',
			'stock'             => 5,
			'destacado'         => true,
		),
		'FV-ACC-004' => array(
			'nombre'            => 'Transportadora rígida talle M',
			'categoria'         => 'Accesorios',
			'precio'            => 42000,
			'descripcion_corta' => 'Transportadora ventilada para viajes y visitas a la clínica.',
			'descripcion'       => 'Transportadora rígida con puerta metálica, ventilación lateral y manija de transporte. El talle M es adecuado para gatos y perros pequeños de hasta 8 kg.

Incluye bandeja interior extraíble para facilitar la limpieza. Verificar el peso y las medidas del animal antes de la compra.',
			'imagen'            => '',
			'stock'             => 6,
			'destacado'         => false,
		),
		'FV-ACC-005' => array(
			'nombre'            => 'Comedero doble de acero',
			'categoria'         => 'Accesorios',
			'precio'            => 18500,
			'descripcion_corta' => 'Base antideslizante con dos bowls de acero inoxidable.',
			'descripcion'       => 'Comedero doble con base de plástico antideslizante y dos bowls de acero inoxidable aptos para agua y alimento. Los bowls se retiran para lavarlos con facilidad.

El diseño elevado ayuda a mantener el área de comida ordenada. Apto para perros y gatos de tamaño pequeño y mediano.',
			'imagen'            => '',
			'stock'             => 11,
			'destacado'         => false,
		),
		'FV-CUI-001' => array(
			'nombre'            => 'Shampoo hipoalergénico 500 ml',
			'categoria'         => 'Cuidado',
			'precio'            => 11800,
			'descripcion_corta' => 'Shampoo suave para pieles sensibles y baños frecuentes.',
			'descripcion'       => 'Shampoo de pH equilibrado con agentes humectantes, pensado para perros y gatos con piel sensible. Limpia sin resecar y deja el pelaje suave.

Aplicar sobre el pelaje húmedo, masajear y enjuagar con abundante agua. Evitar el contacto con los ojos y consultar ante irritaciones persistentes.',
			'imagen'            => '',
			'stock'             => 15,
			'destacado'         => false,
		),
		'FV-CUI-002' => array(
			'nombre'            => 'Cepillo deslanador',
			'categoria'         => 'Cuidado',
			'precio'            => 13200,
			'descripcion_corta' => 'Cepillo que retira pelo muerto y reduce los nudos.',
			'descripcion'       => 'Cepillo con púas de acero inoxidable y protector de puntas para retirar el pelo muerto sin lastimar la piel. Recomendado para razas de pelo medio y largo.

Usar en sesiones cortas, siguiendo la dirección del pelaje. No forzar los nudos: separarlos con los dedos o con un peine antes de cepillar.',
			'imagen'            => '',
			'stock'             => 13,
			'destacado'         => false,
		),
		'FV-CUI-003' => array(
			'nombre'            => 'Pipeta antiparasitaria',
			'categoria'         => 'Cuidado',
			'precio'            => 8900,
			'descripcion_corta' => 'Protección externa mensual para perros de 10 a 20 kg.',
			'descripcion'       => 'Pipeta de aplicación tópica para el control de pulgas y garrapatas. La dosis corresponde a perros de 10 a 20 kg.

Aplicar en la piel, entre los omóplatos, separando el pelaje. No bañar al animal durante las 48 horas posteriores. Consultar el calendario de refuerzos con la clínica.',
			'imagen'            => '',
			'stock'             => 22,
			'destacado'         => true,
		),
		'FV-CUI-004' => array(
			'nombre'            => 'Toallitas húmedas x 80',
			'categoria'         => 'Cuidado',
			'precio'            => 5400,
			'descripcion_corta' => 'Toallitas suaves para limpieza diaria de patas y hocico.',
			'descripcion'       => 'Toallitas húmedas sin alcohol ni perfume, ideales para limpiar patas, hocico y zonas de difícil acceso después del paseo. Su formato práctico permite usarlas en casa o durante los viajes.

No reemplazan el baño ni el cepillado. Cerrar bien el envase después de cada uso para conservar la humedad.',
			'imagen'            => '',
			'stock'             => 25,
			'destacado'         => false,
		),
		'FV-CUI-005' => array(
			'nombre'            => 'Arenilla sanitaria 10 kg',
			'categoria'         => 'Cuidado',
			'precio'            => 9800,
			'descripcion_corta' => 'Arenilla aglomerante con control de olores para gatos.',
			'descripcion'       => 'Arenilla sanitaria de rápida absorción y formación de grumos firmes. El carbón activado ayuda a neutralizar olores y facilita la limpieza diaria del arenero.

Verter una capa de 5 a 7 cm y retirar los grumos con frecuencia. Lavar el arenero con agua y jabón neutro cada semana.',
			'imagen'            => '',
			'stock'             => 10,
			'destacado'         => false,
		),
	);
}

/**
 * Return one catalog item by SKU.
 *
 * @param string $sku Product SKU.
 * @return array<string, mixed>
 */
function fv_catalogo_producto_por_sku( string $sku ): array {
	$catalogo = fv_catalogo_productos();

	return $catalogo[ $sku ] ?? array();
}
