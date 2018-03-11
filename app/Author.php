<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //

	protected $table = 'AUTHORS';

    protected $primaryKey = 'AUTHOR_ID';

   public function book_author()
	{
		return $this->hasMany(Book_Author::class,'AUTHOR_ID');
		# code...
	}
  
}
