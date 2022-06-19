
//var word = document.getElementById("word").value;

//document.getElementById("friendName").value = data.value;
//var sessionValue =  '<?php echo $_SESSION["usersPnumber"]; ?>';

//document.getElementById("amount").innerHTML = sessionValue;

//body.keyup(function() {
    //document.getElementById("amount").value =sessionValue;
//});

var currentDate = new Date();
var dt1 = null;
var dt2 = null;
var x;

function sample(){
    document.getElementById("sampleamount").value = 111;
}

function selectFunction() {
    var dt1 = new Date(document.getElementById("dt1").value);
    var dt2 = new Date(document.getElementById("dt2").value);
    var pointer = document.getElementById("room").value;
    var a = "roomrate";
    var ratepointer = a+pointer;
    var x = document.getElementById(ratepointer).textContent;

    if(dt1 != null && currentDate < dt1 && dt2 != null && currentDate < dt2){
        compute();
    }else{
        document.getElementById("sampleamount").value =  x;
    }
}

function validatedt1(){
    var dt1 = new Date(document.getElementById("dt1").value);
    var dt2 = new Date(document.getElementById("dt2").value);
    if(currentDate > dt1){
        alert("error!!!");
        document.getElementById("dt1").value =  null;
    }else{
        if(dt2 != null && currentDate < dt2){
            if(dt2 > dt1){
                compute();
            }else{
                alert("error!!!");
                document.getElementById("dt1").value =  null;
            }
        }
    }
  }

  function validatedt2(){
    var dt1 = new Date(document.getElementById("dt1").value);
    var dt2 = new Date(document.getElementById("dt2").value);

    if(dt1 != null && currentDate < dt1){
        if(currentDate > dt2){
            alert("error!!!");
            document.getElementById("dt2").value =  null;
        }else{
            if(dt2 <= dt1){
                alert("error!!!");
                document.getElementById("dt2").value =  null;
            }else{
                compute();
            }
        }
    }else{
        alert("error!!! Input check-in date first!");
        document.getElementById("dt2").value =  null;
    }
  }

  function compute(){
    var dt1 = new Date(document.getElementById("dt1").value);
    var dt2 = new Date(document.getElementById("dt2").value);
    //var dt1day = dt1.getDate();
    //var dt2day = dt2.getDate();
    var days = (dt2 - dt1)/86400000; //difference of 2 dates divided by total number of milliseconds to get the difference of number of days.
    var price = getPrice();
    var amount = days * price;
    document.getElementById("sampleamount").value =  amount;
  }

function getPrice(){
    var pointer = document.getElementById("room").value;
    var a = "roomrate";
    var ratepointer = a+pointer;
    var x = document.getElementById(ratepointer).textContent;
    return x;
}
