</div>
<!-- ./wrapper -->
<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
<!-- Ekko Lightbox -->
<script src="<?php echo base_url('assets/plugins/ekko-lightbox/ekko-lightbox.min.js'); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/plugins/select2/js/select2.full.min.js'); ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js'); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('assets/plugins/chart.js/Chart.min.js'); ?>"></script>
<!-- Sparkline -->
<!-- <script src="<?php echo base_url('assets/plugins/sparklines/sparkline.js'); ?>"></script> -->
<!-- JQVMap -->
<!-- <script src="<?php echo base_url('assets/plugins/jqvmap/jquery.vmap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js'); ?>"></script> -->
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url('assets/plugins/jquery-knob/jquery.knob.min.js'); ?>"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url('assets/plugins/moment/moment.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
  <!-- Summernote -->
  <script src="<?php echo base_url('assets/plugins/summernote/summernote-bs4.min.js'); ?>"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
  <!-- bs-custom-file-input -->
  <script src="<?php echo base_url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js'); ?>"></script>
  <!-- SweetAlert2 -->
  <script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets/dist/js/adminlte.js'); ?>"></script>
  <!-- Toastr -->
  <script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!-- <script src="<?php echo base_url('assets/dist/js/pages/dashboard.js'); ?>"></script> -->
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url('assets/dist/js/demo.js'); ?>"></script>
  <!-- Filterizr-->
  <script src="<?php echo base_url('assets/plugins/filterizr/jquery.filterizr.min.js'); ?>"></script>
  <!--Notif Pusher -->
  <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
  <!--Notif Pusher -->
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->

