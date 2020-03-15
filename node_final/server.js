const express = require('express')
const path = require('path')
const PORT = process.env.PORT || 4999
const { Pool, Client } = require('pg')
require('dotenv').config();
const connectionString = process.env.DATABASE_URL;
const pool = new Pool({connectionString: connectionString});
var request = require('@coolaj86/urequest');

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
   
    var ticker = req.query.ticker;
    var url = 'https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol='
    +ticker+'&apikey=QTC0C7W8VC9B36VW';
   request(url,function(error,response,body){
      stock_json= JSON.parse(body);
      console.log(stock_json);
      res.send(stock_json);
    })
})
