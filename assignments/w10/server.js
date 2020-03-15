const express = require('express')
const path = require('path')
const PORT = process.env.PORT || 4999
const { Pool, Client } = require('pg')
require('dotenv').config();
const connectionString = process.env.DATABASE_URL;
const pool = new Pool({connectionString: connectionString});
var XMLHttpRequest = require("xmlhttprequest").XMLHttpRequest;
var localStorage = require('node-localstorage')
const https = require('https');


const app = express()
  app.use(express.static(path.join(__dirname, 'public')))
  app.set('views', path.join(__dirname, 'views'))
  app.set('view engine', 'ejs')
  app.get('/', (req, res) => res.render('pages/index'))
  app.listen(PORT, () => console.log(`Listening on ${ PORT }`))

  app.get('/getStock',(req, res)=>{
    if(!req.query.ticker){
      res.send({
        error: 'You must provide a search term'
      })
    }
    const Http = new XMLHttpRequest();
    var ticker = req.query.ticker;
    const url = "https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol="
    +ticker+"&apikey=QTC0C7W8VC9B36VW"
    Http.open("GET",url);
    Http.send();
    Http.onreadystatechange=(e)=>{
      console.log(Http.responseText)
      
     
    }  
    const got = require('got');

    // got("https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol="
    // +ticker+"&apikey=TXLZQ0VXP5QUYSXN", { json: true }).then(response => {
    //   console.log(response.body.url);
    //   console.log(response.body.explanation);
    // }).catch(error => {
    //   console.log(error.response.body);
    // });
    var resultText = Http.responseText;
 
    res.send("You made a successful api call. Please check your console.log");
    //.res.json(JSON.string(resultText)["Global Quote"]["01. symbol"]);
})
