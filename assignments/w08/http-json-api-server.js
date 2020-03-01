const http = require('http');
const url = require('url');


var server = http.createServer(function(req, res) { 

	res.writeHead(200, { 'Content-Type': 'application/json' });

	if (req.method === 'GET') {

		var date      = new Date(url.parse(req.url, true).query.iso),
			endpoint  = url.parse(req.url, true).pathname; 

		if (endpoint === '/api/parsetime') {

		function parseTime(date) {
			return {
				hour   : date.getHours(),
				minute: date.getMinutes(),
				second: date.getSeconds()
			}
		}
		
		res.end(JSON.stringify(parseTime(date)));

		} else if (endpoint === '/api/unixtime') {

		function unixTime(date) {
			return {
				unixtime: date.getTime()
			}
		}

		res.end(JSON.stringify(unixTime(date)));

		} else {

		res.end('Error: Invalid Endpoint');

		}

    };
    
}); 


server.listen(process.argv[2]);