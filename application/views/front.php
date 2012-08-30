<!doctype html>
<!--[if IEMobile 7 ]>    <html class="no-js iem7" lang="en"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
  <meta charset="utf-8"> 
  
  <title>EbursaKerja.com | Portal Lowongan Pekerjaan Online</title>
  <meta name="description" content="This is nova theme clean and responsive HTML5 theme by WebMonarchy.com. Build a superb looking websites that looks great on desktops, iPads and iPhones! Nova impresses with its beauty and simplicity. Coded in HTML5 & CSS3 - future technology for today and tomorrow. Unique & clean pre made theme skins and easy re-skinning capabilities. ">

  
  
  <!-- The script prevents links from opening in mobile safari. https://gist.github.com/1042026 -->
  <!-- <script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script> -->

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>media/css/template/superfish.css" media="screen"  />
  <link rel="stylesheet" href="<?php echo base_url(); ?>media/css/template/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>media/css/template/flexslider.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>media/css/template/slides.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>media/css/template/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>media/css/template/skin.css" media="screen"  />
  <link rel="stylesheet" href="<?php echo base_url(); ?>media/css/template/custom-rebuild.css" media="screen"  />
  <link rel="stylesheet" href="<?php echo base_url(); ?>media/css/template/googlefont.css" media="screen"  />

  <script src="<?php echo base_url(); ?>media/js/template/libs/modernizr-2.0.6.min.js"></script>
  
</head>

<body>

