


 <style type="text/css">
   .tr-border { border: 2px solid red !important; }
   .no-border{ border:0px !important; }
 </style>
  <main id="main">
    <section id="services" class="section-bg mt-5">
    <form method="post" id="notice-data" name="notice-data">
    <div class="container">

        <div class="row mt-5">
          <div class="col-lg-6">
             <label>Company Name <sup class="red">*</sup></label>
             <input name="company_name" type="text" placeholder="Company Name"  class="form-control" id="company_name" >
          </div>
          <div class="col-lg-6">
             <label id = "label-motor-father-name" >Address Of Company<sup class="red">*</sup></label>
             <input type="text" placeholder="K Street Palli Hill ,  Mumbai , Maharastra" name="address_company" id="address_company" class="form-control" />
          </div>
        </div>

        <div class="row mt-2">
          <div class="col-lg-6">
             <label id = "label-motor-father-name" >Defendant Name<sup class="red">*</sup></label>
              <input type="text" placeholder="Defendant Name" name="defendant_name" id="defendant_name" class="form-control" />
             <span id="err_date_emp" style="color:red;font-weight: bolder;display: none">This Field is required</span>
          </div>
          <div class="col-lg-6">
              <label id = "label-motor-father-name" >Defendant Designation<sup class="red">*</sup></label>
              <input type="text" placeholder="Defendant Designation" name="defendant_designation" id="defendant_designation" class="form-control" />
             <span id="err_date_emp" style="color:red;font-weight: bolder;display: none">This Field is required</span>
          </div>
        </div>
       
          <div class="form-row mt-5">
                <div class="col-md-12 form-group">
                <label class="fontBold fontRoboto">Please Attach following copy of Documents in PDF or Image</label>
                </div>
          </div>

         <div class="row">
          <div class="col-lg-12 mt-5 mt-lg-0">
           <table style="border:0px;" class="table">
                  <tbody><tr id="tr_complaint_harrashment" class="no-border">
                     <td class="fontBold fontRoboto"> <b> Complaint Already Raised To HR</b> </td>
                     <td> <div class="upload-btn">
                           <input type="file" id="complaint_harrashment" name="complaint_harrashment" onchange="checkFile(this.id,'tr_complaint_harrashment')">
                        </div>
                     </td>
                  </tr>
               </tbody></table>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-lg-6">
              <div class="form-row">
                <div class="col-md-12 form-group">
                 <label>What Is Complaint ?<sup class="red">*</sup></label>
                     <textarea class="form-control" rows="8" id="complaint" name="complaint"></textarea>
                  <div class="validate"></div>
                </div>
              </div>
          </div>
        </div>
        
        <div class="row mt-5">
          <div class="col-lg-6">
              <div class="form-row">
                <div class="col-md-12 form-group">
                 <label>Relief Required ?<sup class="red">*</sup></label>
                     <textarea class="form-control" rows="8" id="relief" name="relief"></textarea>
                  <div class="validate"></div>
                </div>
              </div>
          </div>
        </div>
          <div class="row mt-5">
          <div class="col-lg-6">
           <label><button type="button" class="makeNoticeBtn" name="" id="harrasmentFinalSubmit">Send Details</button></label>
           </form>
          </div>
        </div>
      </div>
    </section><!-- End Sevices Section -->

   

    <!-- ======= Frequently Asked Questions Section ======= -->



    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact"  style="padding: 30px;">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>CONTACT US</h2>
          <!-- <p>The weather is amazing, walk with me through the pathway of more success. Take this journey with me, Lion! To succeed you must believe. When you believe, you will succeed.</p> -->
        </div>

       
        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p>Building no. 24, Near Meenakshi Temple, Sector 2 , Udupi - 560021</p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p>support@makemynotice.com</p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p>+91-239841231</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">



    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>Make My Notice</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/ -->
          Designed by <a href="https://bootstrapmade.com/">Make My Notice</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>  
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
   <div id="preloader"></div>
 </body>
  <!-- Vendor JS Files -->

  <script type="text/javascript">
  
    $( function() {

      $("#alreadyLogin").click(function(){
        $("#getStarted").modal('hide');
        $("#logiModal").modal('show');
      });

    $("#newSignUp").click(function(){

      $(".suspension-notice").click(function(){

      })
      $("#getStarted").modal('show');
      $("#logiModal").modal('hide');
    });


  });
  </script>

