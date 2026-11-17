# PHP en Acción — Mini Proyecto 1, Unidad 4

Sitio web dinámico hecho en PHP que demuestra el uso de **variables, tipos de datos, estructuras de control, arreglos y sesiones**. Cada página explica un tema y muestra ejemplos que PHP ejecuta en el servidor al cargarla, y en todas se ve la hora de inicio de sesión, la hora actual y el tiempo activo del usuario.

## Datos generales

| | |
|---|---|
| **Materia** | Programación Web |
| **Unidad** | Unidad 4 – Programación del lado del servidor con PHP |
| **Docente** | Jorge Octavio Guzmán Sánchez |
| **Institución** | TecNM – Instituto Tecnológico de Tuxtla Gutiérrez |
| **Carrera / Grupo** | Ingeniería en Sistemas Computacionales · S5A |
| **Actividad** | Mini proyecto (en equipo) |

## Integrantes del equipo

- Ricardo Francisco Pinto Velasco
- Sebastián Ali Fernández Culebro
- Gabriel Alejandro Cruz Guillen

## Enlaces

- **Sitio publicado:** _(agregar el enlace de InfinityFree)_
- **Repositorio:** https://github.com/RicardoPVX/miniproyecto-php-u4

## Descripción del proyecto

El sitio tiene seis páginas PHP que comparten el mismo encabezado, menú y pie de página mediante `include`. Al entrar a `index.php` se inicia una sesión y se guarda la hora de inicio con `time()`; si ya existía una sesión, se destruye con `session_destroy()` y se crea una nueva. Las demás páginas retoman la sesión, registran la visita y calculan el tiempo activo restando `time() - $_SESSION['hora_inicio']`, convertido a minutos y segundos.

No usa base de datos, archivos ni formularios: los datos solo viven en la sesión mientras está activa.

## Temas de PHP implementados

| Archivo | Tema | Qué se demuestra |
|---|---|---|
| `index.php` | Inicio de sesión | `session_start()`, `isset()`, `session_destroy()`, `session_regenerate_id()`, registro de `time()` en `$_SESSION` |
| `variables.php` | Variables y tipos de datos | Variables `string`, `int`, `float`, `boolean`, `array` y `null`; `echo`, `gettype()`, `var_dump()`, funciones `is_*()`, operaciones, concatenación, interpolación, `date()`, `count()`, casting, constantes, `isset()` y `unset()` |
| `condicionales.php` | Estructuras condicionales | `if`, `else`, `elseif` y `switch` evaluando variables, arreglos, la hora y el día actuales; operadores de comparación y lógicos; ternario y `??` |
| `bucles.php` | Estructuras repetitivas | `for` (incluye `for` anidados para una tabla de multiplicar), `while`, `do...while`, `foreach` con clave y valor, `break` y `continue` |
| `arreglos.php` | Arreglos | Arreglo indexado, asociativo y multidimensional; recorrido con `foreach` y condicionales dentro del recorrido; `array_push()`, `sort()`, `in_array()`, `array_column()`, `array_filter()`, `array_map()`, `usort()`, etc. |
| `sesiones.php` | Sesiones | `$_SESSION`, `session_id()`, `session_status()`, cálculo del tiempo activo paso a paso, contador de visitas e historial que persisten entre páginas, reinicio de sesión |

Además, el menú (`includes/menu.php`) se genera con un arreglo asociativo, `foreach` e `if`, y el pie de página recorre el arreglo de integrantes.

## Estructura del proyecto

```
/
├── index.php
├── variables.php
├── condicionales.php
├── bucles.php
├── arreglos.php
├── sesiones.php
├── css/
│   └── styles.css
├── includes/
│   ├── config.php     # zona horaria, constantes y funciones de apoyo
│   ├── sesion.php     # retoma la sesión y registra la visita (todas menos index)
│   ├── header.php     # <head>, encabezado, menú y barra de sesión
│   ├── menu.php
│   └── footer.php
└── img/
    └── logo.svg
```

## Cómo ejecutarlo en local

Se necesita PHP 8 o superior. Desde la carpeta del proyecto:

```bash
php -S localhost:8000
```

y abrir `http://localhost:8000` en el navegador. También funciona copiando la carpeta a `htdocs` de XAMPP.

## Funcionamiento de la sesión

1. `index.php` llama a `session_start()`. Si existe `$_SESSION['hora_inicio']`, vacía la sesión, la destruye con `session_destroy()` y abre una nueva.
2. Guarda `$_SESSION['hora_inicio'] = time()`.
3. Las demás páginas incluyen `includes/sesion.php`; si alguien entra sin sesión, se le redirige al index.
4. `includes/header.php` muestra en todas las páginas la hora de inicio, la hora actual y el tiempo activo (`intdiv($segundos, 60)` minutos y `$segundos % 60` segundos).
5. El botón **Reiniciar sesión** lleva a `index.php`, que destruye la sesión y crea una nueva hora inicial.