<script>
/* Update item quantity */
function updateCartItem(obj, rowid){
	$.get("<?php echo base_url('cart/updateItemQty/'); ?>", {rowid:rowid, qty:obj.value}, function(resp){
		if(resp == 'ok'){
			location.reload();
		}else{
			alert('Cart update failed, please try again.');
		}
	});
}
</script>
    <script>
      $(document).ready(function(){
    
        load_data();
    
        function load_data(query)
        {
          $.ajax({
            url:"<?php echo base_url(); ?>order/fetch",
            method:"POST",
            data:{query:query},
            success:function(data){
              $('#result').html(data);
            }
          })
        }
    
        $('#search_text').keyup(function(){
          var search = $(this).val();
          if(search != '')
          {
            load_data(search);
          }
          else
          {
            load_data();
          }
        });
      });
    </script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('82baa001eba53108403c', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        
      xhr = $.ajax({
        method : "POST",
        url    : "<?= base_url('notifikasi/list_notifikasi') ?>",
        success : function(response){
          $('.list-notifikasi').html(response);
        }
      })
    });
  </script>
   <script>
    // loading dulu ach ---
    show_loading();
    $( window ).on("load", function() {
        // Handler for .load() called.
        $(".preload-wrapper6").fadeOut('slow');
      });
    function show_loading(){
      $(".preload-wrapper6").show();  
    }
    function hide_loading(){
      $(".preload-wrapper6").fadeOut('fast');
    }
    function call_datepicker(){
      $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true
      });
    }

     $('.list-notifikasi').on('click', '.notifikasi', function(e){
      let id = e.currentTarget.dataset.id;
      let jenis = e.currentTarget.dataset.jenis;
      show_loading();
      xhr = $.ajax({
        method : "POST",
        url : "<?= base_url('notifikasi/approval') ?>",
        data : 'id='+id+'&jenis='+jenis,
        success : function(data) {
          $('#modal_result').html(data);
                        // Display the Bootstrap modal
          $('#modal-lg').modal('show');
          // hide_loading();
        }
      })
    })
    
    $('.notifikasi').on('click', function(e){
      let id = e.currentTarget.dataset.id;
      let jenis = e.currentTarget.dataset.jenis;
      show_loading();
      xhr = $.ajax({
        method : "POST",
        url : "<?= base_url('notifikasi/approval') ?>",
        data : 'id='+id+'&jenis='+jenis,
        success : function(data) {
          $('#modal_result').html(data);
                        // Display the Bootstrap modal
                        $('#modal-lg').modal('show');
          // hide_loading();
        }
      })
    })

    /// CEK UNTUK 2 MODAL SUPAYA BISA SCROLL
    $('body').on('hidden.bs.modal', function () {
      if($('.modal.in').length > 0)
      {
        $('body').addClass('modal-open');
      }
    });


    /////// disable close modal escape
    // $.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';
    // $.fn.modal.prototype.constructor.Constructor.DEFAULTS.keyboard =  false;


    function format_angka(nilai) 
    {
      bk = nilai.replace(/[^\d]/g,"");
      ck = "";
      panjangk = bk.length;
      j = 0;
      for (i = panjangk; i > 0; i--) 
      {
        j = j + 1;
        if (((j % 3) == 1) && (j != 1)) 
        {
          ck = bk.substr(i-1,1) + "." + ck;
          xk = bk;
        }else 
        {
          ck = bk.substr(i-1,1) + ck;
          xk = bk;
        }
      }
      return ck;

    }

    function hanya_angka(nilai) {
      bk = nilai.replace(/[^\d]/g,"");
      ck = "";
      panjangk = bk.length;
      j = 0;
      for (i = panjangk; i > 0; i--) 
      {

        ck = bk.substr(i-1,1) + ck;
        xk = bk;

      }
      return ck;
    }
    function formatNumber (num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
    }
    function error_timeout_ajax($param1){       
      swal({
        title: "Perhatian!",
        text: ($param1 ? $param1 : "Gagal Memuat Halaman, silahkan coba lagi atau periksa koneksi internet anda.."),
        type: "warning",
        confirmButtonColor: "#007AFF" 
      });
    }
  </script>
    <!-- page script -->
  <script>
    $(function () {

      //Initialize Select2 Elements
      $('.select2').select2()
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });

    $(document).ready(function () {
      bsCustomFileInput.init();
    });

    $(document).ready(function() {
        // Untuk sunting
        $('#update_bidang').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

            var id = div.data('id');
            var kode = div.data('kode_bidang');
            var nama = div.data('nama_bidang');
            var modal = $(this);

             // Isi nilai pada field
             modal.find('#id').attr("value", id);
             modal.find('#kode').attr("value", kode);
             modal.find('#nama').attr("value", nama);
           });
      });

    $(document).ready(function() {
        // Untuk sunting
        $('#update_jabatan').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

            var id = div.data('id');
            var jabatan = div.data('jabatan');
            var modal = $(this);

             // Isi nilai pada field
             modal.find('#id').attr("value", id);
             modal.find('#jabatan').attr("value", jabatan);
           });
      });

    $(document).ready(function() {
        // Untuk sunting
        $('#update_pangkat').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

            var id = div.data('id');
            var pangkat = div.data('pangkat');
            var golongan = div.data('golongan');
            var modal = $(this);

             // Isi nilai pada field
             modal.find('#id').attr("value", id);
             modal.find('#pangkat').attr("value", pangkat);
             modal.find('#golongan').attr("value", golongan);
           });
      });

    $(document).ready(function() {
        // Untuk sunting
        $('#update_pegawai').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

            var id = div.data('id');
            var nip = div.data('nip');
            var nama_pegawai = div.data('nama_pegawai');
            var pangkat = div.data('id_pangkat');
            var jabatan = div.data('id_jabatan');
            var modal = $(this);

             // Isi nilai pada field
             modal.find('#id').attr("value", id);
             modal.find('#nip').attr("value", nip);
             modal.find('#nama_pegawai').attr("value", nama_pegawai);
             modal.find("#pangkat option[value='" + pangkat + "']").attr("selected", "selected");
             modal.find("#jabatan option[value='" + jabatan + "']").attr("selected", "selected");
           });
      });

    $(document).ready(function() {
        // Untuk sunting
        $('#update_barang_masuk').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

            var id = div.data('id');
            var no_bukti = div.data('no_bukti');
            var barang = div.data('kode_barang');
            var supplier = div.data('nama_supplier');
            var jumlah_barang_masuk = div.data('jumlah_barang_masuk');
            var jumlah_barang_lama = div.data('jumlah_barang_lama');
            var tgl_masuk = div.data('tgl_masuk');
            var tgl_kadaluarsa = div.data('tgl_kadaluarsa');
            var satuan = div.data('satuan');
            var keterangan = div.data('keterangan');
            var modal = $(this);

             // Isi nilai pada field
             modal.find('#id').attr("value", id);
             modal.find('#no_bukti').attr("value", no_bukti);
             modal.find("#barang option[value='" + barang + "']").attr("selected", "selected");
             modal.find('#supplier').attr("value", supplier);
             modal.find('#jumlah_barang_masuk').attr("value", jumlah_barang_masuk);
             modal.find('#jumlah_barang_lama').attr("value", jumlah_barang_lama);
             modal.find('#tgl_masuk').attr("value", tgl_masuk);
             modal.find('#tgl_kadaluarsa').attr("value", tgl_kadaluarsa);
             modal.find('#satuan').attr("value", satuan);
             modal.find('#keterangan').attr("value", keterangan);

           });
      });

    $(document).ready(function() {
        // Untuk sunting
        $('#update_barang_keluar').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

            var id = div.data('id');
            var kode_barang = div.data('kode_barang');
            var quantity = div.data('quantity');
            var status = div.data('status');
            var modal = $(this);

             // Isi nilai pada field
             modal.find('#id').attr("value", id);
             modal.find('#kode_barang').attr("value", kode_barang);
             modal.find("#status option[value='" + status + "']").attr("selected", "selected");
             modal.find('#quantity').attr("value", quantity);

           });
      });

    $(document).ready(function() {
        // Untuk sunting
        $('#update_barang').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

            var kode = div.data('kode');
            var nama_barang = div.data('nama_barang');
            var jenis_barang = div.data('jenis_barang');
            var tgl_kadaluarsa = div.data('tgl_kadaluarsa');
            var satuan = div.data('satuan');
            var no_gudang = div.data('no_gudang');
            var modal = $(this);

             // Isi nilai pada field
             modal.find('#kode').attr("value", kode);
             modal.find('#nama_barang').attr("value", nama_barang);
             modal.find("#jenis_barang option[value='" + jenis_barang + "']").attr("selected", "selected");
             modal.find('#tgl_kadaluarsa').attr("value", tgl_kadaluarsa);
             modal.find('#satuan').attr("value", satuan);
             modal.find('#no_gudang').attr("value", no_gudang);

           });
      });

    $(document).ready(function() {
        // Untuk sunting
        $('#update_supplier').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

            var id = div.data('id');
            var supplier = div.data('nama_supplier');
            var modal = $(this);

             // Isi nilai pada field
             modal.find('#id').attr("value", id);
             modal.find('#supplier').attr("value", supplier);
           });
      });
    </script>
  </body>
</body>
</html>
