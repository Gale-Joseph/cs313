const http = require('http');
const fs = require('fs');

var port = process.argv[2]
var file = process.argv[3];


var server = http.createServer(function (req,res) { 

	console.log('Request Was Made');

	res.writeHead(200, {'Content-Type':'text/plain'});

	var answer = fs.createReadStream(file, {encoding: 'utf-8'});
	
	answer.pipe(res);

}); 

server.listen(port);