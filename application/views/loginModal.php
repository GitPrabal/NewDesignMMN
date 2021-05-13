<div class="modal fade bd-example-modal-lg" id="logiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-body" style="padding: 0rem;">
      <div class="row"> 
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form" style="padding: 25px;">
               <span style="font-size: 19px;font-weight: bold;">MAKE MY NOTICE</span>
               <span style="font-size: 17px;display: block;margin-top: 10px;margin-bottom: 10px;">Welcome Back, Please Login to your account</span>
               <br />
               <center>
                <div class="alert alert-danger text-center error-msg" style="display: none;"></div>
                <div class="text-center loader" style="display: none;">
                  <h3>
                     Loading...
                  </h3>
                </div>
                
               </center>
                <form>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" id="loginEmail">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" id="loginPass">
                  </div>
                  <input type="button" id="loginUser" name="" value="Login" class="btn btn-primary">
                  <!-- <a href="#" style="text-decoration: none"><span id="newSignUp" style="font-size: 11px;font-weight: bold;">New Here ? Sign Up</span></a> -->
                </form>
                </div>
            </div>

             <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs desktopVisible" style="background: #2f516c;padding-left:0px;">
                <img src="../../public/assets/img/modal_rt.png" class="desktopVisible img-responsive" style="width: 100%;">
                <button type="button" class="close" data-dismiss="modal" style="position:absolute; top: 20px; right: 20px;color: white;font">X</button>
               
            </div>
        </div>
      </div>
   
    </div>
  </div>
</div>


<div class="modal fade bd-example-modal-lg" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-body" style="padding: 0rem;">
      <div class="row"> 
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form" style="padding: 25px;">
               <span style="font-size: 19px;font-weight: bold;">MAKE MY NOTICE</span>
               <span style="font-size: 17px;display: block;margin-top: 10px;margin-bottom: 10px;">Welcome, Create an account</span>
               <br />
               <center>
                <div class="alert alert-danger text-center error-msg" style="display: none;"></div>
                <div class="alert alert-success text-center success-msg" style="display: none;"></div>
                <div class="text-center" style="display: none;">
                  <h3>
                     Loading...
                  </h3>
                </div>
                
               </center>
                <form>

                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" id="first_name">
                  </div>
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name">
                  </div>

                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" id="email_id">
                  </div>
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone_num" class="form-control" id="phone_num">
                  </div>

                  <div class="form-group">
                    <label>Create Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                  </div>

                   <div class="form-group">
                    <label>Date Of Birth</label>
                    <input type="text" name="dob" class="form-control" id="dob">
                  </div>

                  <div class="row">
                       <div class="col-lg-6">
                          <input type="radio" name="gender" value="male" checked=""> Male
                       </div>
                       <div class="col-lg-6">
                          <input type="radio" name="gender" value="female"> Female
                       </div>
                    </div>
                    <div class="row mt-5">
                       
                    </div>

                  <input type="button" id="userSignUp" name="" value="Register" class="btn btn-primary">
                  <!-- <a href="#" style="text-decoration: none"><span id="newSignUp" style="font-size: 11px;font-weight: bold;">Already a Member ? Sign In</span></a> -->
                </form>
                </div>
            </div>

             <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs desktopVisible" style="background: #2f516c;padding-left:0px;">
                <img src="../../public/assets/img/modal_rt.png" class="desktopVisible img-responsive" style="width: 100%;">
                <button type="button" class="close" data-dismiss="modal" style="position:absolute; top: 20px; right: 20px;color: white;font">X</button>
               
            </div>
        </div>
      </div>
   
    </div>
  </div>
</div>