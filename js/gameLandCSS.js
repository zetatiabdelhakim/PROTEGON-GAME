// just css justify
setInterval(function(){
  // ALL divs style
    var divElements = document.querySelectorAll('div[class^="col-"]');
    if(window.innerWidth < 768){ 
        divElements.forEach(function(element) {
          element.style.marginLeft = "4.166666%"; element.style.marginRight = "4.166666%"
        });
      }
    else{
        divElements.forEach(function(element) {
            element.style.marginLeft = "1.3888888%"; element.style.marginRight = "1.3888888%";
          });
    }
    // Table div height
    var table = document.getElementById("table");
    table.style.height = `${table.offsetWidth}px`
    //MY cards div
    var myCards = document.querySelectorAll('#myCards img');
    if(window.innerWidth < 768){
      myCards.forEach(function(element) { element.style.width = "12.28571429%";}); 
    }
  else{
    myCards.forEach(function(element) { element.style.width = "31.3333333%";}); 
    document.getElementById("myCards").style.height="1%";
  }
  // book div
  var book = document.querySelectorAll('#book img');
    if(window.innerWidth < 768){
      book.forEach(function(element) { element.style.width = "12.28571429%";}); 
    }
  else{
    book.forEach(function(element) { element.style.width = "18%";}); 
    document.getElementById("book").style.height="1%";
  }

},100)

