document.addEventListener("DOMContentLoaded", () => {

    // Controla el formulario para mostrar cambios segun el tipo
    document.querySelector("#type_select").addEventListener('change', function () {
        // WARNING TODO: Hay que arreglar el hecho de que se haga el DOM con un value no string
        switch (this.value) {
            case "Casa":
                document.getElementById("display_terrain_form").style.display = "none";
                document.getElementById("display_house_form").style.display = "block";
                break;

            case "Terreno":
                document.getElementById("display_terrain_form").style.display = "block";
                document.getElementById("display_house_form").style.display = "none";
                break;

            default:
                document.getElementById("display_terrain_form").style.display = "none";
                document.getElementById("display_house_form").style.display = "none";
                break;
        }

    });

    // Para añadir nuevas locations
    document.querySelector('#location').addEventListener('change', function(){
        let newLocationSection = document.querySelector('#new_location_wrapper');
        if(this.value === 'new'){
            newLocationSection.removeAttribute('hidden');
        }
        else{
            newLocationSection.setAttribute('hidden', '');
        }
    })

    //Botones y texto de la modificacion del terreno
    var terrain_add_button = document.querySelector("#terrain_add_button");
    var terrain_text_add = document.querySelector("#terrain_text_add");
    var terrain_description_list = document.querySelector("#terrain_description_list");
    var terrain_counter = 0;

    terrain_add_button.addEventListener("click", () => {
        if(terrain_text_add.value === ""){ return }
        terrain_counter++;

        let list_element = document.createElement("li");
        list_element.setAttribute("data-id", terrain_counter);
        list_element.className = "d-flex justify-content-start border-bottom p-1";

        let icon = document.createElement("i");
        icon.setAttribute("data-id", terrain_counter);
        icon.className = "bi bi-trash px-2";
        icon.addEventListener("click", function(){
            document.querySelector(`li[data-id="${this.dataset.id}"]`).remove();
        });

        let text = document.createElement("span");
        text.innerHTML = terrain_text_add.value;
        terrain_text_add.value = "";

        list_element.appendChild(icon);
        list_element.appendChild(text);

        terrain_description_list.appendChild(list_element);
    });

    document.querySelector('#submit').addEventListener('click', function(e){
        let formType = document.querySelector("#type_select");
        let inputData = document.querySelector("#features");
        let data = [];

        switch(formType.value){
            case "Casa":
                document.querySelectorAll('div.flex-column-mod:nth-child(2) > div').forEach(function(element){
                    data.push(`${element.firstElementChild.innerHTML} ${element.lastElementChild.value}`);
                });
                break;
            case "Terreno":
                document.querySelectorAll('li.d-flex').forEach(function(element){
                    data.push(element.lastElementChild.innerHTML);
                })
                break;
        }
        data = JSON.stringify(data);
        inputData.value = data;
        console.log(inputData);
    })

});

