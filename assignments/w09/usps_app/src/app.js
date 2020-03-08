const path = require('path')
const express = require('express')
const app = express();//access to non-static 
//process.env.PORT will be for heroku
const port = process.env.PORT || 3000


app.set('view engine', 'ejs')

//set routes
const indexPath = path.join(__dirname,'../public')
app.use(express.static(indexPath))

app.get('/math',compute);

//turn on listener

app.listen(port, ()=>{
    console.log("Server is running on port" + port)
})

function compute(req,res){
    var total = 0;
    var weight = Number(req.query.weight);
    var type = req.query.type;
    var zone = Number(req.query.zone);

    if(type=='stamp'){
        switch(weight){
            case 1:
                total = .55;
                break;
            case 2:
                total = .70;
                break;
            case 3:
                total = .85;
                break;
            case 3.5:
                total = 1.00;
                break;
            default:
                total = 1.00;
                break;
        }
        type = "Letters (Stamped)";
    }
    if(type=='meter'){
        switch(weight){
            case 1:
                total = .50;
                break;
            case 2:
                total = .65;
                break;
            case 3:
                total = .80;
                break;
            case 3.5:
                total = .95;
                break;
            default:
                total = .95;
                break;
        }
        type = "Letters (Metered)";
    }
    if(type=='flat'){
        switch(weight){
            case 1:
                total = 1;
                break;
            case 2:
                total = 1.2;
                break;
            case 3:
                total = 1.4;
                break;
            case 3.5:
                total = 1.4;
                break;
            case 4:
                total = 1.6;
                break;
            case 5:
                total = 1.8;
                break;
            case 6:
                total = 2;
                break;
            case 7:
                total = 2.2;
                break;
            case 8:
                total = 2.4;
                break;
            case 9:
                total = 2.6;
                break;
            case 10:
                total = 2.8;
                break;
            case 11:
                total = 3;
                break;
            case 12:
                total = 3.2;
                break;
            case 13:
                total = 3.4;
                break;
            default:
                total = 3.4;
                break;
        }
        type = "Large Envelopes(Flats)";
    }
    if(type=='package'){
        var zoneplace =0;
        if(weight==3.5){
            weight = 3;
        }
        if(zone==2){
            zoneplace = 1;
        }else{
            zoneplace = zone;
        }

        var cost = [
            [3.8,3.8,3.85,3.9,3.95,4,4.05,4.2,4.2],
            [3.8,3.8,3.85,3.9,3.95,4,4.05,4.2,4.2],
            [3.8,3.8,3.85,3.9,3.95,4,4,05,4.2,4.2],
            [3.8,3.8,3.85,3.9,3.95,4,4.05,4.2,4.2],
            [4.6,4.6,4.65,4.7,4.75,4.8,4.9,5,5],
            [4.6,4.6,4.65,4.7,4.75,4.8,4.9,5,5],
            [4.6,4.6,4.65,4.7,4.75,4.8,4.9,5,5],
            [4.6,4.6,4.65,4.7,4.75,4.8,4.9,5.00,5.00],
            [5.3,5.3,5.35,5.4,5.45,5.5,5.65,5.75,5.75],
            [5.3,5.3,5.35,5.4,5.45,5.5,5.65,5.75,5.75],
            [5.3,5.3,5.35,5.4,5.45,5.5,5.65,5.75,5.75],
            [5.3,5.3,5.35,5.4,5.45,5.5,5.65,5.75,5.75],
            [5.9,5.3,5.95,6.05,6.15,6.2,6.4,6.5,6.5]
        ];
        total = cost[weight-1][zoneplace-1];
    }
    const params = {weight: weight, type:type, zone:zone, total:total.toFixed(2)};
    res.render('output.ejs',params);
    
}

