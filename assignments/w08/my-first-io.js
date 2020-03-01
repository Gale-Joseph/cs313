const fs = require('fs');//require is built in

//verify that you have a process.argv[2]:
if(process.argv.length < 3) { 
    console.log('Please specify a file to read');
    return;//break function
}

//step 1: create a variable that holds entire file as string
//learnyoucode will set process.argv[2] for validation
const fileContent = fs.readFileSync(process.argv[2]).toString();


//step 2: create an array of strings and return its length-1
// length-1 for learnyounode required file
const lines = fileContent.split('\n').length - 1;

console.log(lines);
