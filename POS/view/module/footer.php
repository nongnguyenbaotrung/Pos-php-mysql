<!-- Footer -->
<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. By <a
        href="" target="_blank">Nong Nguyen Bao Trung</a> -  <a href="" target="_blank"> Nguyen Huu Tin</a>
     .</span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> <i
        class="ti-heart text-danger ml-1"></i></span>
  </div>
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a
        href="" target="_blank">MƠ MƠ</a></span>
  </div>
</footer>

<!-- End page content -->
</div>




<script src="ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace('detail');
</script>



<script>
  // Get the Sidebar
  var mySidebar = document.getElementById("mySidebar");

  // Get the DIV with overlay effect
  var overlayBg = document.getElementById("myOverlay");

  // Toggle between showing and hiding the sidebar, and add overlay effect
  function w3_open() {
    if (mySidebar.style.display === 'block') {
      mySidebar.style.display = 'none';
      overlayBg.style.display = "none";
    } else {
      mySidebar.style.display = 'block';
      overlayBg.style.display = "block";
    }
  }

  // Close the sidebar with the close button
  function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
  }
</script>

</body>

</html>