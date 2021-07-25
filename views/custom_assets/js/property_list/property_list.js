let offset = 0;
let isFilterOn = false;
let search_input_name = undefined;
let search_input_id = undefined;
let search_input_date = undefined;
let spinner = undefined;
let total_properties = undefined;
let processing_data = false;

// Procesa que una valor esté vacío
function isEmpty(value) {
    return ["", 0, null].includes(value);
}

// LLamada a API para ver cuantas propiedades hay
async function countProperties() {
    let data = await fetch(`${location.protocol}//${location.host}/api/countProperties`);
    data = await data.json();
    return data['value'];
}

// LLamada a API para recoger nuevas propiedades
async function getLatestProperties() {
    let response = await fetch(`${location.protocol}//${location.host}/api/properties?limit=10&offset=${offset}&all=1`);
    response = await response.json();
    offset += 10;
    return response;
}

// LLamada a API para recoger nuevas propiedades con un filtro sobre estas
async function getLatestPropertiesFiltered() {
    let url_params = '';
    let params = {
        filter_id: search_input_id.val(),
        filter_name: search_input_name.val(),
        filter_date: search_input_date.val()
    };

    // Esta estructura me deja itara sobre pares key-value en un Objeto JS
    for(const [param_name, param_value] of Object.entries(params)){
        if(isEmpty(param_value)) continue;
        if(url_params.length !== 0) url_params += '&';
        url_params += `${param_name}=${param_value}`;
    }
    const url = `${location.protocol}//${location.host}/api/propertiesFiltered?${url_params}`;
    let response = await fetch(url);
    response = await response.json();
    return response;
}

// Modifica el frontend de las propiedades
async function addProperties(properties) {
    if(properties['properties'].length === 0 )return;

    for (const property of properties['properties']) {
        let button_text = property['prop_isHidden'] === 0 ? 'Esconder' : 'Mostar';
        let child = `
            <tr>
                <td scope="row">${ property.prop_id }</td>
                <td scope="row">${ property.prop_category }</td>
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

    // Genera el evento del boton de esconder
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

// Desde aquí se inician todas la lógica del frontend
$(document).ready(async () => {
    // Iniciando componentes de búsqueda
    search_input_id = $('#prop_id');
    search_input_name = $('#prop_name');
    search_input_date = $('#prop_pub_date');
    spinner = $('.text-center');
    spinner.hide();
    total_properties = await countProperties();


    // Lógica del scroll infinito o hasta donde existan propiedades
    $(window).scroll(async function() {
        if(offset >= total_properties || processing_data || isFilterOn) return;
        spinner.show();
        processing_data = true;

        const last_prop = $('.table > tbody:nth-child(2) > tr:last-child');
        const last_prop_offset = last_prop.offset()['top'];
        const scroll_position = $(window).scrollTop() >= last_prop_offset - $(window).scrollTop();
        if(scroll_position) {
            let properties = await getLatestProperties();
            addProperties(properties);
        }
        spinner.hide()
        processing_data = false;
    });

    // Lógica de Filtro, comprobación de estado de los filtros
    search_input_id.add(search_input_name).add(search_input_date).each((index, element) => {
        let current_element = $(element);
        current_element.change(async () => {
            // Limpia las propiedades
            $('tbody').html('');
            const prev_isFilterON = isFilterOn;
            const filter_id = !isEmpty(search_input_id.val());
            const filter_name = !isEmpty(search_input_name.val());
            const filter_date = !isEmpty(search_input_date.val());
            isFilterOn = filter_id || filter_name || filter_date;

            if(prev_isFilterON !== isFilterOn && !isFilterOn){
                offset = 0;
                let properties = await getLatestProperties();
                addProperties(properties);
            }
            else{
                offset = 0;
                let properties = await getLatestPropertiesFiltered();
                addProperties(properties);
            }
        });
    });

    // Iniciando estado base de la vista
    let init_properties = await getLatestProperties();
    addProperties(init_properties);
});