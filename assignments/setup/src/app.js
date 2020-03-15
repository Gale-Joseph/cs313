const path = require('path')
const express = require('express')
const app = express();
const port = process.env.PORT || 2900
app.set('view engine', 'ejs')

//set the default page when server turns on
const indexPath = path.join(__dirname,'../public')
app.use(express.static(indexPath))

app.get('/test',(req,res)=>{
console.log("Everything works");
res.send("Hello world");
});

app.listen(port, ()=>{
    console.log("Server is running on port" + port)
});