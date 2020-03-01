var args = process.argv;
var int = 0;

for (var i = 2; i < args.length; i++) {

	int += Number(args[i]);

};

console.log(int);

/*official results: 

    'use strict'

    let result = 0

    for (let i = 2; i < process.argv.length; i++) {
      result += Number(process.argv[i])
    }

    console.log(result)*/