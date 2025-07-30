<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\Invitation;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    // index
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $users = User::all();

            $invitations = Invitation::where('is_used', 0)->get();

            $users = $users->merge($invitations);

            return DataTables::of($users)
                ->addIndexColumn()
                ->editColumn('name', function ($user) {
                    return $user->name ?? $user->email;
                })
                ->editColumn('status', function ($user) {
                    return view('components.labels.status', [
                        'status' => $user->status,
                    ]);
                })
                ->addColumn('action', function ($user) {
                    $actions = [
                        [
                            'label' => __('user.show'),
                            'onclick' => 'openInModal({ link: \'' . route('users.show', $user->id) . '\', size: \'md\' })',
                            'permission' => 'user-show'
                        ],
                        [
                            'label' => __('user.edit'),
                            'onclick' => 'openInModal({ link: \'' . route('users.edit', $user->id) . '\', size: \'md\' })',
                            'permission' => 'user-edit'
                        ],
                        [
                            'label' => __('user.change_password'),
                            'onclick' => 'openInModal({ link: \'' . route('users.change-password', $user->id) . '\', size: \'md\' })',
                            'permission' => 'user-change-password'
                        ],
                        [
                            'label' => __('user.delete'),
                            'onclick' => 'confirmDelete(\'' . route('users.destroy', $user->id) . '\')',
                            'permission' => 'user-delete'
                        ],
                    ];

                    // if user status is suspended
                    if ($user->status == 'suspended') {
                        $actions[] = [
                            'label' => __('user.activate'),
                            'onclick' => 'confirmAction({
                                url: \'' . route('users.activate', $user->id) . '\',
                                message: \'' . __('user.activate_confirm') .'\',
                            })',
                            'permission' => 'user-suspend'
                        ];
                    } else {
                        $actions[] =   [
                            'label' => __('user.suspend'),
                            'onclick' => 'confirmAction({
                                url: \'' . route('users.suspend', $user->id) . '\',
                                message: \'' . __('user.suspend_confirm') .'\',
                            })',
                            'permission' => 'user-suspend'
                        ];
                    }

                    if ($user->is_used == "0") {
                        $actions = [
                            [
                                'label' => __('Resend Invitation'),
                                'onclick' => 'openInModal({ link: \'' . route('invitation.edit', $user->id) . '\', size: \'md\' })',
                                'permission' => 'user-invitate'
                            ],
                        ];
                    }
                    return view('components.buttons.action', compact('actions'));
                })
                ->addColumn('status', function ($user) {
                    return view('pages.users._status', compact('user'));
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        $actions = [
            [
                'label' => __('user.create_user'),
                'onclick' => 'openInModal({ link: \'' . route('users.create') . '\', size: \'md\' })',
                'permission' => 'user-create'
            ],
            [
                'label' => __('user.invite_user'),
                'onclick' => 'openInModal({ link: \'' . route('invitation.create') . '\', size: \'md\' })',
                'permission' => 'user-invite'
            ]
        ];

        return view('pages.users.index', [
            'actions' => $actions
        ]);
    }

    //create
    public function create()
    {
        return view('pages.users.create');
    }

    //store
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => ['required', 'unique:users,email'],
        ]);

        User::firstOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'),
        ]);

        return response()->json([
            'message' => 'User created successfully.',
            'success' => true
        ]);
    }

    //edit
    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.users.edit', compact('user'));
    }

    //update
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => ['required', 'unique:users,email,' . $id],
        ]);

        User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json([
            'message' => 'User updated successfully.',
            'success' => true
        ], 200);
    }

    //destroy

    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['success' => 'User deleted successfully.']);
    }

    //show
    public function show($id)
    {
        $user = User::find($id);
        return view('pages.users.show', compact('user'));
    }

    // suspend
    public function suspend($id)
    {
        $user = User::find($id);
        $user->status = 'suspended';
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'User suspended successfully.'
        ]);
    }

    // activate
    public function activate($id)
    {
        $user = User::find($id);
        $user->status = 'active';
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'User activated successfully.'
        ]);
    }

    // changePassword
    public function changePassword()
    {
        return view('pages.users.change-password');
    }

    // updatePassword
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = auth()->user();
        if (!\Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'message' => 'Old password is not correct'
            ], 422);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'success' => 'Password updated successfully'
        ], 201);
    }
}
