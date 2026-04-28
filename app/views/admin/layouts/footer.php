<?php
?>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= BASE_URL ?>/assets/js/swal-helper.js"></script>

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
    (function() {
        const body = document.body;
        const sidebar = document.querySelector('.sidebar-admin');
        const toggleBtn = document.getElementById('adminMobileToggle');
        const overlay = document.getElementById('adminSidebarOverlay');

        if (!sidebar || !toggleBtn || !overlay) return;

        const setToggleState = function(isOpen) {
            const icon = toggleBtn.querySelector('i');
            toggleBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            if (icon) {
                icon.className = isOpen ? 'bi bi-x-lg' : 'bi bi-list';
            }
        };

        const closeSidebar = function() {
            body.classList.remove('sidebar-mobile-open');
            setToggleState(false);
        };

        toggleBtn.addEventListener('click', function() {
            const willOpen = !body.classList.contains('sidebar-mobile-open');
            body.classList.toggle('sidebar-mobile-open');
            setToggleState(willOpen);
        });

        overlay.addEventListener('click', closeSidebar);

        sidebar.querySelectorAll('a, button').forEach(function(el) {
            el.addEventListener('click', closeSidebar);
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth > 991) {
                closeSidebar();
            }
        });

        setToggleState(false);
    })();

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


<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>


<script src="<?= BASE_URL ?>/assets/js/main.js"></script>

<?= $extra_js ?? '' ?>

</body>

</html>