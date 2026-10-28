(function () {
  const layout = document.querySelector('.admin-layout');
  const toggle = document.querySelector('[data-admin-menu-toggle]');
  const backdrop = document.querySelector('[data-admin-backdrop]');

  if (!layout || !toggle) {
    return;
  }

  function closeSidebar() {
    layout.classList.remove('sidebar-open');
    document.body.classList.remove('admin-nav-open');
  }

  function openSidebar() {
    layout.classList.add('sidebar-open');
    document.body.classList.add('admin-nav-open');
  }

  toggle.addEventListener('click', () => {
    if (layout.classList.contains('sidebar-open')) {
      closeSidebar();
    } else {
      openSidebar();
    }
  });

  if (backdrop) {
    backdrop.addEventListener('click', closeSidebar);
  }

  layout.querySelectorAll('.nav a, .nav button[type="submit"]').forEach((el) => {
    el.addEventListener('click', () => {
      if (window.matchMedia('(max-width: 1000px)').matches) {
        closeSidebar();
      }
    });
  });
})();
