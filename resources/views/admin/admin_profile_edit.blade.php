@extends('admin/admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container-full">

	

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Admin Profile Edit</h4>
			 
			</div>
			<!-- /.box-header -->
		         <div class="box-body">
			  <div class="row">
				<div class="col-12">
					<form method="post" action="{{route('admin-profile-store')}}" enctype="multipart/form-data">
					@csrf   
					<div class="row">
						<div class="col-12">		
                            
                        
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
								<h5>Admin User Name <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="name" class="form-control" value="{{$editData->name}}"> 
							</div>
                            </div> 
                            </div> 
                            <div class="col-md-6">
                            <div class="form-group">
								<h5>Admin Email <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="email" name="email" class="form-control" value="{{$editData->email}}"> 
							</div>
                            </div> 
                            </div> 
                            
                        </div><!-- end row -->

                        <div class="row">
                            <div class="col-md-6">

                            <div class="form-group">
								<h5>Profile Image <span class="text-danger">*</span></h5>
								<div class="controls">
									<input id="image" type="file" name="profile_photo_path" class="form-control"  > </div>
							</div>
                            </div>

                            <div class="col-md-6">

                            <img id="showImage" style="width: 100px; height:100px;" class="rounded-circle" 
                            src="{{(!empty($editData->profile_photo_path)) ? url('upload/admin_images/'.$editData->profile_photo_path) : url('upload/no_image.jpg')}}">
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

<script >
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();

            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>


@endsection