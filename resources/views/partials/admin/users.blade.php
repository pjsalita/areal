
<table class="table m-0 table-striped table-hover table-sm table-responsive">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Type</th>
        <th scope="col">PRC ID</th>
        <th scope="col">PRC Verified</th>
        <th scope="col">Email Verified</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <th>{{ $user->id }}</th>
                <td class="text-capitalize">
                    <a href="{{ route('profile.show', $user->id) }}">
                        {{ $user->name }}
                    </a>
                </td>
                <td>{{ $user->email }}</td>
                <td class="text-capitalize">{{ $user->account_type }}</td>
                <td>
                    @if ($user->prc_id)
                        <a href="{{ Storage::url($user->prc_id) }}" target="_blank">
                            <i class="fa fa-external-link"></i>
                        </a>
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if ($user->prc_verified)
                        <form action="{{ route('admin.prc-unverify', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-0 btn">
                                <i class="fa fa-check text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to remove user's PRC ID verified status."></i>
                            </button>
                        </form>
                    @else
                        @if ($user->account_type === 'architect')
                            <form action="{{ route('admin.prc-verify', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-0 btn">
                                    <i class="fa fa-times text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to verify user's PRC ID."></i>
                                </button>
                            </form>
                        @else
                            N/A
                        @endif
                    @endif
                </td>
                <td>
                    @if ($user->email_verified_at)
                        <form action="{{ route('admin.unverify', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-0 btn">
                                <i class="fa fa-check text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to remove user's email address verified status."></i>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.verify', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-0 btn">
                                <i class="fa fa-times text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to verify user's email address."></i>
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
