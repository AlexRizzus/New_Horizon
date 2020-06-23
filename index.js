let toggled = false;
const nav = document.getElementById('navigation');
const btn = document.getElementsByClassName('nav-tgl')[0];
const btnScrollToTop = document.getElementById("btnScrollToTop");
if(btnScrollToTop){
btnScrollToTop.onclick = function(evt){window.scrollTo(0,0);};
}

btn.onclick = function(evt) {
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
function validateLogin(){
  parent = document.getElementById("login-error");
  if(parent.children.length > 0){
  document.getElementsByClassName("error")[0].remove();
}
  var username = document.getElementById("userfield");
  var user = isUsername(username);
  var password = document.getElementById("passfield");
  var psw = isPassword(password);
  if (user && psw)
  {
    return true;
  }
  else {
      displayerror(parent,"Lo Username o la password non rispettano i parametri");
      return false;
  }

}
function validateRegistration(){
  var erremail = document.getElementById("email-error");
  var erruser = document.getElementById("username-error");
  var errpsw = document.getElementById("password-error");
  if(erremail.children.length > 0){
  document.getElementsByClassName("error")[0].remove();
  }
  if(erruser.children.length > 0){
  document.getElementsByClassName("error")[0].remove();
  }
  if(errpsw.children.length > 0){
  document.getElementsByClassName("error")[0].remove();
  }
  var username = document.getElementById("userfield").value;
  var user = isUsername(username);
  if(!user)
  {
    displayerror(erruser,"Nome utente troppo corto");
  }
  var password = document.getElementById("passfield").value;
  var psw = isPassword(password);
  if(!psw)
  {
    displayerror(errpsw,"Prova con una password pi&ugrave; complessa");
  }
  var email = document.getElementById("emailfield").value;
  console.log(email);
  var mail = isEmail(email);
  if(!mail)
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
  return new RegExp('^([a-zA-Z0-9_.+-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9])+$').test(email);
}

function isPassword(psw) {
    return new RegExp(/^[0-9a-zA-Z]{4,}$/).test(psw);
}
