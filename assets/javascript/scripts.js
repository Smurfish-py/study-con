/*User Card*/
const userMenu = document.getElementById('user-menu');
const userCard = document.getElementById('user-card');
userMenu.addEventListener('click', function() {
    if (userCard.style.display === 'none') {
        userCard.style.display = 'block';
    } else {
        userCard.style.display = 'none';
    }
});

document.addEventListener('click', function(event) {
    if (!userCard.contains(event.target) && !userMenu.contains(event.target)) {
        userCard.style.display = 'none';
    }
});

/*Untuk Master Page*/
const iconPengumuman = document.getElementById('icon-buat-pengumuman');
const buatPengumuman = document.getElementById('buat-pengumuman');
iconPengumuman.addEventListener('click', function(){
    if (buatPengumuman.style.display === 'none') buatPengumuman.style.display = 'flex';
});

const batalBuatPengumuman = document.getElementById('batal-buat-pengumuman');
batalBuatPengumuman.addEventListener('click', function(){
    if (buatPengumuman.style.display === 'flex') buatPengumuman.style.display = 'none';
});