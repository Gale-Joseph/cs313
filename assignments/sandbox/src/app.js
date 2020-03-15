require('dotenv').config();
const path = require('path')
const express = require('express')
const app = express();
var router = express.Router();
const {Pool} = require('pg');
//connection for db
const connectionString = process.env.DATABASE_URL;
const port = process.env.PORT || 2999
const pool = new Pool({connectionString: connectionString});


//set default page to show up when sever starts
const indexPath = path.join(__dirname,'../public')
app.use(express.static(indexPath))

router.get('/search', function(req, res, next) {
    pool.connect(conString, function(err, client, done) {
      if (err) {
        return console.error('error fetching client from pool', err);
      }
      console.log("connected to database");
      client.query('SELECT * FROM users', function(err, result) {
        done();
        if (err) {
          return console.error('error running query', err);
        }
        res.send(result);
      });
    });
  });
console.log("what up")

app.get('/getPerson',(req, res, next)=>{
    var sql = "SELECT * FROM person WHERE id = $1::int";
    var id = req.query.id;
    var params = [id];
    pool.query(sql, params, function(err, result) {
    // If an error occurred...
    if (err) {
        console.log("Error in query: ")
        console.log(err);
    }
    res.json(result);
    // Log this to the console for debugging purposes.
    // console.log("Back from DB with result:");
    // console.log(result.rows);


});   
});
// app.get('/getPerson', getPerson);

app.listen(port, ()=>{
    console.log("Server is running on port " + port)
})



// function search(req,res){
// console.log("something happened")
// }

// function getPerson(req,res){
// console.log("Get person is working");
// var id = req.query.id;
// // return res.send('person found: ' + id);

// getPersonDb(id, function(err, result){
// console.log(result);
// })

// };
// function getPersonDb(id,callback){
//     console.log("get person from db: ", id);
//     var sql = "SELECT fname FROM person WHERE id=$1::int";
//     var params = [id];

//     pool.query(sql,params, function(err,result){
//         if(err){
//             console.log("there was an error with db " + err);
//         }

//         console.log(JSON.stringify(result.rows));
//         callback(null,result.rows);
//     })
// }

