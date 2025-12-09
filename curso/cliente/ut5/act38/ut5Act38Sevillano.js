'use strict';

/**
 * Mini-proyecto UT5: gestiona el formulario de partidas del torneo
 * aplicando validaciones personalizadas y guardando datos validados.
 */
document.addEventListener('DOMContentLoaded', initForm);

/**
 * Arranca toda la logica de validacion cuando el DOM esta listo.
 */
function initForm() {
  const form = document.getElementById('formTorneo');
  if (!form) {
    return;
  }

  const fields = {
    blancas: document.getElementById('jugadorBlancas'),
    negras: document.getElementById('jugadorNegras'),
    resultado: document.getElementById('resultado'),
    email: document.getElementById('email'),
    fecha: document.getElementById('fecha'),
    comentario: document.getElementById('comentario')
  };

  const errorNodes = {
    blancas: document.getElementById('errBlancas'),
    negras: document.getElementById('errNegras'),
    color: document.getElementById('errColor'),
    resultado: document.getElementById('errResultado'),
    email: document.getElementById('errEmail'),
    fecha: document.getElementById('errFecha'),
    comentario: document.getElementById('errComentario')
  };

  const mensajeFinal = document.getElementById('mensajeFinal');
  const colorRadios = Array.from(document.querySelectorAll('input[name="color"]'));

  const patterns = {
    name: /^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ]+(?:\s[A-Za-zÁÉÍÓÚÜÑáéíóúüñ]+)*$/,
    email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
    comment: /^[A-Za-z0-9ÁÉÍÓÚÜÑáéíóúüñ .,;:!?()"'\-]*$/
  };

  const STORAGE_KEY = 'ut5act38_partidas';

  /**
   * Muestra el texto de error en el parrafo asociado a un campo.
   * @param {HTMLElement|null} element - nodo <p class="error">
   * @param {string} message - texto a imprimir
   */
  function setError(element, message) {
    if (element) {
      element.textContent = message;
    }
  }

  /**
   * Elimina todos los errores visibles del formulario.
   */
  function clearAllErrors() {
    Object.values(errorNodes).forEach(function (node) {
      setError(node, '');
    });
  }

  /**
   * Gestiona el mensaje general del formulario.
   * @param {string} message - texto a mostrar
   * @param {boolean} isSuccess - define el color del mensaje
   */
  function showFinalMessage(message, isSuccess) {
    if (!mensajeFinal) {
      return;
    }
    mensajeFinal.textContent = message;
    mensajeFinal.style.color = isSuccess ? 'green' : 'crimson';
  }

  /**
   * Obtiene el color seleccionado o cadena vacia.
   * @returns {string} valor del radio marcado
   */
  function getSelectedColor() {
    const selected = colorRadios.find(function (radio) {
      return radio.checked;
    });
    return selected ? selected.value : '';
  }

  /**
   * Valida el nombre del jugador de blancas.
   * @returns {boolean} resultado de la validacion
   */
  function validateNombreBlancas() {
    const value = fields.blancas.value.trim();
    if (value.length < 3 || !patterns.name.test(value)) {
      setError(errorNodes.blancas, 'Introduce un nombre valido (minimo 3 letras).');
      return false;
    }
    setError(errorNodes.blancas, '');
    return true;
  }

  /**
   * Valida el nombre del jugador de negras y que sea distinto.
   * @returns {boolean} resultado de la validacion
   */
  function validateNombreNegras() {
    const value = fields.negras.value.trim();
    if (value.length < 3 || !patterns.name.test(value)) {
      setError(errorNodes.negras, 'Introduce un nombre valido (minimo 3 letras).');
      return false;
    }
    if (
      fields.blancas.value.trim() &&
      value.toLocaleLowerCase() === fields.blancas.value.trim().toLocaleLowerCase()
    ) {
      setError(errorNodes.negras, 'Los nombres no pueden coincidir.');
      return false;
    }
    setError(errorNodes.negras, '');
    return true;
  }

  /**
   * Comprueba que se haya elegido un color.
   * @returns {boolean} resultado de la validacion
   */
  function validateColor() {
    if (!getSelectedColor()) {
      setError(errorNodes.color, 'Selecciona un color.');
      return false;
    }
    setError(errorNodes.color, '');
    return true;
  }

  /**
   * Valida que el resultado se haya seleccionado.
   * @returns {boolean} resultado de la validacion
   */
  function validateResultado() {
    if (!fields.resultado.value) {
      setError(errorNodes.resultado, 'Indica el resultado de la partida.');
      return false;
    }
    setError(errorNodes.resultado, '');
    return true;
  }

  /**
   * Valida el email usando una expresion regular basica.
   * @returns {boolean} resultado de la validacion
   */
  function validateEmail() {
    const value = fields.email.value.trim();
    if (!value || !patterns.email.test(value)) {
      setError(errorNodes.email, 'Introduce un email valido.');
      return false;
    }
    setError(errorNodes.email, '');
    return true;
  }

  /**
   * Comprueba que la fecha exista y no sea futura.
   * @returns {boolean} resultado de la validacion
   */
  function validateFecha() {
    const value = fields.fecha.value;
    if (!value) {
      setError(errorNodes.fecha, 'Selecciona una fecha.');
      return false;
    }
    const selectedDate = new Date(value);
    const today = new Date();
    selectedDate.setHours(0, 0, 0, 0);
    today.setHours(0, 0, 0, 0);
    if (selectedDate > today) {
      setError(errorNodes.fecha, 'La fecha no puede ser futura.');
      return false;
    }
    setError(errorNodes.fecha, '');
    return true;
  }

  /**
   * Valida el comentario opcional controlando longitud y caracteres.
   * @returns {boolean} resultado de la validacion
   */
  function validateComentario() {
    const value = fields.comentario.value.trim();
    if (!value) {
      setError(errorNodes.comentario, '');
      return true;
    }
    if (value.length > 200) {
      setError(errorNodes.comentario, 'Maximo 200 caracteres.');
      return false;
    }
    if (!patterns.comment.test(value)) {
      setError(
        errorNodes.comentario,
        'Solo se permiten letras, numeros y puntuacion basica.'
      );
      return false;
    }
    setError(errorNodes.comentario, '');
    return true;
  }

  /**
   * Construye el objeto partida listo para guardar.
   * @returns {object} datos del formulario
   */
  function buildMatchData() {
    return {
      blancas: fields.blancas.value.trim(),
      negras: fields.negras.value.trim(),
      colorElegido: getSelectedColor(),
      resultado: fields.resultado.value,
      email: fields.email.value.trim(),
      fecha: fields.fecha.value,
      comentario: fields.comentario.value.trim(),
      registradaEn: new Date().toISOString()
    };
  }

  /**
   * Guarda la partida en localStorage acumulando las anteriores.
   * @param {object} partida - datos a persistir
   * @returns {boolean} true si se guarda correctamente
   */
  function guardarPartida(partida) {
    try {
      const partidas = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
      partidas.push(partida);
      localStorage.setItem(STORAGE_KEY, JSON.stringify(partidas));
      return true;
    } catch (error) {
      console.error('No se pudo guardar la partida', error);
      return false;
    }
  }

  /**
   * Revalida el campo de blancas y la comparacion con negras en cada pulsacion.
   */
  function handleNombreBlancasInput() {
    validateNombreBlancas();
    if (fields.negras.value.trim()) {
      validateNombreNegras();
    }
  }

  // Eventos de validacion inmediata para mejorar la experiencia.
  fields.blancas.addEventListener('input', handleNombreBlancasInput);
  fields.negras.addEventListener('input', validateNombreNegras);
  fields.email.addEventListener('input', validateEmail);
  fields.comentario.addEventListener('input', validateComentario);
  fields.fecha.addEventListener('change', validateFecha);
  fields.resultado.addEventListener('change', validateResultado);
  colorRadios.forEach(function (radio) {
    radio.addEventListener('change', validateColor);
  });

  /**
   * Gestiona el evento submit y coordina la validacion completa.
   * @param {SubmitEvent} event - evento del formulario
   */
  function handleSubmit(event) {
    event.preventDefault();
    showFinalMessage('', false);
    const validations = [
      validateNombreBlancas(),
      validateNombreNegras(),
      validateColor(),
      validateResultado(),
      validateEmail(),
      validateFecha(),
      validateComentario()
    ];
    const isValid = validations.every(Boolean);

    if (!isValid) {
      showFinalMessage('Corrige los errores antes de registrar la partida.', false);
      return;
    }

    const partida = buildMatchData();
    if (!guardarPartida(partida)) {
      showFinalMessage('No se pudo guardar la partida en este navegador.', false);
      return;
    }

    form.reset();
    clearAllErrors();
    showFinalMessage('Partida registrada correctamente.', true);
    fields.blancas.focus();
  }
  form.addEventListener('submit', handleSubmit);
}
