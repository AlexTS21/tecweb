<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
              integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
              crossorigin="anonymous" />
        <script>
            function show() {
                // se obtiene el id de la fila donde está el botón presionado
                var rowId = event.target.parentNode.parentNode.id;

                // se obtienen los datos de la fila en forma de arreglo
                var data = document.getElementById(rowId).querySelectorAll(".row-data");
                var name = data[0].innerHTML;
                var age = data[1].innerHTML;

                alert("Name: " + name + "\nAge: " + age);

                send2form(name, age);
            }

            function save(rowId) {
                // Obtiene los inputs de la fila
                var row = document.getElementById(rowId);
                var newName = row.querySelector(".name-input").value;
                var newAge = row.querySelector(".age-input").value;

                // Actualiza los valores de la tabla
                row.querySelector(".name-data").innerHTML = newName;
                row.querySelector(".age-data").innerHTML = newAge;

                alert("Datos actualizados para: " + newName + ", Edad: " + newAge);
            }
        </script>
    </head>
    <body>
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Submit</th>
                </tr>
            </thead>
            <tbody>
                <tr id="1">
                    <th scope="row">1</th>
                    <td class="name-data">Sara</td>
                    <td class="age-data">23</td>
                    <td>
                        <input type="text" class="name-input" value="Sara" />
                        <input type="text" class="age-input" value="23" />
                    </td>
                    <td>
                        <input type="button" value="submit" onclick="show()" />
                        <input type="button" value="save" onclick="save('1')" />
                    </td>
                </tr>

                <tr id="2">
                    <th scope="row">2</th>
                    <td class="name-data">John</td>
                    <td class="age-data">30</td>
                    <td>
                        <input type="text" class="name-input" value="John" />
                        <input type="text" class="age-input" value="30" />
                    </td>
                    <td>
                        <input type="button" value="submit" onclick="show()" />
                        <input type="button" value="save" onclick="save('2')" />
                    </td>
                </tr>

                <tr id="3">
                    <th scope="row">3</th>
                    <td class="name-data">Naman</td>
                    <td class="age-data">20</td>
                    <td>
                        <input type="text" class="name-input" value="Naman" />
                        <input type="text" class="age-input" value="20" />
                    </td>
                    <td>
                        <input type="button" value="submit" onclick="show()" />
                        <input type="button" value="save" onclick="save('3')" />
                    </td>
                </tr>
            </tbody>
        </table>

        <script>
            function send2form(name, age) {     
                var urlForm = "http://localhost/tecweb/Practicas/p10/formulario.php";
                var propName = "nombre=" + name;
                var propAge = "edad=" + age;
                window.open(urlForm + "?" + propName + "&" + propAge);
            }
        </script>
    </body>
</html>
