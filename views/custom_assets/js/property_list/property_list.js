let offset = 0;

// LLamada a API para ver cuantas propiedades hay
async function countProperties() {
    let data = fetch('http://localhost:8000/api/countProperties');
    data = await data.json();
    return data['value'];
}

// LLamada a API para recoger nuevas propiedades
async function getLatestProperties() {
    let response = await fetch(`${location.protocol}//${location.host}/api/properties?limit=10&offset=${offset}`);
    response = await response.json();
    offset+=10;
    return response;
}

// Llama a la api de cambio de estado de una propiedad
function toggleHideShow(element) {
    console.log(element.innerHTML);
}

// Modifica el frontend de las propiedades
async function addProperties() {
    let properties = await getLatestProperties();
    if(properties['properties'].length === 0) return;
    for (const property of properties['properties']) {
        let button_text = property['prop_isHidden'] === 0 ? 'Esconder' : 'Mostar';
        let child = `
            <tr>
                <td scope="row">${ property.prop_id }</td>
                <td>${ property.prop_name }</td>
                <td>${property['prop_price']}MXN</td>
                <td>${ property['prop_location']}, ${ property['prop_address'] }</td>
                <td>
                <div class="input-group">
                    <a class="btn btn-secondary shadow" href="${location.protocol}//${location.host}/edit-property/${ property['prop_id'] }">Editar</a>
                    <button class="btn btn-danger shadow" visibility_button data-id="${property['prop_id']}">${button_text}</button>
                </div>
                </td>
            </tr>
        `;
        $('tbody').append(child);

    }

    $('button[visibility_button]').each(function(index, element){
        let boton = $(element);
        boton.click(() => {
            fetch(`${location.protocol}//${location.host}/api/toggleVisibility?id=${boton.data('id')}`)
            .then(data => data.json())
            .then( data => {
                if(data['value'])
                    boton.html('Oculta');
                else
                    boton.html('Esconder');
            })
        });
    });
}

$(document).ready(async () => {
    addProperties();

    $(window).scroll(function() {
        let last_prop = $('.table > tbody:nth-child(2) > tr:last-child');
        const last_prop_offset = last_prop.offset()['top'];
        if ($(window).scrollTop() >= last_prop_offset - $(window).scrollTop()) 
            addProperties();
    });


});