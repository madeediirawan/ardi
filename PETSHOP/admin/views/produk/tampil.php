<div class="row">
    <div class="pull-left">
        <h4>Daftar Produk</h4>
    </div>
    <div class="pull-right">
        <a href="index.php?mod=produk&page=add">
            <button class="btn btn-primary">Add</button>
        </a>
    </div>
</div>
<div class="row">
    <table class="table">
        <thead>
            <tr>
                <td>
                    #
                </td>
                <td>Id</td><td>Nama</td><th>Jenis</th><th>Harga</th><td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php if($produk != NULL){ 
                $no=1;
                foreach($produk as $row){?>
                    <tr>
                        <td><?=$no;?></td><td><?=$row['id_produk']?></td><td><?=$row['nama'];?></td><td><?=$row['jenis']?></td>
                        <td><?=$row['harga']?></td>                        
                        <td>
                            <a href="index.php?mod=produk&page=edit&id=<?=$row['id_produk']?>"><i class="fa fa-pencil"></i> </a>
                            <a href="index.php?mod=produk&page=delete&id=<?=$row['id_produk']?>"><i class="fa fa-trash"></i> </a>
                        </td>
                    </tr>
               <?php $no++; }
            }?>
        </tbody>
    </table>
</div>