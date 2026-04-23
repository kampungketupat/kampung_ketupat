// ============================================================
// main.js — FIXED VERSION (STABLE)
// ============================================================

// ===== BASE URL AUTO DETECT =====
const BASE_URL = window.location.pathname.includes("kampung-ketupat")
  ? "/kampung-ketupat"
  : "";

// ============================================================
// NAVBAR SCROLL
// ============================================================
window.addEventListener("scroll", () => {
  const navbar = document.getElementById("mainNavbar");
  if (navbar) {
    navbar.classList.toggle("scrolled", window.scrollY > 50);
  }
});

// ============================================================
// SCROLL REVEAL
// ============================================================
const revealObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("show");
        revealObserver.unobserve(entry.target);
      }
    });
  },
  { threshold: 0.12 },
);

document.querySelectorAll(".reveal").forEach((el) => {
  revealObserver.observe(el);
});

// ============================================================
// ACTIVE NAV SCROLL
// ============================================================
const sections = document.querySelectorAll("section[id]");
const navLinks = document.querySelectorAll(".navbar-kk .nav-link");

if (sections.length && navLinks.length) {
  window.addEventListener("scroll", () => {
    const scrollY = window.scrollY + 120;

    sections.forEach((section) => {
      const top = section.offsetTop;
      const height = section.offsetHeight;
      const id = section.getAttribute("id");

      if (scrollY >= top && scrollY < top + height) {
        navLinks.forEach((link) => {
          link.classList.toggle(
            "active",
            link.getAttribute("href") === `#${id}`,
          );
        });
      }
    });
  });
}

document.addEventListener("DOMContentLoaded", () => {
  const reveals = document.querySelectorAll(".reveal");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("active");
        }
      });
    },
    { threshold: 0.15 },
  );

  reveals.forEach((el) => observer.observe(el));
});

// ============================================================
// GALERI (VUE) - WITH DESCRIPTION + LIGHTBOX
// ============================================================
if (document.getElementById("app-galeri")) {
  const { createApp } = Vue;

  createApp({
    data() {
      return {
        kategoriAktif: "semua",
        galeri: window.__GALERI_DATA__ || [],
        selectedImage: null,
      };
    },

    computed: {
      galeriFiltered() {
        if (this.kategoriAktif === "semua") return this.galeri;
        return this.galeri.filter((g) => g.kategori === this.kategoriAktif);
      },
    },

    methods: {
      setKategori(kat) {
        this.kategoriAktif = kat;
      },

      imgUrl(foto) {
        if (!foto) return "";
        return foto.startsWith("http")
          ? foto
          : `${BASE_URL}/assets/uploads/galeri/${foto}`;
      },

      openImage(item) {
        this.selectedImage = item;
        document.body.style.overflow = "hidden";
      },

      closeImage() {
        this.selectedImage = null;
        document.body.style.overflow = "";
      },

      truncate(text, length = 80) {
        if (!text) return "";
        return text.length > length ? text.substring(0, length) + "..." : text;
      },
    },

    mounted() {
      this.$nextTick(() => {
        setTimeout(() => {
          document.querySelectorAll(".gallery-wrap").forEach((el, i) => {
            setTimeout(() => el.classList.add("active"), i * 80);
          });
        }, 200);
      });

      // tutup lightbox dengan ESC
      document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") this.closeImage();
      });
    },

    template: `
    <div>

      <!-- FILTER -->
      <div class="d-flex flex-wrap gap-2 mb-5 justify-content-center reveal">
        <button
          v-for="kat in ['semua','wisata','kuliner','budaya','fasilitas','umum']"
          :key="kat"
          @click="setKategori(kat)"
          :class="['btn btn-kk-outline btn-sm filter-btn', kategoriAktif === kat ? 'active' : '']"
          style="border-radius:999px; text-transform:capitalize; min-width:90px;">
          {{ kat }}
        </button>
      </div>

      <!-- GRID -->
      <div class="row g-4">

        <!-- EMPTY STATE -->
        <div
          v-if="galeriFiltered.length === 0"
          class="col-12 text-center py-5 text-muted">
          <i class="bi bi-image fs-1 d-block mb-3"></i>
          <h6 class="fw-bold">Belum ada foto di kategori ini</h6>
        </div>

        <!-- CARD -->
        <div
          v-else
          v-for="(item, i) in galeriFiltered"
          :key="item.id"
          class="col-sm-6 col-lg-4 gallery-wrap reveal"
          :style="{ transitionDelay: (i * 0.07) + 's' }">

          <div class="gallery-card" @click="openImage(item)">

            <!-- IMAGE -->
            <div class="gallery-img-wrap">
              <img :src="imgUrl(item.foto)" :alt="item.judul" />
              <div class="gallery-img-overlay">
                <i class="bi bi-zoom-in"></i>
              </div>
              <div class="gallery-hover-overlay">
                <div class="gallery-hover-content">
                  <div class="gallery-hover-icon">
                    <i class="bi bi-eye"></i>
                  </div>
                  <span class="gallery-hover-text">Klik untuk melihat detail</span>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>

      <!-- LIGHTBOX -->
      <transition name="fade">
        <div v-if="selectedImage" class="lightbox" @click.self="closeImage">
          <div class="lightbox-inner">

            <!-- CLOSE -->
            <button class="lightbox-close" @click="closeImage">
              <i class="bi bi-x-lg"></i>
            </button>

            <!-- IMAGE -->
            <img :src="imgUrl(selectedImage.foto)" :alt="selectedImage.judul" class="lightbox-img" />

            <!-- CAPTION -->
            <div class="lightbox-caption">
              <span class="lightbox-badge">{{ selectedImage.kategori }}</span>
              <h5 class="lightbox-judul">{{ selectedImage.judul }}</h5>
              <p class="lightbox-desc" v-if="selectedImage.deskripsi">
                {{ selectedImage.deskripsi }}
              </p>
            </div>

          </div>
        </div>
      </transition>

    </div>
    `,
  }).mount("#app-galeri");
}

