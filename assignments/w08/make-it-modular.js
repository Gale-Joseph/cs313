var mod = require('./mymodule.js');

var callback = function(err, data) {
		if (err) {return console.error(err)}
		for (var i = 0; i < data.length; i++) {
			console.log(data[i]);
			}
		}
		
		

mod(process.argv[2], process.argv[3], callback);

/*
   'use strict'
    const filterFn = require('./solution_filter.js')
    const dir = process.argv[2]
    const filterStr = process.argv[3]

    filterFn(dir, filterStr, function (err, list) {
      if (err) {
        return console.error('There was an error:', err)
      }

      list.forEach(function (file) {
        console.log(file)
      })
    })*/

    /*
        'use strict'
    const fs = require('fs')
    const path = require('path')

    module.exports = function (dir, filterStr, callback) {
      fs.readdir(dir, function (err, list) {
        if (err) {
          return callback(err)
        }

        list = list.filter(function (file) {
          return path.extname(file) === '.' + filterStr
        })

        callback(null, list)
      })
    }
*/