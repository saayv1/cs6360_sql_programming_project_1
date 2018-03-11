<html>
<h1>
	CREARE NEW BORROWER
</h1>
<style>
table, th, td {
    border: 1px solid black;
}
</style>

@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif

<?php $message = Session::get('message'); ?>
@if($message)
<h4>{{$message}}</h4>
@endif

<form action="create_borrower" method="post">
	{{ csrf_field() }}

<h4>Fname</h4>
<input type="text-box" name="fname">

<h4>Lname</h4>
<input type="text-box" name="lname">
	

<h4>SSN</h4>
<input type="text-box" name="ssn">
	

<h4>Address</h4>
<input type="text-box" name="address">
	
<h4>Email</h4>
<input type="text-box" name="email">
	
<h4>City</h4>
<input type="text-box" name="city">

<h4>State</h4>
<input type="text-box" name="state">
<h4>Phone</h4>
<input type="text-box" name="phone">

<button id="submit" type="submit">Submit</button>

</form>


</html>