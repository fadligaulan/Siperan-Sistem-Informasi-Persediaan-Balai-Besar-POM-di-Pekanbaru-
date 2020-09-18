<div class="modal fade modal-approval" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?= $this->input->post('keterangan') ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url().'index.php/checkout/update'?>" method="post">
        <div class="text-center mb-3">
          <img class="profile-user-img img-fluid img-circle" src="<?= base_url().'assets/images/profile_user/user1-128x128.jpg' ?>" alt="User profile picture">
        </div>
        <div class="modal-body">
          <div id="modal_result"></div>
        </div>
      </form>
    </div>
  </div>
</div>


