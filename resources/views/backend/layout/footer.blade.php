<footer class="content-footer footer bg-footer-theme">
    <div
        class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            {{ Helper::apk()->copy_right }}
            <script>
                document.write(new Date().getFullYear())
            </script>
            , made with   <a href="#" target="_blank"
                class="footer-link fw-bolder">{{ Helper::apk()->nama_owner }}</a>
        </div>
        <div>
           
            <a href="#"
                target="_blank" class="footer-link me-4">Whatsapp: {{ Helper::apk()->tlp }}</a>
            <a href="#" target="_blank"
                class="footer-link d-none d-sm-inline-block">Versi: {{ Helper::apk()->versi }}</a>
        </div>
    </div>
</footer>