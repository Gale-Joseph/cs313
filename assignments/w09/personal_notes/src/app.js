/* Preparation: 
    The following was installed before this file was written: 
        a. npm init -y //creates package.json
        b. npm i express 
        c. nodemon //allows server to keep running with changes 
        d. path included for path manipulation later */    

 const path = require('path') //needed for path variables
 const express = require('express')
 const app = express()

//allow express to read ejs files
 app.set('view engine', 'ejs')

 /* CREATE ROUTES: Webpages, strings, json data*/

  /*  Serve Web Pages: 
    1. Not necessary, but helpful: create a public folder for assets
    2. Use __dirname, __filename, and path.join(__dirname,'../public/index.html)
    3. Use the app.use(express.static()) to serve up path
 */

 //static pages: 
//  const indexPath = path.join(__dirname,'../public') //create directory const
//  app.use(express.static(indexPath))

//dynamic pages: 
app.get('',(req,res)=>{
    res.render('index',{ //looks for a views folder with index file
        title: 'My page',
        name: 'Joseph Gale'
    })
})


 /* Serve json data and strings: */
 app.get('',(req, res)=>{
    res.send('Hello express!')
 })

 app.get('/help',(req,res)=>{
     res.send('Help page')
 })

 //start up server and have it listen on port
 app.listen(3001, ()=>{
     console.log('Server is up on port 3001') //optional argument callback function
 })
