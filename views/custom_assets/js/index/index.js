$(document).ready(async () => {
    let properties = await getLatestProperties(10);
    fillLastProperties(properties);

});

async function getLatestProperties(quantity) {
    let response = await fetch(`${location.protocol}//${location.host}/api/properties?limit=${quantity}`)
    response = await response.json();
    return response;
}

async function getPropertyImages(id) {
    let response = await fetch(`${location.protocol}//${location.host}/api/propertyImages?prop_id=${id}`)
    response = await response.json();
    return response;
}

async function getFirstPropertyImage(id){
    const image_set = await getPropertyImages(id);
    console.log(image_set);
    const first_image_path = image_set['images'][0]['img_path'];
    return first_image_path;
}

async function fillLastProperties(properties) {
    let counter = 0;
    for (const property of properties['properties']) {
        const property_image_url = await getFirstPropertyImage(property['prop_id']);
        console.log(property_image_url);
        let carousel_item = $(`
            <div class="col-12 p-0 p-md-2 col-md-4 mt-2 mt-md-0 ">
                <div class="card shadow-sm">
                    <div class="card-img-top card-img-top-250 position-relative">
                        <img src="${property_image_url}" class="img-fluid" alt="image1">
                        <div class="p-2 m-2 position-absolute top-0 end-0 bg-white shadow-sm rounded"
                            style="font-size:.8rem;">
                            ${property['prop_location']}
                        </div>

                        <div class="p-2 m-2 position-absolute top-0 start-0 bg-white shadow-sm rounded"
                            style="font-size:.8rem;">
                            ${property['prop_price']} MXN
                        </div>
                    </div>
                    <div class="card-block pt-2">
                        <div class="card-header position-relative">
                            <div>
                                <h3>${property['prop_name']}</h3>
                            </div>
                            <div>
                                <small class="text-muted" style="font-size:1rem;">${property['prop_address']} </small>
                            </div>
                        </div>
                        <div class="card-text p-3">${property['prop_description']}</div>
                    </div>
                </div>
            </div>
        `);

        if (counter % 3 === 0) {
            let new_container = counter === 0 ?
                $('<div class="row row-equal w-100 carousel-item active m-0 m-md-5"></div>') :
                $('<div class="row row-equal w-100 carousel-item m-0 m-md-5"></div>');
            new_container.append(carousel_item);
            $('[latest_properties]').append(new_container);
        }
        $('div.row-equal:nth-last-child(1)').append(carousel_item);
        counter += 1;
    }

    //Areglando espacios en blanco
    const blank_spaces = 3 - (counter % 3);
    let blank_space_content = undefined;
    console.log(blank_spaces);
    if(blank_spaces === 1)
        blank_space_content = $('<div class="col-md-4"></div>');
    else if(blank_spaces === 2)
        blank_space_content = $('<div class="col-md-8"></div>');

    $('div.row-equal:nth-last-child(1)').append(blank_space_content);
}