$(document).ready(async () => {
    let latest_properties = await getLatestProperties();
    fillLatestProperties(latest_properties);

    let recent_properties = await getRecentProperties(9);
    fillRecentProperties(recent_properties);
});

// Latest three properties
async function getLatestProperties() {
    let response = await fetch(`${location.protocol}//${location.host}/api/properties?limit=3`)
    response = await response.json();
    return response;
}

async function fillLatestProperties(properties) {
    console.log(properties);
    for (const property of properties['properties']) {
        const property_image_url = await getFirstPropertyImage(property['prop_id']);
        let carousel_item = $(`
            <div class="swiper-slide carousel-item-a intro-item bg-image overflow-hidden" 
                style="background-image: url(${property_image_url})">
                <div class="overlay overlay-a"></div>
                <div class="intro-content display-table">
                    <div class="table-cell">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="intro-body">
                                        <p class="intro-title-top">${property['prop_location']}
                                        <br>${property['prop_address']}
                                        </p>
                                        <h1 class="intro-title mb-4 w-50">
                                            ${property['prop_name']}
                                        </h1>
                                        <p class="intro-subtitle intro-price">
                                        <a href="${location.protocol}//${location.host}/detail/${property['prop_id']}"><span class="price-a">${property['prop_price']} MXN</span></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);
        $('[latest_properties]').append(carousel_item);
    }

    new Swiper('.intro-carousel', {
        speed: 600,
        loop: true,
        autoplay: {
          delay: 2000,
          disableOnInteraction: false
        },
        slidesPerView: 'auto',
        pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true
        }
      });
}

// Recent Properties
async function getRecentProperties(quantity) {
    let response = await fetch(`${location.protocol}//${location.host}/api/properties?limit=${quantity}&offset=3`)
    response = await response.json();
    return response;
}

async function getPropertyImages(id) {
    let response = await fetch(`${location.protocol}//${location.host}/api/propertyImages?prop_id=${id}`)
    response = await response.json();
    return response;
}

async function getFirstPropertyImage(id) {
    const image_set = await getPropertyImages(id);
    const first_image_path = image_set['images'][0]['img_path'];
    return first_image_path;
}

async function fillRecentProperties(properties) {
    let counter = 0;
    for (const property of properties['properties']) {
        const property_image_url = await getFirstPropertyImage(property['prop_id']);
        let carousel_item = $(`
            <div class="col-12 p-0 p-md-2 col-md-4 mt-2 mt-md-0">
                <a href="${location.protocol}//${location.host}/detail/${property['prop_id']}" class="text-decoration-none w-100">
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
                            <div class="card-text p-3 text-break overflow-scroll" style="height: 200px;">
                                ${property['prop_description']}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        `);

        if (counter % 3 === 0) {
            let new_container = counter === 0 ?
                $('<div class="row row-equal w-100 carousel-item active m-0 m-md-5"></div>') :
                $('<div class="row row-equal w-100 carousel-item m-0 m-md-5"></div>');
            new_container.append(carousel_item);
            $('[recent_properties]').append(new_container);
        }
        $('div.row-equal:nth-last-child(1)').append(carousel_item);
        counter += 1;
    }

    //Areglando espacios en blanco
    const blank_spaces = 3 - (counter % 3);
    let blank_space_content = undefined;
    if (blank_spaces === 1)
        blank_space_content = $('<div class="col-md-4"></div>');
    else if (blank_spaces === 2)
        blank_space_content = $('<div class="col-md-8"></div>');

    $('div.row-equal:nth-last-child(1)').append(blank_space_content);
}