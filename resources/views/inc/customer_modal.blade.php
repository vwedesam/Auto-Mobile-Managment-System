		


			<div class="modal fade" id="addNewCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	          <div class="modal-dialog" role="document">
	            <div class="modal-content">
	              <div class="modal-body">
	                <div class="box">
	                    <div class="box-header">
	                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                        <i class="icon-book"></i>
	                        <h5> Add New Customer </h5>
	                    </div>
	                    <div class="box-content">
	                        {!! Form::open(['method' => 'POST', 'route' => ['customer.store']])    !!} <!-- Customer Form -->
	              
	                            <div class="input-prepend">
	                                <span class="add-on"><i class="icon-user"></i></span>
	                                <input class="span4" value="" name="full_name" type="text" placeholder="Full Name..." required >
	                            </div>
	                            <br>
	                            <div class="input-prepend">
	                                <span class="add-on"><i class="icon-envelope"></i></span>
	                                <input class="span4" value="" name="email" type="email" placeholder="Email address" required="true">
	                            </div>
	                            <br>
	                            <div class="input-prepend">
	                                <span class="add-on"><i class="icon-flag"></i></span>
	                                <input class="span4" value="" name="address" type="text" placeholder="Enter Full Address..." required >
	                            </div>
	                            <br>
	                            <div class="input-prepend">
	                                <span class="add-on"><i class="icon-phone"></i></span>
	                                <input class="span4" value=""  name="phone_number" type="number" placeholder="Phone Number..." required >
	                            </div>
	                    </div>
	                    <div class="box-footer">
	                           <button type="submit" class="btn btn-primary">
	                            <i class="icon-ok"></i>
	                            Submit !!
	                           </button>
	                        </form>
	                    </div>
	                </div>
	             </div>

	            </div>
	          </div>
	       </div>