<div id="container">
    <header>
    	<section class="header_fix">
            <a class="logo" href="<?php echo site_url(); ?>"></a><!-- /.logo --> 
            <section class="contact_detail">Telpon: 031 784 522 72</section><!-- /.contact_detail -->
            <section class="social_links">
            	<a href="" class="linkedin"></a>
            	<a href="" class="rss"></a>
            	<a href="" class="google"></a>
            	<a href="" class="twitter"></a>
            	<a href="" class="facebook"></a>
            </section><!-- /.social_links -->
        </section><!-- /.header_fix --> 
    </header><!-- /header -->
    
    <nav>
    	<section class="nav_fix">
            <section class="nav_fix_in all-round">
            <a href="#" class="buynow signin " target="_blank">LOGIN</a>
            <fieldset id="signin_menu">
                <form method="post" id="signin" action="https://twitter.com/sessions">
                    <p>
                        <label for="username">Email</label>
                        <input id="username" name="username" title="username" type="text">
                    </p>
                    <p>
                        <label for="password">Password</label>
                        <input id="password" name="password" title="password" type="password">
                    </p>
                    <p>
                        <input type="submit" class="button button-small submit green" value="MASUK" />
                        <a id=forgot_username_link title="lupa dengan password Anda?" href="#">Lupa Password?</a>
                    </p>
                </form>
            </fieldset>
            <ul class="main-menu">
                <li class="current_page_item"><a href="#">Beranda</a></li>
                <li><a href="#">Informasi Pendaftaran</a>
                  <ul>
                      <li><a href="#">Pelamar</a></li>
                      <li><a href="#">Perusahaan</a></li>
                  </ul>
                </li>
                <li><a href="#">Lowongan Terbaru</a></li>
                <li><a href="#">Pasang Lowongan</a></li>
                <li><a href="#">Fitur</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Kontak</a></li>
            </ul>
        	</section><!-- /.nav_fix_in -->
        </section><!-- /.nav_fix -->
    </nav><!-- /nav -->
    
	<section id="content-container">
    	<section class="content_container_fix">
        
        <section class="full_width">
                    
            <section class="strap_box_transparent">
				<img usemap="#maps" src="<?php echo base_url(); ?>media/images/template/main/ina.png">
				<map id="maps" name="maps">
		            <?php
			            if($q_main_state->num_rows() > 0){
				            foreach($q_main_state->result() as $state_rows){
					            echo "<area onMouseOver=\"this.style.backgroundColor='#00FFFF'\" onMouseOut=\"this.style.backgroundColor='#ff0000'\" title='".$state_rows->state_value."' id=\"propinsi\" href='".base_url()."lowongan/provinsi/".$state_rows->state_id."/".url_title($state_rows->state_value).".html' coords='".$state_rows->coor."' shape=\"poly\"/>";
				            }
			            }
		            ?>
		        </map>
                <h3>Daftar dan Temukan Karir Anda disini. Gratis!!</h3>
                <br /><br />
                <a href="#" class="button blue" target="_self"><span>Registrasi Pelamar</span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <a href="#" class="button red" target="_self"><span>Cari Lowongan Kerja</span></a>
            </section><!-- /.strap_box -->
            
            <section class="one_half_front last">
               <!-- Tabs -->
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">Lowongan Kerja Terbaru</a></li>
                        <li><a href="#tabs-2">Kategori Lowongan Kerja</a></li>
                        <li><a href="#tabs-3">Lokasi Lowongan Kerja</a></li>
                        <li><a href="#tabs-4">Ragam Posisi Pelamar</a></li>
                        <li><a href="#tabs-5">Data Perusahaan</a></li>
                    </ul>
                    <div id="tabs-1">
                    <h4>Daftar Lowongan Kerja Terbaru</h4>
                    <p>Mauris porttitor ullamcorper augue. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Phasellus mattis tincidunt nibh. Cras orci urna, blandit id, pretium vel, aliquet ornare, felis. Maecenas scelerisque sem non nisl. Fusce sed lorem in enim dictum bibendum.sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div id="tabs-2">
                    <h4>Lowongan Kerja Berdasarkan Kategori</h4>
                    <p>Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div id="tabs-3">
                    <h4>Lowongan Kerja Berdasarkan Wilayah</h4>
                    <p>Phasellus mattis tembelek kongkong tincidunt nibh. Cras orci urna, blandit id, pretium vel, aliquet ornare, felis. Maecenas scelerisque sem non nisl. Fusce sed lorem in enim dictum bibendum.sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div id="tabs-4">
                    <h4>Jenis Posisi Pelamar</h4>
                    <p>Mauris porttitor ullamcorper asu raumu mbokne ancpk augue. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Phasellus mattis tincidunt nibh. Cras orci urna, blandit id, pretium vel, aliquet ornare, felis. Maecenas scelerisque sem non nisl. Fusce sed lorem in enim dictum bibendum.sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div id="tabs-5">
                    <h4>Daftar Perusahaan Terbaru</h4>
                    <p>Mauris porttitor ullamcorper augue. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad sapu kon matek gk ngurus aq minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Phasellus mattis tincidunt nibh. Cras orci urna, blandit id, pretium vel, aliquet ornare, felis. Maecenas scelerisque sem non nisl. Fusce sed lorem in enim dictum bibendum.sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
            </section><!-- /.one_half -->
            
            <section class="content_heading">
            	<a class="gotop" href="#"></a>
                <h3>Perusahaan Populer</h3>
            </section><!-- /.content_heading --> 
            
            <section class="slide_content" id="slide_content_gallery">
             
               <div class="slides_container gallery">
                  
                  <div><!-- start panel 1 --> 
                  
                    <section class="view_box view_box_1_4">
                      <div class="view view_move view_1_4">
                          <img src="<?php echo base_url(); ?>media/images/template/samples/small/work_thum_1.jpg" alt="image" />
                          <a class="mask" href="portfolio-single-image-full.html">
                             <span class="thumicon link-thumicon"></span>
                          </a>
                      </div>
                      <h3><a href="">Bank Mandiri Tbk.</a></h3>
                      <span class="meta"></span>
                    </section><!-- /.view_box --> 
                  
                  <section class="view_box view_box_1_4">
                    <div class="view view_move view_1_4">
                        <img src="<?php echo base_url(); ?>media/images/template/samples/small/work_thum_2.jpg" alt="image" />
                        <a class="mask" href="images/samples/big/work_thum_2.jpg" data-rel="prettyPhoto">
                           <span class="thumicon magnifier-thumicon"></span>
                        </a>
                    </div>  
                    <h3><a href="">Kementrian Dalam Negeri</a></h3>
                    <span class="meta"></span>
                  </section><!-- /.view_box --> 
                  
                  <section class="view_box view_box_1_4">
                    <div class="view view_move view_1_4">
                        <img src="<?php echo base_url(); ?>media/images/template/samples/small/work_thum_3.jpg" alt="image" />
                         <a class="mask" href="http://www.youtube.com/watch?v=kh29_SERH0Y?rel=0" data-rel="prettyPhoto">
                           <span class="thumicon video-thumicon"></span>
                        </a>
                    </div>  
                    <h3><a href="">Garuda Airlines</a></h3>
                    <span class="meta"></span>
                  </section><!-- /.view_box --> 
                  
                  <section class="view_box view_box_1_4 last">
                    <div class="view view_move view_1_4">
                        <img src="<?php echo base_url(); ?>media/images/template/samples/small/work_thum_4.jpg" alt="image"/>
                        <a class="mask" href="images/samples/big/work_thum_4.jpg" data-rel="prettyPhoto[pp_gal]">
                           <span class="thumicon image-thumicon"></span>
                        </a>
                        <a href="<?php echo base_url(); ?>media/images/template/samples/big/work_thum_2.jpg" data-rel="prettyPhoto[pp_gal]" style="visibility:hidden;"></a>
                        <a href="<?php echo base_url(); ?>media/images/template/samples/big/work_thum_5.jpg" data-rel="prettyPhoto[pp_gal]" style="visibility:hidden;"></a>
                        <a href="<?php echo base_url(); ?>media/images/template/samples/big/work_thum_7.jpg" data-rel="prettyPhoto[pp_gal]" style="visibility:hidden;"></a>
                        <a href="<?php echo base_url(); ?>media/images/template/samples/big/work_thum_10.jpg" data-rel="prettyPhoto[pp_gal]" style="visibility:hidden;"></a>
                        <a href="<?php echo base_url(); ?>media/images/template/samples/big/work_thum_12.jpg" data-rel="prettyPhoto[pp_gal]" style="visibility:hidden;"></a>
                    </div>  
                    <h3><a href="">Trans Corp.</a></h3>
                    <span class="meta"></span>
                  </section><!-- /.view_box --> 
                  
                 </div><!-- end panel 1 --> 
                
                 <div><!-- start panel 2 --> 
                  
                  <section class="view_box view_box_1_4">
                    <div class="view view_move view_1_4">
                        <img src="<?php echo base_url(); ?>media/images/template/samples/small/work_thum_5.jpg" alt="image" />
                        <a class="mask" href="<?php echo base_url(); ?>media/images/template/samples/big/work_thum_5.jpg" data-rel="prettyPhoto">
                           <span class="thumicon magnifier-thumicon"></span>
                        </a>
                    </div>  
                    <h3><a href="">PT. Telkom Tbk.</a></h3>
                    <span class="meta"></span>
                  </section><!-- /.view_box --> 
                  
                  <section class="view_box view_box_1_4">
                    <div class="view view_move view_1_4">
                        <img src="<?php echo base_url(); ?>media/images/template/samples/small/work_thum_6.jpg" alt="image" />
                        <a class="mask" href="portfolio-single-slider-full.html" >
                            <span class="thumicon link-thumicon"></span>
                         </a>
                    </div>  
                    <h3><a href="">Indosat</a></h3>
                    <span class="meta"></span>
                  </section><!-- /.view_box --> 
                  
                  <section class="view_box view_box_1_4">
                    <div class="view view_move view_1_4">
                        <img src="<?php echo base_url(); ?>media/images/template/samples/small/work_thum_7.jpg" alt="image" />
                        <a class="mask" href="portfolio-single-slider-full.html">
                           <span class="thumicon link-thumicon"></span>
                        </a>
                    </div>  
                    <h3><a href="">Pemerintah Kota Surabaya</a></h3>
                    <span class="meta"></span>
                  </section><!-- /.view_box --> 
                  
                  <section class="view_box view_box_1_4 last">
                    <div class="view view_move view_1_4">
                        <img src="<?php echo base_url(); ?>media/images/template/samples/small/work_thum_8.jpg" alt="image" />
                        <a class="mask" href="<?php echo base_url(); ?>media/images/template/samples/big/work_thum_8.jpg" data-rel="prettyPhoto[pp_gal2]">
                           <span class="thumicon image-thumicon"></span>
                        </a>
                        <a href="<?php echo base_url(); ?>media/images/template/samples/big/work_thum_2.jpg" data-rel="prettyPhoto[pp_gal2]" style="visibility:hidden;"></a>
                        <a href="<?php echo base_url(); ?>media/images/template/samples/big/work_thum_5.jpg" data-rel="prettyPhoto[pp_gal2]" style="visibility:hidden;"></a>
                        <a href="<?php echo base_url(); ?>media/images/template/samples/big/work_thum_7.jpg" data-rel="prettyPhoto[pp_gal2]" style="visibility:hidden;"></a>
                        <a href="<?php echo base_url(); ?>media/images/template/samples/big/work_thum_10.jpg" data-rel="prettyPhoto[pp_gal2]" style="visibility:hidden;"></a>
                        <a href="<?php echo base_url(); ?>media/images/template/samples/big/work_thum_12.jpg" data-rel="prettyPhoto[pp_gal2]" style="visibility:hidden;"></a>
                    </div>  
                    <h3><a href="">Kantor Pos Indonesia</a></h3>
                    <span class="meta"></span>
                  </section><!-- /.view_box --> 
                  
                </div> <!-- end panel 2 --> 
                
             </div><!-- /.slides_container --> 
             
           </section><!-- /.slide_content --> 
        
          </section><!-- /.full_width -->
         
          <section class="clear_full"></section><!-- /.clear_full --> 
            
        </section><!-- /.content_container_fix --> 
    </section><!-- /#content-container -->   

    <footer>
    	<section class="footer_fix">
            <section class="footer_widgets">
            
            	<section class="footer_widget_12">
                	<h3>Lebih Jauh Tentang <strong>EbursaKerja.com</strong></h3>
                    <article>
                    <img src="<?php echo base_url(); ?>media/images/template/icons/retina-icons/globe_64.png" class="float-left" alt="globe" />
                    <p>This is nova theme clean and responsive HTML5 theme by WebMonarchy.com. Build a superb looking websites that looks great on desktops, iPads and iPhones!
					</p>
                    <p>Nova impresses with its beauty and simplicity.  Coded in HTML5 &amp; CSS3 - future technology for today and tomorrow. Unique &amp; clean