// ============================================================
// KRITIK SARAN (VUE) - FINAL PREMIUM
// ============================================================
if (document.getElementById("app-kritik-saran")) {
  const { createApp } = Vue;

  createApp({
    data() {
      return {
        nama: "",
        email: "",
        jenis: "saran",
        pesan: "",
        maxChar: 1000,
        loading: false,
        errors: {},
      };
    },

    computed: {
      sisaChar() {
        return this.maxChar - this.pesan.length;
      },
    },

    watch: {
      pesan(val) {
        if (val.length > this.maxChar) {
          this.pesan = val.substring(0, this.maxChar);
        }
      },
    },

    methods: {
      validate() {
        this.errors = {};

        if (!this.nama.trim()) {
          this.errors.nama = "Nama wajib diisi.";
        }

        if (this.email && !/\S+@\S+\.\S+/.test(this.email)) {
          this.errors.email = "Format email tidak valid.";
        }

        if (!this.pesan.trim()) {
          this.errors.pesan = "Pesan wajib diisi.";
        } else if (this.pesan.trim().length < 10) {
          this.errors.pesan = "Pesan minimal 10 karakter.";
        }

        return Object.keys(this.errors).length === 0;
      },

      submit() {
        if (!this.validate()) return;

        this.loading = true;

        setTimeout(() => {
          document.getElementById("form-kritik-saran").submit();
        }, 500);
      },
    },

    mounted() {
      this.$nextTick(() => {
        const reveals = document.querySelectorAll(".reveal");

        const observer = new IntersectionObserver(
          (entries) => {
            entries.forEach((entry) => {
              if (entry.isIntersecting) {
                entry.target.classList.add("active");
              }
            });
          },
          { threshold: 0.15 },
        );

        reveals.forEach((el) => observer.observe(el));
      });
    },

    template: `
      <div class="form-kk">

        <!-- NAMA -->
        <div class="mb-3">
          <label class="form-label fw-600">
            Nama Lengkap <span class="text-danger">*</span>
          </label>

          <input v-model="nama" name="nama" type="text"
            class="form-control kk-input"
            :class="errors.nama ? 'is-invalid' : ''"
            placeholder="Masukkan nama Anda..." />

          <div v-if="errors.nama" class="invalid-feedback">
            {{ errors.nama }}
          </div>
        </div>

        <!-- EMAIL -->
        <div class="mb-3">
          <label class="form-label fw-600">
            Email <span class="text-muted">(opsional)</span>
          </label>

          <input v-model="email" name="email" type="email"
            class="form-control kk-input"
            :class="errors.email ? 'is-invalid' : ''"
            placeholder="email@contoh.com" />

          <div v-if="errors.email" class="invalid-feedback">
            {{ errors.email }}
          </div>
        </div>

        <!-- JENIS -->
        <div class="mb-3">
          <label class="form-label fw-600">
            Jenis Pesan <span class="text-danger">*</span>
          </label>

          <select v-model="jenis" name="jenis" class="form-select kk-input">
            <option value="kritik">Kritik</option>
            <option value="saran">Saran</option>
            <option value="pertanyaan">Pertanyaan</option>
            <option value="apresiasi">Apresiasi</option>
          </select>
        </div>

        <!-- PESAN -->
        <div class="mb-4">
          <label class="form-label fw-600">
            Pesan <span class="text-danger">*</span>
          </label>

          <textarea v-model="pesan" name="pesan"
            class="form-control kk-textarea"
            rows="5"
            :class="errors.pesan ? 'is-invalid' : ''"
            placeholder="Tulis kritik, saran, atau pertanyaan Anda..."></textarea>

          <div class="d-flex justify-content-between mt-1">

            <div v-if="errors.pesan" class="text-danger small">
              {{ errors.pesan }}
            </div>

            <small
              class="ms-auto"
              :class="sisaChar < 100 ? 'text-danger fw-bold' : 'text-muted'">
              {{ pesan.length }} / {{ maxChar }}
            </small>

          </div>
        </div>

        <!-- BUTTON -->
        <button @click="submit" type="button"
          class="btn btn-kk w-100 d-flex align-items-center justify-content-center gap-2">

          <span v-if="!loading">
            <i class="bi bi-send"></i> Kirim Pesan
          </span>

          <span v-else>
            <span class="spinner-border spinner-border-sm"></span>
            Mengirim...
          </span>

        </button>

      </div>
    `,
  }).mount("#app-kritik-saran");
}

