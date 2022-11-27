<?php
    function insert_phong($tenphong,$gia,$giasale,$sokhach,$img,$mota,$idlp){
        $sql="INSERT INTO phong(name_phong,price,price_sale,sokhach,img,mota,id_loaiphong) values('$tenphong','$gia','$giasale','$sokhach','$img','$mota','$idlp')";
        pdo_execute($sql);
    }
    function delete_phong($id){
        $sql="delete from phong where id_phong=".$id;
        pdo_execute($sql);
    }
    function loadall_phong_home(){
        $sql="SELECT * FROM phong where 1 order by id_phong desc limit 0,9";
        $listp=pdo_query($sql);
        return $listp;
    }
    function loadall_phong_timkiem(){
        $sql= "select phong.id_phong,phong.name_phong,phong.img,phong.sokhach,phong.price,phong.price,phong.trangthai,phong.id_loaiphong,phong.price_sale,datphong.ngayden,datphong.ngaytra from datphong
            inner join phong on datphong.id_phong=phong.id_phong";
        // $sql.= "upadate phong set trangthai ='' where id_phong=".$id_phong;
        $listsearch=pdo_query($sql);
        return $listsearch;
    }
    function loadall_phong(){
        $sql="SELECT * FROM phong order by id_phong desc";
        $listp=pdo_query($sql);
        return $listp;
    }
    function loadone_phong($id){
        $sql="select * from phong where id_phong=".$id;
        $room=pdo_query_one($sql);
        return $room;
    }
    function loadall_phongchuadat2($ngaydat , $ngaytra){
        $sql = "select * from phong where id_phong IN (select id_phong from datphong where tinhtrang = 0 AND ngayden = '$ngaydat' AND ngaytra = '$ngaytra')";
        $listphongtk = pdo_query($sql);
        return $listphongtk;
    }
    function loadall_phongchuadat3($ngaydat , $ngaytra){
        $sql = "select * from phong where id_phong IN (select id_phong from datphong where tinhtrang = 0 AND ngayden <= '$ngaydat' AND ngaytra <= '$ngaytra')";
        $listphongtk = pdo_query($sql);
        return $listphongtk;
    }
    function loadall_phongchuadat(){
        $sql = "select * from phong where id_phong NOT IN (select id_phong from datphong where tinhtrang = 1)";
        $listphongtk = pdo_query($sql);
        return $listphongtk;
    }
    function load_phong_cungloai($id){
        $sql="select * from phong where id_loaiphong=".$id." ";
        $listp=pdo_query($sql);
        return $listp;
    }
    function load_tenlp($idlp){
        if($idlp>0){
            $sql="select * from loaiphong where id_loaiphong=".$idlp;
            $lp=pdo_query_one($sql);
            extract($lp);
            return $name_phong;
        }else{
            return "";
        }
        
    }
    function update_phong($id,$tenphong,$gia,$giasale,$sokhach,$img,$mota,$idlp){
        if($img!=""){
            $sql="UPDATE phong
            SET id_phong = '$id', name_phong = '$tenphong', price = $gia, price_sale = '$giasale', sokhach = '$sokhach', img = '$img', mota = '$mota' , id_loaiphong = $idlp
            WHERE id_phong = $id ";
        }else{
            $sql="UPDATE phong
            SET id_phong = '$id', name_phong = '$tenphong', price = $gia, price_sale = '$giasale', sokhach = '$sokhach', mota = '$mota' , id_loaiphong = $idlp
            WHERE id_phong = $id ";
        }
        pdo_execute($sql);
    }
?>