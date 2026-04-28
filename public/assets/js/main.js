const BASE_URL = window.location.pathname.includes("kampung-ketupat")
  ? "/kampung-ketupat"
  : "";

const navbar = document.getElementById("mainNavbar");
if (navbar) {
  window.addEventListener("scroll", () => {
    navbar.classList.toggle("scrolled", window.scrollY > 50);
  });
}

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
document.addEventListener("DOMContentLoaded", function () {
  const BASE_URL = window.location.pathname.includes("kampung-ketupat")
    ? "/kampung-ketupat"
    : "";

  const navbar = document.getElementById("mainNavbar");
  if (navbar) {
    window.addEventListener("scroll", () => {
      navbar.classList.toggle("scrolled", window.scrollY > 50);
    });
  }

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

  const searchInput = document.getElementById("searchInput");
  const filterSelect = document.getElementById("filterKategori");
  const statPublish = document.getElementById("publish");
  const statHidden = document.getElementById("hidden");

  function filterGaleri() {
    const keyword = (searchInput?.value || "").toLowerCase();
    const kategori = (filterSelect?.value || "").toLowerCase();

    document.querySelectorAll(".galeri-item").forEach((item) => {
      const judul = item.dataset.judul || "";
      const kat = item.dataset.kategori || "";

      const matchSearch = !keyword || judul.includes(keyword);
      const matchKategori = !kategori || kat === kategori;

      item.style.display = matchSearch && matchKategori ? "" : "none";
    });
  }

  searchInput?.addEventListener("input", filterGaleri);
  filterSelect?.addEventListener("change", filterGaleri);

  function updateStats() {
    let publish = 0;
    let hidden = 0;

    document.querySelectorAll(".toggle-publish").forEach((t) => {
      t.checked ? publish++ : hidden++;
    });

    if (statPublish) statPublish.textContent = publish;
    if (statHidden) statHidden.textContent = hidden;
  }

  const csrfToken =
    document.querySelector('meta[name="csrf-token"]')?.getAttribute("content") ||
    "";
  document.querySelectorAll(".toggle-publish").forEach((toggle) => {
    toggle.addEventListener("change", function () {
      const id = this.dataset.id;
      const status = this.checked ? 1 : 0;
      const textEl =
        this.closest(".toggle-wrap")?.querySelector(".toggle-text");
      const self = this;

      fetch(BASE_URL + "/admin/galeri/togglePublish", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body:
          "_token=" +
          encodeURIComponent(csrfToken) +
          "&id=" +
          encodeURIComponent(id) +
          "&status=" +
          encodeURIComponent(status),
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            if (textEl) {
              textEl.textContent =
                status == 1 ? "Ditampilkan" : "Disembunyikan";
            }
            updateStats();
          }
        })
        .catch((err) => {
          console.error("Gagal update:", err);
          self.checked = !self.checked;
        });
    });
  });
});
