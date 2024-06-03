<style>
    .content-wrapper {
            flex: 1;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background: #f8f9fa;
            position: relative;
            bottom: 0;
            width: 100%;
        }
</style>

<footer class="footer mt-auto py-3 bg-white">
  <div class="container">
      <span class="text-muted">&copy; {{ date('Y') }} Agrogestor. Todos los derechos reservados.</span>
  </div>
</footer>
