(function () {
  const menuBtn = document.querySelector('.menu');
  const nav = document.querySelector('.navlinks');
  if (menuBtn) {
    menuBtn.addEventListener('click', () => nav?.classList.toggle('open'));
  }
  document.querySelectorAll('.navlinks a').forEach((a) => {
    a.addEventListener('click', () => nav?.classList.remove('open'));
  });
  document.querySelectorAll('[data-year]').forEach((el) => {
    el.textContent = new Date().getFullYear();
  });

  const io = new IntersectionObserver(
    (entries) => entries.forEach((e) => e.isIntersecting && e.target.classList.add('show')),
    { threshold: 0.08 }
  );
  document.querySelectorAll('.reveal').forEach((el) => io.observe(el));
  if (window.lucide) {
    lucide.createIcons();
  }

  const settings = window.ZBT_SETTINGS || {};
  document.querySelectorAll('[data-address]').forEach((e) => {
    e.textContent = settings.address || 'Warsak Road, Peshawar, Pakistan';
  });
  document.querySelectorAll('[data-email]').forEach((e) => {
    const email = settings.email || 'info@zamanbuildtech.com';
    e.textContent = email;
    if (e.tagName === 'A') {
      e.href = 'mailto:' + email;
    }
  });
  document.querySelectorAll('[data-phone]').forEach((e) => {
    const phone = settings.phone || '+92 300 0000000';
    e.textContent = phone;
    if (e.tagName === 'A') {
      e.href = 'tel:' + phone.replace(/\s/g, '');
    }
  });

  const pfilters = document.querySelector('[data-property-filters]');
  if (pfilters) {
    pfilters.addEventListener('input', () => {
      const q = (pfilters.querySelector('[name=q]')?.value || '').toLowerCase();
      const type = pfilters.querySelector('[name=type]')?.value || '';
      const status = pfilters.querySelector('[name=status]')?.value || '';
      const area = pfilters.querySelector('[name=area]')?.value || '';
      document.querySelectorAll('[data-property-grid] .property-card').forEach((c) => {
        const txt = c.innerText.toLowerCase();
        const ok =
          (!q || txt.includes(q)) &&
          (!type || c.dataset.type === type) &&
          (!status || c.dataset.status === status) &&
          (!area || (c.dataset.area || '').includes(area));
        c.style.display = ok ? '' : 'none';
      });
    });
  }

  const projectFilters = document.querySelector('[data-project-filters]');
  if (projectFilters) {
    projectFilters.addEventListener('change', () => {
      const cat = projectFilters.querySelector('[name=category]')?.value || '';
      const status = projectFilters.querySelector('[name=status]')?.value || '';
      document.querySelectorAll('[data-project-card]').forEach((c) => {
        c.style.display =
          (!cat || c.dataset.category === cat) && (!status || c.dataset.status === status) ? '' : 'none';
      });
    });
  }

  if (!document.body.classList.contains('admin-body')) {
    const btn = document.createElement('button');
    btn.className = 'whatsapp-float';
    btn.title = 'WhatsApp';
    btn.innerHTML = '☎';
    btn.onclick = () => {
      const n = (settings.whatsapp || settings.phone || '').replace(/\D/g, '');
      const txt = encodeURIComponent(
        'Hello Zaman Build Tech & Real Estate, I would like to know more about your services and properties.'
      );
      window.open('https://wa.me/' + n + '?text=' + txt, '_blank');
    };
    document.body.appendChild(btn);
  }
})();
