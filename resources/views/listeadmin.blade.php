<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Administration</title>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>



<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
		responsive:true,
		lengthChange:false,
		autoWidth:false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example1').DataTable( {
		responsive:true,
		lengthChange:false,
		autoWidth:false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>


<link rel="apple-touch-icon" sizes="180x180" href="{{asset('vendors/images/favicon_Dorra_DHAHRI.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('vendors/images/favicon_Dorra_DHAHRI.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('vendors/images/favicon_Dorra_DHAHRI.png')}}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/core.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/css/responsive.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/style.css')}}">

	
</head>
<body>

<!-- header -->
@include('Layouts.header')
<!-- //header -->
<!-- header -->
@include('Layouts.sidebar')
<!-- //header -->

<div class="main-container1">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Liste des admins</h4>
								 @if(Session::has('success'))
        <div class="alert alert-success">
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
       @if(Session::has('danger'))
        <div class="alert alert-danger">
            <p>{{ Session::get('danger') }}</p>
        </div>
    @endif
							</div>
							<div class="clearfix">
                      
                        <form name="frmImage" role="form" method="Post" action="{{route('Ajoutadmin')}}" ENCTYPE="multipart/Form-data" data-toggle="validator" onsubmit="return validation(thisform)">
						@csrf     
						<div class="pull-right">
                                <button type="submit" name="submit" class="btn pull-right btn-dore">Ajouter admin</button>
                            </div>

                        </form>

                    </div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('acceuil')}}">Acceuil</a></li>
									<li class="breadcrumb-item active" aria-current="page">Admins</li>
								</ol>
							</nav>
						</div>
					
					</div>
				</div>
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Liste des admins</h4>
						
					</div>
					@if ($admintotal==0) 
  <center>
    <h3 class="alert alert-warning">
      <strong> Vous ne possedez pas aucune admins pour le moment</strong>
    </h3>
  </center>
   @else
					<div class="pb-20">
					<table class="table display nowrap" id="example">
							<thead>
								<tr>
								
								<th >Nom/prénom </th>
								<th >Photo</th>
								<th >Email</th>
								<th >Mot de passe</th>
								<th >Role</th>
                                <th >Action</th>
								
								</tr>
							</thead>
							<tbody>
							@foreach ($admins as $admin)
                            
							
                            <tr>
                           
                                  <td>{{ $admin->name }}   </td>
								  <td><img src="{{asset('images/'. $admin->photo)}}" class="image_add_article"  width="100">  </td>
                                  <td>{{ $admin->email}} </td>
                                  <td>{{$admin->motdepass }} </td>
                                  <td>{{$admin->role }} </td>
                                  <td>
                          
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
											<form action="{{route('Adminview')}}" method="POST" id="form" >
                            	 	                 @csrf 
                            	 	                 <input type="number" name="id" value="{{ $admin->id }}"  hidden > 
												     <a class="dropdown-item" href="#"><button type="submit" class="button2"> <i class="dw dw-eye"></i> Voir </button></a>
										</form>
											<form action="{{route('Modifieradmin')}}" method="POST" id="form" >
                            	 	                 @csrf 
                            	 	                 <input type="number" name="id" value="{{ $admin->id }}"  hidden > 
												     <a class="dropdown-item" href="#"><button type="submit" class="button2"> <i class="dw dw-edit2"></i> Modifier </button></a>
										</form>
										<form action="{{route('destroyAdmin')}}" method="POST" id="form" >
                            	 	                 @csrf 
                            	 	                 <input type="number" name="id" value="{{ $admin->id }}"  hidden > 
												     <a class="dropdown-item" href="#"><button type="submit" class="button2"> <i class="dw dw-delete-3"></i> Supprimer </button></a>
										</form>
												
											</div>
										</div>
									</td>
								</tr>
							
								@endforeach
						
							</tbody>
						</table>
					</div>
				
				</div>
			</div>
		    


					
  @endif 
			
				
			</div>
			

	<!-- footer -->
@include('Layouts.footer')
<!-- //footer -->
</div>
</div>
</body>
	<!-- js -->
	<script src="{{asset('vendors/scripts/core.js')}}"></script>
	<script src="{{asset('vendors/scripts/script.min.js')}}"></script>
	<script src="{{asset('vendors/scripts/process.js')}}"></script>
	<script src="{{asset('vendors/scripts/layout-settings.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>

	<script src="{{asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
	<!-- buttons for Export datatable -->
	<script src="{{asset('src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/buttons.print.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/pdfmake.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/vfs_fonts.js')}}"></script>
	<!-- Datatable Setting js -->
	<script src="{{asset('vendors/scripts/datatable-setting.js')}}"></script></body>
</html>