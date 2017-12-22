
<!-- FOOTER -->
<footer>

    <!-- CONTAINER -->
    <div class="container" data-animated='fadeInUp'>

        <!-- ROW -->
        <div class="row">

            <div class="col-lg-2 col-md-2 col-sm-6 padbot10 text-center">
                <a href="{{ route('landing') }}" style="width: 100%;">
                    <img class="foot_logo_img" src="{{ asset('frontend_images/lowids_logo.png') }}" alt="" />
                </a>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-ss-12 padbot10">
                <h4>Kontak</h4>
                <div class="foot_address">
                    <span>Lowids</span>Ruko Bintaro Jaya Sektor 9 Blok D No.5<br/>
                    Tangerang, Banten
                </div>
                {{--<div class="foot_live_chat"><a href="javascript:void(0);" ><i class="fa fa-comment-o"></i> Live chat</a></div>--}}
            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 col-ss-12 padbot10">
                <div class="foot_phone"><span>021-7451927</span></div>
                <div class="foot_phone"><span>021-74860612</span></div>
                <div class="foot_mail"><a href="mailto:lowids@yahoo.co.id">lowids@yahoo.co.id</a></div>
            </div>

            <div class="respond_clear_480"></div>

            <div class="col-lg-2 col-md-2 col-sm-6 padbot10">
                <p style="color: #0b0b0b">
                    Senin - Sabtu<br>
                    <i class="fa fa-clock-o"></i> 8.30 - 17.30<br>
                    Minggu / Libur<br/>
                    <i class="fa fa-clock-o"></i> 8.30 - 16.00<br>
                </p>
            </div>

            <div class="respond_clear_768"></div>

            <div class="col-lg-3 col-md-3 padbot10">
                {{--<h4>Newsletter</h4>--}}
                {{--<form class="newsletter_form clearfix" action="javascript:void(0);" method="get">--}}
                    {{--<input type="text" name="newsletter" value="Enter E-mail & Get 10% off" onFocus="if (this.value == 'Enter E-mail & Get 10% off') this.value = '';" onBlur="if (this.value == '') this.value = 'Enter E-mail & Get 10% off';" />--}}
                    {{--<input class="btn newsletter_btn" type="submit" value="SIGN UP">--}}
                {{--</form>--}}

                <h4>Media Sosial</h4>
                <div class="social">
                    {{--<a href="javascript:void(0);" ><i class="fa fa-twitter"></i></a>--}}
                    {{--<a href="javascript:void(0);" ><i class="fa fa-facebook"></i></a>--}}
                    {{--<a href="javascript:void(0);" ><i class="fa fa-pinterest-square"></i></a>--}}
                    {{--<a href="javascript:void(0);" ><i class="fa fa-tumblr"></i></a>--}}
                    <a href="https://www.instagram.com/lowids_bahankue" ><i class="fa fa-instagram"></i></a>
                </div>
            </div>
        </div><!-- //ROW -->
    </div><!-- //CONTAINER -->

    <!-- COPYRIGHT -->
    <div class="copyright">

        <!-- CONTAINER -->
        <div class="container clearfix">
            {{--<div class="foot_logo"><a href="index.html" ><img src="{{ asset('frontend_images/lowids-logo.png') }}" alt="" /></a></div>--}}

            <div class="copyright_inf">
                <span>Lowids© 2017</span>
                <a href="{{ route('terms-show') }}" style="color: #000000">Syarat dan Ketentuan</a>
                <a class="back_top" href="javascript:void(0);" >Kembali ke atas <i class="fa fa-angle-up"></i></a>
            </div>
        </div><!-- //CONTAINER -->
    </div><!-- //COPYRIGHT -->
</footer><!-- //FOOTER -->