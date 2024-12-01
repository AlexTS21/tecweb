// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

$(document).ready(function(){ //El contenido de la función se ejecutará cuando la página esté cargada,
    //la idea de declarar muchas funciones aqui es porque con JQUERY se estan creando event listeners
    //que se activan en el momento en que el usuario interactua con la pagina, algunos cuando
    //se hace click en un boton, otros cuando se suelta una tecla, etc.
    let edit = false;

    let JsonString = JSON.stringify(baseJSON,null,2);
    $('#description').val(JsonString);
    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.ajax({
            url: './backend/list',
            type: 'GET',
            success: function(response) {
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const productos = JSON.parse(response);
            
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';

                    productos.forEach(producto => {
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
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger"">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#products').html(template);
                }
            }
        });
    }

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/search',
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if(Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
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
                                        <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
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
                            $('#product-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                            $('#products').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
            listarProductos();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();

        // SE Declara el JSON que contiene los datos del formulario
        let finalJSON = {
            "id": $('#productId').val(),
            "nombre": $('#name').val(),
            "precio": $('#precio').val(),
            "unidades": $('#unidades').val(),
            "modelo": $('#modelo').val(),
            "marca": $('#marca').val(),
            "detalles": $('#detalles').val(),
            "imagen": $('#imagen').val()
        };

        if(finalJSON.unidades == ""){
            $('#unidades').val(0.0);
            finalJSON.unidades = 0.0;
        }
    
        /**
         * AQUÍ DEBES AGREGAR LAS VALIDACIONES DE LOS DATOS EN EL JSON
         * --> EN CASO DE NO HABER ERRORES, SE ENVIAR EL PRODUCTO A AGREGAR
         **/
        let noValido = false;
        if(nombre(finalJSON.nombre, edit)){ //Se valida el nombre, si es incorrecto la funcion de nombre regresa true, 
            //por lo que se muestra un mensaje de error y se sale del proceso de envio de datos, se cancela el submit
            $('#name').addClass('is-invalid');
            noValido = true;
        }

        if(precio(finalJSON.precio)){ 
            $('#precio').addClass('is-invalid');
            noValido = true;
        }

        if(unidades(finalJSON.unidades)){
            $('#unidades').addClass('is-invalid');
            noValido = true;
        }

        if(modelo(finalJSON.modelo)){
            $('#modelo').addClass('is-invalid');
            noValido = true;
        }

        if(marca(finalJSON.marca)){
            $('#marca').addClass('is-invalid');
            noValido = true;
        }

        if(detalles(finalJSON.detalles)){
            $('#detalles').addClass('is-invalid');
            noValido = true;
        }

        if(noValido){ //Si noValido es true, se cancela el submit
            return;
        }

        if(finalJSON.imagen == ""){ //Para el campo de la imagen, no hay una validacion como tal, pero en dado caso de que no se haya
            //ingresado una ruta a una imagen, se asigna una imagen por defecto
            finalJSON.imagen = "img/default.png";
        }


        

        const url = edit === false ? './backend/add' : './backend/edit';
        
        $.post(url, finalJSON, (response) => {
            //console.log(response);
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let respuesta = JSON.parse(response);
            // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
            // SE REINICIA EL FORMULARIO
            $('#name').val('');
            $('#precio').val('');
            $('#unidades').val('');
            $('#modelo').val('');
            $('#marca').val('');
            $('#detalles').val('');
            $('#imagen').val('');
            $('#productId').val('');


            // SE HACE VISIBLE LA BARRA DE ESTADO
            $('#product-result').show();
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            $('#container').html(template_bar);
            // SE LISTAN TODOS LOS PRODUCTOS
            listarProductos();
            // SE REGRESA LA BANDERA DE EDICIÓN A false
            edit = false;
        });
    });

    $(document).on('click', '.product-delete', (e) => {
        if(confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('productId');
            $.post('./backend/delete', {id}, (response) => {
                $('#product-result').hide();
                listarProductos();

                let respuesta = JSON.parse(response);
                console.log(respuesta.message);
            });
        }
    });

    $(document).on('click', '.product-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('./backend/single', {id}, (response) => {
            // SE CONVIERTE A OBJETO EL JSON OBTENIDO
            let product = JSON.parse(response);
            // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
            $('#name').val(product.nombre);
            // EL ID SE INSERTA EN UN CAMPO OCULTO PARA USARLO DESPUÉS PARA LA ACTUALIZACIÓN
            $('#productId').val(product.id);
            
            //Se rellena el formulario con los datos del producto que se quiere editar
            $('#precio').val(product.precio);
            $('#unidades').val(product.unidades);
            $('#modelo').val(product.modelo);
            $('#marca').val(product.marca);
            $('#detalles').val(product.detalles);
            $('#imagen').val(product.imagen);
            
            // SE PONE LA BANDERA DE EDICIÓN EN true
            edit = true;
        });
        e.preventDefault();
    });    


    //Se agregan ahora los event listeners para los campos del formulario, se realizan las validaciones
    //correspondientes y se muestra un mensaje de error si es necesario.
    $('#name').on('blur', function() { //Se agrega un event listener para el campo nombre, cada vez que se pierde el foco, o sea que
        //se da click en otro lado cuando antes se le habia dado click a este campo, se ejecuta la función
        let nombreInput = $(this).val();

        nombre(nombreInput, edit);


        
        
    });

    $('#marca').on('blur', function() {
        let marcaInput = $(this).val();
        if (marca(marcaInput)) {
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    });

    $('#modelo').on('blur', function() {
        let modeloInput = $(this).val();
        if (modelo(modeloInput)) {
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    });

    $('#precio').on('blur', function() {
        let precioInput = $(this).val();
        if (precio(precioInput)) {
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    });

    $('#detalles').on('blur', function() {
        let detallesInput = $(this).val();
        if (detalles(detallesInput)) {
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    });

    $('#unidades').on('blur', function() {
        let unidadesInput = $(this).val();
        if (unidades(unidadesInput)) {
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    });

});

function nombre(nom,edit){
    let noValido = false;
    let errorLongitud = false;
    if(nom.length > 100 || nom.length==0){

        console.log("Error en la longitud nombre");
        $('#ErrorNombre').text("Nombre no valido, debe tener entre 1 y 100 caracteres");
        noValido = true;
        errorLongitud = true;
    }

    let producto = {
        "nombre":$('#name').val()
    };
    if(edit){
        if(noValido){
            $('#name').addClass('is-invalid');
            $('#name').removeClass('is-valid');
        }else{
            $('#name').removeClass('is-invalid');
            $('#name').addClass('is-valid');
        }
        return noValido;
    }
    $.post('./backend/singleSearch', producto, (response) => {
        let respuesta = JSON.parse(response);

        if(respuesta.status == "error" && edit == false){
            console.log("Error: Nombre del producto ya existe");

                $('#ErrorNombre').text("Nombre del producto ya existe");
            
            noValido = true;
        }

        if(noValido){
            $('#name').addClass('is-invalid');
            $('#name').removeClass('is-valid');
        }else{
            $('#name').removeClass('is-invalid');
            $('#name').addClass('is-valid');
        }
    })

    return noValido;
}

function marca(mar){
    let marcas = {
        "sony":1,
        "universal":2,
        "unknow":3,
        "atlantic":4,
    };
    if(marcas[mar] == undefined){
        console.log("Error en marca");
        return true;
    }else{
        return false;
    }
}

function modelo(model){
    let regex = /^[a-zA-Z0-9]{1,25}$/; // Expresión regular
    if(model.length > 25 || regex.test(model) == false){
        console.log("Error en modelo");
        return true;
    }else{
        return false;
    }
}

function precio(precio){
    if(Number(precio) < 99.99){
        console.log("Error en precio");
        return true;
    }else{
        return false;
    }
}

function detalles(detalles){
    if(detalles!= ""){
        if(detalles.length > 255){
            console.log("Error en detalles");
            return true;
        }
    }
    return false;
}

function unidades(unidades){
    if(Number(unidades) < 0){
        console.log("Error en unidades");
        return true;
    }else{
        return false;
    }
}