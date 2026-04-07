document.querySelectorAll(".tolak-btn").forEach((button) => {
  button.addEventListener("click", function () {
    const pesanAdmin = this.nextElementSibling;
    const containerCard = this.parentElement.parentElement;
    this.classList.add("hidden");
    containerCard.classList.add("bg-red-500/10");
    pesanAdmin.classList.remove("hidden");
  });
});

function jalankanTimer(element, sisaDetik, idPinjam) {
  // console.log(element, sisaDetik, idPinjam);
  const hitungMundur = setInterval(() => {
    sisaDetik--;
    if (sisaDetik <= 0) {
      clearInterval(hitungMundur);
      element.innerText = "WAKTU HABIS!";
      // Lapor ke PHP kalau selesai
      fetch("../../src/php/finish_timer.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `id=${idPinjam}`,
      }).then(() => location.reload());
      return;
    }
    let menit = Math.floor(sisaDetik / 60);
    let detik = sisaDetik % 60;
    element.innerText = `${menit}:${detik < 10 ? "0" : ""}${detik}`;

    // console.log(element);
  }, 1000);
}

document.querySelectorAll(".display-timer").forEach((span) => {
  // const idPinjam = this.dataset.id;
  const sisa = span.dataset.sisa;

  if (!isNaN(sisa) && sisa > 0) {
    span.classList.remove("hidden");
    // Langsung jalankan timer pakai angka sisa itu
    jalankanTimer(span, sisa, span.dataset.id);
  } else if (sisa <= 0) {
    span.innerText = "WAKTU HABIS!";
    span.classList.remove("hidden");
  }
});

document.querySelectorAll(".start-timer-btn").forEach((button) => {
  button.addEventListener("click", function () {
    const idPinjam = this.dataset.id;
    const containerCard = this.parentElement;
    const displayTimer = containerCard.querySelector(".display-timer");

    fetch("../../src/php/approve_start.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `id=${idPinjam}`,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          this.classList.add("hidden");

          if (displayTimer) {
            displayTimer.classList.remove("hidden");
            // Panggil fungsi hitung mundur
            jalankanTimer(displayTimer, data.sisa_detik, idPinjam);
          }
        } else {
          alert("Gagal memulai timer: " + data.message);
        }
      })
      .catch((err) => console.error("Error:", err));
  });
});
