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
