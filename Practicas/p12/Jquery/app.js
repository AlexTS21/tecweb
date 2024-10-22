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
                //console.log(response)
                let productos = JSON.parse(response);
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if(Object.keys(productos).length > 0) {
                // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                let template_bar = '';

                productos.forEach(producto => {
                    // SE COMPRUEBA QUE SE OBTIENE UN OBJETO POR ITERACIÓN
                    //console.log(producto);

                    // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                    let descripcion = '';
                    descripcion += '<li>precio: '+producto.precio+'</li>';
                    descripcion += '<li>unidades: '+producto.unidades+'</li>';
                    descripcion += '<li>modelo: '+producto.modelo+'</li>';
                    descripcion += '<li>marca: '+producto.marca+'</li>';
                    descripcion += '<li>detalles: '+producto.detalles+'</li>';
                
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;

                    template_bar += `
                        <li>${producto.nombre}</il>
                    `;
                    });
                    // SE HACE VISIBLE LA BARRA DE ESTADO
                    document.getElementById("product-result").className = "card my-4 d-block";
                    // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                    document.getElementById("container").innerHTML = template_bar;  
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    document.getElementById("products").innerHTML = template;
                }
            }
        })
    })

    $('#product-form').submit(function(e){
        
        
        
        let descripcion =  $('#description').val();

        let obj =  JSON.parse(descripcion);
        obj.nombre =  $('#name').val();

        const producto = JSON.stringify(obj)
        console.log(producto)
        $.post('backend/product-add.php', producto, function(response){
            console.log(response)
        })
        e.preventDefault();
    })
});
