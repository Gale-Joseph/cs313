/*objective: print a list of files in a directory*/
const fs = require('fs'); //get file system library
const path = require('path')//get the path library

if(process.argv.length<4){
    console.log('Please specify a path and filter parameter');
    return; //break the function execution
}

fs.readdir(process.argv[2],(error, fileList)=>{//shorthand notation for function(error,fileList);
    if(error){
        console.error(error);
        return;//break function execution
    }

    //if no error: 
    const filteredFiles = fileList.filter((file)=>{
        return path.extname(file)==='.' + process.argv[3];
    });

    filteredFiles.forEach((file)=>{
        console.log(file);
    });
});