// ============================================================
// EVENT (VUE)
// ============================================================
if (document.getElementById("app-event")) {
  const { createApp } = Vue;

  createApp({
    data() {
      return {
        filter: "all",
        search: "",
        events: window.__EVENT_DATA__ || [],
        selectedEvent: null,
      };
    },

    computed: {
      filteredEvents() {
        const keyword = (this.search || "").trim().toLowerCase();

        return this.events.filter((ev) => {
          const name = (ev.nama_event || "").toLowerCase();

          const matchFilter =
            this.filter === "all" || ev.status === this.filter;

          if (!keyword) return matchFilter;

          return matchFilter && name.includes(keyword);
        });
        2;
      },
    },

    methods: {
      setFilter(s) {
        this.filter = s;

        this.$nextTick(() => {
          const reveals = document.querySelectorAll(".reveal");

          reveals.forEach((el) => el.classList.remove("active"));

          const observer = new IntersectionObserver(
            (entries) => {
              entries.forEach((entry) => {
                if (entry.isIntersecting) {
                  entry.target.classList.add("active");
                }
              });
            },
            { threshold: 0.15 },
          );

          reveals.forEach((el) => observer.observe(el));
        });
      },

      formatStatus(s) {
        return s.replace("_", " ").replace(/\b\w/g, (l) => l.toUpperCase());
      },

      getDay(date) {
        return new Date(date).getDate();
      },

      getMonth(date) {
        return new Date(date).toLocaleDateString("id-ID", { month: "short" });
      },

      formatDate(date) {
        return new Date(date).toLocaleDateString("id-ID", {
          day: "numeric",
          month: "short",
          year: "numeric",
        });
      },

      formatTime(time) {
        return time ? time.substring(0, 5) : "";
      },

      statusClass(status) {
        if (status === "berlangsung") return "badge-status-berlangsung";
        if (status === "akan_datang") return "badge-status-akan";
        return "badge-status-selesai";
      },

      getIcon(link) {
        if (!link) return "bi bi-link-45deg";

        const l = link.toLowerCase();
        if (l.includes("instagram") || l.includes("ig"))
          return "bi bi-instagram";
        if (l.includes("facebook") || l.includes("fb")) return "bi bi-facebook";
        if (l.includes("wa") || l.includes("whatsapp")) return "bi bi-whatsapp";
        if (l.includes("tiktok")) return "bi bi-tiktok";
        return "bi bi-link-45deg";
      },

      openModal(ev) {
        this.selectedEvent = ev;

        const modal = new bootstrap.Modal(
          document.getElementById("eventModal"),
        );

        document.getElementById("modalTitle").innerText = ev.nama_event;
        document.getElementById("modalDesc").innerText = ev.deskripsi;

        document.getElementById("modalTime").innerText =
          (ev.jam_mulai ? this.formatTime(ev.jam_mulai) : "") +
          (ev.jam_selesai ? " - " + this.formatTime(ev.jam_selesai) : "") +
          " WITA";

        document.getElementById("modalLocation").innerText = ev.lokasi;

        const linkBox = document.getElementById("modalLinkBox");

        if (ev.link_info) {
          linkBox.classList.remove("d-none");
          document.getElementById("modalLink").href = ev.link_info;
        } else {
          linkBox.classList.add("d-none");
        }

        modal.show();
      },
    },

    mounted() {
      this.$nextTick(() => {
        const reveals = document.querySelectorAll(".reveal");

        const observer = new IntersectionObserver(
          (entries) => {
            entries.forEach((entry) => {
              if (entry.isIntersecting) {
                entry.target.classList.add("active");
              }
            });
          },
          { threshold: 0.15 },
        );

        reveals.forEach((el) => observer.observe(el));
      });
    },

    template: `
    <div>

      <!-- SEARCH + FILTER -->
      <div class="d-flex flex-wrap gap-2 mb-4 justify-content-between">

        <input type="text"
          v-model="search"
          class="form-control kk-search"
          placeholder="Cari event..."
          style="max-width:250px;">

        <div class="d-flex gap-2">
          <button v-for="s in ['all','akan_datang','berlangsung','selesai']"
            :key="s"
            @click="setFilter(s)"
            :class="['btn btn-kk-outline btn-sm filter-btn', filter === s ? 'active' : '']">

            {{ s === 'all' ? 'Semua' : formatStatus(s) }}

          </button>
        </div>

      </div>

      <!-- LIST -->
      <div class="row g-4">

        <div v-if="filteredEvents.length === 0"
          class="col-12 text-center py-5 text-muted">

          <i class="bi bi-calendar-x fs-1 d-block mb-3"></i>

          <h6 class="fw-bold">Event tidak ditemukan</h6>

          <p class="small mb-0">
            Tidak ada event untuk pencarian "<b>{{ search }}</b>"
          </p>

        </div>

        <div v-else
          v-for="ev in filteredEvents"
          :key="ev.id"
          class="col-lg-4 col-md-6 reveal event-item"
          @click="openModal(ev)">

          <div class="kk-event-card h-100">
            <div class="card-body d-flex gap-3">

              <div class="event-date-box flex-shrink-0">
                <div class="day">{{ getDay(ev.tanggal_mulai) }}</div>
                <div class="month">{{ getMonth(ev.tanggal_mulai) }}</div>
              </div>

              <div class="event-content">

                <span :class="['badge mb-2', statusClass(ev.status)]">
                  {{ formatStatus(ev.status) }}
                </span>

                <h6 class="fw-bold mb-2 mt-1">
                  {{ ev.nama_event }}
                </h6>

                <p class="text-muted small mb-2">
                  {{ ev.deskripsi.substring(0,80) }}...
                </p>

                <div class="small text-muted mb-1">
                  <i class="bi bi-calendar-event me-1"></i>
                  {{ formatDate(ev.tanggal_mulai) }}
                </div>

                <div v-if="ev.jam_mulai" class="small text-muted mb-1">
                  <i class="bi bi-clock me-1"></i>
                  {{ formatTime(ev.jam_mulai) }}
                  <span v-if="ev.jam_selesai">
                    - {{ formatTime(ev.jam_selesai) }}
                  </span> WITA
                </div>

                <div class="small text-muted mb-1">
                  <i class="bi bi-geo-alt me-1"></i>
                  {{ ev.lokasi }}
                </div>

              </div>

            </div>
          </div>

        </div>

      </div>

    </div>
    `,
  }).mount("#app-event");
}

