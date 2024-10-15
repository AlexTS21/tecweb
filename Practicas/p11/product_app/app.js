// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarID(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    var id = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            
            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if(Object.keys(productos).length > 0) {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let descripcion = '';
                    descripcion += '<li>precio: '+productos.precio+'</li>';
                    descripcion += '<li>unidades: '+productos.unidades+'</li>';
                    descripcion += '<li>modelo: '+productos.modelo+'</li>';
                    descripcion += '<li>marca: '+productos.marca+'</li>';
                    descripcion += '<li>detalles: '+productos.detalles+'</li>';
                
                // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                    template += `
                        <tr>
                            <td>${productos.id}</td>
                            <td>${productos.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
        }
    };
    client.send("id="+id);
}

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    // Obtener los valores del formulario
    let nombre = document.getElementById('name').value.trim();
    let description = document.getElementById('description').value.trim();
    
    // Parsear el JSON de la descripción
    let productData;
    try {
        productData = JSON.parse(description);
    } catch (error) {
        alert("Error en el formato del JSON. Por favor verifica.");
        return;
    }

    // Validaciones del JSON
    if (!nombre || nombre.length > 100) {
        alert("El nombre del producto es requerido y debe tener 100 caracteres o menos.");
        return;
    }

    if (!productData.marca || productData.marca === "") {
        alert("La marca es requerida y debe seleccionarse de la lista.");
        return;
    }

    if (!productData.modelo || !/^[a-zA-Z0-9]+$/.test(productData.modelo) || productData.modelo.length > 25) {
        alert("El modelo es requerido, debe ser alfanumérico y tener 25 caracteres o menos.");
        return;
    }

    if (!productData.precio || productData.precio <= 99.99) {
        alert("El precio es requerido y debe ser mayor a 99.99.");
        return;
    }

    if (productData.detalles && productData.detalles.length > 250) {
        alert("Los detalles deben tener 250 caracteres o menos.");
        return;
    }

    if (!productData.unidades || productData.unidades < 0) {
        alert("Las unidades son requeridas y deben ser mayores o iguales a 0.");
        return;
    }

    if (!productData.imagen) {
        productData.imagen = './imagenes/default.png'; // Ruta de imagen por defecto
    }

    // Si todo es válido, enviar los datos al servidor
    var client = getXMLHttpRequest();
    client.open('POST', './backend/add_product.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    // Preparar los datos a enviar
    let data = `nombre=${encodeURIComponent(nombre)}&marca=${encodeURIComponent(productData.marca)}&modelo=${encodeURIComponent(productData.modelo)}&precio=${encodeURIComponent(productData.precio)}&detalles=${encodeURIComponent(productData.detalles || '')}&unidades=${encodeURIComponent(productData.unidades)}&imagen=${encodeURIComponent(productData.imagen)}`;
    
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            console.log('Producto agregado:', client.responseText);
            alert("Producto agregado exitosamente.");
            // Aquí podrías refrescar la lista de productos o limpiar el formulario
        }
    };

    client.send(data);
}
// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}

//Para buscar un producto
function buscarProducto(e) {
    e.preventDefault();

    // SE OBTIENE EL TEXTO A BUSCAR
    var search = document.getElementById('search').value;
    
    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    

            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if(productos.length > 0) {
                // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                productos.forEach(producto => {
                    let descripcion = `
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                    `;

                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                });

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            } else {
                document.getElementById("productos").innerHTML = '<tr><td colspan="3">No se encontraron productos.</td></tr>';
            }
        }
    };
    client.send("search=" + search);
}

