function myFocusFunction(x) {x.value = '';}
function myBlurFunction(x) {x.value = 'cerca pianeta…';}

//const btn = document.getElementsById('pulsante_cerca_pianeta');

let toggled = false;
const nav = document.getElementsByClassName('navigation')[0];
const btn = document.getElementsByClassName('nav-tgl')[0];
const first_button = document.getElementsByClassName('desktop')[0];
const sec_button = document.getElementsByClassName('desktop')[1];
const third_button = document.getElementsByClassName('desktop')[2];
const fourth_button = document.getElementsByClassName('desktop')[3];
const fifth_button = document.getElementsByClassName('desktop')[4];
const sixth_button = document.getElementsByClassName('desktop')[5];
const seventh_button = document.getElementsByClassName('desktop')[6];
btn.onclick = function(evt) {
  if (!toggled) {
    toggled = true;
    btn.classList.add('toggled');
    nav.classList.add('active');
    first_button.classList.add('active');
    sec_button.classList.add('active');
    third_button.classList.add('active');
    fourth_button.classList.add('active');
    fifth_button.classList.add('active');
    sixth_button.classList.add('active');
    seventh_button.classList.add('active');
  } else {
    toggled = false;
    btn.classList.remove('toggled');
    nav.classList.remove('active');
    first_button.classList.remove('active');
    sec_button.classList.remove('active');
    third_button.classList.remove('active');
    fourth_button.classList.remove('active');
    fifth_button.classList.remove('active');
    sixth_button.classList.remove('active');
    seventh_button.classList.remove('active');
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