// ============================================================
// UMKM (VUE)
// ============================================================
if (document.getElementById("app-umkm")) {
  const { createApp } = Vue;

  createApp({
    data() {
      return {
        cari: "",
        kategori: "semua",
        umkm: window.__UMKM_DATA__ || [],
      };
    },

    computed: {
      umkmFiltered() {
        const keyword = (this.cari || "").trim().toLowerCase();

        return this.umkm.filter((u) => {
          const nama = (u.nama_umkm || "").toLowerCase();

          const cocokKat =
            this.kategori === "semua" || u.kategori === this.kategori;

          if (!keyword) return cocokKat;

          return cocokKat && nama.includes(keyword);
        });
      },
    },

    methods: {
      imgUrl(foto) {
        if (!foto) return `/assets/img/umkm-default.jpg`;
        return `/assets/uploads/umkm/${foto}`;
      },
      resetAnimasi() {
        this.$nextTick(() => {
          const reveals = document.querySelectorAll(".reveal");

          reveals.forEach((el) => el.classList.remove("active"));

          const observer = new IntersectionObserver(
            (entries) => {
              entries.forEach((entry) => {
                if (entry.isIntersecting) {
                  entry.target.classList.add("active");
                }
              });
            },
            { threshold: 0.15 },
          );

          reveals.forEach((el) => observer.observe(el));
        });
      },
    },
    mounted() {
      this.resetAnimasi();
    },

    template: `
    <div>

      <!-- SEARCH + FILTER -->
      <div class="d-flex flex-wrap gap-2 mb-4 justify-content-between">

        <input v-model="cari" @input="resetAnimasi" type="text"
          class="form-control kk-search"
          placeholder="Cari UMKM..."
          style="max-width:250px;">

        <div class="d-flex gap-2">
          <button v-for="kat in ['semua','kuliner','kerajinan','souvenir','jasa']"
            :key="kat"
            @click="kategori = kat; resetAnimasi()"
            :class="['btn btn-kk-outline btn-sm filter-btn', kategori === kat ? 'active' : '']">
            {{ kat }}
          </button>
        </div>

      </div>

      <!-- GRID -->
      <div class="row g-4">

        <!-- EMPTY -->
        <div v-if="umkmFiltered.length === 0"
          class="col-12 text-center py-5 text-muted">

          <i class="bi bi-shop fs-1 d-block mb-3"></i>

          <h6 class="fw-bold">UMKM tidak ditemukan</h6>

          <p class="small mb-0">
            Tidak ada hasil untuk "<b>{{ cari }}</b>"
          </p>

        </div>

        <!-- DATA -->
        <div v-else
          v-for="(u, i) in umkmFiltered"
          :key="u.id"
          class="col-sm-6 col-lg-3 reveal"
          :style="{ transitionDelay: (i * 0.08) + 's' }">

          <div class="umkm-card card-kk h-100">

            <div class="umkm-img">
              <img :src="imgUrl(u.foto)" :alt="u.nama_umkm" />
            </div>

            <div class="card-body">

              <span class="umkm-badge">{{ u.kategori }}</span>

              <h6 class="umkm-title">{{ u.nama_umkm }}</h6>

              <div class="umkm-meta">
                <span class="umkm-owner">
                  <i class="bi bi-people me-1"></i> {{ u.pemilik }}
                </span>
              </div>

              <p class="umkm-desc">
                {{ u.produk_unggulan }}
              </p>

              <a v-if="u.kontak"
                :href="'tel:' + u.kontak"
                class="btn btn-kk-outline btn-sm w-100">
                <i class="bi bi-telephone me-1"></i>Hubungi
              </a>

            </div>

          </div>

        </div>

      </div>

    </div>
    `,
  }).mount("#app-umkm");
}

