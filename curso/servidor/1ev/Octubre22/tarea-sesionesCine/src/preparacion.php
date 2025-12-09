<?php


/*pagina de cine.... nos logeamos con nuestra cuenta de usuario, y seleccionar la pelicula y la butaca a elegir. y se guarda 10 minutos desde que se selecciona,
si en esos 10 minutos no se paga el precio de la butaca, se pierde la butaca reservada y la  puede volver a seleccionar otro usuario.
ademas se podra comprar bebida y comida al reservar la butaca.
tendremos 5 peliculas.
usuarios creados predefinidamente para probarlo. contraseña y nomobre de usuario seran iguales.
usuario, alumno, profesor, pablo, admin.
en el index se vera un listado de las sesiones de usuarios guardadas, y de las butacas en total reservadas. (2 contadores).
al logearte vuelves al index (pero sin el login, ya que estas logeado) y ves un mensaje de bienvenida.

butacas creadas en cuadrícula 10x10.
index con un welcome, con las peliculas a elegir.
index con el login debajo de las peliculas a elegir.
al seleccionar la pelicula, se ve la sala con las butacas.
al seleccionar la butaca, te lleva a un paso medio si quieres elegir palomitas, bebida, ambos o nada , despues de esta seleccion, se ve un resumen de la reserva, con la pelicula, la butaca elegida, el precio total (butaca + extras si los hay) y un boton de pagar.
si se paga (un fake boton, que simula pagar), se confirma la reserva y se guarda en sesion.
*/
