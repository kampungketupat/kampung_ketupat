// ===============================
// SWEETALERT HELPER GLOBAL
// ===============================

const SwalHelper = {
  confirmDelete(url) {
    Swal.fire({
      title: "Yakin hapus data?",
      text: "Data tidak bisa dikembalikan!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#6c757d",
      confirmButtonText: "Ya, hapus!",
      cancelButtonText: "Batal",
    }).then((result) => {
      if (result.isConfirmed) window.location.href = url;
    });
  },

  confirm(title, text, url, confirmColor = "#f97316") {
    Swal.fire({
      title: title,
      text: text,
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: confirmColor,
      cancelButtonColor: "#6b7280",
      confirmButtonText: "Ya, lanjutkan",
      cancelButtonText: "Batal",
    }).then((result) => {
      if (result.isConfirmed) window.location.href = url;
    });
  },

  // Konfirmasi dengan input tanggal selesai untuk publikasi
  confirmPublish(url) {
    Swal.fire({
      title: "Tampilkan ke Publik",
      html: `
                <p style="font-size:14px;color:#6b7280;margin-bottom:16px;">
                    Pilih sampai kapan pesan ini ditampilkan ke pengunjung.
                </p>
                <div style="text-align:left;margin-bottom:8px;">
                    <label style="font-size:13px;font-weight:600;color:#374151;">
                        Tanggal Mulai Tayang
                    </label>
                    <input type="date" id="swal-mulai" class="swal2-input" 
                           style="margin:6px 0 0;" />
                </div>
                <div style="text-align:left;">
                    <label style="font-size:13px;font-weight:600;color:#374151;">
                        Tanggal Selesai Tayang
                    </label>
                    <input type="date" id="swal-selesai" class="swal2-input"
                           style="margin:6px 0 0;" />
                </div>
            `,
      icon: "info",
      showCancelButton: true,
      confirmButtonColor: "#16a34a",
      cancelButtonColor: "#6b7280",
      confirmButtonText: "Tampilkan",
      cancelButtonText: "Batal",
      didOpen: () => {
        // Default: mulai hari ini, selesai seminggu lagi
        const today = new Date().toISOString().split("T")[0];
        const nextWeek = new Date(Date.now() + 7 * 86400000)
          .toISOString()
          .split("T")[0];
        document.getElementById("swal-mulai").value = today;
        document.getElementById("swal-selesai").value = nextWeek;
      },
      preConfirm: () => {
        const mulai = document.getElementById("swal-mulai").value;
        const selesai = document.getElementById("swal-selesai").value;
        if (!mulai || !selesai) {
          Swal.showValidationMessage("Tanggal mulai dan selesai wajib diisi");
          return false;
        }
        if (selesai < mulai) {
          Swal.showValidationMessage(
            "Tanggal selesai tidak boleh sebelum tanggal mulai",
          );
          return false;
        }
        return { mulai, selesai };
      },
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href =
          url +
          "&mulai=" +
          result.value.mulai +
          "&selesai=" +
          result.value.selesai;
      }
    });
  },

  success(msg) {
    Swal.fire({
      toast: true,
      position: "top-end",
      icon: "success",
      title: msg,
      showConfirmButton: false,
      timer: 2500,
    });
  },

  error(msg) {
    Swal.fire({
      toast: true,
      position: "top-end",
      icon: "error",
      title: msg,
      showConfirmButton: false,
      timer: 3000,
    });
  },

  welcome(name) {
    Swal.fire({
      icon: "success",
      title: "Selamat Datang 👋",
      text: "Halo, " + name,
      timer: 2000,
      showConfirmButton: false,
    });
  },

  confirmSubmit(form) {
    Swal.fire({
      title: "Simpan data?",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Ya, simpan",
      cancelButtonText: "Batal",
    }).then((result) => {
      if (result.isConfirmed) form.submit();
    });
  },

  logout(url) {
    Swal.fire({
      title: "Yakin ingin logout?",
      text: "Sesi admin akan berakhir",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#dc3545",
      confirmButtonText: "Ya, logout",
      cancelButtonText: "Batal",
    }).then((result) => {
      if (result.isConfirmed) window.location.href = url;
    });
  },
};
