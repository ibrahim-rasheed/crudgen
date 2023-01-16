<div>



    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif


    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Name Dhiv</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($model_data == null)
                    <tr>
                        <td colspan="3" align="center">
                            No post Found.
                        </td>
                    </tr>
                @elseif (count($model_data) > 0)
                    @foreach ($model_data as $item)
                        <tr>
                            <td>
                                {{ $item->id }}
                            </td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                {{ $item->name_dhiv }}
                            </td>
                            <td>
                                @if ($item->status == 'Active')
                                    <span class="badge badge-success">{{ $item->status }}</span>
                                @else
                                    <span class="badge badge-warning">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td>
                                <button data-toggle="modal" data-target="#modal" wire:click="edit({{ $item->id }})"
                                    wire:loading.attr="disabled" class="btn btn-primary btn-sm">Edit</button>
                                <button onclick="deletePost({{ $item->id }})"
                                    class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" align="center">
                            No post Found.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>



    <script>
        function deletePost(id) {
            if (confirm("Are you sure to delete this record?"))
                window.livewire.emit('deletePost', id);
        }
        document.addEventListener("DOMContentLoaded", () => {
            window.livewire.on('upsert', () => {
                $('#modal').modal('hide');
            });

            // clear form fields when bootstrap modal is closed
            $('#modal').on('hidden.bs.modal', function() {
                console.log('resetFields');
                $('.upsert').trigger('reset');
            });

        });
    </script>


    @include('livewire.{{ view_modal_path }}')



</div>
