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
      if (result.isConfirmed) {
        window.location.href = url;
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
      if (result.isConfirmed) {
        form.submit();
      }
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
      if (result.isConfirmed) {
        window.location.href = url;
      }
    });
  },
};
