<?php

namespace AhmetSerefoglu\RecursingLichterman\Http\Controllers;

namespace AhmetSerefoglu\RecursingLichterman;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BooksController extends Controller
{
     protected $successStatus = 200;
     protected $errorStatus = 400;
     
     /** 
      * Kitap Oluştu
     */
     public function store(Request $request)
     {

          $rules = [
               'name' => 'required',
               'publisher' => 'required',
               'authors_id' => 'required',
               'label_id' => 'required'
          ];

          $validator = Validator::make($request->all(), $rules);

          if ($validator->fails()) {
               return response()->json(['message' => $validator->errors(), 'code' => $this->errorStatus]);
          }


          $book = Book::create($request->all());

          $book->fill([
               'secret' => Crypt::encrypt($request->secret)
          ])->save();

          $message['success'] = 'Kitap Başarıyla Oluşturuldu';

          return response()->json(['message' => $message, 'code' => $this->successStatus]);
     }

     /**
      * Kitap ve Detayını Görüntüle
      */
     public function show($book_id)
     {
          try {
               $book = Book::findOrFail($book_id);

               if ($book->users) {
                    foreach ($book->users as $k) {
                         $message['users'] = $k->name;
                    }
               }

               $message['book'] = $book;

               
               $message['authors'] = $book->authors->name;
               $message['label'] = $book->labels->label_no;

               $message['success'] = "Kitap Çağırıldı";

          } catch (ModelNotFoundException $e) {
               if ($e instanceof ModelNotFoundException) {

                    $message['error'] = 'Kayit Bulunamadi';

                    return response()->json(['message' => $message, 'code' => $this->errorStatus]);
               }
          }
          return response()->json(['message' => $message, 'code' => $this->status]);
     }

     /**
      * Yazar'a göre kitap listele
      */
     public function authorBook($author_id)
     {

          try {
               $author = Author::findOrFail($author_id);

               foreach ($author->books as $k) {
                    $message['book'] = $k;
               }
          } catch (ModelNotFoundException $e) {
               if ($e instanceof ModelNotFoundException) {

                    $message['error'] = 'Kayit Bulunamadi';

                    return response()->json(['message' => $message, 'code' => $this->errorStatus]);
               }
          }
          return response()->json(['message' => Crypt::encrypt($message), 'code' => $this->status]);
     }

     /**
      * Etikete göre kitap listele
      */
     public function labelBook($label_id)
     {
          try {
               $label = Label::findOrFail($label_id);

               $message['book'] = $label->book;
          } catch (ModelNotFoundException $e) {
               if ($e instanceof ModelNotFoundException) {

                    $message['error'] = 'Kayit Bulunamadi';

                    return response()->json(['message' => $message, 'code' => $this->errorStatus]);
               }
          }
          return response()->json(['message' => Crypt::encrypt($message), 'code' => $this->status]);
     }

     /**
      * Kitap'ı Kullanıcıya ata
      */
     public function booksDeliveryStore(Request $request, $book_id)
     {
          try {
               $book = Book::findOrFail($book_id);

               $book->kullanici()->attach($request->kullanici);

               $message['error'] = 'Kitap Kullanıcıya Atandı';

          } catch (ModelNotFoundException $e) {
               if ($e instanceof ModelNotFoundException) {

                    $message['error'] = 'Kayit Bulunamadi';

                    return response()->json(['message' => $message, 'code' => $this->errorStatus]);
               }
          }
          return response()->json(['message' => Crypt::encrypt($message), 'code' => $this->status]);
     }

     /**
      * Kitabı Kullanıcıdan Al
      */
     public function booksDeliveryDelete(Request $request, $book_id)
     {
          try {
               $book = Book::findOrFail($book_id);
               $bookdelivery = BookDelivery::create([
                    'books' => $book->name,
                    'delivery' =>$book->authorized_person
               ]);
               $book->kullanici()->detach($request->kullanici);

               $message['error'] = 'Kitap Kullanıcıdan Alındı';

          } catch (ModelNotFoundException $e) {
               if ($e instanceof ModelNotFoundException) {

                    $message['error'] = 'Kayit Bulunamadi';

                    return response()->json(['message' => $message, 'code' => $this->errorStatus]);
               }
          }
          return response()->json(['message' => $message, 'code' => $this->status]);
     }

     /**
      * Kitabı teslim alanlar
      */
     public function booksDeliveryShow($book_id)
     {
          try {
               $book = Book::findOrFail($book_id);
               
               $bookDelivery = BookDelivery::where('book',$book->name)->get();

               $message['bookdelivery'] = $bookDelivery;
               
               $message['error'] = 'Kitap Teslim Alanlar';

          } catch (ModelNotFoundException $e) {
               if ($e instanceof ModelNotFoundException) {

                    $message['error'] = 'Kayit Bulunamadi';

                    return response()->json(['message' => $message, 'code' => $this->errorStatus]);
               }
          }
          return response()->json(['message' => Crypt::encrypt($message), 'code' => $this->status]);
     }
}
