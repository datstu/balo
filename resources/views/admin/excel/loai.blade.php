@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Nhập xuất file excel Loại sản phẩm
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                        <form action="{{url('/import-loaisp')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                            <input type="file" name="file" accept=".xlsx"><br>
                            <input type="submit" value="Nhập file" name="import_csv" class="btn btn-warning">
                        </form>
                        <form action="{{url('/export-loaisp')}}" method="POST">
                              @csrf
                           <input type="submit" value="Xuất file" name="export_csv" class="btn btn-success">
                        </form>

                            </div>
                           

                        </div>
                    </section>

            </div>
@endsection