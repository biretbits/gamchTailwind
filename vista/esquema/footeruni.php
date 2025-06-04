<script>
  // Captura el offcanvas, el botón de abrir y el botón de cerrar
  const offcanvas = document.getElementById('offcanvasWithBackdrop');
  const openLink = document.getElementById('openOffcanvasLink'); // El enlace del header
  const openBtn = document.getElementById('openOffcanvasBtn'); // El botón debajo del header
  const closeBtn = document.getElementById('closeOffcanvasBtn');

  // Evento para abrir el offcanvas desde el enlace
  openLink.addEventListener('click', () => {
    offcanvas.classList.remove('-translate-x-full');
    offcanvas.setAttribute('aria-hidden', 'false');
    openBtn.setAttribute('aria-expanded', 'true');
  });

  // Evento para abrir el offcanvas desde el botón
  openBtn.addEventListener('click', () => {
    offcanvas.classList.remove('-translate-x-full');
    offcanvas.setAttribute('aria-hidden', 'false');
    openBtn.setAttribute('aria-expanded', 'true');
  });

  // Evento para cerrar el offcanvas
  closeBtn.addEventListener('click', () => {
    offcanvas.classList.add('-translate-x-full');
    offcanvas.setAttribute('aria-hidden', 'true');
    openBtn.setAttribute('aria-expanded', 'false');
  });

  // Cierra el offcanvas si se hace clic fuera de él
  window.addEventListener('click', (e) => {
    if (!offcanvas.contains(e.target) && !openBtn.contains(e.target) && !openLink.contains(e.target)) {
      if (!offcanvas.classList.contains('-translate-x-full')) {
        offcanvas.classList.add('-translate-x-full');
        offcanvas.setAttribute('aria-hidden', 'true');
        openBtn.setAttribute('aria-expanded', 'false');
      }
    }
  });
</script>


</div>
</div>
<footer class="bg-gray-900 text-center">
  <!-- Redes sociales -->
  <div class="container mx-auto py-4">
    <section class="mb-0">
      <a
        href="https://www.facebook.com/people/Gobierno-Aut%C3%B3nomo-Municipal-de-Challapata/100076076944999/"
        role="button"
         target="_blank"
        aria-label="Facebook"
        class="inline-flex items-center justify-center w-10 h-10 m-1 border border-white rounded-full text-white hover:bg-white hover:text-gray-900 transition"
      >
        <i class="fa fa-facebook-f"></i>
      </a>

      <!-- WhatsApp -->
      <a
        href="#!"
        role="button"
         target="_blank"
        aria-label="WhatsApp"
        class="inline-flex items-center justify-center w-10 h-10 m-1 border border-white rounded-full text-white hover:bg-white hover:text-gray-900 transition"
      >
        <i class="fa fa-whatsapp"></i>
      </a>

      <!-- YouTube -->
      <a
        href="https://www.youtube.com/@GAM-Challapata"
        role="button"
         target="_blank"
        aria-label="YouTube"
        class="inline-flex items-center justify-center w-10 h-10 m-1 border border-white rounded-full text-white hover:bg-white hover:text-gray-900 transition"
      >
        <i class="fa fa-youtube"></i>
      </a>
    </section>
  </div>

  <!-- Copyright -->
  <div class="text-white bg-black bg-opacity-20 py-2 text-sm">
    © 2025 Copyright:
    <span class="font-semibold">Gobierno Autónomo Municipal de Challapata</span>
  </div>
</footer>

  <!-- Tailwind CSS CDN -->

  <script src='/vista/activos/browser@4.js'></script>

  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <!-- jQuery (debe ir antes que Select2) -->
  <script src="/vista/activos/jquery-3.5.1.min.js"></script>

  <!-- Bootstrap JS (comentado porque no lo estás utilizando) -->
  <!--<script src="/vista/activos/bootstrap/bootstrap.min.js"></script>-->

  <!-- Select2 JS -->
  <script src="/vista/activos/select2/js/select2.min.js"></script>

  <!-- PDF.js scripts -->
  <script src="/vista/pdfjss/build/pdf.js"></script>
  <script src="/vista/pdfjss/web/pdf_viewer.js"></script>

  <!-- SweetAlert2 JS -->
  <script src="/vista/activos/sweetAlert2/sweetalert2.min.js"></script>

  <!-- Tu archivo JS personalizado -->
  <script src="/vista/activos/app.js"></script>
</body>

</html>
