<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/_clear.php')
?>
<div id="container">

    <!-- Start Header Section -->
    <div class="hidden-header"></div>
    <header class="clearfix">

      <!-- Start Top Bar -->
      <!--
      <div class="top-bar dark-bar" style="display: block;">
        <div class="container">
          <div class="row">
            <div class="col-md-6">

              <ul class="contact-details">
                <li><a href="#"><i class="fa fa-mobile"></i> Tel: (55)69325006</a>
                </li>
                <li><a href="mailto:someone@example.com?Subject=Hello%20again" target="_top"><i class="fa fa-envelope-o"></i> contacto@multicode.com.mx  </a>
                </li>
                <li><a href="#"><i class="fa fa-phone"></i> Atención Lun. a Vier. de 11 a 14 Horas.</a>
                </li>
              </ul>

            </div>

            <div class="col-md-6">

              <ul class="social-list">
                <li>
                  <a class="facebook itl-tooltip" data-placement="bottom" title="Facebook" href="https://www.facebook.com/multicode.alfredotrejo?fref=ts" target="_blank"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                  <a class="twitter itl-tooltip" data-placement="bottom" title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                </li>

                <li>
                  <a class="google itl-tooltip" data-placement="bottom" title="YouTube" href="https://www.youtube.com/channel/UCsTYMtdxA-RbKesEiBAJkDA" target="_blank"><i class="fa fa-youtube"></i></a>
                </li>

                <li>
                  <a class="dribbble itl-tooltip" data-placement="bottom" title="Dribble" href="#"><i class="fa fa-dribbble"></i></a>
                </li>
                <li>
                  <a class="linkdin itl-tooltip" data-placement="bottom" title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                </li>
                <li>
                  <a class="flickr itl-tooltip" data-placement="bottom" title="Flickr" href="#"><i class="fa fa-flickr"></i></a>
                </li>
                <li>
                  <a class="tumblr itl-tooltip" data-placement="bottom" title="Tumblr" href="#"><i class="fa fa-tumblr"></i></a>
                </li>
                <li>
                  <a class="instgram itl-tooltip" data-placement="bottom" title="Instagram" href="#"><i class="fa fa-instagram"></i></a>
                </li>
                <li>
                  <a class="vimeo itl-tooltip" data-placement="bottom" title="vimeo" href="#"><i class="fa fa-vimeo-square"></i></a>
                </li>
                <li>
                  <a class="skype itl-tooltip" data-placement="bottom" title="Skype" href="#" target="_blank"><i class="fa fa-skype"></i></a>
                </li>
              </ul>

            </div>

          </div>

        </div>

      </div>
       -->
      <!-- .top-bar -->
      <!-- End Top Bar -->


      <!-- Start  Logo & Naviagtion  -->
      <div class="navbar navbar-default navbar-top">
        <div class="container">
          <div class="navbar-header">
            <!-- Stat Toggle Nav Link For Mobiles -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
            <!-- End Toggle Nav Link For Mobiles -->
            <a class="navbar-brand" href="/"  >
              <img alt=""  src="/img/imagenes/mc.png"  height="10px" width="188">
            </a>
          </div>
          <div class="navbar-collapse collapse">
            <!-- Stat Search -->
            <div class="search-side">
              <a class="show-search"><i class="fa fa-search"></i></a>
              <div class="search-form">
                <form autocomplete="off" role="search" method="get" class="searchform" action="#">
                  <input type="text" value="" name="s" id="s" placeholder="Search the site...">
                </form>
              </div>
            </div>
            <!-- End Search -->
            <!-- Start Navigation List -->
            <ul class="nav navbar-nav navbar-right">
              <li>
                <a href="/">Inicio</a>

              </li>
	          <li>
                <a href="/site/nosotros">Nosotros</a>

              </li>

               <li>
                <a href="#">Productos</a>
                <ul class="dropdown">
                  <li><a href="/site/multicode">Multicode</a>
                  </li>
                  <li><a href="/site/accesorios">Accesorios</a>
                  </li>

                  <li><a href="/site/validar-producto">Validar producto</a>
                  </li>

                </ul>
              </li>

              <li>
                <a href="/site/distribuidor">Distribuidores </a>

              </li>
              <li>
                <a href="/site/ventas">Ventas</a>

              </li>

              <li><a href="/site/contact">Contacto</a>

              <?php if(Yii::$app->user->isGuest):?>




              		<li>
                <a href="#">Clientes</a>
                <ul class="dropdown">
                <li><a href="<?= Url::to(['/user/sign-in/signup']); ?>"><?=Yii::t('frontend', 'Signup') ?></a></li>

                <li><a href="<?= Url::to(['/user/sign-in/login']); ?>"><?=Yii::t('frontend', 'Login') ?></a></li>
                </ul>
              </li>



              <?php endif;?>



              <?php if(!Yii::$app->user->isGuest):?>

                 <?php if(!(Yii::$app->user->can('manager'))):?>

              <li>
                <a href="#"><i class="fa fa-mobile"></i> Mis productos</a>
                <ul class="dropdown">
                  <li><a href="<?= Url::to(['/producto-cliente/mis-productos']); ?>"><?= Yii::t('frontend', 'Ver todos') ?></a>
                  </li>
                 <li><a href="<?=  Url::to(['/producto-cliente/registro-producto']); ?>"><?= Yii::t('frontend', 'Registrar producto') ?></a>
                  </li>
                 <li>
                 <a href="<?= Url::to(['/user/default/index']); ?>"><?= Yii::t('frontend', 'Soporte y ayuda') ?></a>
                  </li>

                </ul>
              </li>
              <?php endif;?>

              	<li>
                <a href="#"><i class="fa fa-user"></i>  <?= Yii::$app->user->identity->username ?></a>
                <ul class="dropdown">
                <?php if(Yii::$app->user->can('user')):?>
                  <li><a href="<?= Url::to(['/user/default/index']); ?>"><?= Yii::t('frontend', 'Settings') ?></a>
                  </li>
                  <?php endif;?>

                  <?php if(!(Yii::$app->user->can('manager'))):?>
                  <li><a href="<?= Url::to(['/site/actualizar-informacion-personal']); ?>"><?= Yii::t('frontend', 'Información de contacto') ?></a>
                  </li>
                      <?php endif;?>

                 <?php if(Yii::$app->user->can('manager')):?>
                 <li><a href="<?=  Yii::getAlias('@backendUrl'); ?>"><?= Yii::t('frontend', 'Backend') ?></a>
                  </li>
                  <?php endif;?>
                 <li>
                 <?= Html::a(Yii::t('frontend', 'Salir'), Url::to(['/user/sign-in/logout']), ['data-method' => 'POST']) ?>
                  </li>
                </ul>
              </li>

              <?php endif;?>

            </ul>
            <!-- End Navigation List -->
          </div>
        </div>

        <!-- Mobile Menu Start -->
        <ul class="wpb-mobile-menu">

              <li>
                <a href="/">Inicio</a>

              </li>
	          <li>
                <a href="/site/nosotros">Nosotros</a>

              </li>

               <li>
                <a href="#">Productos</a>
                <ul class="dropdown">
                  <li><a href="/site/multicode">Multicode</a>
                  </li>
                  <li><a href="/site/accesorios">Accesorios</a>
                  </li>

                  <li><a href="/site/validar-producto">Validar producto</a>
                  </li>

                </ul>
              </li>

              <li>
                <a href="/site/distribuidor">Distribuidores </a>

              </li>
              <li>
                <a href="/site/ventas">Ventas</a>

              </li>

              <li><a href="/site/contact">Contacto</a>

              <?php if(Yii::$app->user->isGuest):?>




              		<li>
                <a href="#">Clientes</a>
                <ul class="dropdown">
                <li><a href="<?= Url::to(['/user/sign-in/signup']); ?>"><?=Yii::t('frontend', 'Signup') ?></a></li>

                <li><a href="<?= Url::to(['/user/sign-in/login']); ?>"><?=Yii::t('frontend', 'Login') ?></a></li>
                </ul>
              </li>



              <?php endif;?>



              <?php if(!Yii::$app->user->isGuest):?>

                 <?php if(!(Yii::$app->user->can('manager'))):?>

              <li>
                <a href="#">Mis productos</a>
                <ul class="dropdown">
                  <li><a href="<?= Url::to(['/producto-cliente/mis-productos']); ?>"><?= Yii::t('frontend', 'Ver todos') ?></a>
                  </li>
                 <li><a href="<?=  Url::to(['/producto-cliente/registro-producto']); ?>"><?= Yii::t('frontend', 'Registrar producto') ?></a>
                  </li>
                 <li>
                 <a href="<?= Url::to(['/user/default/index']); ?>"><?= Yii::t('frontend', 'Soporte y ayuda') ?></a>
                  </li>

                </ul>
              </li>
              <?php endif;?>

              	<li>
                <a href="#"><?= Yii::$app->user->identity->getPublicIdentity() ?>+</a>
                <ul class="dropdown">
                <?php if(Yii::$app->user->can('user')):?>
                  <li><a href="<?= Url::to(['/user/default/index']); ?>"><?= Yii::t('frontend', 'Settings') ?></a>
                  </li>
                  <?php endif;?>

                  <?php if(!(Yii::$app->user->can('manager'))):?>
                  <li><a href="<?= Url::to(['/site/actualizar-informacion-personal']); ?>"><?= Yii::t('frontend', 'Información de contacto') ?></a>
                  </li>
                      <?php endif;?>

                 <?php if(Yii::$app->user->can('manager')):?>
                 <li><a href="<?=  Yii::getAlias('@backendUrl'); ?>"><?= Yii::t('frontend', 'Backend') ?></a>
                  </li>
                  <?php endif;?>
                 <li>
                 <?= Html::a(Yii::t('frontend', 'Salir'), Url::to(['/user/sign-in/logout']), ['data-method' => 'POST']) ?>
                  </li>
                </ul>
              </li>

              <?php endif;?>

            </ul>
        <!-- Mobile Menu End -->

      </div>
      <!-- End Header Logo & Naviagtion -->

    </header>
    <!-- End Header Section -->




    <?php echo $content ?>

  <!-- Start Footer -->
    <footer>
      <div class="container">
        <div class="row footer-widgets">

          <!-- Start Subscribe & Social Links Widget -->
          <div class="col-md-5">
            <div class="footer-widget mail-subscribe-widget">
              <h4>¡Mantente Conectado!<span class="head-line"></span></h4>
              <p>¡Únete a nuestra lista de correo para estar al día y obtener avisos sobre nuestros nuevos lanzamientos!</p>

            </div>
            <div class="footer-widget social-widget">
              <h4>Síguenos en...<span class="head-line"></span></h4>
              <ul class="social-icons">
                <li>
                  <a class="facebook" href="https://www.facebook.com/multicode.alfredotrejo?fref=ts" target="_blank"><i class="fa fa-facebook"></i></a>
                </li>
                <!--
                <li>
                  <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                </li>
                -->

                <li>
                  <a class="google itl-tooltip" data-placement="bottom" title="YouTube" href="https://www.youtube.com/channel/UCsTYMtdxA-RbKesEiBAJkDA" target="_blank"><i class="fa fa-youtube"></i></a>
                </li>

                <li>
                  <a class="skype" href="#"><i class="fa fa-skype"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <!-- .col-md-3 -->
          <!-- End Subscribe & Social Links Widget -->


          <!-- Start Twitter Widget -->
          <!--
          <div class="col-md-3">
            <div class="footer-widget twitter-widget">
              <h4><span class="head-line"></span></h4>
              <ul>
                <li>
                  <p><a href="#">@SoyCerrajero </a>Los nuevos productos de la marca Philips estarán disponibles a partir de enero del 2017.</p>
                  <span>15 de Octubre del 2016</span>
                </li>

              </ul>
            </div>
          </div> -->
          <!-- .col-md-3 -->
          <!-- End Twitter Widget -->




          <!-- End Flickr Widget -->


          <!-- Start Contact Widget -->
          <div class="col-md-5">
            <div class="footer-widget contact-widget">
              <h4><img src="/img/imagenes/mc.png" class="img-responsive" alt="Footer Logo" /></h4>
              <p>Nuestro equipo de atención a clientes está disponible de 10 am a 6 pm de Lunes a Viernes. </p>
              <ul>
                <li><span>Teléfono:</span> (55)69325006</li>
                <li><span>Email:</span> contacto@multicode.com.mx</li>
                <li><span>Website:</span> http://www.multicode.com.mx/</li>
              </ul>
            </div>
          </div>
          <!-- .col-md-3 -->
          <!-- End Contact Widget -->


        </div>
        <!-- row -->

        <!-- Start Copyright -->
        <div class="copyright-section">
          <div class="row">
            <div class="col-md-6">
              <p>&copy;  2016 J.A.T.E. Todos los derechos reservados. <a href="#"></a> </p>
            </div>
            <div class="col-md-6">
              <ul class="footer-nav">
                <li><a href="#">Sitemap</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- End Copyright -->

      </div>
    </footer>
    <!-- End Footer -->



