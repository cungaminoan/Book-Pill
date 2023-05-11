@extends('layout.admin.master')

@section('content')
    <div class="flex flex-col">
        <div class="flex flex-row items-center justify-between mb-[1rem]">
            <form action="{{ route('admin.user.list') }}" method="GET" class="flex flex-row items-center w-[35%] justify-between">
                <input type="text" class="w-4/5 input_auth_username mb-[0] mr-[8px]" name="searchKey" placeholder="Username / Phone number / Email">

                <button class="button-action rounded font-bold">
                    <span>
                        Search
                    </span>
                </button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <td>
                        Username
                    </td>
                    <td>
                        Full name
                    </td>
                    <td>
                        Email
                    </td>
                    <td>
                        Phone number
                    </td>
                    <td>
                        Date of Birth
                    </td>
                    <td>
                        Status
                    </td>
                    <td>
                        Action
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach($userList as $user)
                    <tr>
                        <td>
                            {{ $user->username }}
                        </td>
                        <td>
                            {{ $user->full_name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->phone_number }}
                        </td>
                        <td>
                            {{ $user->date_of_birth }}
                        </td>
                        <td class="uppercase" id="status_user">
                            {{ $user->statusUser->status_user }}
                        </td>
                        <td>
                            <div class="flex flex-col items-center justify-center">
                                <a role="button" href="{{ route('admin.user.detail', ['id' => $user->id]) }}" class="btn btn-info text-center">
                                    <span>
                                        Info
                                    </span>
                                </a>
                                <div id="change_status_user" >
                                    @if($user->status == 1)
                                        <button class="btn btn-danger" onclick="changeStatusUser({{$user->id}}, 2)">
                                            <span>
                                                Disable
                                            </span>
                                        </button>
                                    @else
                                        <button class="btn btn-edit" onclick="changeStatusUser({{$user->id}}, 1)">
                                            <span>
                                                Active
                                            </span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function routeChangeStatusUser() {
            return "{{ route('admin.user.change_status') }}"
        }
    </script>
    <script src="{{ asset('assets/js/admin/user.js') }}"></script>
@endsection
