const map = require('through2-map');
const http = require('http');


var uppercase = map(function (chunk) {

		return chunk.toString().toUpperCase();

	});

var server = http.createServer(function(req, res) {

	if (req.method === 'POST') { 

		req.pipe(uppercase).pipe(res);

	};
	

}); 

server.listen(process.argv[2]);