pre made theme skins and easy re-skinning capabilities.</a>
					</p>
                    </article>
                </section><!-- /.footer_widget_12 -->
                
                <section class="footer_widget_14">
                	<h3>Halaman Terkait</h3>
                    <article>
                    <ul>
                    	<li><a href="">+  Lowongan Terbaru </a></li>
						<li><a href="">+  Lokasi Lowongan </a></li>
                        <li><a href="">+  Posisi Lowongan </a></li>
                        <li><a href="">+  Kategori Lowongan </a></li>
                        <li><a href="">+  Test Online </a></li>
					</ul>
                    </article>
                </section><!-- /.footer_widget_14 -->
                
                <section class="footer_widget_14">
                	<h3>Inilah Kami</h3>
                    <article>
                    <p>
                    <strong>PT. Elektronik Bursa Kerja</strong><br />
                    Indonesia<br /><br />
                    phone: 031 867 5586<br />
                    fax: 031 856 5587<br />
                    email: <a href="mailto:info@ebursakerja.com">info@ebursakerja.com</a>
                    <p>
                    </article>
                </section><!-- /.footer_widget_14 -->
            
            </section><!-- /.footer_widgets --> 
            
            <section class="footer_meta">
            	<span class="copyright">&copy; 2012 Official Site of 
            	    <strong><a href="http://www.ebursakerja.com">eBursaKerja.com</a></strong>
            	</span>
                <ul class="footer_menu"> 
                    <li><a href="#">Laporkan Penyimpangan</a></li>
                    <li><a href="#">Kritik & Saran</a></li>
                    <li><a href="#">Kerjasama?</a></li>
                </ul><!-- /.footer_menu --> 
            </section><!-- /.footer_meta --> 
            
        </section><!-- /.footer_fix --> 
    </footer><!-- /footer -->
