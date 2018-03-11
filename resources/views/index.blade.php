<html>
<h1> LIBRARIAN 
</h1>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
<form action="main" method="post" novalidate>
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
		<th>TITLE</th>		
		<th>ISBN10</th>
		<th>AUTHOR</th>
		<th>AVAILABILITY</th>

	</tr>
	@foreach($var as $v)
	<tr>
		<td>
			{{$v->TITLE}}
		</td>		
		<td>
			{{$v->ISBN10}}
		</td>

		<td>
			{{$v->AUTHOR}}
		</td>
		<td>
			{{$v->AVAILABILITY}}
		</td>
		<td>
			<!--
			<a href="check_out?book_details=<?php echo $v->ISBN10; ?>">Select</a></td>
		--><form action="check_out" method="get" >
			{{ csrf_field() }}
			<input type = "hidden" name = "book_details" value = "{{$v->ISBN10}}">
			<button id="submit" type="submit">Select</button>
		</form>
	
		</td>
	</tr>
	@endforeach
</table>

	{{$var->links()}}
</html>