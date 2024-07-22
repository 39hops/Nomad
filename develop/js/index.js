let dropdown = document.querySelectorAll('.dropdown');

for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener('click', toggle);
}

function show(e) {
    document.querySelector('.text02').value = e;
}

function toggle() {
    this.classList.toggle('active');
}