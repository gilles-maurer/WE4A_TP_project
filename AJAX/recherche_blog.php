<script>

//Variable globale
previousText = "";
timer = 0;

//Timer qui boucle toutes les secondes pour changer la variable globale
function TimerIncrease() {
  timer+=1000;
  setTimeout('TimerIncrease()',1000);
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

function autoFillName(nametext){
  document.getElementById("suggestField").value = nametext;
}

</script>
<hr>
<div id="demo2" class="center">

  <input id="suggestField" type="text" onkeyup="suggestNamesFromInput(this.value)">
  <p id="suggestions"><i>rechercher des blogs !</i></p>

</div>