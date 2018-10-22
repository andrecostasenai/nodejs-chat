<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat da Fábrica</title>
    <style>
        .balao {
            color:white;
            background-color:#6c5ce7;
            border-top:10px solid #6c5ce7;
            border-left:10px solid transparent;
            border-bottom: 0px;
            border-right: 0px;
            background-clip: padding-box;
            padding: 0 10px 10px 10px;
            width: inherit;
            margin-bottom: 10px;
            border-radius: 0px 50px 50px 0px;
            font-size: medium;
        }

        .btn-success{
            background-color: #6c5ce7!important;
            border: 0px!important;
        }

        body{
            height:100%!important;
        }

        html{
            height:100%;
        }

        .balao-direito{
            background-color: #ecf0f1;
            color:black;
            border-top:10px solid #ecf0f1;
            border-left:unset;
            border-bottom: 0px;
            border-right: 10px solid transparent;
            background-clip: padding-box;
            padding: 0 10px 10px 10px;
            width: inherit;
            margin-bottom: 10px;
            border-radius: 50px 0px 0px 50px;
            text-align: right;
            font-size: medium;
        }
    </style>
    <link rel="stylesheet" 
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body class="container" style="background-color: #2d3436;color:black;">
    <div id="chat" class="col-md-12">
            <div class="col-md-12 mb-5 fixed-bottom" id="msg" style="overflow:visible;">
                
            </div>
        <div id="" class="form-inline">
            <center>
                <form class="col-md-12 mb-2 fixed-bottom" onsubmit="return Enviar();">
                    <input type="text" name="user" required id="user" class="form-control" placeholder="Digite seu nome">
                    <input placeholder="Digite uma mensagem..." class="form-control" style="width: 60%" type="text" name="nome" id="nome" required>
                    <button type="submit" class="btn btn-success pull-right">Enviar</button>
                    <button type="button" id="ver" class="btn btn-success pull-right" onclick="Historico()">Ver histórico</button>
                </form>
            </center>
        </div>
    </div>
    <script>
        function Enviar()
        {
            var request = new XMLHttpRequest();

            // Open a new connection, using the GET request on the URL endpoint
            request.open('GET', 'http://192.168.2.2:10000/api/notificar?nome='+document.getElementById("user").value+'&notificacao='+document.getElementById("nome").value, true);

            request.send();
            document.getElementById("nome").value = null;
            document.getElementById("user").readOnly = true;
            return false;
        }

        function Historico()
        {
            if (document.getElementById("ver").innerText == "Ver histórico")
            {
                document.getElementById("msg").classList.remove("fixed-bottom");
                document.getElementById("ver").innerText = "Desabilitar histórico";
            }
            else
            {
                document.getElementById("msg").className += " fixed-bottom";
                document.getElementById("ver").innerText = "Ver histórico";
            }
        }
    </script>

    <script src="http://192.168.2.2:4555/socket.io/socket.io.js"></script>
    <script>
        var socket = io('http://192.168.2.2:4555', {transports: ['websocket', 'polling', 'flashsocket']});
        let cont = 0;
        
        socket.on('nome', (data) => {
            var today = new Date();
            var label = document.createElement("LABEL");
            label.innerText = data;
            label.id = "lblUser"+(cont+1);
            label.style.color = "white";
            label.style.fontSize = "medium";
            label.className = "col-md-12 text-left";
            document.getElementById("msg").appendChild(label);
        })

        socket.on('notificacao', function (data) {
            cont++;
            var x = document.createElement("INPUT");
            x.id = "inputmsg"+cont;
            x.className = "balao";
            x.readOnly = true;
            x.setAttribute("type", "text");
            x.setAttribute("value", data);

            var today = new Date();
            var dd = today.getDate();

            var mm = today.getMonth()+1; 
            var yyyy = today.getFullYear();
            var hh = today.getHours();
            var min = today.getMinutes();
            var ss = today.getSeconds();

            if (dd<10) 
            {
                dd='0'+dd;
            } 

            if (mm<10) 
            {
                mm+='0'+mm;
            } 

            if (ss<10)
            {
                ss='0'+ss;
            }

            if (hh<10)
            {
                hh='0'+hh;
            }

            if (min<10)
            {
                min='0'+min;
            }


            document.getElementById("msg").appendChild(x);
            var a = document.createElement("BR");
            document.getElementById("msg").appendChild(a);


            var span = document.createElement("p");
            span.innerText = dd + "/" + mm + "/" + yyyy + " " + hh + ":" + min + ":" + ss;
            span.id = "date"+cont;
            span.style.color = "white";
            span.className = "col-md-12 text-left";

            document.getElementById("msg").appendChild(span);

            if (document.getElementById("lblUser"+cont).innerText == document.getElementById("user").value)
            {
                document.getElementById("inputmsg"+cont).className = "balao-direito";
                document.getElementById("lblUser"+cont).className = "col-md-12 text-right";
                document.getElementById("date"+cont).className = "col-md-12 text-right";
            }
        });
    </script>
</body>
</html>