// ============================================================
// ADMIN GALERI — Search, Filter, Toggle, Stats Real-time
// ============================================================
document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchInput");
  const filterSelect = document.getElementById("filterKategori");
  const items = document.querySelectorAll(".galeri-item");
  const statPublish = document.getElementById("publish");
  const statHidden = document.getElementById("hidden");

  // ----------------------------------------------------------
  // SEARCH & FILTER
  // ----------------------------------------------------------
  function filterGaleri() {
    const keyword = (searchInput?.value || "").trim().toLowerCase();
    const kategori = (filterSelect?.value || "").toLowerCase();

    items.forEach(function (item) {
      const judul = item.dataset.judul || "";
      const kat = item.dataset.kategori || "";

      const matchSearch = !keyword || judul.includes(keyword);
      const matchKategori = !kategori || kat === kategori;

      item.style.display = matchSearch && matchKategori ? "" : "none";
    });
  }

  searchInput?.addEventListener("input", filterGaleri);
  filterSelect?.addEventListener("change", filterGaleri);

  // ----------------------------------------------------------
  // UPDATE STATS REAL-TIME
  // ----------------------------------------------------------
  function updateStats() {
    let publish = 0;
    let hidden = 0;

    document.querySelectorAll(".toggle-publish").forEach(function (t) {
      t.checked ? publish++ : hidden++;
    });

    if (statPublish) statPublish.textContent = publish;
    if (statHidden) statHidden.textContent = hidden;
  }
});
