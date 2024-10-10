document.addEventListener('DOMContentLoaded', function() {
    var scrollTopLink = document.getElementById('scrollTopLink');
    
    scrollTopLink.addEventListener('click', function(e) {
        e.preventDefault(); // Previene el comportamiento predeterminado del enlace
        
        var targetElement = document.getElementById('page-top');
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
    });
});