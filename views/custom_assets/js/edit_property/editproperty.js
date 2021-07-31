document.addEventListener("DOMContentLoaded", () => {
    // Trigering event for property type
    const property_type = document.querySelector("#type_select");
    triggerEvent(property_type, 'change');
    
    // Se gestionan todas las features entrantes
    switch (property_type.value) {
        case 'Terreno':
            document.querySelectorAll('.intro-single > div:nth-child(1) > form:nth-child(1) > span').forEach((feature_element) => {
                const input = document.querySelector('#terrain_text_add');
                input.value = feature_element.dataset.content;
                const update_button = document.querySelector('#terrain_add_button');
                update_button.click();
            });
            break;
        default:
            break;
    }
});

/**
 * Esta función permite lanzar los eventos que no pueden ser lanzados con las funciones sobre 
 * un elemento
 * @param {Element} element 
 * @param {String} type 
 */
function triggerEvent(element, type) {
    // IE9+
    if ('createEvent' in document) {
        var e = document.createEvent('HTMLEvents');
        e.initEvent(type, false, true);
        element.dispatchEvent(e);
    }
    // IE8
    else {
        var e = document.createEventObject();
        e.eventType = type;
        element.fireEvent('on' + e.eventType, e);
    }
}