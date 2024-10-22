// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}

$(document).ready(function(){
    console.log("Jquery is working");

    $('#search').keyup(function(e){
        let search = $('#search').val();
        $.ajax({
            url:'backend/product-search.php',
            type: 'POST',
            data: {search},
            success: function(response){
                console.log(response)
                let tasks = JSON.parse(response);
                    let template = '';
                    tasks.forEach(task => {
                        template += `<li>
                            ${task.nombre}
                        </li>`
                    });

                    $('#container').html(template);
                    $('#product-result').show();
            }
        })
    })
});
