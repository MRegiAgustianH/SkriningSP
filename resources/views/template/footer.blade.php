<!-- footer section -->
<style>
    /* Premium Footer Overrides */
    .footer_section {
        background: linear-gradient(180deg, #0383ef 0%, #024884 100%) !important;
        color: #ffffff;
        padding: 60px 0 30px 0;
        position: relative;
        overflow: hidden;
    }

    .footer_section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 1px;
        background: rgba(255, 255, 255, 0.15);
    }

    .footer_col h4 {
        color: #ffffff !important;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 12px;
    }

    .footer_col h4::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 32px;
        height: 3px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 2px;
    }

    .footer_detail p {
        color: rgba(255, 255, 255, 0.85);
        font-size: 14px;
        line-height: 1.6;
        margin-top: 15px;
    }

    .footer_social {
        display: flex;
        gap: 12px;
        margin-top: 24px;
    }

    .footer_social a {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff !important;
        font-size: 15px;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-decoration: none;
    }

    .footer_social a:hover {
        background: #ffffff;
        color: #0383ef !important;
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .contact_link_box {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 15px;
    }

    .contact_link_box a {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: rgba(255, 255, 255, 0.85) !important;
        font-size: 14px;
        transition: color 0.2s ease;
        text-decoration: none;
    }

    .contact_link_box a:hover {
        color: #ffffff !important;
    }

    .contact_link_box a i {
        color: rgba(255, 255, 255, 0.9);
        font-size: 15px;
    }

    .footer-info {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: 40px;
        padding-top: 24px;
        text-align: center;
    }

    .footer-info p {
        color: rgba(255, 255, 255, 0.6) !important;
        font-size: 13px;
        margin: 0;
    }

    .footer-info a {
        color: #ffffff !important;
        font-weight: 600;
        text-decoration: none;
    }

    .footer-info a:hover {
        text-decoration: underline;
    }
</style>

<footer class="footer_section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 footer_col">
                <div class="footer_detail">
                    <h4>
                        Sistem Pakar Skrining Kecanduan Game Online
                    </h4>
                    <p>
                        Aplikasi ini untuk Menskrining kecanduan game online berdasarkan gejala-gejala yang dirasakan
                    </p>
                </div>
                <div class="footer_social">
                    <a href="https://facebook.com/#" target="_blank">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                    <a href="https://twitter.com/#" target="_blank">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                    <a href="https://instagram.com/#" target="_blank">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-2 footer_col">
            </div>
            <div class="col-md-4 footer_col">
                <div class="footer_contact">
                    <h4>
                        Kontak
                    </h4>
                    <div class="contact_link_box">
                        <a href="mailto:SkriningApp@gmail.com" target="_blank">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span>
                                SkriningApp@gmail.com
                            </span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <div class="footer-info">
            <p>
                &copy; @php echo date('Y') @endphp - <a href="#">SkriningApp</a>
            </p>
        </div>
    </div>
</footer>
<!-- footer section -->
