
const toggleButton = document.getElementById('toggle-dark-mode');
toggleButton.addEventListener('click', function () {
    document.body.classList.toggle('dark-mode');
    if (document.body.classList.contains('dark-mode')) {
        toggleButton.innerHTML = '<i class="fas fa-sun me-2"></i> Desactivar Modo Oscuro';
    } else {
        toggleButton.innerHTML = '<i class="fas fa-moon me-2"></i> Activar Modo Oscuro';
    }
});
