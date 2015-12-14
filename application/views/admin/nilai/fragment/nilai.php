<?php if(is_null($siswa->getNilaiByUH($judul_kelas[0], $no_uh, $semester)[0])) : ?>
<a id="tombol<?=$siswa->getNis()."_".$no_uh?>">
    --
</a>
<script type="text/javascript">
    $("#tombol<?=$siswa->getNis()."_".$no_uh?>").click(function (){
        $("#formAdd").attr("action", "<?=base_url();?>admin/nilai/tambah_nilai/<?=$judul_kelas[0]?>/<?= $siswa->getNis();?>");
        $("#UhAdd").attr("value", "<?=$no_uh?>");
        $("#kelasAdd").attr("value", "<?=$judul_kelas[0]?>");
        $("#semesterAdd").attr("value", "<?=$semester?>");
        $("#tahun_ajaranAdd").attr("value", "<?=date('Y');?>");
        $("#tanggalAdd").attr("value", "<?=date('d-n-Y');?>");
        $("#addNilai").modal("toggle");
    });
</script>
<?php else : ?>
<?php $data_nilai = $siswa->getNilaiByUH($judul_kelas[0], $no_uh, $semester)[0];
$keterangan = $data_nilai->getKeterangan();
?>
<a data-toggle="modal" id="editNilai<?=$data_nilai->getId();?>">
    <?= $data_nilai->getNilai();?>
</a>
<script type="text/javascript">
    $("#editNilai<?=$data_nilai->getId();?>").click(function (){
        $("#formEdit").attr("action", "<?=base_url();?>admin/nilai/edit_nilai/<?=$data_nilai->getKelas()?>/<?= $data_nilai->getSiswa()->getNis();?>");
        $("#UhEdit").attr("value", "<?=$data_nilai->getNo_uh()?>");
        $("#kelasEdit").attr("value", "<?=$data_nilai->getKelas()?>");
        $("#semesterEdit").attr("value", "<?=$data_nilai->getSemester()?>");
        $("#nilaiEdit").attr("value", "<?=$data_nilai->getNilai()?>");
        $("#nilaiRemidiEdit").attr("value", "<?php echo (is_null($data_nilai->getNilai_remidi())) ? '' : $data_nilai->getNilai_remidi();?>");
        $("#tahun_ajaranEdit").attr("value", "<?=$data_nilai->getTahun();?>");
        $("#tanggalEdit").attr("value", "<?=date('d-n-Y', $data_nilai->getTanggal()->getTimestamp());?>");
        $("#btnDelOk").attr("href", "<?php echo base_url().'admin/nilai/hapus_nilai';?>/<?= $data_nilai->getSiswa()->getNis();?>/<?= $data_nilai->getKelas();?>/<?= $data_nilai->getSemester();?>/<?= $data_nilai->getNo_uh();?>/<?= $data_nilai->getTahun();?>");
        $("#editNilai").modal("toggle");
    });
</script>
<?php endif;?>
