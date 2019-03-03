<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Alumni - SMK Negeri 1 Klaten</title>
    <link href="https://fonts.googleapis.com/css?family=Oxygen:400,700|Arimo:400,700" rel="stylesheet">
    <link rel="stylesheet" href="/blue/css/style.css">
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
</head>
<body class="is-boxed has-animations">
    <div class="body-wrap boxed-container">
        <header class="site-header">
            <div class="container">
                <div class="site-header-inner">
                    <div class="brand header-brand">
                        <h1 class="m-0">
                            <a href="#">
                                <!-- <img src="https://static.smkn1klaten.sch.id/default/logo_smk.png" alt="Alumni SMK Negeri 1 Klaten"> -->
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <section class="hero">
				<div class="hero-left-decoration is-revealing"></div>
				<div class="hero-right-decoration is-revealing"></div>
                <div class="container">
                    <div class="hero-inner">
						<div class="hero-copy">
	                        <h1 class="hero-title mt-0 is-revealing">Sistem Informasi Alumni SMK N 1 Klaten</h1>
	                        <p class="hero-paragraph is-revealing">Sistem ini digunakan untuk melakukan pendataan alumni sekaligus untuk saling mendapatkan informasi sesama alumni.</p>
	                        <p class="hero-cta mb-0 is-revealing">
                                @guest
								<a class="button button-default button-shadow" href="{{route('front.new.get')}}">Registrasi</a>
                                <a class="button button-primary button-shadow" href="{{route('front.login.get')}}">Login</a>
                                @endguest
                                @auth
                                <a class="button button-primary button-shadow" href="{{route('dashboard')}}">Dashboard</a>
                                @endauth
							</p>
						</div>
						<div class="hero-illustration">
						</div>
                    </div>
                </div>
            </section>

			<section class="features section text-center">
                <div class="container">
                    <div class="features-inner section-inner has-top-divider">
						<div class="features-header text-center">
							<div class="container-sm">
								<h2 class="section-title mt-0">Sebaran Alumni</h2>
								<p class="section-paragraph mb-0">Berikut merupakan data sebaran alumni SMK Negeri 1 Klaten berdasarkan keterserapan pada pendidikan tinggi dan dunia kerja.</p>
							</div>
						</div>
                        <div class="features-wrap">
                            <div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
                                        <img src="/blue/images/feature-icon-01.svg" alt="Feature 01">
                                    </div>
                                    <h4 class="feature-title">Pendidikan</h4>
                                    <p class="text-sm"><a class="button button-primary button-shadow" href="#">Tampilkan data</a></p>
                                </div>
                            </div>
                            <div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
                                        <img src="/blue/images/feature-icon-02.svg" alt="Feature 02">
                                    </div>
                                    <h4 class="feature-title">Pekerjaan</h4>
                                    <p class="text-sm"><a class="button button-primary button-shadow" href="#">Tampilkan data</a></p>
                                </div>
                            </div>
                            <div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
                                        <img src="/blue/images/feature-icon-03.svg" alt="Feature 03">
                                    </div>
                                    <h4 class="feature-title">Wirausaha</h4>
                                    <p class="text-sm"><a class="button button-primary button-shadow" href="#">Tampilkan data</a></p>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </section>

			<section class="features-tabs section">
                <div class="container">
                    <div class="features-tabs-inner section-inner has-top-divider">
						<div class="tabs-container">
							<ul class="tabs-links">
								<li class="is-revealing">
									<a href="#tab-1" class="tab-link is-active">
										<img src="/blue/images/tabs-icon-01.svg" alt="Tabs icon 01">
										<span class="h4 m-0">Pendataan Alumni</span>
									</a>
								</li>
								<li class="is-revealing">
									<a href="#tab-2" class="tab-link">
										<img src="/blue/images/tabs-icon-02.svg" alt="Tabs icon 02">
										<span class="h4 m-0">Informasi Alumni</span>
									</a>
								</li>
								<li class="is-revealing">
									<a href="#tab-3" class="tab-link">
										<img src="/blue/images/tabs-icon-03.svg" alt="Tabs icon 03">
										<span class="h4 m-0">Informasi Bursa Kerja</span>
									</a>
								</li>
							</ul>
							<div class="tabs-content">
								<div id="tab-1" class="tab-panel is-active">
									<h2>Data Alumni</h2>
									<p>Diharapkan dengan adanya pendataan alumni ini dapat dijadikan referensi sekaligus tolak ukur kompetensi lulusan SMK Negeri 1 Klaten.</p>
									<p class="mb-0">Pendataan ini mencakup informasi pendidikan, pekerjaan sekaligus usaha yang dikembangkan alumni.</p>
								</div>
								<div id="tab-2" class="tab-panel">
									<h2>Info Alumni</h2>
									<p>Dengan memasukkan informasi personal pada sistem ini, diharapkan dapat membantu menghubungkan kembali alumni-alumni yang sudah lama tidak saling terhubung.</p>									
								</div>
								<div id="tab-3" class="tab-panel">
									<h2>Bursa Kerja</h2>
									<p>Dengan terdaftar sebagai alumni SMK Negeri 1 Klaten, setiap alumni dapat saling berbagi (memberi dan memperoleh) informasi lowongan pekerjaan, selain itu pihak BKK SMK Negeri 1 Klaten juga dapat dengan mudah membagikan informasi kepada alumni.</p>
									<p class="mb-0"><b>[Experimental Feature]</b> Fitur ini masih pada tahap eksperimen, butuh dukungan dari para alumni, khususnya alumni IT untuk bersama membangun sistem informasi ini. <a target="_blank" href="https://github.com/marufshidiq/alumni-smk">Contribute as Programmer</a></p>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </section>

			<section class="testimonials section">
				<div class="container">
					<div class="testimonials-inner section-inner">
						<div class="testimonials-header text-center text-light">
							<h2 class="section-title mt-0">Testimoni Alumni</h2>
						</div>
						<div class="testimonials-wrap">
							<div class="testimonial text-sm is-revealing">
								<div class="testimonial-inner">
									<div class="testimonial-main">
										<div class="testimonial-body">
											<p>Pesan dan kesan alumni</p>
										</div>
									</div>
									<div class="testimonial-footer">
										<div class="testimonial-name"><a href="#">@alumni1</a></div>
									</div>
								</div>
							</div>							
						</div>
					</div>
				</div>
			</section>

            <section class="pricing section">
                <div class="container">
                    <div class="pricing-inner section-inner">                        
						<div class="pricing-faqs container-sm is-revealing">
							<h4 class="mt-40 mb-32">FAQs</h4>
	                        <ul class="accordion">
	                            <li>
	                                <div class="accordion-title">
										<span>Dimana data alumni disimpan?</span>
										<div class="accordion-icon"></div>
									</div>
	                                <div class="accordion-body">
	                                    <p>Semua data pada sistem ini disimpan pada server yang dikelola oleh sekolah.</p>
	                                </div>
	                            </li>
                                <li>
	                                <div class="accordion-title">
										<span>Siapa saja yang dapat mengetahui data pribadi alumni?</span>
										<div class="accordion-icon"></div>
									</div>
	                                <div class="accordion-body">
	                                    <p>Data pribadi hanya ditampilkan kepada alumni lain yang terdaftar, pengguna yang tidak terdaftar tidak dapat mengetahui informasi tersebut.</p>
	                                </div>
	                            </li>
                                <li>
	                                <div class="accordion-title">
										<span>Apakah saya dapat membatasi siapa saja yang dapat mengetahui data saya?</span>
										<div class="accordion-icon"></div>
									</div>
	                                <div class="accordion-body">
	                                    <p>Ya. Semua data pribadi yang anda masukkan dapat diatur sebagai data private, sehingga hanya dapat dilihat oleh alumni yang sudah anda beri akses.</p>
	                                </div>
	                            </li>
	                        </ul>
						</div>
                    </div>
                </div>
            </section>

			<section class="cta section">
				<div class="container">
					<div class="cta-inner section-inner is-revealing">
						<h3 class="section-title mt-0">Informasi lebih lanjut?</h3>
						<div class="cta-cta">
							<a class="button button-primary button-shadow" href="mailto:info@smkn1klaten.sch.id">Hubungi Admin</a>
						</div>
					</div>
				</div>
			</section>
        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="site-footer-inner">
                    <div class="brand footer-brand">
                        <a href="https://www.smkn1klaten.sch.id">
                            <img src="https://static.smkn1klaten.sch.id/default/logo_smk.png" width="50px" alt="Alumni SMK N 1 Klaten">
                        </a>
                    </div>
                    <ul class="footer-links list-reset">
                        <!-- <li>
                            <a href="#">Contact</a>
                        </li>
                        <li>
                            <a href="#">About us</a>
                        </li>
                        <li>
                            <a href="#">FAQ's</a>
                        </li>
                        <li>
                            <a href="#">Support</a>
                        </li> -->
                    </ul>
                    <ul class="footer-social-links list-reset">
                        <!-- <li>
                            <a href="#">
                                <span class="screen-reader-text">Facebook</span>
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.023 16L6 9H3V6h3V4c0-2.7 1.672-4 4.08-4 1.153 0 2.144.086 2.433.124v2.821h-1.67c-1.31 0-1.563.623-1.563 1.536V6H13l-1 3H9.28v7H6.023z" fill="#FFF"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="screen-reader-text">Twitter</span>
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 3c-.6.3-1.2.4-1.9.5.7-.4 1.2-1 1.4-1.8-.6.4-1.3.6-2.1.8-.6-.6-1.5-1-2.4-1-1.7 0-3.2 1.5-3.2 3.3 0 .3 0 .5.1.7-2.7-.1-5.2-1.4-6.8-3.4-.3.5-.4 1-.4 1.7 0 1.1.6 2.1 1.5 2.7-.5 0-1-.2-1.5-.4C.7 7.7 1.8 9 3.3 9.3c-.3.1-.6.1-.9.1-.2 0-.4 0-.6-.1.4 1.3 1.6 2.3 3.1 2.3-1.1.9-2.5 1.4-4.1 1.4H0c1.5.9 3.2 1.5 5 1.5 6 0 9.3-5 9.3-9.3v-.4C15 4.3 15.6 3.7 16 3z" fill="#FFF"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="screen-reader-text">Google</span>
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.9 7v2.4H12c-.2 1-1.2 3-4 3-2.4 0-4.3-2-4.3-4.4 0-2.4 2-4.4 4.3-4.4 1.4 0 2.3.6 2.8 1.1l1.9-1.8C11.5 1.7 9.9 1 8 1 4.1 1 1 4.1 1 8s3.1 7 7 7c4 0 6.7-2.8 6.7-6.8 0-.5 0-.8-.1-1.2H7.9z" fill="#FFF"/>
                                </svg>
                            </a>
                        </li> -->
                    </ul>
                    <div class="footer-copyright">&copy; 2019 MRFSHDQ&nbsp;|&nbsp; <a target="_blank" href="https://github.com/marufshidiq/alumni-smk">@version('version-compact')</a></div>
                </div>
            </div>
        </footer>
    </div>

    <script src="/blue/js/main.min.js"></script>
    @if(env('APP_PHASE') == 'production')
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='{{env('TAWK_TO_URL')}}';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
    @endif
</body>
</html>
