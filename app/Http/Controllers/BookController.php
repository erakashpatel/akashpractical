<?php

namespace App\Http\Controllers;
use App;
use App\Book;
use DB;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = Book::with(['Categories'])->paginate(10);

      
        if($request->ajax()){
            $books = Book::with(['Categories'])->skip($request['jtStartIndex'])->take($request['jtPageSize'])->get();
            $jTableResult = array();
            App::setLocale($request['locale'], config('app.locale'));
            $jTableResult['Result'] = "OK";
            foreach ($books as $value) {
                $cats = $value->Categories->pluck('category_name')->all();
                $value->cats = implode(',',$cats);
                $book_array = array();
                $book_array['id'] = $value->id;
                $book_array['cats'] = $value->cats;
                $book_array['book_title'] = $value->book_title;
                $book_array['book_author'] = $value->book_author;
                $book_array['issued_on'] = $value->issued_on;
                $result[] = $book_array;
            }
            $jTableResult['Records'] = $result;
            $jTableResult['TotalRecordCount'] = Book::all()->count();
            return $jTableResult;
        }
        return view('book.index')->with('books',$books)->with('locale',$request['locale']);
    }
}
