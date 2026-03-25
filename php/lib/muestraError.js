import { ProblemDetailsError } from "./ProblemDetailsError.js"

/**
 * Redirecciona a una página de error específica.
 * @param { ProblemDetailsError | Error | null } error descripción del error.
 */
export function muestraError(error) {
  console.error(error);
  
  if (error instanceof ProblemDetailsError) {
    const type = error.problemDetails.type;
    // Si el tipo es una ruta válida, redireccionamos a ella
    if (type && type !== "about:blank") {
      location.href = type;
    } else {
      location.href = "errors/errorinterno.html";
    }
  } else {
    // Para errores genéricos de red o ejecución
    location.href = "errors/errorinterno.html";
  }
}