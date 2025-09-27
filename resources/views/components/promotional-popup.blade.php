<div id="promotional-popup" class="promotional-popup-overlay" style="display: none;">
    <div class="promotional-popup-container">
        <div class="promotional-popup-content">
            <button class="popup-close-btn" onclick="closePromotionalPopup()">
                <i class="fas fa-times"></i>
            </button>
            
            <div class="popup-image-container">
                <img id="popup-image" src="" alt="" class="popup-image">
                <div class="popup-text-overlay">
                    <h2 id="popup-title" class="popup-overlay-title"></h2>
                    <p id="popup-description" class="popup-overlay-description"></p>
                </div>
            </div>
            
            <div class="popup-actions">
                <button class="btn btn-popup-close" onclick="closePromotionalPopup()">
                    Cerrar
                </button>
                <button id="popup-link-btn" class="btn btn-popup-action" style="display: none;" onclick="openPopupLink()">
                    Ver Promoción
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Popup Promocional Styles */
.promotional-popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(5px);
    animation: fadeIn 0.3s ease-out;
}

.promotional-popup-container {
    position: relative;
    max-width: 800px;
    max-height: 90vh;
    margin: 20px;
    animation: popupSlideIn 0.4s ease-out;
}

.promotional-popup-content {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    position: relative;
}

.popup-close-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    width: 40px;
    height: 40px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    transition: all 0.3s ease;
    font-size: 18px;
}

.popup-close-btn:hover {
    background: rgba(0, 0, 0, 0.9);
    transform: scale(1.1);
}

.popup-image-container {
    position: relative;
    width: 100%;
    max-height: 600px;
    overflow: hidden;
}

.popup-image {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
}

.popup-actions {
    padding: 20px;
    display: flex;
    gap: 15px;
    justify-content: center;
    background: #f8f9fa;
}

