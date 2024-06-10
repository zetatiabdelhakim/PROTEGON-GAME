function chooseCard(){
  for(let i=1;i<=14;i++){
    document.getElementById(`c-myCards-${i}`).onclick=function(){
      document.getElementById(`myCards`).style.visibility = "hidden";
      document.getElementById(`book`).style.visibility = "hidden";
      let num = getNumFromSrc(this.src);
      document.getElementById(`c-player-1`).src = this.src;
    }
  }
}
function do_the_exchange(){
  var start = document.getElementById("exchange");
  var div = document.getElementsByClassName("exchange_div")[0];
  var end = document.getElementById("do-the-exchange");
  var Mycard = document.getElementById("c1-c");
  var cardbook = document.getElementById("c2-c");
  var position_mycard = 0;
  var position_book = 0;
  start.onclick = function(){
    cardbook.src = "PROTEGON/cards/NO CARD.png";
    Mycard.src = "PROTEGON/cards/NO CARD.png";
    this.style.visibility = "hidden";
    div.style.visibility = "visible";
    for(let i=1;i<=14;i++){
      document.getElementById(`c-myCards-${i}`).onclick=()=>{Mycard.src = document.getElementById(`c-myCards-${i}`).src;position_mycard = i;}
    }
    for(let i=1;i<=23;i++){
      document.getElementById(`c-book-${i}`).onclick=()=>{cardbook.src = document.getElementById(`c-book-${i}`).src;position_book = i;}
    }
  }
  end.onclick=function(){
    if(position_mycard != 0 && position_book !=0){
      document.getElementById(`c-myCards-${position_mycard}`).src = cardbook.src;
      document.getElementById(`c-book-${position_book}`).src = Mycard.src;
      console.log(`book ${getNumFromSrc(cardbook.src)} ------ card ${getNumFromSrc(Mycard.src)}`);
    }
    start.style.visibility = "visible";
    div.style.visibility = "hidden" ;
    position_mycard = 0;
    position_book = 0;
  }
}

function info(info = ""){
  var information = document.getElementById("information");
  var the_info = document.getElementById("the-info");
  the_info.innerHTML = info;
  information.style.visibility =  "visible";
  the_info.style.visibility = "visible";
  information.onclick = function(){
      this.style.visibility = "hidden";
      the_info.style.visibility = "hidden";
    }
}