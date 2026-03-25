import { ProblemDetailsError } from "./ProblemDetailsError.js"

/**
 * Redirecciona a una página de error específica basada en el tipo de error.
 * @param {ProblemDetailsError | Error} error
 */
export function muestraError(error) {
  console.error(error);
  if (error instanceof ProblemDetailsError) {
    // Si el error tiene un "type" (URL), redireccionamos a esa página
    if (error.type && error.type !== "about:blank") {
      location.href = error.type;
    } else {
      // Si no hay tipo específico, usamos el error interno genérico
      location.href = "/errors/errorinterno.html";
    }
  } else {
    // Para errores genéricos de JS
    location.href = "/errors/errorinterno.html";
  }
}