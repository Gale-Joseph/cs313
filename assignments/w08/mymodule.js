var fs = require('fs');
var path = require('path');
var answer = [];

module.exports = function(loc, ext, callback) {
			var ext = "." + ext;
			fs.readdir(loc, function(err, list) {
				if (err) {return callback(err);}
				for (var i = 0; i < list.length; i++) {
					if (path.extname(list[i]) === ext) {
					answer.push(list[i]); }
				}
			callback(null, answer);
			});
        };	
        