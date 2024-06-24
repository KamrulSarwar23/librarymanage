<style>
    /* Add this CSS to your styles */

    .site-wrapper {
        display: flex;
        flex-direction: column;
        min-height: 60vh;
    }

    .site-content {
        flex: 1;
    }
</style>

<div class="site-wrapper">
    <div class="site-content">
        <!-- Your page content goes here -->
    </div>
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-lg-0">
                    <div class="row mb-5">
                        <div class="col-12">
                            <h3 class="footer-heading mb-4">About Us</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Veniam blanditiis, vero voluptatum distinctio qui. Nostrum
                                quibusdam, dolor unde sunt fugiat.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 ml-auto">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h3 class="footer-heading mb-4">Navigation</h3>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="{{ route('home.page') }}">Home</a></li>
                                <li><a href="{{ route('all.books') }}">Book</a></li>
                                <li><a href="{{ route('contact.page') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0" id="contact-section">
                    <div class="mb-4">
                        <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                        <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                        <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                        <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                    </div>
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        All rights reserved |
                        <i class="icon-heart text-danger" aria-hidden="true"></i> by
                        <a href="#" target="_blank">Five Dev</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>
</div>
