let button = document.querySelectorAll('.btn-1');
let nav = document.querySelector('.nav-1');
let nav2 = document.querySelector('.nav-2');
let button2 = document.querySelectorAll('.btn-2');
let button3 = document.querySelectorAll('.btn-3');
let nav3 = document.querySelector('.nav-3');
for (let element of button) {
    element.addEventListener('click', function() {
        nav.classList.toggle('open');
        nav.classList.toggle('close');
    })
}
for (let element of button2) {
    element.addEventListener('click', function() {
        nav2.classList.toggle('open');
        nav2.classList.toggle('close');
    })
}
for (let element of button3) {
    element.addEventListener('click', function() {
        nav3.classList.toggle('open');
        nav3.classList.toggle('close');
    })
}
