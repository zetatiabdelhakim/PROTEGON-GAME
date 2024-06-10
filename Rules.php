<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.3.0-alpha1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/Rules.css">
    <title>RULES</title>
    <link rel="icon" href="PROTEGON/Logo no bg.png" type="image/png">
</head>
<body>
  <div class="container">
   <h1><font>RULES</font><br> <hr><img src="PROTEGON/Logo no bg.png" alt=""></h1>
   <ul class="list-group list-group-flush">
    <li class="list-group-item">The game consists of 79 cards, numbered 1 to 4, as well as cards numbered from 15 to 85 inclusively.
        Additionally, there are cards numbered 97, 98, 99, and 100.</li>
    <li class="list-group-item">The game begins with four players, one of whom is 'PROTEGON'.</li>
    <li class="list-group-item">Each player is initially dealt a set of 14 cards,
        while the remaining cards are securely placed in a designated location referred to as the 'book',
        which only the discerning 'PROTEGON' is privy to observe.</li>
    <li class="list-group-item">The game consists of a total of eleven exhilarating rounds.</li>
    <li class="list-group-item">At the onset of each round, the 'PROTEGON' must make a decisive declaration regarding the nature of the round,
        specifying whether it is to be played as a 'MAX' or 'MIN' round.</li>
    <li class="list-group-item">During each round, players are required to strategically place a card on the 'table'
        (ensuring all cards placed on the table are clearly visible and transparent to all players)</li>
    <li class="list-group-item">The victor of the round is determined by the player who possesses the lowest number in the case of a 'MIN' round,
        and the highest number in the event of a 'MAX' round.</li>
    <li class="list-group-item">In the game, there exist four special cards,
        referred to as the 'sepcial cards', namely 1, 2, 3, and 4 for 'MIN' rounds, and 100, 99, 98, and 97 for 'MAX' rounds.</li>
    <li class="list-group-item">In the event that two or more players place a special card during a round, the round becomes null, with no consequences
        and the game progresses to the next round.</li>
    <li class="list-group-item">* During a round, if only one player plays a special card, that player must emerge victorious;
        otherwise, they will face elimination.
        To win a round that includes a special card, the value of the special card must
        exceed the sum of the highest card and one-fourth of the smaller card's value in a 'MAX' round,
        or be strictly lower than the difference between the highest card and the smaller card's value
        minus 2 (if there are 4 players) or minus 1 (if there are 3 or 2 players) in a 'MIN' round.
        <br> * In the case of a round with a single special card, if the player holding the special card loses,
        the special card is not considered for determining the winner. Instead, in a 'MAX' round,
        the player with the highest number emerges victorious, while in a 'MIN' round,
        the player with the lowest number secures the win.
       </li>
    <li class="list-group-item">If a player gets eliminated, all of his cards will be transferred to the table,
        ensuring that they are visible to all players.</li>
    <li class="list-group-item">The 'PROTEGON' must emerge victorious in every round, as failure to do so will result in immediate elimination.
        The winner of the round will then assume the title of 'PROTEGON',
        and the gift of the 'book' will be transferred to the new 'PROTEGON'.</li>
    <li class="list-group-item">At any time during the game, the first 'PROTEGON' can take two cards from the 'book',
        but he must also put a card from his hand into the 'book'.
        If the first 'PROTEGON' is eliminated, the second 'PROTEGON' can take one card from the 'book' following the same process.
        However, if the second 'PROTEGON' is eliminated, the third 'PROTEGON' cannot take any cards from the 'book'.</li>
   
    <li class="list-group-item">If a player happens to be the last one two times in a row, he will be eliminated.
        By "last one," we refer to the player who had the minimum card in the 'MAX' round and the maximum card in the 'MIN' round.
        In the event of a round with a special card where the player who possesses it loses,
        he will be considered the last one. Conversely, if he wins, the normal rule will be applied.
       </li>
        <li class="list-group-item">The ultimate victor of the game is none other than the revered 'PROTEGON' when the game reaches its conclusion.</li>
</ul>
<br><button class="btn btn-secondary" onclick="go()">Home</button><br><br>
<script>function go(){window.location.href = "./Index.php";}</script>
  <br>
  <br>
  </div>
</body>
</html>
<script src="js/Rules.js"></script>