// var http = require('http');
// var fs = require('fs');

// /* readFile has twor params: the file and the lamba function
// - The lamba function has 2 params: error and the contents of file
// - The lamba functio is called the callback function
// - read file could have a middle options parameter like 'utf8';
// */
// fs.readFile('./index.html', function (err, fileContents) {
//     if (err) {
//         throw err; 
//     }
//     //if no error is thrown, run this following:       
//     http.createServer(function(request, response) {  //create a server
//         response.writeHeader(200, {"Content-Type": "text/html"});  //write a header
//         response.write(fileContents);  //print file contents
//         response.end(); //end response 
//     }).listen(5000);//http.createServer(function(){}).listen(5000);
// });

var http = require('http');
function onRequest(req,res){
    console.log('A request has been made');
    if(req.url=='/home'){
        res.write("<h1>Welcome to the Home Page</h1>");
        res.end();
    }else if(req.url=='/getData'){
        res.write(JSON.stringify({"name":"Joseph","class":"cs313"}));
        res.end();
    }else{
    res.write("<h1>Error 404</h1>");
    res.write("<p>Page not found</p>");
    res.end();};
}
var server = http.createServer(onRequest);
server.listen(8888);
console.log("The server is now listening on port 8888");


