/**
 * Codifica un texto para que no se pueda interpretar como HTML.
 * @param {string} texto
 * @returns {string} el texto codificado.
 */
export function htmlentities(texto) {
  const div = document.createElement("div");
  div.textContent = texto;
  return div.innerHTML;
}