<div wire:ignore.self id="modal" class="modal fade" id="modal-danger" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add / Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <p wire:loading wire:target="edit">
                    <i class="fa fa-spinner fa-spin" style="font-size:48px;color:rgb(48, 122, 241);"></i>
                </p>

                <form wire:loading.remove wire:target="edit" class="upsert">

                    <input type="hidden" id="pid" wire:model="pid" value="0">

                    <div class="form-group mb-3">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Enter Name" wire:model.lazy="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="name_dhiv">ނަން:</label>
                        <input type="text" class="form-control @error('name_dhiv') is-invalid @enderror"
                            id="name_dhiv" placeholder="ނަން" wire:model.lazy="name_dhiv">
                        @error('name_dhiv')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="d-grid gap-2">
                        <button wire:click.prevent="store()" class="btn btn-success btn-block">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
