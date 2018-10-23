var express = require('express')
  , app = express()
  , server = require('http').createServer(app).listen(4555)
  , io = require('socket.io').listen(server)
  , bodyParser = require('body-parser');
  app.use(bodyParser.urlencoded({ extended: true }));
  app.use(bodyParser.json());
  var port = process.env.PORT || 10000;
  var router = express.Router();
  var emitir = function(req, res, next) {
  var notificar = req.query.notificacao || '';
  var nomeq = req.query.nome || '';
    if(notificar != '') {
      io.emit('nome', nomeq);
      io.emit('notificacao', notificar);
      next();
    } else {
      next();
    }
  }
  app.use(emitir);
  app.use('192.168.2.2', router);
  app.use('/api', router);
  router.route('/notificar')
    .get(function(req, res){
    //aqui vamos receber a mensagem
    res.json({message: "testando essa rota"})
    req.app.get('views')
    })
  app.listen(port);
  console.log('conectado a porta ' + port);