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


const btnScrollToTop = document.getElementById("btnScrollToTop");
btnScrollToTop.onclick = function(evt){window.scrollTo(0,0);};

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
function validateLogin(){
  parent = document.getElementById("login-error");
  if(parent.children.length > 0){
  document.getElementsByClassName("error")[0].remove();
}
  username = document.forms["login"]["username"].value;
  user = isUsername(username);
  password = document.forms["login"]["password"].value;
  psw = isPassword(password);
  if (user && psw)
  {
    return true;
  }
  else {
      displayerror(parent,"Username o Password errata, riprova");
      return false;
  }

}
function validateRegistration(){
  erremail = document.getElementById("email-error");
  erruser = document.getElementById("username-error");
  errpsw = document.getElementById("password-error");
  if(erremail.children.length > 0){
  document.getElementsByClassName("error")[0].remove();
  }
  if(erruser.children.length > 0){
  document.getElementsByClassName("error")[0].remove();
  }
  if(errpsw.children.length > 0){
  document.getElementsByClassName("error")[0].remove();
  }
  username = document.forms["registrazione"]["username"].value;
  user = isUsername(username);
  if(!user)
  {
    displayerror(erruser,"Nome utente troppo corto");
  }
  password = document.forms["registrazione"]["password"].value;
  psw = isPassword(password);
  if(!psw)
  {
    displayerror(errpsw,"Prova con una password più complessa");
  }
  email = document.forms["registrazione"]["email"].value;
  email = isEmail(password);
  if(!email)
  {
    displayerror(erremail,"E-mail non valida");
  }
  return (user && psw && email) ;
}
function displayerror(parent, message){
  var strong = document.createElement("strong");
  var text = document.createTextNode(message);
  strong.appendChild(text);
  strong.classList.add("error");
  parent.appendChild(strong);
}
function isUsername(username) {
    return username.length > 3;
}
function isEmail(email) {
    return new RegExp(/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/).test(email);
}

function isPassword(psw) {
    return new RegExp(/^[0-9a-zA-Z]{4,}$/).test(psw);
}
