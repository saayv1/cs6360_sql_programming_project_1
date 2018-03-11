<html>
<h1> CHECK IN
</h1>

<style>
table, th, td {
    border: 1px solid black;
}
</style>

<form action="check_in_search" method="post" novalidate>
	{{ csrf_field() }}
<h4>Search
<input type="text-box" name="selection">
<button id="submit" type="submit">Go</button>
</h4>
</form>
@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif

<?php $message = Session::get('message'); ?>
@if($message)
<h4>{{$message}}</h4>
@endif
	{{ csrf_field() }}
<table>
	<tr>
		<th>BORROWER ID</th>		
		<th>ISBN10</th>
		<th>FNAME</th>
		<th>LNAME</th>
		<th>DATE OUT</th>

	</tr>
	@foreach($var as $v)
	<tr>
		<td>
			{{$v->CARD_ID}}
		</td>		
		<td>
			{{$v->ISBN10}}
		</td>

		<td>
			{{$v->FNAME}}
		</td>
		<td>
			{{$v->LNAME}}
		</td>
		<td>
			{{$v->DATE_OUT}}
		</td>
		<td>
			<!--
			<a href="check_out?book_details=<?php echo $v->ISBN10; ?>">Select</a></td>
		-->
		<form action="check_in" method="post" >
			{{ csrf_field() }}
			<input type = "hidden" name = "loan_id" value = "{{$v->LOAN_ID}}">
			<button id="submit" type="submit">Select</button>
		</form>
	
		</td>
	</tr>
	@endforeach
</table>

</html>