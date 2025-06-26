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

/*List Pengumuman*/
const editButton = document.querySelectorAll(".edit-pengumuman-button");

for (let i = 0; i < editButton.length; i ++) {
    editButton[i].addEventListener("click", () => {
        let isiPengumuman = document.getElementById(`obj-${i}`);
        let formElement = document.createElement("form");
        let textElement = document.createElement("textarea");
        let submitElement = document.createElement("button");
        let editButton = document.getElementById("edit-button");
        let cancelButton = document.getElementById("cancel-button");

        editButton.id = "cancel-button";
        cancelButton.innerHTML = "[<i class='fa-solid fa-users'></i>] batal";


        formElement.setAttribute("method", "post");
        formElement.setAttribute("action", "list.pengumuman.php");
        textElement.innerHTML = "<?php echo $row['isi']?>";
        textElement.setAttribute("placeholder", "Masukkan pengumuman anda disini ...");
        textElement.style = "min-width: 100%; max-width: 100%; min-height: fit-content; max-height: 200px;";
        submitElement.setAttribute("type", "submit");
        submitElement.innerText = "Simpan";
        formElement.appendChild(textElement);
        formElement.appendChild(submitElement);

        isiPengumuman.replaceWith(formElement);

    });
}