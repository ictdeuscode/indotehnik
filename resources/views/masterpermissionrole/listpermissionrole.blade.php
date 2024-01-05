<div>
    <div class="table-responsive">
        <table id="tabelMasterRole" class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 250px;">Role / Permission</th>
                    @foreach($masterRole as $role)
                    <th style="text-align: center;">
                        {{ $role->nama }}
                        <br>
                        <input type="checkbox" aria-label="" onclick="checkAll('{{$role->id}}', this)" @if($role->permissions->count()) checked @endif>
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($masterPermission as $index => $permission)
                <tr>
                    <td>{{ ucwords(str_replace("_", " ", $permission->nama)) }}</td>
                    @foreach($masterRole as $role)
                    <td>
                        <div class="form-check d-flex justify-content-center align-items-center">
                            <input class="form-check-input position-static" type="checkbox"
                                id="permission_{{ $role->id }}_{{ $permission->id }}"
                                @if ($permission->roles->contains($role->id)) checked @endif
                                onchange="togglePermission('{{ $permission->id }}','{{ $role->id }}')">
                        </div>
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('javascript-internal')
<script>
    function togglePermission(idPermission, idRole) {
        $.ajax({
            type: "POST",
            url: "{{ route('masterpermissionrole.togglePermission') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id_role": idRole,
                "id_permission": idPermission
            },
            success: function(result) {
                if (result.status) {
                    Swal.fire({
                        title: "Success !",
                        text: "Permission berhasil diubah !",
                        icon: "success"
                    });
                } else {
                    Swal.fire({
                        title: "Error !",
                        text: "Permission gagal diubah !",
                        icon: "error"
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: "Error !",
                    text: "Gagal mengubah data, silahkan hubungi admin !",
                    icon: "error"
                });
            }
        });
    }

    function checkAll(id_role, element)
    {
        var action = element.checked ? 'add' : 'remove';

        if(action == 'add')
        {
            $('input[id^="permission_'+id_role+'_"]').prop('checked', true);
        }
        else
        {
            $('input[id^="permission_'+id_role+'_"]').prop('checked', false);
        }

        $.ajax({
            url: "{{ route('masterpermissionrole.toggleCheckAllPermission') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id_role: id_role,
                action: action
            },
            success: function()
            {
                Swal.fire({
                    title: "Success !",
                    text: "Permission berhasil diubah !",
                    icon: "success"
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: "Error !",
                    text: "Gagal mengubah data, silahkan hubungi admin !",
                    icon: "error"
                });
            }
        });
    }
</script>
@endpush
