function openModal(id, username) {
  // 1. Ambil elemen-elemen modal
  const overlay = document.getElementById("passwordOverlay");
  const inputId = document.getElementById("modalInputId");
  const inputUser = document.getElementById("modalInputUsername");
  const displayName = document.getElementById("displayUserName");

  // 2. Isi data sesuai card yang diklik
  inputId.value = id;
  inputUser.value = username;
  displayName.innerText = username;

  overlay.classList.remove("hidden");
}

function closeModal() {
  document.getElementById("passwordOverlay").classList.add("hidden");
}
