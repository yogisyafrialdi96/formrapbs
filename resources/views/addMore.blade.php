<!DOCTYPE html>
<html>
<head>
    <title>Ajuan Program dan Kebutuhan Operasional Unit Sekeretariat</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
      
<div class="container">
    <div class="card mt-5">
        <h3 class="card-header p-3">Ajuan Program dan Kebutuhan Operasional Unit Sekeretariat</h3>
        <div class="card-body">

            @session('success')
                <div class="alert alert-success" role="alert"> 
                    {{ $value }}
                </div>
            @endsession

            <form method="post" action="{{ route('add-more.store') }}" enctype="multipart/form-data">
                @csrf
                <h5>Ajuan Program</h5>
                <div class="form-group mb-2">
                    <label>Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ request()->old('name') }}" />
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label>Jabtan:</label>
                    <input type="text" name="jabatan" class="form-control" placeholder="Jabatan" value="{{ request()->old('jabatan') }}" />
                    @error('jabatan')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <table class="table table-bordered mt-5 table-add-more">
                    <thead>
                        <tr>
                            <th colspan="2">Kegiatan/Barang yang dibutuhkan</th>
                            <th><button class="btn btn-primary btn-sm btn-add-more"><i class="fa fa-plus"></i> Tambah Item</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $key = 0;
                        @endphp
                        @if(request()->old('stocks'))
                            @foreach(request()->old('stocks') as $key => $stock)
                            <tr>
                                <td>
                                    <input type="text" name="stocks[{{$key}}][quantity]" class="form-control" placeholder="Nama Kegiatan/Barang" value="{{ $stock['quantity'] ?? '' }}" />
                                    @error("stocks.{$key}.quantity")
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" name="stocks[{{$key}}][price]" class="form-control" placeholder="Alokasi Anggaran" value="{{ $stock['price'] ?? '' }}" />
                                    @error("stocks.{$key}.price")
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </td>
                                <td><button class="btn btn-danger btn-sm btn-add-more-rm"><i class="fa fa-trash"></i></button></td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td><input type="text" name="stocks[0][quantity]" class="form-control" placeholder="Nama Kegiatan/Barang" /></td>
                                <td><input type="number" name="stocks[0][price]" class="form-control" placeholder="Alokasi Anggaran" /></td>
                                <td><button class="btn btn-danger btn-sm btn-add-more-rm"><i class="fa fa-trash"></i></button></td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i> Submit</button>
                </div>
            </form>

            {{-- <h5 class="mt-5">Product List:</h5>
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Total Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->stocks->sum('quantity') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">There are no products.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table> --}}
          
            {{-- {!! $products->links('pagination::bootstrap-5') !!} --}}
        </div>
    </div>
</div>
</body>

<script type="text/javascript">
    $(document).ready(function(){  

        i = "{{$key}}";
        
        $(".btn-add-more").click(function(e){
            e.preventDefault();
            i++;
            $(".table-add-more tbody").append('<tr><td><input type="text" name="stocks['+i+'][quantity]" class="form-control" placeholder="Nama Barang/Kegiatan" /></td><td><input type="number" name="stocks['+i+'][price]" class="form-control" placeholder="Alokasi Anggaran" /></td><td><button class="btn btn-danger btn-sm btn-add-more-rm"><i class="fa fa-trash"></i></button></td></tr>');
        });

        $(document).on('click', '.btn-add-more-rm', function(){  
            $(this).parents("tr").remove();
        }); 

    });
</script> 
</html>