</div> <!-- /#container -->


  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>media/js/template/libs/jquery-1.7.2.min.js"><\/script>')</script>
  <script src="<?php echo base_url(); ?>media/js/template/libs/jquery.tipsy.js"></script>
  
  <script type="text/javascript">

    jQuery(document).ready(function($){ 
    
        // sper fish menu
        $("ul.main-menu").supersubs({ 
            minWidth:    12,
            maxWidth:    150,
            extraWidth:  1
        
        }).superfish({ 
            delay:       300,
            animation:   {opacity:'show',height:'show'}, 
            speed:       'normal',               
            autoArrows:  false,          
            dropShadows: true  
        });
                
       
        // set box login
        $(".signin").click(function(e) {          
			e.preventDefault();
            $("fieldset#signin_menu").toggle("blind");
			$(".signin").toggleClass("menu-open");
        });
		
		$("fieldset#signin_menu").mouseup(function() {
			return false
		});
		$(document).mouseup(function(e) {
			if($(e.target).parent("a.signin").length==0) {
				$(".signin").removeClass("menu-open");
				$("fieldset#signin_menu").hide();
			}
		});		
		
		
		// set tooltip
		$('#forgot_username_link').tipsy({gravity: 'n'});
			
    }); 
  </script>
  
  <script src="<?php echo base_url(); ?>media/js/template/libs/ui/jquery.ui.core.js"></script>
  <script src="<?php echo base_url(); ?>media/js/template/libs/ui/jquery.ui.widget.js"></script>
  <script src="<?php echo base_url(); ?>media/js/template/libs/ui/jquery.ui.accordion.js"></script>
  <script src="<?php echo base_url(); ?>media/js/template/libs/ui/jquery.ui.tabs.js"></script>
  <script src="<?php echo base_url(); ?>media/js/template/libs/superfish/hoverIntent.js"></script> 
  <script src="<?php echo base_url(); ?>media/js/template/libs/superfish/superfish.js"></script> 
  <script src="<?php echo base_url(); ?>media/js/template/libs/superfish/supersubs.js"></script>
  <script src="<?php echo base_url(); ?>media/js/template/libs/jquery.flexslider-min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>media/js/template/libs/jquery.easing.1.3.js"></script>
  <script src="<?php echo base_url(); ?>media/js/template/libs/slides.min.jquery.js"></script>
  <script src="<?php echo base_url(); ?>media/js/template/libs/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
    
  <script src="<?php echo base_url(); ?>media/js/template/scripts.js"></script>
  <!-- scripts concatenated and minified via ant build script-->
  <script src="<?php echo base_url(); ?>media/js/template/helper.js"></script>
  <!-- end scripts-->

</body>
</html>
