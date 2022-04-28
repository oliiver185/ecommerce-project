@extends('admin/admin_master')
@section('admin')




<div class="container-full">

	

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Admin Change Password</h4>
			 
			</div>
			<!-- /.box-header -->
		         <div class="box-body">
			  <div class="row">
				<div class="col-12">
					<form method="post" action="{{route('update-change-password')}}" >
					@csrf   
					<div class="row">
						<div class="col-12">		
                            
                        
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
								<h5>Current Password <span class="text-danger">*</span></h5>
								<div class="controls">
									<input  type="password" id="current_password" name="oldpassword" class="form-control" > 
							</div>
                            </div> 
                           
                            
                            <div class="form-group">
								<h5>Current Password <span class="text-danger">*</span></h5>
								<div class="controls">
									<input id="password" type="password" name="password"  class="form-control" > 
							</div>
                            </div> 
                            
                            
                            <div class="form-group">
								<h5>Confirmation Password <span class="text-danger">*</span></h5>
								<div class="controls">
									<input id="password_confirmation" type="password" name="password_confirmation" class="form-control" > 
							</div>
                            </div> 
                            </div>
                        </div><!-- end row -->

                       
                        
						
						
							
							
						</div>
						</div>
					
					
						
						
						<div class="text-xs-right">
							<input type="submit" value="Update" class="btn btn-rounded btn-primary mb-5">
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			</div>
			<!-- /.box-body -->
		

		</section>
		<!-- /.content -->
	  </div>
            
            </div>
        </section>

</div>




@endsection