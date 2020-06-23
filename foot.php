  <div class = "container center">
        <footer id="footer">
        <div class="row">
          <div class="col-lg-12">

          
              <a class = "space" href="<?php echo ROOT_URL.'feedback'; ?>">Feedback</a>
              <a  class = "space" href  ="<?php echo ROOT_URL.'documentation'; ?>">Help</a>

              <a  class = "space" href="<?php echo ROOT_URL.'terms'; ?>">Terms & Privacy</a>  
              <a class = "space"  href="<?php echo ROOT_URL.'cookie_policy'; ?>">Cookie Policy</a>
              <!-- <a class = "space"  href="<?php echo ROOT_URL.'sitemap.xml'; ?>">Sitemap</a> -->
              <br>
              <br>
              <div class = "divider" style = "width: 45%;margin-left:27%;"></div>

              <br>
          <p>Copyright &copy; an <b>Ekomobong Archibong</b> production <?php echo date("Y")?></p>

          </div>
        </div>
      </footer>
      </div>

      <br>
      <br>
        <script src = 'public/js/jquery-3.4.1.min.js'></script>
        <script src = "public/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
        <script src = "public/js/materialize.min.js"></script>
        <script src = "public/js/angular.min.js"></script>
        <script src = "public/js/script.js"></script>
        <script>
        $(function() {
          $(".container").click(function(){
              $("#navbarColor01").removeClass('show');
          })
        })
        // modals
        $("#close").click(function(){
            $(".modal").css('display', 'none');
        })
        
          // Preloader
          $(window).on('load', function() {
            if ($('#preloader').length) {
              $('#preloader').delay(100).fadeOut('slow', function() {
                $(this).remove();
              });
            }
          });
          </script>
         </body>
</html>
