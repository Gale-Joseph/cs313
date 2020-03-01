const http = require('http');
const concatStream = require('concat-stream');

http.get(process.argv[2], function(response) {

	response.setEncoding('utf-8')
	response.on('error', function(err) {return console.error(err);} )
	

var concatBuffer = concatStream(function(buffer) {

	console.log(buffer.length);
	console.log(buffer);
});

	response.pipe(concatBuffer)

});

/*

    'use strict'
    const http = require('http')
    const bl = require('bl')

    http.get(process.argv[2], function (response) {
      response.pipe(bl(function (err, data) {
        if (err) {
          return console.error(err)
        }
        data = data.toString()
        console.log(data.length)
        console.log(data)
      }))
    })*/