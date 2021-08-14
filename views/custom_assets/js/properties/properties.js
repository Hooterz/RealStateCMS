let offset = 0;
const limit = 12;
let isPaginationEnd = false;

function debug(complemento=1) {
    console.log(`limit: ${limit}`);
    console.log(`offset: ${offset}`);
    console.log(`page end: ${isPaginationEnd}`);

}

function setPageNumber(addition=0) {
    const calculated_page = (offset / limit) + addition;
    $('li.page-item:nth-child(2) > span:nth-child(1)').html(calculated_page);
}

async function getPropertiesByCategory(limit, offset, custom_cat=undefined) {
    const cat_id = $(".custom-select").val();
    let server_response;
    if(custom_cat !== undefined)
        server_response = await fetch(`${location.protocol}//${location.host}/api/propertiesByCategory?cat_id=${custom_cat}&limit=${limit}&offset=${offset}`);
    else 
        server_response = await fetch(`${location.protocol}//${location.host}/api/propertiesByCategory?cat_id=${cat_id}&limit=${limit}&offset=${offset}`);
    server_response = await server_response.json();
    // console.log(server_response);
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

function fixPaginationButtonDesign() {
    const nextButton = $('li.page-item:nth-child(3)');
    const prevButton = $('li.page-item:nth-child(1)');
    const pageNumber = $('li.page-item:nth-child(2) > span:nth-child(1)');

    if(isPaginationEnd) nextButton.hide();
    else nextButton.show();

    if(pageNumber.html() === '0') prevButton.hide(); 
    else prevButton.show();
}

async function nextProperties (){
    if(isPaginationEnd) return;

    let properties = await getPropertiesByCategory(limit, offset);
    if(properties['properties'].length === 0) return;

    let next_properties = await getPropertiesByCategory(limit, offset + limit);
    if(next_properties['properties'].length === 0) isPaginationEnd = true;

    await fillProperties(properties);
    setPageNumber();
    offset += limit;
    debug();
    fixPaginationButtonDesign();
}

async function prevProperties () {
    if (offset <= 0) return;

    if(isPaginationEnd){
      offset = offset - limit < 0 ? 0 : offset - (2 * limit);
      isPaginationEnd = false;
    } 
    else offset = offset - limit < 0 ? 0 : offset - limit;

    let properties = await getPropertiesByCategory(limit, offset);
    await fillProperties(properties);
    setPageNumber();
    if(offset === 0) offset = limit;
    debug();
    fixPaginationButtonDesign();
}

async function fillProperties(properties){
    let container = $("div.row:nth-child(2)");
    container.html('');
    for (const property of properties['properties']) {
        const property_image_url = await getFirstPropertyImage(property['prop_id']);
        let element = $(`
        <div class="col-md-3 my-3">
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

$(document).ready(async () => {
  const initInfo = async () => {
      offset = 0;
      isPaginationEnd = false;
      nextProperties();
  }
  
  $(".custom-select").on('change', initInfo);
  $('li.page-item:nth-child(1)').on('click', async () => prevProperties());
  $('li.page-item:nth-child(3)').on('click', async () => nextProperties());
  
  initInfo();
});