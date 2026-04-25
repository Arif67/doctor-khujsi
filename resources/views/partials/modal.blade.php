<!-- Delete Confirmation Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-zoom modal-md modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      
      <div class="modal-header border-0">
        <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body text-center">
        <p class="mb-4">Are you sure you want to delete this item?</p>
        <div class="d-flex justify-content-between">
          <button type="button" class="btn btn-outline-secondary w-45" data-bs-dismiss="modal">Cancel</button>
          
          <form id="delete-link" action="" method="POST" class="w-45">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger w-100">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="reject-hospital-modal" tabindex="-1" aria-labelledby="rejectHospitalModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="rejectHospitalModalLabel">Reject Hospital Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="reject-hospital-form" action="" method="POST">
        <div class="modal-body">
          @csrf
          @method('PATCH')
          <div class="mb-3">
            <label for="reject_reason" class="form-label">Reject Reason</label>
            <textarea id="reject_reason" name="rejection_reason" class="form-control" rows="4" maxlength="1000" placeholder="Why this hospital is being rejected?" required></textarea>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Reject Account</button>
        </div>
      </form>
    </div>
  </div>
</div>
