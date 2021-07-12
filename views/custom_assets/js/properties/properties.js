let total_offset = 0;
const general_limit = 4;
let isPaginationEnd = false;

$(document).ready(async () => {
    const initInfo = async () => {
        let temp_properties = await getPropertiesByCategory(general_limit, 0);
        await fillProperties(temp_properties);
        total_offset = general_limit;
        isPaginationEnd = false;
        setPageNumber();
    }
    
    $(".custom-select").on('change', initInfo);
    $('li.page-item:nth-child(1)').on('click', prevProperties);
    $('li.page-item:nth-child(3)').on('click', nextProperties);
    
    initInfo();
});

 

function debug() {
    console.log(`total offset: ${total_offset}`);
    console.log(`limit: ${general_limit}`);
}

function setPageNumber(addition=0) {
    const calculated_page = (total_offset / general_limit) + addition;
    $('li.page-item:nth-child(2) > span:nth-child(1)').html(calculated_page);
}

function getPageNumber() {
    let value = $('li.page-item:nth-child(2) > span:nth-child(1)').html();
    return parseInt(value);
}

async function getPropertiesByCategory(limit, offset, custom_cat=undefined) {
    const cat_id = $(".custom-select").val();
    let server_response;
    if(custom_cat !== undefined)
        server_response = await fetch(`${location.protocol}//${location.host}/api/propertiesByCategory?cat_id=${custom_cat}&limit=${limit}&offset=${offset}`);
    else 
        server_response = await fetch(`${location.protocol}//${location.host}/api/propertiesByCategory?cat_id=${cat_id}&limit=${limit}&offset=${offset}`);
    server_response = await server_response.json();
    return server_response;
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

async function nextProperties (){
    if(total_offset === 0) total_offset = general_limit;
    let properties = await getPropertiesByCategory(general_limit, total_offset);
    const success = await fillProperties(properties);
    if(success){
        total_offset += general_limit;
        setPageNumber();
    }
}

async function prevProperties () {
    if(isPaginationEnd){
        let calculated_offset = 2 * general_limit
        total_offset -= calculated_offset;
        isPaginationEnd = false;
    }
    else {
        let calculated_offset = total_offset - general_limit
        total_offset = calculated_offset < 0 ? 0 : calculated_offset;
    }
    let properties = await getPropertiesByCategory(general_limit, total_offset);
    const success = await fillProperties(properties);
    setPageNumber(1);
}

async function fillProperties(properties){
    if(isPaginationEnd) return false;
    const next_properties = await getPropertiesByCategory(general_limit, total_offset + general_limit);
    if(next_properties['properties'].length === 0) isPaginationEnd = true;
    let container = $("div.row:nth-child(2)");
    container.html('');
    for (const property of properties['properties']) {
        const property_image_url = await getFirstPropertyImage(property['prop_id']);
        let element = $(`<div class="col-md-3 my-3">
        <div class="card-box-a rounded card-shadow bg-img" style="background: url('${property_image_url}');">
          <div class="img-box-a fill">
          </div>
          <div class="card-overlay">
            <div class="card-overlay-a-content">
              <div class="card-header-a">
                <h2 class="card-title-a">
                  <a href="${location.protocol}//${location.host}/detail/${property['prop_id']}">
                    ${property['prop_name']}
                  </a>
                </h2>
              </div>
              <div class="card-body-a">
                <div class="price-box d-flex">
                  <span class="price-a">${property['prop_price']} MXN</span>
                </div>
                <a href="${location.protocol}//${location.host}/detail/${property['prop_id']}" class="link-a">Click here to view
                  <span class="bi bi-chevron-right"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      `);
      container.append(element);
    }
    return true;
}