</div>


<!-- Go To Top Link -->
  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

<!-- Style Switcher -->
  <div class="switcher-box">
    <a class="open-switcher show-switcher"><i class="fa fa-cog fa-2x"></i></a>
    <h4>Style Switcher</h4>
    <span>12 Predefined Color Skins</span>
    <ul class="colors-list">
      <li>
        <a onClick="setActiveStyleSheet('blue'); return false;" title="Blue" class="blue"></a>
      </li>
      <li>
        <a onClick="setActiveStyleSheet('sky-blue'); return false;" title="Sky Blue" class="sky-blue"></a>
      </li>
      <li>
        <a onClick="setActiveStyleSheet('cyan'); return false;" title="Cyan" class="cyan"></a>
      </li>
      <li>
        <a onClick="setActiveStyleSheet('jade'); return false;" title="Jade" class="jade"></a>
      </li>
      <li>
        <a onClick="setActiveStyleSheet('green'); return false;" title="Green" class="green"></a>
      </li>
      <li>
        <a onClick="setActiveStyleSheet('purple'); return false;" title="Purple" class="purple"></a>
      </li>
      <li>
        <a onClick="setActiveStyleSheet('pink'); return false;" title="Pink" class="pink"></a>
      </li>
      <li>
        <a onClick="setActiveStyleSheet('red'); return false;" title="Red" class="red"></a>
      </li>
      <li>
        <a onClick="setActiveStyleSheet('orange'); return false;" title="Orange" class="orange"></a>
      </li>
      <li>
        <a onClick="setActiveStyleSheet('yellow'); return false;" title="Yellow" class="yellow"></a>
      </li>
      <li>
        <a onClick="setActiveStyleSheet('peach'); return false;" title="Peach" class="peach"></a>
      </li>
      <li>
        <a onClick="setActiveStyleSheet('beige'); return false;" title="Biege" class="beige"></a>
      </li>
    </ul>
    <span>Top Bar Color</span>
    <select id="topbar-style" class="topbar-style">
      <option value="1">Light (Default)</option>
      <option value="2">Dark</option>
      <option value="3">Color</option>
    </select>
    <span>Layout Style</span>
    <select id="layout-style" class="layout-style">
      <option value="1">Wide</option>
      <option value="2">Boxed</option>
    </select>
    <span>Patterns for Boxed Version</span>
    <ul class="bg-list">
      <li>
        <a href="#" class="bg1"></a>
      </li>
      <li>
        <a href="#" class="bg2"></a>
      </li>
      <li>
        <a href="#" class="bg3"></a>
      </li>
      <li>
        <a href="#" class="bg4"></a>
      </li>
      <li>
        <a href="#" class="bg5"></a>
      </li>
      <li>
        <a href="#" class="bg6"></a>
      </li>
      <li>
        <a href="#" class="bg7"></a>
      </li>
      <li>
        <a href="#" class="bg8"></a>
      </li>
      <li>
        <a href="#" class="bg9"></a>
      </li>
      <li>
        <a href="#" class="bg10"></a>
      </li>
      <li>
        <a href="#" class="bg11"></a>
      </li>
      <li>
        <a href="#" class="bg12"></a>
      </li>
      <li>
        <a href="#" class="bg13"></a>
      </li>
      <li>
        <a href="#" class="bg14"></a>
      </li>
    </ul>
  </div>



<?php $this->endContent() ?>

