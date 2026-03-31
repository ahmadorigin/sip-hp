const mobileMenuButton = document.getElementById("mobileMenuButton");
const mobileMenu = document.getElementById("mobileMenu");
const menuIcon = document.getElementById("menuIcon");
const closeIcon = document.getElementById("closeIcon");

mobileMenuButton.addEventListener("click", () => {
  // Toggle menu
  mobileMenu.classList.toggle("hidden");

  // Toggle icon hamburger <-> close
  menuIcon.classList.toggle("hidden");
  closeIcon.classList.toggle("hidden");

  // Animasi smooth
  if (!mobileMenu.classList.contains("hidden")) {
    mobileMenu.style.animation = "slideDown 0.3s ease-out";
  }
});

// Close menu saat klik di luar (opsional)
document.addEventListener("click", function (event) {
  const isClickInside =
    mobileMenuButton.contains(event.target) ||
    mobileMenu.contains(event.target);
  if (!isClickInside && !mobileMenu.classList.contains("hidden")) {
    mobileMenu.classList.add("hidden");
    menuIcon.classList.remove("hidden");
    closeIcon.classList.add("hidden");
  }
});

// Tambahkan keyframe animation
const style = document.createElement("style");
style.textContent = `
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
document.head.appendChild(style);
