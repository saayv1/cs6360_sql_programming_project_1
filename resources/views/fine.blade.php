<html>
<h1> FINES
</h1>

<style>
table, th, td {
    border: 1px solid black;
}
</style>

<form action="fine" method="post" novalidate>
	{{ csrf_field() }}

<input type="text-box" name="update">
<button id="submit" type="submit">Update</button>

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
		<th>CARD ID</th>
		<th>FNAME</th>
		<th>LNAME</th>		
		<th>FINE AMOUNT</th>
		
	</tr>
	@foreach($list_of_all_fines as $v)
	<tr>
		<td>
			{{$v->CARD_ID}}
		</td>	
		<td>
			{{$v->FNAME}}
		</td>
		<td>
			{{$v->LNAME}}
		</td>	
		<td>
			${{$v->TOTAL_FINE}}
		</td>

		
	
		<td>
		<form action="fine_pay" method="post" >
			{{ csrf_field() }}
			<input type = "hidden" name = "card_id" value = "{{$v->CARD_ID}}">
			<button id="submit" type="submit">Select</button>
		</form>
	
		</td>
	</tr>
	@endforeach
</table>

</html>