/* WHAT IS process.argv?
- An array containing comman line arguments
- Element [0] is node, Element[1] is file path
- The rest of the elements are filled in with commnand line inputs
- OR var process.argv = ['node', 'file.js', ‘x’, ‘y’];
- Iterate through process.argv starting with 2 for process.argv[2]
*/
// console.log(process.argv);

/*WHAT IS array.splice()?
- remove items from an array and put them in a new array
*/
process.argv[2] = 'apple';
process.argv[3] = 'orange';
console.log('------------------------------------')
console.log(process.argv);
console.log('------------------------------------')
console.log(process.argv.splice(2,1,"zulu"));//returns apple, replaces apple with zulu
console.log('------------------------------------')
console.log(process.argv);

/*WHAT IS array.reduce()?
- turns array into one number
- requres a function for first parameter, has optional 2nd parameter
- first parameter-function takes in 2 arguments, then customize what you do with them
-https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/Reduce
- I am deeming this not so important to understand right now
- reduce starts with a value or first index as first parameter and executes your 
    formula between those two parameters. The two parameters joined become the previous
    value and then the current value comes up next for the same treatment. 
*/
