// ===== NAVBAR SCROLL (AMAN) =====
const navbar = document.getElementById("mainNavbar");
if (navbar) {
  window.addEventListener("scroll", () => {
    navbar.classList.toggle("scrolled", window.scrollY > 50);
  });
}

// ===== SCROLL REVEAL (AMAN) =====
const revealElements = document.querySelectorAll(".reveal");

if (revealElements.length > 0) {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("show");
        }
      });
    },
    { threshold: 0.1 },
  );

  revealElements.forEach((el) => observer.observe(el));
}

// ----------------------------------------------------------
// TOGGLE PUBLISH
// ----------------------------------------------------------
document.querySelectorAll(".toggle-publish").forEach(function (toggle) {
  toggle.addEventListener("change", function () {
    const id = this.dataset.id;
    const status = this.checked ? 1 : 0;
    const textEl = this.closest(".toggle-wrap").querySelector(".toggle-text");
    const self = this;

    fetch(BASE_URL + "/admin/galeri/togglePublish", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "id=" + id + "&status=" + status,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          textEl.textContent = status == 1 ? "Ditampilkan" : "Disembunyikan";
          updateStats();
        }
      })
      .catch((err) => {
        console.error("Gagal update:", err);
        self.checked = !self.checked;
      });
  });
});
