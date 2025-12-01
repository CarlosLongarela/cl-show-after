# CL Show After

## Descripción
CL Show After es un plugin sencillo para WordPress que permite mostrar contenido de forma condicional basándose en una fecha y hora específicas. Utilizando un shortcode, puedes envolver cualquier contenido (texto, HTML, o incluso otros shortcodes) para que permanezca oculto hasta que se alcance el momento configurado.

Este plugin es útil para programar la visualización de ofertas, anuncios, enlaces de registro o cualquier información que deba aparecer automáticamente en un momento determinado sin necesidad de editar la página manualmente.

## Instalación
1. Sube la carpeta del plugin al directorio `/wp-content/plugins/` de tu instalación de WordPress.
2. Activa el plugin desde el menu 'Plugins' en el panel de administración de WordPress.

## Uso
Para utilizar el plugin, usa el shortcode `[cl_show_after]` en tus entradas, páginas o widgets.

### Sintaxis del shortcode
```
[cl_show_after date-time="AAAA-MM-DD HH:mm"]
Tu contenido aqui.
[/cl_show_after]
```

### Parámetros
*   **date-time** (Requerido): La fecha y hora a partir de la cual se mostrara el contenido. El formato debe ser `AAAA-MM-DD HH:mm` (Año-Mes-Dia Hora:Minuto).

### Notas importantes
*   El plugin utiliza la zona horaria configurada en los **Ajustes Generales** de tu sitio WordPress. Asegurate de que la hora de tu sitio sea correcta para que el contenido se muestre en el momento esperado.
*   Si no se especifica el atributo `date-time` o si el formato es incorrecto, el contenido no se mostrara.

## Ejemplo
Si quieres mostrar un mensaje de oferta a partir del 1 de Diciembre de 2025 a las 12:00 del mediodia:

```
[cl_show_after date-time="2025-12-01 12:00"]
<h2>¡La oferta ha comenzado!</h2>
<p>Aprovecha nuestros descuentos especiales disponibles ahora.</p>
[/cl_show_after]
```

Antes de esa fecha y hora, el contenido dentro del shortcode estará oculto para los visitantes.
