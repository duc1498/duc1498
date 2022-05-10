<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

use App\Post;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route::get('index'.'IndexController@showIndex');

Route::get('profile/{name}','ProfileController@showProfile');

Route::get('index','HomeController@showWelcome');
Route::get('about','AboutController@showDetails');


// Route::get('about',function (){          //tạo thêm 1 đường đẫn đến link khác
//     return 'About Content';
// });
Route::get('about/directions',function (){ //tạo 1 trang mới là trang con của trang wep
    return 'Directions go here';
});

Route::any('submit-form',function(){  //
    return 'Process Form';

});


// Route::get('about/{theSubject}',function($theSubject){ // thay đổi cách hiện thị trang wep bằng cách giá trị truyền vào trên thanh trình duyệt
//      return $theSubject. ' content goes here'; // nối chuỗi
// });

Route::get('about/{theSubject}','AboutController@showSubject');//thêm tên miền sau

Route::get('about/classes/{theSubject}',function($theSubject){ //ghi nộ dung trên
     return "Content on $theSubject";

});
Route::get('about/classes/{theArt}/{thePrice}',function($theSubject,$thePrice){  //tra ve ket qua chuoi gồm 2 giá trị
    return "The product: $theSubject and $thePrice";

});
Route::get('where',function(){
    return Redirect::route('directions');

});
   // thêm dữ liệu
Route::get('/insert',function(){
    DB::insert('insert into posts(title,body,is_admin) values(?,?,?)',['PHP with Laravel','Laravel is the best fremeword !',0]);
    return 'DONE';
});
//truy vấn đến mysql
Route::get('/read',function(){
    $result = DB::select('select * from posts where id = ?',[1]);

    foreach($result as $post){
       return $post->title;
}
});
 //cap nhập dữ liệu
Route::get('update',function(){
    $updated = DB::update('update posts set title = "New title" where id > ?',[1]);
    return $updated;
    });
// xóa dữ liệu
Route::get('delete',function(){
    $deleted = DB::delete('delete from posts where id = ?',[2]);
   return $deleted;
   });
   
// đọc dữ liệu (eloquent : giúp tương tác với dũ liệu database 1 cách đơn giản và linh hoạt)

Route::get('readALL',function(){   //tạo 1 miền
    $posts = Post::all();   // gọi toàn bộ dữ liệu trong model Post
    foreach ($posts as $p) {    // duyệt qua từng bản ghi 1
        echo $p->title ."".$p->body ;  // echo in ra màn hình 
        echo "<br>";
    }
});
// //tìm kiếm trong bản ghi
// Route::get('findID', function() { // tạo 1 miền 
//     $posts = Post::where('id','4') // tìm kiếm tat ca cac bản ghi trong bảng posts có trường id là 2
//        ->orderBy('id','desc') // sắp xếp ID giá trị tăng dần
//        ->take(10)  // muốn lấy bn bản ghi
//        ->get(); // truy vấn dữ liệu ra
// // hiển thị dữ liệu
// foreach ($posts as $p) {    // duyệt qua từng bản ghi 1
//     echo $p->title ."".$p->body ;  // echo in ra màn hình 
//     echo "<br>";
// }
// }) ;


//tìm kiếm nâng cao
Route::get('findID' , function(){
 $posts = Post::where('id','>=','4') // tìm kiếm dữ liệu lớn hơn 4
        ->where('title','New title') // mệnh đề tìm kiếm (tìm kiếm trong title từ khóa New title)
        ->where('body','like','%Laravel')
        ->orderBy('id','desc') // sắp xếp theo ID giá trị tăng dần
        ->take(10) // muốn lấy bao nhiêu bản ghi
        ->get(); // truy vấn dữ liệu ra
        foreach ($posts as $p) {    // duyệt qua từng bản ghi 1
    echo $p->title ."".$p->body ;  // echo in ra màn hình 
    echo "<br>";
}
});

// insert dữ liệu thông qua model (insert : thêm mới dữ liệu)
Route::get('insertORM', function(){ // tạo 1 miền
    $p = new Post;   // gửi dữ liệu đi
    $p->title = 'insert ORM';    
    $p->body = 'INSERTED done done ORM';
    $p->is_admin = 1;
    $p->save(); // lưu trữ đối tượng vừa thêm
});

// cập nhập bản ghi 
Route::get('updateORM', function(){  //tao miền
    $p = Post::where('id','4')->first(); //tìm kiếm giá trị trong bản ghi
    $p->title = 'updated ORM';
    $p->body = 'updated Ahihi DONE DONE';
    $p->save();
});

// xóa bản dữ liệu
Route::get('deleteORM', function(){
    Post::where('id','>=',14)
    ->delete();
});

//xóa bản ghi nhưng cách khác
Route::get('destroyORM', function(){
       Post::destroy([7,5]);
});
