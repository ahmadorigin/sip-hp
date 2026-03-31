document.querySelectorAll(".start-timer-btn").forEach((button) => {
  button.addEventListener("click", function () {
    let menit = parseInt(this.getAttribute("data-menit"));
    let displaySpan = this.parentElement.querySelector(".display-timer");
    let detik = menit * 60;
    this.style.display = "none";
    displaySpan.classList.remove("hidden");
    let interval = setInterval(() => {
      let minutes = Math.floor(detik / 60);
      let seconds = detik % 60;
      displaySpan.textContent = `${minutes.toString().padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;
      if (detik <= 0) {
        clearInterval(interval);
        displaySpan.textContent = "Waktu habis!";
        displaySpan.classList.add("text-red-400");
      }
      detik--;
    }, 1000);
  });
});
