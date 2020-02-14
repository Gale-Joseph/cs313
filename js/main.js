
/*########################################################*/
/*ajax jquery commands*/
jQuery(document).ready(function(){
    $('#buyForm').submit(function(e){
        e.preventDefault();
        var inputs = $(this).serialize();
        $.post("insert.php",inputs,function(){
            $('.content').load('refresh.php');
        })
    })
})

jQuery(document).ready(function(){
    $('#sellForm').submit(function(e){
        e.preventDefault();
        var inputs = $(this).serialize();
        $.post("sell.php",inputs,function(){
            $('.content').load('refresh.php');
        })
    })
})

function purchase(){
    console.log("purchased!!");
    $('#buyForm').submit(function(e){
        console.log('buyform found');
        e.preventDefault();
        var inputs = $(this).serialize();
        $.post('insert.php',inputs,function(){
            $('.content').load('refresh.php');
        })
    })
}

/*##########################################################*/
/*This function generates a table to display data retrieved from api*/
/*this function needs to go before api call, otherwise not recognized*/
function displayResults(){
    var stockJson = JSON.parse(localStorage.getItem('searchResult'));
    var firstKey = Object.keys(stockJson)[0];
    var ticker = stockJson["Global Quote"]["01. symbol"];
    var currentPrice = stockJson["Global Quote"]["05. price"];
    var previousClose = stockJson["Global Quote"]["08. previous close"];
    var tradingDay = stockJson["Global Quote"]["07. latest trading day"];

    if(firstKey=="Error Message"){
        document.getElementById("dataDisplay").innerHTML="Invalid entry";

    }else{    

    //delete any output table if it exists
    deleteTable("outputTable");
        
    //create a form and table within that form
    //createForm("dataDisplay","outputTable");

    //append table with data from api call   
    //fillTable();

    //alternative table with titles
    createTable("dataDisplay","outputTable","outputRow");

    //append table with data from api call
    //create titles
    var tbl = document.getElementById("outputTable");
     var row = tbl.insertRow();
     var cell1 = row.insertCell();
     var cell2 = row.insertCell();
     var cell3 = row.insertCell();
     var cell4 = row.insertCell();
     
     cell1.innerHTML = ticker;
     cell2.innerHTML = tradingDay;
     cell3.innerHTML = previousClose;
     cell4.innerHTML = currentPrice;  
    
    //##### nested functions for output table ######

    //this populates the output table with form elements
    //function fillTable(){
        
        // ---- 1. create input elements: ----

        //ticker input on output form
        // var inputTicker = document.createElement("input");
        // inputTicker.type="text";
        // inputTicker.name="ticker";
        // inputTicker.value=ticker;
        // inputTicker.readOnly=true;

        // //date input on output form
        // var inputDate = document.createElement("input");
        // inputDate.type="text";
        // inputDate.name="date";
        // inputDate.value=tradingDay;
        // inputDate.readOnly=true;

        // //price input on output form
        // var inputPrice = document.createElement("input");
        // inputPrice.type="text";
        // inputPrice.name="price";
        // inputPrice.value=currentPrice;
        // inputPrice.readOnly=true;

        // //shares input on output form
        // // var inputShares = document.createElement("input");
        // // inputShares.type="text";
        // // inputShares.name="shares";

        // //----- 2. append input elements to table: ------        
        // var tbl = document.getElementById("outputTable");
        // var row = tbl.insertRow();
        // var cell1 = row.insertCell();
        // var cell2 = row.insertCell();
        // var cell3 = row.insertCell();
        // // var cell4 = row.insertCell();
        // // var cell5 = row.insertCell();
                
        // cell1.appendChild(inputTicker);
        // cell2.appendChild(inputDate);
        // cell3.appendChild(inputPrice);
        // cell4.appendChild(inputShares);
        // cell5.innerHTML = "<button type='submit' onclick='purchase()' \
        // value='Purchase'>Purchase</button>";
  //  }  
        
    };//close else statement
}

/*helper functions for displayResults()*/

//delete table if it exits
function deleteTable(tableId){
    if(document.getElementById(tableId) != null){
        document.getElementById(tableId).remove();
        console.log("Table deleted");
    }

}

function createTable(elementId,tableId,rowId){

    var t = document.createElement('table');
    t.setAttribute("id", tableId);
    document.getElementById(elementId).appendChild(t);
    
    var r = document.createElement('thead');
    r.setAttribute("id", rowId);
    document.getElementById(tableId).appendChild(r);
    
    var c = document.createElement('td');
    var cinput = document.createTextNode("Symbol");
    c.appendChild(cinput);
    document.getElementById(rowId).appendChild(c);

    var c2 = document.createElement('td');
    var c2input = document.createTextNode("Date");
    c2.appendChild(c2input);
    document.getElementById(rowId).appendChild(c2);

    var c3 = document.createElement('td');
    var c3input = document.createTextNode("Previous Close");
    c3.appendChild(c3input);
    document.getElementById(rowId).appendChild(c3);

    var c4 = document.createElement('td');
    var c4input = document.createTextNode("Current Price");
    c4.appendChild(c4input);
    document.getElementById(rowId).appendChild(c4);

    console.log("Table created");

    }

//create a form & table within the form
// function createForm(elementId,tableId){
//     var form = document.createElement('form');
//     form.setAttribute("id","buyForm");
//     form.setAttribute("method","post");
//     form.setAttribute("action","insert.php");
//     document.getElementById(elementId).appendChild(form);

//     //create table within form so inputs appear in table
//     var t = document.createElement('table');
//     t.setAttribute("id", tableId);
//     document.getElementById("buyForm").appendChild(t);

// }

//purchase function
  function purchase(){
      console.log("Purchased!!")
  }

  
/*##########################################################*/
/*this function gets stockdata from alphavantage and stores 
it to local storage*/
function displayTest(){
    console.log("displayTest() is showing")
}
function getStockData(){

    //1. Create an XMLHttpRequest object (request object)
    const xhr = new XMLHttpRequest();
    
    //2. Of the 5 stages of ready state, check for ready state '4' or done
    /*3. Define an event listener or handler: onreadystatechange
        Explanation: if the state changes, call the function below*/
    xhr.onreadystatechange = function getStockData (){
        if (xhr.readyState==4){
            if (xhr.status==200){
                //store response text to local storage to generate all tables
                var responseText = xhr.responseText;
                localStorage.setItem("searchResult",responseText);
    
                //print response text to console for troubleshooting
                console.log("Showing response text:");
                console.log(xhr.responseText); 

                //display results
                displayResults();

                
    
            if(xhr.status==404){
                console.log("File or resource not found");
            }
            }
        }
    };

    //trim whitespace and carriage returns from user input
    var symbol = document.getElementById("userInput").value.trim().replace(/[\n\r]/g, '');

    //add trimmed output variable 'symbol' in url and send request
    url = "https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol="
            +symbol+"&apikey=QTC0C7W8VC9B36VW";
    xhr.open('get',url,true);
    xhr.send();
    //alternate key: QTC0C7W8VC9B36VW
    //alternate key: TXLZQ0VXP5QUYSXN
    }



