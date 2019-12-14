let toggled = false;
const nav = document.getElementsByClassName('navigation')[0];
const btn = document.getElementsByClassName('nav-tgl')[0];
const other_button = document.getElementsByClassName('desktop')[0];
btn.onclick = function(evt) {
  if (!toggled) {
    toggled = true;
    evt.target.classList.add('toggled');
    nav.classList.add('active');
    other_button.classList.add('active');
  } else {
    toggled = false;
    evt.target.classList.remove('toggled');
    nav.classList.remove('active');
    other_button.classList.remove('active');
  }
}