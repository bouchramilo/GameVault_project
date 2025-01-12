const updateform = document.querySelectorAll('.updateform');
const deletemodal = document.querySelector('.deletemodal');
const sprm = document.querySelectorAll('.sprm');
const pic = document.querySelector('.pic');
const close = document.querySelector('.close');
const gamemodal = document.querySelector('.gamemodal');
const addgame = document.querySelector('.addgame');
const formContainerModifier = document.getElementById('formContainerModifier');


updateform.forEach(upd => {
    upd.addEventListener('click', () => {
        formContainerModifier.classList.toggle('hidden');
    })

});
sprm.forEach(del => {
    del.addEventListener('click', () => {
        deletemodal.classList.toggle('hidden');
    });
})

pic.addEventListener('click', () => {
    deletemodal.classList.toggle('hidden');
});
addgame.addEventListener('click', () => {
    gamemodal.classList.toggle('hidden');
})
close.addEventListener('click', () => {
    gamemodal.classList.toggle('hidden');
})

function deletebtn(id) {
    document.getElementById('id_game').value = id;
}

function modifierbtn(id, title, details, releaseDate, price, genre) {
    document.getElementById('idgame').value = id;
    document.getElementById('title').value = title;
    document.getElementById('details').value = details;
    document.getElementById('releaseDate').value = releaseDate;
    document.getElementById('price').value = price;
    document.getElementById('genre').value = genre;
}