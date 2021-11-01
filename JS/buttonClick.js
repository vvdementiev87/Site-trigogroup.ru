let button = document.querySelector('.btn-1');
let nav = document.querySelector('.nav-1');
let nav2 = document.querySelector('.nav-2');
let button2 = document.querySelector('.btn-2');
let button3 = document.querySelector('.btn-3');
let button4 = document.querySelector('.btn-4');
let button5 = document.querySelector('.btn-5');

button.onclick = function () {
    nav.classList.toggle('open');
    nav.classList.toggle('close');
};

button2.onclick = function () {
    nav.classList.toggle('open');
    nav.classList.toggle('close');
};
button3.onclick = function () {
    nav.classList.toggle('open');
    nav.classList.toggle('close');
};
button4.onclick = function () {
    nav2.classList.toggle('open');
    nav2.classList.toggle('close');
};
button5.onclick = function () {
    nav2.classList.toggle('open');
    nav2.classList.toggle('close');
};