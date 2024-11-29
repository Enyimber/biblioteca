// Conexión al servidor WebSocket
const socket = new WebSocket('ws://localhost:8081/notifications');

socket.onopen = () => {
    console.log('Conexión establecida con el servidor WebSocket.');
};

socket.onmessage = (event) => {
    const data = JSON.parse(event.data);
    console.log(data);
    if (data.type === 'chat') {
        addNotification(data.message); // Manejar la nueva notificación
    }
};


socket.onerror = (error) => {
    console.error('Error en WebSocket:', error);
};

socket.onclose = () => {
    console.log('Conexión con WebSocket cerrada.');
};

// Función para añadir notificaciones dinámicas
function addNotification(message) {


    

    const notificationList = document.getElementById('notification-list');
    const notificationCounter = document.getElementById('notification-counter');

    // Crear una nueva notificación
    const notificationItem = document.createElement('a');
    notificationItem.className = 'dropdown-item d-flex align-items-center';
    notificationItem.href = '<?= base_url("prestamos/verSolicitudes"); ?>'; // Cambia si tienes un enlace más específico
    notificationItem.innerHTML = `
        <div class="mr-3">
            <div class="icon-circle bg-warning">
                <i class="fas fa-exclamation-triangle text-white"></i>
            </div>
        </div>
        <div>
            <span class="font-weight-bold">${message}</span>
        </div>
    `;

    // Añadir la notificación al inicio de la lista
    notificationList.insertBefore(notificationItem, notificationList.firstChild);

    // Actualizar el contador
    const currentCount = parseInt(notificationCounter.textContent) || 0;
    notificationCounter.textContent = currentCount + 1;
    notificationCounter.style.display = 'inline-block';
}