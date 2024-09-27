@extends('layouts.simple.master')
@section('title', 'Employee')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Employees</li>
<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="job-search">
					<div class="card-body pb-0">
						<div class="media">
							<div class="media-body">
								<h4 class="f-w-600"><a href="#">Create Employee</a>
								</h4>
							</div>
						</div>
						<div class="job-description">
							<h6 class="mb-0">Personal Details </h6>
							<form class="form theme-form" action="{{route('employees.store')}}" method="POST">
								@csrf
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>First Name:<span class="font-danger">*</span></label>
											<input class="form-control" name="first_name" type="text" required="">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>Last Name:<span class="font-danger">*</span></label>
											<input class="form-control" name="last_name" type="text" required="">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>Email:</label>
											<input class="form-control" name="email" type="email">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>Phone:</label>
											<input class="form-control" name="phone" type="tel">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>Address:</label>
											<input class="form-control" name="address" type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>Designation:</label>
											<input class="form-control" name="designation" type="text" placeholder="E.g. Manager">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>Salary (N):</label>
											<input class="form-control" name="salary" type="number" min="0">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>Bank Name:</label>
											<input class="form-control" name="bank_name" type="text" placeholder="E.g Zenith Bank">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label>Account Number:</label>
											<input class="form-control" name="bank_account_number" type="number" min="0">
										</div>
									</div>
								</div>
								<div>
									<button class="btn btn-primary" type="submit">Create</button>
								</div>
							</form>
						</div>
					</div>		
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
@endsection