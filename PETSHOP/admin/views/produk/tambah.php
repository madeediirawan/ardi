<h4>Tambah Data</h4>
<hr>
<form action="index.php?mod=produk&page=save" method="POST" enctype="multipart/form-data">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Nama</label>
            <input type="text" name="nama" required value="<?=(isset($_POST['nama']))?$_POST['nama']:'';?>" class="form-control">
            
            <span class="text-danger"><?=(isset($err['nama']))?$err['nama']:'';?></span>
        </div>
        
        <div class="form-group">
        <label for="">Jenis</label>
            <input type="text" name="jenis" value="<?=(isset($_POST['jenis']))?$_POST['jenis']:'';?>" class="form-control">
            <span class="text-danger"><?=(isset($err['jenis']))?$err['jenis']:'';?></span>
        </div>
        <div class="form-group">
        <label for="">harga</label>
            <input type="number" name="harga" value="<?=(isset($_POST['harga']))?$_POST['harga']:'';?>" class="form-control">
            <span class="text-danger"><?=(isset($err['harga']))?$err['harga']:'';?></span>
        </div>
    </div>
        <div class="form-group">
        Pilih file:
        <img src="../media/<?=$_POST['photos']?>" width="100">
        <input type="file" name="photos" id="photos" value="Upload Image">
        <span class="text-danger"><?=(isset($err['photos']))?$err['photos']:'';?></span>
    </div>
    <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
    </div>
    </div>
</form>