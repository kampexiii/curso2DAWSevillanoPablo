//expresion regular para validar un correo electronico
export const validarCorreo = (correo) => {
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return regex.test(correo);
};

if(!validarCorreo(correo)){
    console.log("Correo invalido");
}


//expresion regular para validar un numero de telefono (formato internacional)
export const validarTelefono = (telefono) => {
    const regex = /^\+?[1-9]\d{1,14}$/;
    return regex.test(telefono);
};

//expresion regular para validar telefono españa +34 obligatorio
export const validarTelefonoEspana = (telefono) => {
    const regex = /^\+34[6789]\d{8}$/;
    return regex.test(telefono);
};

//expresion regular para validar una fecha en formato dd/mm/yyyy
export const validarFecha = (fecha) => {
    const regex = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(19|20)\d\d$/;
    return regex.test(fecha);
};


//expresion regular para validar una URL
export const validarURL = (url) => {
    const regex = /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([\/\w .-]*)*\/?$/;
    return regex.test(url);
};


//expresion regular para validar un codigo postal (5 digitos)
export const validarCodigoPostal = (codigoPostal) => {
    const regex = /^\d{5}$/;
    return regex.test(codigoPostal);
};


//expresion regular para validar un nombre real (solo letras y espacios)
export const validarNombreReal = (nombre) => {
    const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/;
    return regex.test(nombre);
};

//expresion regular para validar una contraseña (minimo 8 caracteres, al menos una letra mayuscula, una letra minuscula, un numero y un caracter especial)
export const validarContrasena = (contrasena) => {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return regex.test(contrasena);
};

//mostrar mensaje si la contraseña no es valida y lo que le falto por poner al usuario
export const mensajeContrasenaInvalida = (contrasena) => {
    const mensajes = [];
    if (!/(?=.*[a-z])/.test(contrasena)) {
        mensajes.push("al menos una letra minuscula");
    }
    if (!/(?=.*[A-Z])/.test(contrasena)) {
        mensajes.push("al menos una letra mayuscula");
    }
    if (!/(?=.*\d)/.test(contrasena)) {
        mensajes.push("al menos un numero");
    }
    if (!/(?=.*[@$!%*?&])/.test(contrasena)) {
        mensajes.push("al menos un caracter especial");
    }
    if (contrasena.length < 8) {
        mensajes.push("al menos 8 caracteres");
    }
    return mensajes.join(", ");
};


//expresion regular para validar un numero de tarjeta de credito (16 digitos)
export const validarTarjetaCredito = (tarjeta) => {
    const regex = /^\d{16}$/;
    return regex.test(tarjeta);
};


//expresion regular validar ajedrez (notacion algebraica basica)
export const validarMovimientoAjedrez = (movimiento) => {
    const regex = /^(?:[KQRBN]?[a-h]?[1-8]?x?[a-h][1-8](?:=[QRBN])?|O-O(?:-O)?)([+#])?$/;
    return regex.test(movimiento);
};


