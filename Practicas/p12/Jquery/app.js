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
    let edit = false;
    fetchProducts();
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
                                <td>
                                    <a herf="#" class="product-item">${producto.nombre}<a/>
                                </td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger" >
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
        //Transformamos a Json los datos
        let descripcion =  $('#description').val();
        let obj =  JSON.parse(descripcion);
        obj.nombre =  $('#name').val();
        obj.id = $('#product-id').val();
        const producto = JSON.stringify(obj)

        //Validamos los datos antes de ser enviados
        // Validaciones
        if (!obj.nombre || obj.nombre.length > 100) {
            alert('El nombre es requerido y debe tener 100 caracteres o menos.');
            e.preventDefault();
            return;
        }

        if (!obj.marca) {
            alert('La marca es requerida.');
            e.preventDefault();
            return;
            
        }

        if (!obj.modelo || !/^[a-zA-Z0-9]+$/.test(obj.modelo) || obj.modelo.length > 25) {
            alert('El modelo es requerido, debe ser alfanumérico y tener 25 caracteres o menos.');
            e.preventDefault();
            return;
            
        }

        if (!obj.precio || obj.precio <= 99.99) {
            alert('El precio es requerido y debe ser mayor a 99.99.');
            e.preventDefault();
            return;
        }

        if (obj.detalles && obj.detalles.length > 250) {
            alert('Los detalles deben tener 250 caracteres o menos.');
            e.preventDefault();
            return;
        }

        if (obj.unidades === undefined || obj.unidades < 0) {
            alert('Las unidades son requeridas y deben ser mayor o igual a 0.');
            e.preventDefault();
            return;
        }

        // Si la ruta de la imagen no está definida, usa una por defecto
        if (!obj.imagen) {
            obj.imagen = 'ruta/a/imagen/por/defecto.jpg';
        }


        let url = edit === false ? 'backend/product-add.php' : 'backend/product-edit.php';
        console.log(url)
        //Mandamos los datos al servidor  y escribimos su respuesta
        $.post(url, producto, function(response){
            console.log(response)
            let res = JSON.parse(response);
            let template_bar = ``;
            template_bar += `
                <li>${res.status}</il>
                <li>${res.message}</il>
            `;
            // SE HACE VISIBLE LA BARRA DE ESTADO
            document.getElementById("product-result").className = "card my-4 d-block";
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            document.getElementById("container").innerHTML = template_bar;  
            btn.textContent = "Agregar Producto"
            fetchProducts();
        })
        e.preventDefault();
    })


    $(document).on('click', '.product-delete', function(){
        if( confirm("De verdad deseas eliinar el Producto") ) {
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('productId');
            console.log(id)
            $.getgo('backend/product-delete.php', {id},function(response){
                let res = JSON.parse(response);
                let template_bar = ``;
                template_bar += `
                    <li>${res.status}</il>
                    <li>${res.message}</il>
                `;
                // SE HACE VISIBLE LA BARRA DE ESTADO
                document.getElementById("product-result").className = "card my-4 d-block";
                // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                document.getElementById("container").innerHTML = template_bar;  
                fetchProducts();
            });
        }
    })

    $(document).on('click', '.product-item', function(){
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');
        $.post('backend/product-single.php', {id}, function(response){
            const producto = JSON.parse(response);
            $('#name').val(producto.nombre);
            var descripcion = {};
            descripcion.precio = producto.precio;
            descripcion.unidades= producto.unidades;
            descripcion.modelo=producto.modelo;
            descripcion.marca=producto.marca;
            descripcion.detalles=producto.detalles;
            descripcion.imagen=producto.imagen;
            const datos = JSON.stringify(descripcion); 
            $('#description').val(datos);
            $('#product-id').val(id)
            let btn = document.getElementById("sbm");
            btn.textContent = "Editar producto"
            edit = true;    
        })
    })

    function fetchProducts(){
        $.ajax({
            url: "backend/product-list.php",
            type: 'GET',
            success: function(response){
                
                //console.log(response)
                let productos = JSON.parse(response);
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';
                    

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
                                <td>
                                    <a herf="#" class="product-item">${producto.nombre}<a/>
                                </td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger" >
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;

                    
                    });
                    
                    
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    document.getElementById("products").innerHTML = template;
                }
            }
        })
    }



});
