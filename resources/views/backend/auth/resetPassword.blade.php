@include('backend.layout.headerFront')
@include('sweetalert::alert')
<!-- Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->

<!-- Content -->
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <img src="{{ asset('') }}storage/images/logo/{{ Helper::apk()->logo }}" alt=""
                            style="width: 30%;">
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Welcome to 👋<br>{{ Helper::apk()->nama_aplikasi }}</h4>
                    <p class="mb-4">Silahkan Hubungi Wa Admin: 08515550000</p>
                    <a href="login">
                        <small>Back to Login</small>
                    </a>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>
<!--/ Content -->


@include('backend.layout.footerFront')
