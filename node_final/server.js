//set up require libraries
const express = require('express')
const path = require('path')
const { Pool, Client } = require('pg')
const {check,validationResult} = require('express-validator');
var request = require('@coolaj86/urequest');
require('dotenv').config();

//set up critical constants/vars
const PORT = process.env.PORT || 4999

//set up connection variables
const connectionString = process.env.DATABASE_URL;
const pool = new Pool({connectionString: connectionString});

//set up express, get/post, listener
const app = express()
  //standard core setup:
  app.use(express.static(path.join(__dirname, 'public')))
  app.use(express.urlencoded({extended:true}));//see https://stackoverflow.com/questions/25471856/express-throws-error-as-body-parser-deprecated-undefined-extended
  app.use(express.json());
  app.set('views', path.join(__dirname, 'views'))
  app.set('view engine', 'ejs')
  app.get('/', (req, res) => res.render('pages/index'))
  app.listen(PORT, () => console.log(`Listening on ${ PORT }`))


  //additional post/get requests
  app.post('/buyStock',buyStock);
  app.get('/getPort',getPort);

//scripts and functions
function getPort(req,res){
  const sql = "SELECT * FROM purchase";
  pool.query(sql,function(err,result){
    if(err){
      console.log("error: "+err);
    }
    // console.log(JSON.stringify(result.rows));
    res.json(result.rows);
  })
  
}

function buyStock(req,res){
  //convert input into variables
  var rawTicker = req.body.ticker;
  var ticker = rawTicker.toLowerCase();
  var price = parseFloat(req.body.price);
  var shares = parseInt(req.body.shares);

  //var ticker = rawTicker.toLowerCase();
  // var price = req.query.price;
  // var shares = req.query.shares;
  
  //create parameter array for placeholders
  const params = [ticker,price,shares];
  //const sql = "SELECT * FROM purchase WHERE ticker=$1::text";
  const sql = "INSERT INTO purchase VALUES(DEFAULT,$1::text,$2::numeric,$3::int)";
  pool.query(sql,params,function(err,result){
    if(err){
      console.log("error: "+err);
    }
    res.render('pages/index.ejs');
    //return to homepage:
    //res.sendFile(path.join(__dirname+'/public/index.html'));
  })
  //res.send("working on stock request")
  }
