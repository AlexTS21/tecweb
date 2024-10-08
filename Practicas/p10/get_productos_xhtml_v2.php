<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet"
              href= "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
              integrity= "sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
              crossorigin="anonymous" />

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>    
            function show() {
                // se obtiene el id de la fila donde está el botón presinado
                var rowId = event.target.parentNode.parentNode.id;

                // se obtienen los datos de la fila en forma de arreglo
                var data = document.getElementById(rowId).querySelectorAll(".row-data");
                /**
                querySelectorAll() devuelve una lista de elementos (NodeList) que 
                coinciden con el grupo de selectores CSS indicados.
                (ver: https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Selectors)

                En este caso se obtienen todos los datos de la fila con el id encontrado
                y que pertenecen a la clase "row-data".
                */

                var name = data[0].innerHTML;
                var age = data[1].innerHTML;

                alert("Name: " + name + "\nAge: " + age);

                send2form(name, age);
            }
        </script>
    </head>
    <body>
        
        <table class="table">
            <tbody>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope=""col>Edit</th>
                    <th scope="col">Submit</th>
                    
                </tr>

                <tr id="1">
                    <th scope="row">1</th>
                    <td class="row-data">Sara</td>
                    <td class="row-data">23</td>
                    <td><input type="button" value="edit" onclick="edit()"/></td>
                    <td><input type="button" 
                               value="submit" 
                               onclick="show()" /></td>
                </tr>

                <tr id="2">
                    <th scope="row">2</th>
                    <td class="row-data">John</td>
                    <td class="row-data">30</td>
                    <td><input type="button" value="edit" onclick="edit()"/></td>
                    <td><input type="button" 
                               value="submit" 
                               onclick="show()" /></td>
                </tr>

                <tr id="3">
                    <th scope="row">3</th>
                    <td class="row-data">Naman</td>
                    <td class="row-data">20</td>
                    <td><input type="button" value="edit" onclick="edit()"/></td>
                    <td><input type="button" 
                               value="submit" 
                               onclick="show()" /></td>
                </tr>
            </tbody>
        </table>
        <script>
            function send2form(name, age) {     //form) { 
                var urlForm = "http://localhost/tecweb/Practicas/p10/formulario.php";
                var propName = "nombre="+name;
                var propAge = "edad="+age;
                window.open(urlForm+"?"+propName+"&"+propAge);
            }

            function edit(){
                let newName = prompt("Ingresa el nuevo nombre");
                let newAge = prompt("Ingresa la nueva edad");
                // se obtiene el id de la fila donde está el botón presinado
                var rowId = event.target.parentNode.parentNode.id;
                let row =  document.getElementById(rowId)

                // Seleccionar las celdas con clase "row-data" en la fila
                let cells = row.getElementsByClassName('row-data');

               
                
                // Actualizar los valores de las celdas
                cells[0].innerText = newName;  // Actualizar nombre
                cells[1].innerText = newAge;   // Actualizar edad
            }
        </script>
    </body>
</html>