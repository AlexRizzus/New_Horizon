function myFocusFunction(x) {x.value = '';}
function myBlurFunction(x) { if(x.value === '') { x.value = 'Cerca luogo…'; }}

/*function resetPosition(id) {
  var elmnt = document.getElementById(id);
  elmnt.scroll(0, 1000);
}*/

var actual_pos = null;

const btnScrollToTop = document.getElementById("btnScrollToTop");
btnScrollToTop.onclick = function(evt){window.scrollTo(0,0);};


const btnAnnullaFiltro = document.getElementById("pulsante_cerca_tutte");
btnAnnullaFiltro.onclick = function(evt){localStorage.setItem("actual_pos", document.documentElement.scrollTop);};

const btnCercaPianeta = document.getElementById("pulsante_cerca_pianeta");
btnCercaPianeta.onclick = function(evt){localStorage.setItem("actual_pos", document.documentElement.scrollTop);};

var forms = document.getElementsByClassName("missionform");

for (var i = 0, len = forms.length; i < len; i++) {
  forms[i].addEventListener('submit', handleForm);
}

//var testForm = document.getElementById("missionForm1");
//testForm.addEventListener('submit', handleForm);

function handleForm(event) {
  // event.preventDefault();
  localStorage.setItem("actual_pos", document.documentElement.scrollTop);
  // window.alert(localStorage.getItem("actual_pos"));
  // testForm.submit();
}

window.onload = function(){
  // window.alert(localStorage.getItem("actual_pos"));
  window.scrollTo(localStorage.getItem("actual_pos"), localStorage.getItem("actual_pos"));
}

/*const gogo = document.getElementById("missionForm1");
gogo.onsubmit = function(evt){window.scrollTo(100,100);return false;};*/

// btnPrefe.onclick = function(evt){alert("Missione aggiunta correttamente ai preferiti!");};

let toggled = false;
const nav = document.getElementById('navigation');
const btn = document.getElementsByClassName('nav-tgl')[0];

btn.onclick = function (evt) {
  if (toggled) {
    toggled = false;
    btn.innerHTML = "&equiv;"
    navigation.style.height = "0%";
  } else {
    toggled = true;
    btn.innerHTML = "&times;"
    navigation.style.height = "100%";
  }
}

/*
document.getElementById("search").onsubmit = function()
{
  checkInput();
}

function checkInput{
  var input_nomePianeta = document.getElementById("cerca_missione");
  var risultatoInput = checkNomePianeta(input_nomePianeta);
  return risultatoInput;
}


function checkNomePianeta(nomePianeta) {
  var patt = new RegExp('^[a-zA-Z]{2,}$');
  if(patt.test(nomePianeta.value)){
    togliErrore(nomeInput);
    return true;
  }
  else {
    mostraErrore(nomeInput, "Nome del pianeta non valido, inserire almeno 2 caratteri");
    return false;
  }
}

function mostraErrore(input, testoErrore) {
  // Mostra un messaggio di errore per un determinato input
  togliErrore(input);
  var p = input.parentNode;
  var strong = document.createElement("strong");
  strong.appendChild(document.createTextElement(testoerrore));
  p.appendChild(strong);
}

function togliErrore(input) {
  var p = input.parentNode;
  //var toRemove = p.getElementsByClassName("error")[0];
  //p.removeChild(toRemove);
  if(p.children.lenght > 0)
  {
    p.removeChild(p.children[0]);
  }
}
*/
