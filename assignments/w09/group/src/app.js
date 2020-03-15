const path = require('path')
const express = require('express')
const app = express();
const port = process.env.PORT || 3000

app.set('view engine', 'ejs')

//set routes
const indexPath = path.join(__dirname,'../public')
app.use(express.static(indexPath))

// app.get('/math',(req,res)=>{
//     //res.render('output', {qs: req.query});//assign get request a var name 'qs'

// })

app.get('/math',compute);

app.get('/math_service',compute_json)


//turn on listener

app.listen(port, ()=>{
    console.log("Server is running on port" + port)
})

function compute_json(req,res){
    const operation = req.query.operation;
    const operand1 = Number(req.query.operand1);
    const operand2 = Number(req.query.operand2);

    let result = 0;
    if(operation=='plus'){
        result = operand1+operand2;
    }else if(operation == '-'){
        result = operand1-operand2
    }else if(operation =='x'){
        result = operand1 * operand2;
    }else{
        result = operand1 / operand2;
    }
    const params = {operation: operation, operand1:operand1, operand2:operand2, result:result};
    res.json(params)


}

function compute(req,res){
    const operation = req.query.operation;
    const operand1 = Number(req.query.operand1);
    const operand2 = Number(req.query.operand2);

    let result = 0;
    if(operation=='+'){
        result = operand1+operand2;
    }else if(operation == '-'){
        result = operand1-operand2
    }else if(operation =='x'){
        result = operand1 * operand2;
    }else{
        result = operand1 / operand2;
    }
    const params = {operation: operation, operand1:operand1, operand2:operand2, result:result};
    res.render('output.ejs',params);
    
}

