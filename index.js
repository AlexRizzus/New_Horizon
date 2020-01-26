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
function validateLogin(){
  p = document.getElementById("login-error");
  if(p.children.length > 0){
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
    var strong = document.createElement("strong");
    var text = document.createTextNode("Username o Password non corrette, riprova")
    strong.appendChild(text);
    strong.classList.add("error");
    p.appendChild(strong);
    return false;
  }

}
function validateRegistration(){
  p = document.getElementById("login-error");
  if(p.children.length > 0){
  document.getElementsByClassName("error")[0].remove();
  }
  if(p.children.length > 0){
  document.getElementsByClassName("error")[0].remove();
  }
  if(p.children.length > 0){
  document.getElementsByClassName("error")[0].remove();
  }
  if(p.children.length > 0){
  document.getElementsByClassName("error")[0].remove();
  }
  username = document.forms["login"]["username"].value;
  user = isUsername(username);
  password = document.forms["login"]["password"].value;
  psw = isPassword(password);
  email = document.forms["login"]["email"].value;
  email = isEmail(password);
  return user && psw && email;
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
