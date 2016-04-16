<?php if(is_null($siswa->getNilaiByUH($judul_kelas[0], $no_uh, $semester))) : ?>
<a id="tombol<?=$siswa->getNis()."_".$no_uh?>">
    --
</a>
<script type="text/javascript">
    $("#tombol<?=$siswa->getNis()."_".$no_uh?>").click(function (){
        // experiment : ajax_tambah_nilai (kalau mau balik, dihilangkan ajax-nya)
        $("#form-edit").attr("action", "<?=base_url();?>admin/nilai/ajax_tambah_nilai/<?=$judul_kelas[0]?>/<?= $siswa->getNis();?>");
        $("#no_uh").attr("value", "<?=$no_uh?>");
        $("#kelas").attr("value", "<?=$judul_kelas[0]?>");
        $(".input_nilai").attr("value", "");
        $(".nilai_remidi").attr("value", "");
        $("#semester").attr("value", "<?=$semester?>");
        $("#tahun_ajaran").attr("value", "<?=$tahun_ajaran;?>");
        $("#tgl").attr("value", "<?=date('d-n-Y');?>");
        $("#btn-del").addClass("disabled");
        $("#form-modal").modal("toggle");
    });
</script>
<?php else : ?>
<?php $data_nilai = $siswa->getNilaiByUH($judul_kelas[0], $no_uh, $semester);
$keterangan = $data_nilai->getKeterangan();
?>
<a data-toggle="modal" id="tombol2<?=$data_nilai->getId();?>">
    <?= $data_nilai->getNilai();?>
</a>
<script type="text/javascript">
    $("#tombol2<?=$data_nilai->getId();?>").click(function (){
        $("#form-edit").attr("action", "<?=base_url();?>admin/nilai/ajax_edit_nilai/<?=$data_nilai->getKelas()?>/<?= $data_nilai->getSiswa()->getNis();?>");
        $("#no_uh").attr("value", "<?=$data_nilai->getNo_uh()?>");
        $("#kelas").attr("value", "<?=$data_nilai->getKelas()?>");
        $("#semester").attr("value", "<?=$data_nilai->getSemester()?>");
        $(".input_nilai").attr("value", "<?php echo $data_nilai->getNilai();?>");
        $(".nilai_remidi").attr("value", "<?php echo (is_null($data_nilai->getNilai_remidi())) ? '' : $data_nilai->getNilai_remidi();?>");
        $("#tahun_ajaran").attr("value", "<?=$data_nilai->getTahun();?>");
        $("#tgl").attr("value", "<?=date('d-n-Y', $data_nilai->getTanggal()->getTimestamp());?>");
        $("#btn-del").removeClass("disabled");
        $("#btn-del-ok").attr("href", "<?php echo base_url().'admin/nilai/ajax_hapus_nilai';?>/<?= $data_nilai->getSiswa()->getNis();?>/<?= $data_nilai->getKelas();?>/<?= $data_nilai->getSemester();?>/<?= $data_nilai->getNo_uh();?>/<?= $data_nilai->getTahun();?>");
        $("#form-modal").modal("toggle");
    });
</script>
<?php endif;?>
