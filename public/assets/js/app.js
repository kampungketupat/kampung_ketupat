const BASE_URL = window.location.pathname.includes("kampung-ketupat")
  ? "/kampung-ketupat"
  : "";

window.addEventListener("scroll", () => {
  const navbar = document.getElementById("mainNavbar");
  if (navbar) {
    navbar.classList.toggle("scrolled", window.scrollY > 50);
  }
});

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

if (document.getElementById("app-galeri")) {
  const { createApp } = Vue;

  createApp({
    data() {
      return {
        kategoriAktif: "semua",
        galeri: window.__GALERI_DATA__ || [],
        selectedImage: null,
        selectedIndex: 0,
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

        this.$nextTick(() => {
          document.querySelectorAll(".gallery-wrap").forEach((el) => {
            el.classList.remove("active");
          });
          setTimeout(() => {
            document.querySelectorAll(".gallery-wrap").forEach((el, i) => {
              setTimeout(() => el.classList.add("active"), i * 80);
            });
          }, 50);
        });
      },

      imgUrl(foto) {
        if (!foto) return "";
        return foto.startsWith("http")
          ? foto
          : `${BASE_URL}/assets/uploads/galeri/${foto}`;
      },

      openImage(item) {
        this.selectedImage = item;
        this.selectedIndex = this.galeriFiltered.indexOf(item);
        document.body.style.overflow = "hidden";
      },

      closeImage() {
        this.selectedImage = null;
        document.body.style.overflow = "";
      },

      prevImage() {
        if (this.selectedIndex > 0) {
          this.selectedIndex--;
          this.selectedImage = this.galeriFiltered[this.selectedIndex];
        }
      },

      nextImage() {
        if (this.selectedIndex < this.galeriFiltered.length - 1) {
          this.selectedIndex++;
          this.selectedImage = this.galeriFiltered[this.selectedIndex];
        }
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

      document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") this.closeImage();
        if (e.key === "ArrowLeft") this.prevImage();
        if (e.key === "ArrowRight") this.nextImage();
      });
    },

    template: `
    <div>

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

      <div class="row g-4">

        <div
          v-if="galeriFiltered.length === 0"
          class="col-12 text-center py-5 text-muted">
          <i class="bi bi-image fs-1 d-block mb-3"></i>
          <h6 class="fw-bold">Belum ada foto di kategori ini</h6>
        </div>

        <div
          v-else
          v-for="(item, i) in galeriFiltered"
          :key="item.id"
          class="col-sm-6 col-lg-4 gallery-wrap reveal"
          :style="{ transitionDelay: (i * 0.07) + 's' }">

          <div class="gallery-card" @click="openImage(item)">

            <div class="gallery-img-wrap">
              <img :src="imgUrl(item.foto)" :alt="item.judul" />
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

      <transition name="fade">
        <div v-if="selectedImage" class="lightbox" @click.self="closeImage">
          <div class="lightbox-inner">

            <button class="lightbox-close" @click="closeImage">
              <i class="bi bi-x-lg"></i>
            </button>

            <button class="lightbox-arrow lightbox-prev"
              @click="prevImage"
              :disabled="selectedIndex === 0"
              :class="{ 'arrow-disabled': selectedIndex === 0 }">
              <i class="bi bi-chevron-left"></i>
            </button>

            <img :src="imgUrl(selectedImage.foto)" :alt="selectedImage.judul" class="lightbox-img" />

            <button class="lightbox-arrow lightbox-next"
              @click="nextImage"
              :disabled="selectedIndex === galeriFiltered.length - 1"
              :class="{ 'arrow-disabled': selectedIndex === galeriFiltered.length - 1 }">
              <i class="bi bi-chevron-right"></i>
            </button>

            
            <div class="lightbox-caption">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="lightbox-badge">{{ selectedImage.kategori }}</span>
                <span class="lightbox-counter">{{ selectedIndex + 1 }} / {{ galeriFiltered.length }}</span>
              </div>
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
          const matchFilter = this.filter === "all" || ev.status === this.filter;
          if (!keyword) return matchFilter;
          return matchFilter && name.includes(keyword);
        });
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
                if (entry.isIntersecting) entry.target.classList.add("active");
              });
            },
            { threshold: 0.15 }
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
          month: "long",
          year: "numeric",
        });
      },

      formatTime(time) {
        return time ? time.substring(0, 5) : "";
      },

      fotoUrl(foto) {
        if (!foto) return "";
        return foto.startsWith("http")
          ? foto
          : BASE_URL + "/assets/uploads/event/" + foto;
      },

      statusClass(status) {
        if (status === "berlangsung") return "badge-status-berlangsung";
        if (status === "akan_datang") return "badge-status-akan";
        return "badge-status-selesai";
      },

      getIcon(link) {
        if (!link) return "bi bi-link-45deg";
        const l = link.toLowerCase();
        if (l.includes("instagram") || l.includes("ig")) return "bi bi-instagram";
        if (l.includes("facebook") || l.includes("fb")) return "bi bi-facebook";
        if (l.includes("wa") || l.includes("whatsapp")) return "bi bi-whatsapp";
        if (l.includes("tiktok")) return "bi bi-tiktok";
        return "bi bi-link-45deg";
      },

      openDetail(ev) {
        this.selectedEvent = ev;
        document.body.style.overflow = "hidden";
      },

      closeDetail() {
        this.selectedEvent = null;
        document.body.style.overflow = "";
      },
    },

    mounted() {
      this.$nextTick(() => {
        const reveals = document.querySelectorAll(".reveal");
        const observer = new IntersectionObserver(
          (entries) => {
            entries.forEach((entry) => {
              if (entry.isIntersecting) entry.target.classList.add("active");
            });
          },
          { threshold: 0.15 }
        );
        reveals.forEach((el) => observer.observe(el));
      });

      document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") this.closeDetail();
      });
    },

    template: `
    <div>

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
          @click="openDetail(ev)">

          <div class="kk-event-card h-100">

            
            <div v-if="ev.foto" class="ev-foto-wrap">
              <img :src="fotoUrl(ev.foto)" :alt="ev.nama_event" />
              <span :class="['ev-foto-badge', statusClass(ev.status)]">
                {{ formatStatus(ev.status) }}
              </span>
            </div>

            <div class="card-body d-flex gap-3">

              <div class="event-date-box flex-shrink-0">
                <div class="day">{{ getDay(ev.tanggal_mulai) }}</div>
                <div class="month">{{ getMonth(ev.tanggal_mulai) }}</div>
              </div>

              <div class="event-content">

                <span v-if="!ev.foto" :class="['badge mb-2', statusClass(ev.status)]">
                  {{ formatStatus(ev.status) }}
                </span>

                <h6 class="fw-bold mb-2 mt-1">{{ ev.nama_event }}</h6>

                <p class="text-muted small mb-2">
                  {{ ev.deskripsi ? ev.deskripsi.substring(0, 80) + '...' : '' }}
                </p>

                <div class="small text-muted mb-1">
                  <i class="bi bi-calendar-event me-1"></i>
                  {{ formatDate(ev.tanggal_mulai) }}
                </div>

                <div v-if="ev.jam_mulai" class="small text-muted mb-1">
                  <i class="bi bi-clock me-1"></i>
                  {{ formatTime(ev.jam_mulai) }}
                  <span v-if="ev.jam_selesai">- {{ formatTime(ev.jam_selesai) }}</span>
                  WITA
                </div>

                <div class="small text-muted mb-1">
                  <i class="bi bi-geo-alt me-1"></i>
                  {{ ev.lokasi }}
                </div>

                <div class="ev-detail-hint">
                  <i class="bi bi-eye me-1"></i>Lihat Detail
                </div>

              </div>
            </div>

          </div>
        </div>

      </div>

      <transition name="ev-modal-fade">
        <div v-if="selectedEvent"
          class="ev-modal-overlay"
          @click.self="closeDetail">

          <div class="ev-modal-box">

            <button class="ev-modal-close" @click="closeDetail">
              <i class="bi bi-x-lg"></i>
            </button>

            <div v-if="selectedEvent.foto" class="ev-modal-img">
              <img :src="fotoUrl(selectedEvent.foto)" :alt="selectedEvent.nama_event" />
              <span :class="['ev-modal-status', statusClass(selectedEvent.status)]">
                {{ formatStatus(selectedEvent.status) }}
              </span>
            </div>

            
            <div v-else class="ev-modal-header-nofoto">
              <span :class="['ev-modal-status-inline', statusClass(selectedEvent.status)]">
                {{ formatStatus(selectedEvent.status) }}
              </span>
            </div>

            
            <div class="ev-modal-content">

              
              <div class="ev-modal-datebox">
                <div class="ev-modal-day">{{ getDay(selectedEvent.tanggal_mulai) }}</div>
                <div class="ev-modal-month">{{ getMonth(selectedEvent.tanggal_mulai) }}</div>
              </div>

              <h4 class="ev-modal-title">{{ selectedEvent.nama_event }}</h4>

              
              <div class="ev-modal-info">

                <div class="ev-modal-info-item">
                  <div class="ev-modal-info-icon">
                    <i class="bi bi-calendar3"></i>
                  </div>
                  <div>
                    <span class="ev-modal-info-label">Tanggal</span>
                    <p class="ev-modal-info-val">
                      {{ formatDate(selectedEvent.tanggal_mulai) }}
                      <template v-if="selectedEvent.tanggal_selesai && selectedEvent.tanggal_selesai !== selectedEvent.tanggal_mulai">
                        &ndash; {{ formatDate(selectedEvent.tanggal_selesai) }}
                      </template>
                    </p>
                  </div>
                </div>

                <div v-if="selectedEvent.jam_mulai" class="ev-modal-info-item">
                  <div class="ev-modal-info-icon">
                    <i class="bi bi-clock"></i>
                  </div>
                  <div>
                    <span class="ev-modal-info-label">Waktu</span>
                    <p class="ev-modal-info-val">
                      {{ formatTime(selectedEvent.jam_mulai) }}
                      <span v-if="selectedEvent.jam_selesai">&ndash; {{ formatTime(selectedEvent.jam_selesai) }}</span>
                      WITA
                    </p>
                  </div>
                </div>

                <div class="ev-modal-info-item">
                  <div class="ev-modal-info-icon">
                    <i class="bi bi-geo-alt-fill"></i>
                  </div>
                  <div>
                    <span class="ev-modal-info-label">Lokasi</span>
                    <p class="ev-modal-info-val">{{ selectedEvent.lokasi }}</p>
                  </div>
                </div>

              </div>

              
              <div v-if="selectedEvent.deskripsi" class="ev-modal-desc">
                <h6 class="ev-modal-desc-label">Tentang Event</h6>
                <p>{{ selectedEvent.deskripsi }}</p>
              </div>

              <a v-if="selectedEvent.link_info"
                :href="selectedEvent.link_info"
                target="_blank"
                class="ev-modal-link-btn"
                @click.stop>
                <i :class="getIcon(selectedEvent.link_info)"></i>
                Info Selengkapnya
              </a>

            </div>
          </div>
        </div>
      </transition>

    </div>
    `,
  }).mount("#app-event");
}

if (document.getElementById("app-umkm")) {
  const { createApp } = Vue;

  createApp({
    data() {
      return {
        cari: "",
        kategori: "semua",
        umkm: window.__UMKM_DATA__ || [],
        selectedUmkm: null,
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
        if (!foto) return `${BASE_URL}/assets/img/umkm-default.jpg`;
        return `${BASE_URL}/assets/uploads/umkm/${foto}`;
      },

      resetAnimasi() {
        this.$nextTick(() => {
          const reveals = document.querySelectorAll(".reveal");
          reveals.forEach((el) => el.classList.remove("active"));
          const observer = new IntersectionObserver(
            (entries) => {
              entries.forEach((entry) => {
                if (entry.isIntersecting) entry.target.classList.add("active");
              });
            },
            { threshold: 0.15 },
          );
          reveals.forEach((el) => observer.observe(el));
        });
      },

      openDetail(u) {
        this.selectedUmkm = u;
        document.body.style.overflow = "hidden";
      },

      closeDetail() {
        this.selectedUmkm = null;
        document.body.style.overflow = "";
      },
    },

    mounted() {
      this.resetAnimasi();

      document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") this.closeDetail();
      });
    },

    template: `
    <div>

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

      <div class="row g-4">

        <div v-if="umkmFiltered.length === 0"
          class="col-12 text-center py-5 text-muted">
          <i class="bi bi-shop fs-1 d-block mb-3"></i>
          <h6 class="fw-bold">UMKM tidak ditemukan</h6>
          <p class="small mb-0">Tidak ada hasil untuk "<b>{{ cari }}</b>"</p>
        </div>

        <div v-else
          v-for="(u, i) in umkmFiltered"
          :key="u.id"
          class="col-sm-6 col-lg-3 reveal"
          :style="{ transitionDelay: (i * 0.08) + 's' }">

          <div class="umkm-card-v2" @click="openDetail(u)">

            <div class="umkm-v2-img">
              <img :src="imgUrl(u.foto)" :alt="u.nama_umkm" />
              <span class="umkm-v2-kategori-badge">{{ u.kategori }}</span>
            </div>

            <div class="umkm-v2-body">

              <h6 class="umkm-v2-title">{{ u.nama_umkm }}</h6>

              <div v-if="u.pemilik" class="umkm-v2-meta">
                <i class="bi bi-person"></i>
                <span>{{ u.pemilik }}</span>
              </div>

              <div v-if="u.alamat" class="umkm-v2-meta">
                <i class="bi bi-geo-alt"></i>
                <span>{{ u.alamat }}</span>
              </div>

              <p v-if="u.produk_unggulan" class="umkm-v2-produk">
                <i class="bi bi-stars me-1"></i>{{ u.produk_unggulan }}
              </p>

              <p v-if="u.deskripsi" class="umkm-v2-desc">
                {{ u.deskripsi.length > 80 ? u.deskripsi.substring(0,80) + '...' : u.deskripsi }}
              </p>

              <div class="umkm-v2-detail-hint">
                <i class="bi bi-eye me-1"></i>Lihat Detail
              </div>

            </div>
          </div>
        </div>

      </div>

      <transition name="umkm-fade">
        <div v-if="selectedUmkm"
          class="umkm-modal-overlay"
          @click.self="closeDetail">

          <div class="umkm-modal-box">

            <button class="umkm-modal-close" @click="closeDetail">
              <i class="bi bi-x-lg"></i>
            </button>

            <div class="umkm-modal-img">
              <img :src="imgUrl(selectedUmkm.foto)" :alt="selectedUmkm.nama_umkm" />
              <span class="umkm-modal-kategori">{{ selectedUmkm.kategori }}</span>
            </div>

            <div class="umkm-modal-content">

              <h4 class="umkm-modal-title">{{ selectedUmkm.nama_umkm }}</h4>

              <div class="umkm-modal-info">

                <div v-if="selectedUmkm.pemilik" class="umkm-modal-info-item">
                  <div class="umkm-modal-info-icon">
                    <i class="bi bi-person-fill"></i>
                  </div>
                  <div>
                    <span class="umkm-modal-info-label">Pemilik</span>
                    <p class="umkm-modal-info-val">{{ selectedUmkm.pemilik }}</p>
                  </div>
                </div>

                <div v-if="selectedUmkm.alamat" class="umkm-modal-info-item">
                  <div class="umkm-modal-info-icon">
                    <i class="bi bi-geo-alt-fill"></i>
                  </div>
                  <div>
                    <span class="umkm-modal-info-label">Alamat</span>
                    <p class="umkm-modal-info-val">{{ selectedUmkm.alamat }}</p>
                  </div>
                </div>

                <div v-if="selectedUmkm.produk_unggulan" class="umkm-modal-info-item">
                  <div class="umkm-modal-info-icon">
                    <i class="bi bi-stars"></i>
                  </div>
                  <div>
                    <span class="umkm-modal-info-label">Produk Unggulan</span>
                    <p class="umkm-modal-info-val">{{ selectedUmkm.produk_unggulan }}</p>
                  </div>
                </div>

                <div v-if="selectedUmkm.kontak" class="umkm-modal-info-item">
                  <div class="umkm-modal-info-icon">
                    <i class="bi bi-telephone-fill"></i>
                  </div>
                  <div>
                    <span class="umkm-modal-info-label">Kontak</span>
                    <p class="umkm-modal-info-val">{{ selectedUmkm.kontak }}</p>
                  </div>
                </div>

              </div>

              
              <div v-if="selectedUmkm.deskripsi" class="umkm-modal-desc">
                <h6 class="umkm-modal-desc-label">Tentang Usaha</h6>
                <p>{{ selectedUmkm.deskripsi }}</p>
              </div>

              
              <a v-if="selectedUmkm.kontak"
                :href="'https://wa.me/' + selectedUmkm.kontak.replace(/[^0-9]/g,'')"
                target="_blank"
                class="umkm-modal-wa-btn"
                @click.stop>
                <i class="bi bi-whatsapp"></i>
                Hubungi via WhatsApp
              </a>

            </div>
          </div>
        </div>
      </transition>

    </div>
    `,
  }).mount("#app-umkm");
}
