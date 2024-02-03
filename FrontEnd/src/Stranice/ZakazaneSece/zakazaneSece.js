const izlazBtn = document.querySelector('.dodajNovi__cancel');

const dodajForma = document.querySelector('.seca__formDodajOtvori');

const otvaranjeFormeBtn= document.querySelector('.seca__dodajNovu');

const dodajNovePodatkeBtn = document.querySelector('.dodajNovi__snimiBtn');

// izvrsava otvaranje forme za dodavanje nove sece, preventira reload(default behaviour)
function otvoriDodajSecuFormu(){
    otvaranjeFormeBtn.addEventListener('click', e =>{
        e.preventDefault();
        dodajForma.classList.add('seca__activeForm');
    })
}
otvoriDodajSecuFormu();

// izvrsava zatvaranje forme za dodavanje nove sece, preventira reload(default behaviour)
function zatvoriFormu(){
    izlazBtn.addEventListener('click', e =>{
        e.preventDefault();
        dodajForma.classList.remove('seca__activeForm');
    })
}
zatvoriFormu();

// izvrsava slanje forme za dodavanje nove sece, preventira reload(default behaviour)
function posaljiFormu(){
    dodajNovePodatkeBtn.addEventListener('submit', e => {
        e.preventDefault();
        location.reload();
    })
}
posaljiFormu();