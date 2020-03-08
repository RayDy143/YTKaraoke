<main>
	<div class="container">
		<div class="card col s12">
			
		</div>
	</div>
	<div class="row">
      <div class="col s12">
        <div class="card-panel">
        	<h5>Users</h5>
         	<table class="bordered highlight responsive-table" id="UserTable">
				<thead>
					<tr>
						<th>UserID</th>
						<th>Email</th>
						<th>Name</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
        </div>
      </div>
    </div>
	<div class="fixed-action-btn">
		<a class="btn-floating btn-large red pulse">
		  <i class="large material-icons">mode_edit</i>
		</a>
		<ul>
	  		<li><a class="btn-floating modal-trigger red btn tooltipped" href="#UserModal" data-tooltip="Add New User" data-position="left"><i class="material-icons">add</i></a></li>	
		</ul>
	</div>
	<div class="modal bottom-sheet" id="UserModal">
		<form action="#" id="frmUser" method="POST">
		<div class="modal-content">
			<h4>Add User</h4>
			<div class="row">
				<div class="input-field col s4">
					<input type="email" required name="Email" id="txtEmail">
					<label for="txtEmail">Email</label>
				</div>
				<div class="input-field col s4">
					<input type="text" required name="FirstName" id="txtFname">
					<label for="txtFname">First Name</label>
				</div>
				<div class="input-field col s4">
					<input type="text" required name="LastName" id="txtLname">
					<label for="txtLname">Last Name</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn modal-action red modal-close">close</button>
			<button class="btn modal-action" type="submit">Add<i class="material-icons right">send</i></button>
		</div>
		</form>
	</div>
	<div class="modal bottom-sheet" id="UpdateUserModal">
		<div class="modal-content">
			<form action="#" id="frmUpdateUser" method="POST">
				<div class="modal-content">
					<h4>Update User</h4>
					<div class="row">
						<input type="hidden" required name="ID" id="txtID">
						<div class="input-field col s4">
							<input type="email" required name="Email" id="txtUpdateEmail">
							<label for="txtUpdateEmail">Email</label>
						</div>
						<div class="input-field col s4">
							<input type="text" required name="FirstName" id="txtUpdateFname">
							<label for="txtUpdateFname">First Name</label>
						</div>
						<div class="input-field col s4">
							<input type="text" required name="LastName" id="txtUpdateLname">
							<label for="txtUpdateLname">Last Name</label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn modal-action red modal-close">close</button>
					<button class="btn modal-action" type="submit">Update<i class="material-icons right">send</i></button>
				</div>
			</form>
		</div>
	</div>
</main>
<script type="text/javascript">
	$(document).ready(function() {
		$('.modal').modal();
		$('.tooltipped').tooltip();
		$('.fixed-action-btn').floatingActionButton();
		getUser();
		$('#UserTable tbody').on( 'click', 'button.edit', function () {
	        $('#UpdateUserModal').modal('open');
	        var id=$(this).attr('data-id');
	        $.ajax({
	        	url: '<?php echo base_url(); ?>index.php/User/getUserByID/'+id,
	        	type: 'POST',
	        	dataType: 'json'
	        })
	        .done(function(response) {
	        	console.log("success");
	        	$("#txtID").val(response.user.ID);
	        	$("#txtUpdateEmail").val(response.user.Email);
	        	$("#txtUpdateLname").val(response.user.Lastname);
	        	$("#txtUpdateFname").val(response.user.Firstname);
	        	M.updateTextFields();
	        })
	        .fail(function() {
	        	console.log("error");
	        })
	        .always(function() {
	        	console.log("complete");
	        });
	        
	    } );

	    $('#UserTable tbody').on( 'click', 'button.delete', function () {
	    	var id=$(this).attr('data-id');
	        $.ajax({
	        	url: '<?php echo base_url(); ?>index.php/User/DeleteUser/'+id,
	        	type: 'POST',
	        	dataType: 'json'
	        })
	        .done(function() {
	        	console.log("success");
	        	M.toast({html:"Deleted"});
	        	getUser();
	        })
	        .fail(function() {
	        	console.log("error");
	        })
	        .always(function() {
	        	console.log("complete");
	        });
	        
	    } );

		$("#frmUser").submit(function(e) {
			e.preventDefault();
			$.ajax({
				url: '<?php echo base_url(); ?>index.php/User/AddUser',
				type: 'POST',
				dataType: 'json',
				data: $("#frmUser").serialize()
			})
			.done(function() {
				console.log("success");
				$('.modal').modal('close');
				M.toast({html: 'Added!', classes: 'rounded'});
				getUser();
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		});

		$("#frmUpdateUser").submit(function(e) {
			e.preventDefault();
			$.ajax({
				url: '<?php echo base_url(); ?>index.php/User/UpdateUser',
				type: 'POST',
				dataType: 'json',
				data: $("#frmUpdateUser").serialize()
			})
			.done(function(response) {
				console.log("success");
				if(response.success){
					$('.modal').modal('close');
					M.toast({html: 'Updated!', classes: 'rounded'});
					getUser();
				}
				
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		});

		function assignToEventsColumns(data) {
		    var table = $('#UserTable').dataTable({
		        "bAutoWidth": false,
		        "bDestroy": true,
		        "autoWidth": true,
		        "columnDefs": [ {
					"targets": 3,
					"orderable": false
				} ],
		        "aaData": data.user,
		        "columns": [{
		            "data": "ID"
		        }, {
		            "data": "Email"
		        }, {
		            "mData": function vehicle(data, type, dataToSet) {
		    			return data.Firstname + " " + data.Lastname;
		    		}
		        }, {
		        	"mData": function vehicle(data, type, dataToSet) {
		    			return "<button class='btn btn-floating waves-effect waves-light edit' href='#' data-id='"+data.ID+"'><i class='material-icons'>mode_edit</i></button><button class='btn red waves-effect waves-light btn-floating delete' data-id='"+data.ID+"'><i class='material-icons'>delete</i></button>";
		    		}
		        }]
		    });
		    $('select').formSelect();

		}
		function getUser() {
			$.ajax({
				url: '<?php echo base_url(); ?>index.php/User/GetUser',
				type: 'POST',
				dataType: 'json'
			})
			.done(function(response) {
				assignToEventsColumns(response);
				
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		}
	});
</script>


