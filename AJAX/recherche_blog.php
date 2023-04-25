<script>

//Variable globale
previousText = "";
timer = 0;

//Timer qui boucle toutes les secondes pour changer la variable globale
function TimerIncrease() {
  timer+=500;
  setTimeout('TimerIncrease()',500);
}
TimerIncrease();

function suggestNamesFromInput(currentText) {

  if (currentText != previousText && timer >= 500 ){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("suggestions").innerHTML = this.responseText;
      }
    xhttp.open("GET", "./AJAX/load_recherche_blog.php?var=" + currentText , true); //Le booléen final dit si le chargement est asynchrone ou non
    xhttp.send();

    previousText = currentText;
    timer = 0;
  }
  
}


</script>
<hr>
<div id="demo2" class="center">

  <input id="suggestField" type="text" onkeyup="suggestNamesFromInput(this.value)">
  <p id="suggestions"><i>Recherchez des blogs !</i></p>

</div>