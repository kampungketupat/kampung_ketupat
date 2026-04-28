<?php
// footer admin
?>
</div> <!-- end admin-container -->
</div> <!-- end admin-main -->

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= BASE_URL ?>/assets/js/swal-helper.js"></script>

<!-- FLASH MESSAGE -->
<?php if (!empty($_SESSION['success'])): ?>
    <script>
        SwalHelper.success("<?= $_SESSION['success'] ?>");
    </script>
<?php unset($_SESSION['success']);
endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
    <script>
        SwalHelper.error("<?= $_SESSION['error'] ?>");
    </script>
<?php unset($_SESSION['error']);
endif; ?>

<?php if (!empty($_SESSION['welcome'])): ?>
    <script>
        SwalHelper.welcome("<?= $_SESSION['welcome'] ?>");
    </script>
<?php unset($_SESSION['welcome']);
endif; ?>


<script>
    window.logout = function() {
        SwalHelper.logout("<?= BASE_URL ?>/admin/logout");
    }

    window.hapus = function(url, id) {
        SwalHelper.confirmDelete(url, id);
    }

    window.submitForm = function(e) {
        e.preventDefault();
        SwalHelper.confirmSubmit(e.target);
        return false;
    }
</script>

<!-- Vue -->
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<!-- Main JS -->
<script src="<?= BASE_URL ?>/assets/js/main.js"></script>

<?= $extra_js ?? '' ?>

</body>

</html>