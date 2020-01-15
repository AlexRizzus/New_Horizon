const btn = document.getElementsById('pulsante_cerca_pianeta');

btn.onclick = function()
{
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
