<html>
<h1>
	CHECK OUT
</h1>

<style>
table, th, td {
    border: 1px solid black;
}
</style>

@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif

<h4> Here's the book you selected</h4>
<form action="check_out" method="post">
	{{ csrf_field() }}
<table>
	<tr>
		<th>TITLE</th>		
		<th>ISBN10</th>
		<th>AUTHOR</th>

	</tr>
	
	<tr>
		<td>
			{{$var->TITLE}}
		</td>		
		<td>
			{{$var->ISBN10}}
		</td>

		<td>
			{{$var->AUTHOR}}
		</td>
	</tr>
	
</table>

<form action="check_out" method="post" novalidate>
	{{ csrf_field() }}
<h4>Enter Card Id
<input type="text-box" name="card_id">
<input type = "hidden" name = "book_details" value = "{{$var->ISBN10}}">
<button id="submit" type="submit">Go</button>
</h4>
</form>

</html>