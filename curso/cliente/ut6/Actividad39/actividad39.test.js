const {
    validarNombres,
    validarEmail,
    validarFecha,
    validarComentario,
    validarFormulario
} = require('./actividad39');

describe('Pruebas para validarNombres', () => {
    test('devuelve true si ambos nombres son válidos y diferentes', () => {
        expect(validarNombres('Pablo', 'Maria')).toBe(true);
    });

    test('devuelve false si un nombre es demasiado corto', () => {
        expect(validarNombres('Pa', 'Maria')).toBe(false);
    });

    test('devuelve false si un nombre contiene números', () => {
        expect(validarNombres('Pablo123', 'Maria')).toBe(false);
    });

    test('devuelve false si los nombres son iguales', () => {
        expect(validarNombres('Pablo', 'Pablo')).toBe(false);
    });
});

describe('Pruebas para validarEmail', () => {
    test('devuelve true para un email válido .com', () => {
        expect(validarEmail('test@example.com')).toBe(true);
    });

    test('devuelve true para un email válido .es', () => {
        expect(validarEmail('usuario@dominio.es')).toBe(true);
    });

    test('devuelve false para un email inválido sin dominio correcto', () => {
        expect(validarEmail('usuario@dominio')).toBe(false);
    });
});

describe('Pruebas para validarFecha', () => {
    test('devuelve false si la fecha está vacía', () => {
        expect(validarFecha('')).toBe(false);
    });

    test('devuelve true si la fecha es hoy', () => {
        const hoy = new Date().toISOString().split('T')[0];
        expect(validarFecha(hoy)).toBe(true);
    });

    test('devuelve false si la fecha es futura', () => {
        const manana = new Date();
        manana.setDate(manana.getDate() + 1);
        const fechaFutura = manana.toISOString().split('T')[0];
        expect(validarFecha(fechaFutura)).toBe(false);
    });
});

describe('Pruebas para validarComentario', () => {
    test('devuelve true si el comentario está vacío', () => {
        expect(validarComentario('')).toBe(true);
    });

    test('devuelve true si el comentario tiene longitud 200', () => {
        const comentario = 'a'.repeat(200);
        expect(validarComentario(comentario)).toBe(true);
    });

    test('devuelve false si el comentario tiene más de 200 caracteres', () => {
        const comentario = 'a'.repeat(201);
        expect(validarComentario(comentario)).toBe(false);
    });
});

describe('Pruebas para validarFormulario', () => {
    const dataValida = {
        jBlancas: 'Pablo',
        jNegras: 'Maria',
        color: 'blancas',
        resultado: '1-0',
        email: 'test@example.com',
        fecha: new Date().toISOString().split('T')[0],
        comentario: 'Partida interesante'
    };

    test('devuelve true si el objeto data es completamente válido', () => {
        expect(validarFormulario(dataValida)).toBe(true);
    });

    test('devuelve false si el objeto data tiene un email inválido', () => {
        const dataInvalida = { ...dataValida, email: 'email-invalido' };
        expect(validarFormulario(dataInvalida)).toBe(false);
    });

    test('devuelve false si el objeto data tiene una fecha futura', () => {
        const manana = new Date();
        manana.setDate(manana.getDate() + 1);
        const fechaFutura = manana.toISOString().split('T')[0];
        const dataInvalida = { ...dataValida, fecha: fechaFutura };
        expect(validarFormulario(dataInvalida)).toBe(false);
    });
});
