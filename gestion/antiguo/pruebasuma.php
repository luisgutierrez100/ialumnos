<!DOCTYPE html>

<!--http://www.lawebdelprogramador.com-->

<html>

<head>

    <script type="text/javascript">

    /**

     * Funcion que se ejecuta cada vez que se añade una letra en un cuadro de texto

     * Suma los valores de los cuadros de texto

     */

    function sumar()

    {

        var valor1=verificar("valor1");

        var valor2=verificar("valor2");

        var valor3=verificar("valor3");

        var valor4=verificar("valor4");

        // realizamos la suma de los valores y los ponemos en la casilla del

        // formulario que contiene el total

        document.getElementById("total").value=parseFloat(valor1)+parseFloat(valor2)+parseFloat(valor3)+parseFloat(valor4);

    }

 

    </script>

 

    <style>

    input   {border:1px solid #808080;text-align:right;width:100px;}

    #total  {font-weight:bold;}

    div     {width:200px;text-align:right;}

    </style>

</head>

 

<body>

    <h1>Suma de valores</h1>

    <div>Valor 1: <input type="text" id="valor1" onkeyup="sumar();"></div>

    <div>Valor 2: <input type="text" id="valor2" onkeyup="sumar();"></div>

    <div>Valor 3: <input type="text" id="valor3" onkeyup="sumar();"></div>

    <div>Valor 4: <input type="text" id="valor4" onkeyup="sumar();"></div>

    <div>Total: <input type="text" id="total" disabled value="0">

</body>

</html>