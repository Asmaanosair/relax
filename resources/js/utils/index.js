/**
 * Active link
 *
 * @returns void
 */
export function activeLink() {
  const id = window.page.identifier
  const link = document.querySelector(`#${id}--l`)

  if (link) {
    link.classList.add('active')
  }
}