.btn-popup-close {
    background: #6c757d;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-popup-close:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

.btn-popup-action {
    background: linear-gradient(135deg, #D4AF37, #FFD700);
    color: #1a0b0a;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-popup-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
}

/* Animaciones */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes popupSlideIn {
    from { 
        opacity: 0;
        transform: scale(0.8) translateY(-50px);
    }
    to { 
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

@keyframes popupSlideOut {
    from { 
        opacity: 1;
        transform: scale(1) translateY(0);
    }
    to { 
        opacity: 0;
        transform: scale(0.8) translateY(-50px);
    }
}

.popup-closing .promotional-popup-container {
    animation: popupSlideOut 0.3s ease-in;
}

.popup-closing {
    animation: fadeOut 0.3s ease-in;
}

@keyframes fadeOut {
    from { opacity: 1; }
    to { opacity: 0; }
}

/* Responsive */
@media (max-width: 768px) {
    .promotional-popup-container {
        margin: 10px;
        max-height: 95vh;
    }
    
    .popup-image-container {
        max-height: 400px;
    }
    
    .popup-actions {
        flex-direction: column;
    }
    
    .btn-popup-close,
    .btn-popup-action {
        width: 100%;
    }

    .promotional-popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(5px);
    animation: fadeIn 0.3s ease-out;
}

.promotional-popup-container {
    position: relative;
    max-width: 800px;
    max-height: 90vh;
    margin: 20px;
    animation: popupSlideIn 0.4s ease-out;
}

.promotional-popup-content {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    position: relative;
}

.popup-close-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    width: 40px;
    height: 40px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    transition: all 0.3s ease;
    font-size: 18px;
}

.popup-close-btn:hover {
    background: rgba(0, 0, 0, 0.9);
    transform: scale(1.1);
}

.popup-image-container {
    position: relative;
    width: 100%;
    max-height: 600px;
    overflow: hidden;
}

.popup-image {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
}

.popup-actions {
    padding: 20px;
    display: flex;
    gap: 15px;
    justify-content: center;
    background: #f8f9fa;
}

.btn-popup-close {
    background: #6c757d;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-popup-close:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

.btn-popup-action {
    background: linear-gradient(135deg, var(--color-fondo-terciario), var(--color-fondo-senario));
    color: var(--color-texto-primario);
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-popup-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(254, 198, 1, 0.4);
}

/* Animaciones del popup */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes popupSlideIn {
    from { 
        opacity: 0;
        transform: scale(0.8) translateY(-50px);
    }
    to { 
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

@keyframes popupSlideOut {
    from { 
        opacity: 1;
        transform: scale(1) translateY(0);
    }
    to { 
        opacity: 0;
        transform: scale(0.8) translateY(-50px);
    }
}

.popup-closing .promotional-popup-container {
    animation: popupSlideOut 0.3s ease-in;
}

.popup-closing {
    animation: fadeOut 0.3s ease-in;
}

@keyframes fadeOut {
    from { opacity: 1; }
    to { opacity: 0; }
}

/* Responsive del popup */
@media (max-width: 768px) {
    .promotional-popup-container {
        margin: 10px;
        max-height: 95vh;
    }
    
    .popup-image-container {
        max-height: 400px;
    }
    
    .popup-actions {
        flex-direction: column;
    }
    
    .btn-popup-close,
    .btn-popup-action {
        width: 100%;
    }
}
}
</style>

<script>
// Variables globales del popup
let currentPopupData = null;

// Función para obtener y mostrar popup activo
function checkForActivePopup() {
    fetch('/api/popup/active')
        .then(response => response.json())
        .then(data => {
            if (data.popup) {
                showPromotionalPopup(data.popup);
            }
        })
        .catch(error => {
            console.error('Error al obtener popup:', error);
        });
}

// Función para mostrar el popup
function showPromotionalPopup(popupData) {
    currentPopupData = popupData;
    
    const popupOverlay = document.getElementById('promotional-popup');
    const popupImage = document.getElementById('popup-image');
    const linkButton = document.getElementById('popup-link-btn');
    
    // Configurar imagen
    popupImage.src = popupData.image;
    popupImage.alt = popupData.title;
    
    // Configurar botón de enlace
    if (popupData.link) {
        linkButton.style.display = 'inline-block';
        linkButton.onclick = () => openPopupLink(popupData.link);
    } else {
        linkButton.style.display = 'none';
    }
    
    // Mostrar popup
    popupOverlay.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    
    // Agregar event listener para cerrar con ESC
    document.addEventListener('keydown', handleEscKey);
    
    // Cerrar al hacer clic fuera del popup
    popupOverlay.addEventListener('click', handleOutsideClick);
}

// Función para cerrar el popup
function closePromotionalPopup() {
    const popupOverlay = document.getElementById('promotional-popup');
    
    // Agregar clase para animación de cierre
    popupOverlay.classList.add('popup-closing');
    
    setTimeout(() => {
        popupOverlay.style.display = 'none';
        popupOverlay.classList.remove('popup-closing');
        document.body.style.overflow = 'auto';
        
        // Remover event listeners
        document.removeEventListener('keydown', handleEscKey);
        popupOverlay.removeEventListener('click', handleOutsideClick);
        
        currentPopupData = null;
    }, 300);
}

// Función para abrir enlace del popup
function openPopupLink(url = null) {
    const link = url || (currentPopupData ? currentPopupData.link : null);
    if (link) {
        window.open(link, '_blank');
        closePromotionalPopup();
    }
}

// Manejador para tecla ESC
function handleEscKey(event) {
    if (event.key === 'Escape') {
        closePromotionalPopup();
    }
}

// Manejador para clic fuera del popup
function handleOutsideClick(event) {
    if (event.target === document.getElementById('promotional-popup')) {
        closePromotionalPopup();
    }
}

// Verificar popup al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    // Esperar un poco antes de mostrar el popup para no interferir con la carga
    setTimeout(checkForActivePopup, 2000);
});
</script>