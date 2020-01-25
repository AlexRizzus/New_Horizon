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
const logout = document.getElementsByClassName('transparent')[0];
logout.onclick = function(){
url = "login.php"
try{
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(e) {
            // try an older version
            try{
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
              echo('problems');
            }
req.open('DELETE',url,true);
window.location = 'login.php';
}
