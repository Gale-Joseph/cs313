var path=require('path')
var express=require('express')
var app=express()
var session=require('express-session')
var validator = require('validator')
var chalk = require('chalk')
const sanitizer = require('sanitize')
app.use(session({secret:'cats pajamas'}))
app.use(express.urlencoded({extended:true}))
app.use(express.json());
app.set('views', path.join(__dirname, 'views'))
app.set('view engine', 'ejs')
app.set('port',(process.env.PORT||5003));
app.use(express.static(path.join(__dirname,'public')))

//database setup
const { Pool, Client } = require('pg')
require('dotenv').config();//allows env.DATABASE_URL
const connectionString = process.env.DATABASE_URL;
const pool = new Pool({connectionString: connectionString});

//bcrypt setup
const bcrypt = require('bcrypt')
const saltRounds=10;

  // app.get('/', (req, res) => res.render('pages/index'))
app.listen(app.get('port'), () => console.log('Listening on app',app.get('port')))


//handle login/registration
app.get('/',function(req,res){
  res.render('pages/index.ejs')
})
app.post('/login',handleLogin)
app.get('/logout',handleLogout)
app.get('/toRegister',function(req,res){
res.render('pages/register.ejs')
})
app.post('/register',register)
app.get('/dashboard',handleDash)

//handle stock purchases
app.post('/buyStock',buyStock)
app.post('/sellStock',sellStock)
app.get('/getPort',getPort);
app.get('/portfolio', function(req,res){
  res.render('pages/portfolio.ejs')
})

/*################## FUNCTIONS ######################*/

/*######### LOGIN/REGISTRATION##############*/

//##LOGIN
function handleLogin(req,res){

  //validate username/password    
  const trialUsername = req.body.username
  const trialPw = req.body.password

  //prepare query and connect to db
  const sql = "SELECT firstname,id,password FROM customer WHERE email=$1::text";
  const params = [trialUsername]
  pool.query(sql,params,function(err,result){
      //handle connection errors
      if(err){
          console.log("An error occured: " + err)
          res.render("index",{error:'A connection problem happened'})
      }
      console.log(result.rowCount)
      if(result.rowCount<1){
        res.render("pages/index.ejs",{error:'Username or password invalid'})
      }else{
        //check hashed password against trial password
       var hashedPw = result.rows[0]['password'];
       var isMatching = bcrypt.compareSync(trialPw,hashedPw)
             //redirect if error
      if(!isMatching){
        res.render('pages/index.ejs',{error:'Username or password is wrong'})
        //console.log("redirecting error!!")
    }else{
        //start session
        req.session.customerid=result.rows[0]['id']
        req.session.firstname = result.rows[0]['firstname']
        console.log(result.rows[0])
        console.log("The customer id is: " + req.session.customerid)
        //send to dashboard if passwords match
        res.redirect('/dashboard')
        
    }
      }
  })
}
function handleLogout(req,res){
 req.session.destroy();
 console.log("session destroyed")
 res.redirect('/')
}

function handleDash(req,res){
  res.render('pages/dashboard.ejs',{firstname:req.session.firstname})
  console.log("Dashboard session: " + req.session.firstname + " id: " + req.session.customerid)
}

//###Register new customers
function register(req,res){
  //set variables from post input, include validator to clean input
  const firstname = validator.escape(req.body.firstname)    
  const lastname = validator.escape(req.body.lastname)
  const email = req.body.email.toLowerCase()
  const password1 = req.body.password1
  const password2 =req.body.password2
  const acceptTerms = req.body.terms

  //validate that all fields are fille in
  if(!firstname){
      var firstnameError = '*Please enter a first name'
  }
  if(!lastname){
      var lastnameError = '*Please enter a last name'
  }
  if(!validator.isEmail(email)||!email){
      var emailError = '*Please enter a valid email'
      
  }
  if(!password1||!password2){
      var passwordError = '*Please fill in both password fields'
  }
  if(password1!=password2){
      passwordError = '*Passwords do not match'
  }
  if(acceptTerms!='on'){
      var termsError = '*You must agree to the terms and policy'
  }
  //check if username already exists
  const params = [email]
  const sql = 'SELECT * FROM customer WHERE email=$1::text'
  pool.query(sql,params,function(err,result){    
      if(err){
          console.log("There was an error during username validation: " + err)
      }
      //test whether a row is returned and upate error message
      if(result.rows.length>0){
          console.log(result.rows)
          console.log(chalk.red("Error: " + email + " found...inform user to pick a new email"))
          emailError = '*This account already exists.' 
      }
      //send user back to login page if any of the following errors exist:
      if(firstnameError||lastnameError||emailError||passwordError||termsError){
          res.render('pages/register.ejs',{firstnameError:firstnameError,lastnameError:lastnameError,
          emailError:emailError,passwordError:passwordError,termsError:termsError,
          firstname:firstname,lastname:lastname,email:email})
      }else{//continue to regitration process if no errors
          console.log(chalk.green("Registering user and hashing password..."))
          bcrypt.hash(password2,saltRounds,function(err,hash){
              console.log(firstname,lastname,email,password1,password2,acceptTerms)
              const params = [firstname,lastname,email,hash]
              const sql = "INSERT INTO customer VALUES"+
                  "(DEFAULT,$1::text,$2::text,$3::text, $4::text)";
              pool.query(sql,params,function(err,result){
                  if(err){
                      console.log(err)
                  }
                  req.session.firstname=req.body.firstname;
                  res.redirect('/dashboard')
              })
          })
      }

  })
}

/*######### STOCK PURCHASES ##############*/
    
function getPort(req,res){
  const customerid = req.session.customerid;
  const sql = "SELECT * FROM purchase WHERE customerid=$1::int";
  const params = [customerid]
  pool.query(sql,params,function(err,result){
    if(err){
      console.log("error: "+err);
    }
    // console.log(JSON.stringify(result.rows));
    res.json(result.rows);
  })
  
}

function buyStock(req,res){
  //convert input into variables
  var rawTicker = req.body.ticker
  var ticker = rawTicker.toLowerCase()
  var price = parseFloat(req.body.price)
  var shares = parseInt(req.body.shares)
  var customerid = req.session.customerid

  const params = [customerid,ticker,price,shares];
  console.log(params);
  const sql = "INSERT INTO purchase VALUES(DEFAULT,$1::int,$2::text,$3::numeric,$4::int)";
  pool.query(sql,params,function(err,result){
    if(err){
      console.log("error: "+err);
    }
    res.redirect('/dashboard')
  })

  }

  function sellStock(req,res){
    //convert input into variables
    var rawTicker = req.body.ticker
    var ticker = rawTicker.toLowerCase()
    var price = parseFloat(req.body.price)
    var shares = parseInt(req.body.shares)
    var customerid = req.session.customerid
  
    const params = [customerid,ticker,price,shares];
    console.log(params);
    const sql = "INSERT INTO purchase VALUES(DEFAULT,$1::int,$2::text,$3::numeric,$4::int)";
    pool.query(sql,params,function(err,result){
      if(err){
        console.log("error: "+err);
      }
      res.redirect('/dashboard')
    })
  
    }
